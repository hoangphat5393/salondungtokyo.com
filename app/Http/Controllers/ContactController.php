<?php

namespace App\Http\Controllers;

use App\Models\Frontend\Contact;
use App\Models\Frontend\EmailTemplate;
use App\Traits\LocalizeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Lunaweb\RecaptchaV3\Facades\RecaptchaV3;

class ContactController extends Controller
{
    use LocalizeController;

    public $data = [
        'error' => false,
        'success' => false,
        'message' => '',
    ];

    public function index()
    {
        $this->localized();

        $seo = [
            'seo_title' => 'Liên Hệ & Đặt Lịch Hẹn | '.setting_option('webtitle', 'Salon Dũng Tokyo'),
            'seo_keyword' => 'lien he salon dung tokyo, dat lich lam toc, dia chi salon dung tokyo',
            'seo_description' => 'Liên hệ Salon Dũng Tokyo để được tư vấn các mẫu tóc thời thượng và đặt lịch làm tóc chuyên nghiệp phong cách Nhật Bản & Hàn Quốc.',
            'seo_image' => get_image(setting_option('logo')),
        ];

        return view('frontend.contact.index', [
            'data' => $this->data,
            'seo' => $seo,
        ]);
    }

    public function submit(Request $request)
    {
        $detail = $request->input('contact');
        if (! is_array($detail) || empty($detail)) {
            $detail = $request->only(['name', 'email', 'address', 'phone', 'content', 'date', 'time', 'type']);
        }

        $shouldReturnJson = $request->expectsJson() || $request->wantsJson() || $request->ajax();

        // Validation rules
        $validator = Validator::make($detail, [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|min:9|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:255',
            'content' => 'required|string|min:5|max:2000',
        ], [
            'name.required' => 'Vui lòng nhập họ và tên!',
            'name.max' => 'Họ và tên không được vượt quá 255 ký tự.',
            'phone.required' => 'Vui lòng cung cấp số điện thoại!',
            'phone.min' => 'Số điện thoại tối thiểu 9 số.',
            'email.email' => 'Địa chỉ email không đúng định dạng!',
            'content.required' => 'Vui lòng nhập nội dung lời nhắn!',
            'content.min' => 'Nội dung lời nhắn tối thiểu 5 ký tự.',
        ]);

        if ($validator->fails()) {
            $errorMessage = $validator->errors()->first();

            if ($shouldReturnJson) {
                return response()->json([
                    'status' => 'error',
                    'message' => $errorMessage,
                    'errors' => $validator->errors(),
                ], 422);
            }

            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Xác định loại liên hệ
        $contactType = ! empty($detail['type']) ? $detail['type'] : 'contact';

        // ReCaptcha (chỉ kích hoạt trên production khi có secret, an toàn trên local theo chuẩn dự án)
        $score = 1.0;
        $recaptchaSecret = config('recaptchav3.secret');
        if (! empty($recaptchaSecret) && app()->environment('production')) {
            $recaptchaToken = $request->get('g-recaptcha-response');
            if (! empty($recaptchaToken) && class_exists('Lunaweb\RecaptchaV3\Facades\RecaptchaV3')) {
                try {
                    $verified = RecaptchaV3::verify($recaptchaToken, 'contact');
                    $score = is_numeric($verified) ? (float) $verified : 0.0;
                } catch (\Throwable $e) {
                    report($e);
                    $score = 1.0;
                }
            } else {
                $score = 0.0;
            }
        }

        if ($score < 0.3) {
            $botMsg = 'Hệ thống phát hiện hành vi bất thường, vui lòng thử lại sau.';
            if ($shouldReturnJson) {
                return response()->json([
                    'status' => 'error',
                    'message' => $botMsg,
                ], 400);
            }

            return redirect()->back()->withErrors($botMsg)->withInput();
        }

        // Ghép thêm thông tin ngày/giờ hẹn vào nội dung nếu có (dành cho form đặt lịch)
        $fullContent = trim($detail['content'] ?? '');
        if (! empty($detail['date'])) {
            $fullContent = '[Ngày hẹn: '.$detail['date'].(! empty($detail['time']) ? ' - Khung giờ: '.$detail['time'] : '').'] '.$fullContent;
        }

        // Lưu dữ liệu vào Database
        $data = [
            'name' => trim($detail['name'] ?? ''),
            'email' => trim($detail['email'] ?? ''),
            'address' => trim($detail['address'] ?? ''),
            'phone' => trim($detail['phone'] ?? ''),
            'content' => $fullContent,
            'type' => $contactType,
            'status' => 0,
            'ip_address' => $request->ip(),
        ];

        try {
            $contact = Contact::create($data);
            if ($contact && $contact->id) {
                Contact::where('id', $contact->id)->update(['sort' => $contact->id]);
            }
        } catch (\Throwable $e) {
            Log::error('Contact Save Error: '.$e->getMessage());
        }

        // Xử lý gửi Mail thông báo tới Admin & Khách hàng
        try {
            $mail_customer = null;
            if (class_exists('App\Models\Frontend\EmailTemplate')) {
                $mail_customer = EmailTemplate::where('status', 1)->first();
            }
            $mail_content = $mail_customer?->text ?? '';

            if ($mail_content !== '') {
                $dataFind = [
                    '/\{\{\$name\}\}/',
                    '/\{\{\$email\}\}/',
                    '/\{\{\$address\}\}/',
                    '/\{\{\$phone\}\}/',
                    '/\{\{\$content\}\}/',
                ];
                $mail_content = preg_replace($dataFind, $data, $mail_content);
            } else {
                $typeLabel = $contactType === 'booking' ? 'Đặt lịch hẹn' : 'Liên hệ';
                $mail_content = '<h3>Thông tin liên hệ mới từ website Salon Dũng Tokyo:</h3>'
                    .'<p><strong>Loại:</strong> '.$typeLabel.'</p>'
                    .'<p><strong>Họ tên:</strong> '.e($data['name']).'</p>'
                    .'<p><strong>Số điện thoại:</strong> '.e($data['phone']).'</p>'
                    .'<p><strong>Email:</strong> '.e($data['email']).'</p>'
                    .'<p><strong>Địa chỉ:</strong> '.e($data['address']).'</p>'
                    .'<p><strong>Nội dung:</strong> '.nl2br(e($data['content'])).'</p>';
            }

            $webTitle = setting_option('webtitle', 'Salon Dũng Tokyo');
            $adminEmail = setting_option('email_admin', config('mail.from.address', 'contact@salondungtokyo.vn'));
            $fromMail = [$adminEmail ?: 'contact@salondungtokyo.vn', $webTitle];
            $typeTitle = $contactType === 'booking' ? 'Đăng ký đặt lịch hẹn' : 'Đăng ký tư vấn / Liên hệ';
            $subject = $webTitle.' - '.$typeTitle.' ('.date('Y-m-d H:i:s').')';

            if (! empty($data['email'])) {
                Mail::send([], [], function ($message) use ($data, $fromMail, $subject, $mail_content) {
                    $message->from($fromMail[0], $fromMail[1])
                        ->to($data['email'])
                        ->subject($subject)
                        ->html($mail_content);
                });
            }

            if (! empty($adminEmail)) {
                Mail::send([], [], function ($message) use ($fromMail, $adminEmail, $subject, $mail_content) {
                    $message->from($fromMail[0], $fromMail[1])
                        ->to($adminEmail)
                        ->subject($subject)
                        ->html($mail_content);
                });
            }
        } catch (\Throwable $e) {
            Log::error('Contact mail send error: '.$e->getMessage());
        }

        $redirectUrl = route('contact.completed');

        if ($shouldReturnJson) {
            return response()->json([
                'status' => 'success',
                'message' => 'Gửi thông tin liên hệ thành công!',
                'redirect' => $redirectUrl,
                'data' => $data,
            ]);
        }

        return redirect()->to($redirectUrl)->with('contact_name', $data['name']);
    }

    public function completed(Request $request)
    {
        $this->localized();

        return view('frontend.contact.completed', [
            'seo' => [
                'seo_title' => 'Hoàn Tất Liên Hệ | '.setting_option('webtitle', 'Salon Dũng Tokyo'),
                'seo_keyword' => 'hoan tat lien he salon dung tokyo',
                'seo_description' => 'Cảm ơn quý khách đã gửi thông tin liên hệ tới Salon Dũng Tokyo.',
                'seo_image' => get_image(setting_option('logo')),
            ],
        ]);
    }
}
