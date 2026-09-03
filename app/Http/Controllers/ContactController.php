<?php

namespace App\Http\Controllers;

use App\Models\Frontend\Contact;
use App\Traits\LocalizeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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

        return view('frontend.contact.index', ['data' => $this->data]);
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
            'date' => 'nullable|string|max:50',
            'content' => 'nullable|string|max:2000',
        ], [
            'name.required' => 'Vui lòng nhập họ và tên của bạn!',
            'name.max' => 'Họ và tên không được vượt quá 255 ký tự.',
            'phone.required' => 'Vui lòng cung cấp số điện thoại liên hệ!',
            'phone.min' => 'Số điện thoại tối thiểu 9 số.',
            'email.email' => 'Địa chỉ email không đúng định dạng!',
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

        // Loại liên hệ
        $contactType = ! empty($detail['type']) ? $detail['type'] : 'booking';

        // ReCaptcha (chỉ kích hoạt trên production khi có secret)
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

        // Ghép thêm thông tin ngày/giờ hẹn vào nội dung nếu có
        $fullContent = trim($detail['content'] ?? '');
        if (! empty($detail['date'])) {
            $fullContent = '[Ngày hẹn: '.$detail['date'].(! empty($detail['time']) ? ' - Khung giờ: '.$detail['time'] : '').'] '.$fullContent;
        }

        // Lưu dữ liệu vào Database
        $data = [
            'name' => trim($detail['name'] ?? ''),
            'email' => trim($detail['email'] ?? ''),
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

        $successMsg = 'Cảm ơn quý khách! Đội ngũ Salon Dũng Tokyo đã nhận thông tin lịch hẹn và sẽ liên hệ xác nhận sau 5 phút.';

        if ($shouldReturnJson) {
            return response()->json([
                'status' => 'success',
                'message' => $successMsg,
                'data' => $data,
            ]);
        }

        return redirect()->route('contact.completed')->with('success', $successMsg);
    }

    public function completed(Request $request)
    {
        return view('frontend.contact.completed');
    }
}
