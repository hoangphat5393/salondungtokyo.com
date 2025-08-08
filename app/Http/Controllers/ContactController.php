<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;
use App\Models\EmailTemplate;
use App\Models\Contact;
use Validator;
use Lunaweb\RecaptchaV3\Facades\RecaptchaV3;

class ContactController extends Controller
{
    use \App\Traits\LocalizeController;

    public $data = [
        'error' => false,
        'success' => false,
        'message' => ''
    ];

    public function index()
    {
        $this->localized();
        $this->data['page'] = \App\Page::where('slug', 'contact')->first();
        // return view($this->templatePath . '.contact.index', ['data' => $this->data]);
        return view('theme.page.contact', ['data' => $this->data]);
    }

    public function show()
    {
        $this->localized();
        $this->data['page'] = \App\Page::where('slug', 'contact')->first();
        // return view($this->templatePath . '.contact.index', ['data' => $this->data]);
        return view('theme.contact.index', ['data' => $this->data]);
    }

    public function confirmation(Request $rq)
    {
        $this->localized();
        $detail = $rq->input('contact');
        if ($detail) {
            $this->data['data'] = $detail;
            // return view($this->templatePath . '.contact.confirmation', $this->data)->compileShortcodes();
            return view($this->templatePath . '.contact.confirmation', $this->data);
        }
    }

    public function getContact(Request $request, $type)
    {
        if ($type == 'request-contact') {
            $this->data['status'] = 'success';
            $this->data['type'] = $type;
            $this->data['url_current'] = $request->url_current;
            $this->data['product_title'] = $request->product_title;
            $this->data['view'] = view('theme.page.includes.get-contact-form', ['data' => $this->data])->render();
        }
        return response()->json($this->data);
    }

    public function submit(Request $request)
    {
        $detail = $request->input('contact', false);

        $score = RecaptchaV3::verify($request->get('g-recaptcha-response'), 'contact');


        if ($score > 0.7 && $detail) {

            $this->data['data'] = $detail;

            $mail_customer = EmailTemplate::where('group', 'contact_admin')->first();
            $mail_content = $mail_customer->text;

            $data = array(
                'name' => htmlspecialchars($detail['name']),
                // 'address' => $detail['address'],
                'email' => htmlspecialchars($detail['email']),
                'phone' => htmlspecialchars($detail['phone']),
                'content' => htmlspecialchars($detail['content']),
            );

            // Mail content
            $dataFind = [
                '/\{\{\$name\}\}/',
                // '/\{\{\$address\}\}/',
                '/\{\{\$email\}\}/',
                '/\{\{\$phone\}\}/',
                '/\{\{\$content\}\}/',
            ];
            $mail_content = preg_replace($dataFind, $data, $mail_content);

            // Save contact
            $data['type'] = 'contact';

            // Get IP address
            $data['ip_address'] = $request->ip();

            $respons = Contact::create($data);
            $insert_id = $respons->id;

            Contact::where("id", $insert_id)->update(['sort' => $insert_id]);

            // if (app()->getLocale() == 'vi') {
            //     $sub = setting_option('company_name_vi');
            //     $from_mail = [setting_option('smtp-from-address'), setting_option('company_name_vi') ?? ''];
            // } else {
            //     $sub = setting_option('company_name');
            //     $from_mail = [setting_option('smtp-from-address'), setting_option('company_name') ?? ''];
            // }

            $sub = setting_option('webtitle');
            $from_mail = [setting_option('email_admin'), setting_option('webtitle') ?? ''];

            $subject = $sub . 'Đăng ký tư vấn' . ' (' . date('Y-m-d H:i:s') . ')';

            // dd((new Mail));

            // Email thông báo gửi khách hàng
            Mail::send(
                [],
                [],
                function ($message) use ($data, $from_mail, $subject, $mail_content) {
                    $message->from($from_mail[0])
                        ->to($data['email'])
                        ->subject($subject)
                        ->html(htmlspecialchars_decode($mail_content));
                }
            );

            // Thông báo tới admin, có khách hàng liên hệ
            $sendToAdmin = [setting_option('email_admin')];

            // Email test
            $test_mail = setting_option('email_test');
            if ($test_mail)
                array_push($sendToAdmin, $test_mail);

            Mail::send(
                [],
                [],
                function ($message) use ($data, $from_mail, $sendToAdmin, $subject, $mail_content) {
                    $message->from($from_mail[0])
                        ->to($sendToAdmin)
                        ->subject($subject)
                        ->html(htmlspecialchars_decode($mail_content));
                }
            );

            $this->data['status'] = 'success';
            $this->data['message'] = 'Register Successfully';

            return response()->json($this->data);
            // return redirect()->route('contact_completed')->with('contact_name', $detail['name']);

        } elseif ($score > 0.3) {
            $this->data['status'] = 'error';
            $this->data['message'] = 'require additional email verification';
            return response()->json($this->data);
        } else {
            $this->data['status'] = 'error';
            $this->data['message'] = 'You are most likely a bot';
            return response()->json($this->data);
        }
    }

    public function completed(Request $request)
    {
        return view('theme.contact.completed');
        // $this->localized();
        // $detail = $request->all();
        // if ($detail) {
        //     $this->data['data'] = $detail;
        //     return view($this->templatePath . '.contact.completed', $this->data)->compileShortcodes();
        // } else {
        //     return redirect('/');
        // }
    }
}
