<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;
use App\Models\EmailTemplate;
use App\Models\Contact;
use App\Models\Service;

class SetupController extends Controller
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
        $this->data['service'] = Service::where('status', 1)->orderbydesc('sort')->get();
        return view('theme.setup.index', $this->data);
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

    // public function getContact(Request $request, $type)
    // {
    //     if ($type == 'request-contact') {
    //         $this->data['status'] = 'success';
    //         $this->data['type'] = $type;
    //         $this->data['url_current'] = $request->url_current;
    //         $this->data['product_title'] = $request->product_title;
    //         $this->data['view'] = view('theme.page.includes.get-contact-form', ['data' => $this->data])->render();
    //     }
    //     return response()->json($this->data);
    // }

    public function submit(Request $rq)
    {
        $detail = $rq->input('contact', false);

        if ($detail) {

            $this->data['data'] = $detail;

            $mail_customer = EmailTemplate::where('group', 'contact_setup')->first();

            $mail_content = $mail_customer->text;

            $data = array(
                'name' => $detail['name'],
                'phone' => $detail['phone'],
                'status' => $detail['status'],
                'content' => $detail['content'],
            );

            // Mail content
            $dataFind = [
                '/\{\{\$name\}\}/',
                '/\{\{\$phone\}\}/',
                '/\{\{\$status\}\}/',
                '/\{\{\$content\}\}/',
            ];
            $mail_content = preg_replace($dataFind, $data, $mail_content);


            // Save contact
            $data['type'] = 'setup';

            unset($data['status']);

            $respons = Contact::create($data);
            $insert_id = $respons->id;

            // if sort = 0 => update sort = id
            Contact::where("id", $insert_id)->update(['sort' => $insert_id]);

            $sub = setting_option('webtitle');
            $from_mail = [setting_option('email_admin'), setting_option('webtitle') ?? ''];

            $subject = $sub . 'Đăng ký tư vấn' . ' (' . date('Y-m-d H:i:s') . ')';
            $sendToAdmin = setting_option('email_admin');

            // email thông báo gửi khách hàng

            // Mail::send(
            //     [],
            //     [],
            //     function ($message) use ($data, $from_mail, $subject, $mail_content) {
            //         $message->from($from_mail[0])
            //             ->to($data['email'])
            //             ->subject($subject)
            //             ->html(htmlspecialchars_decode($mail_content));
            //         // ->text('html');
            //     }
            // );

            // dd($mail_content);

            // Thông báo tới admin, có khách hàng liên hệ
            $sendToAdmin = setting_option('email_admin');


            Mail::send(
                [],
                [],
                function ($message) use ($data, $from_mail, $sendToAdmin, $subject, $mail_content) {
                    $message->from($from_mail[0])
                        ->to($sendToAdmin)
                        ->subject($subject)
                        ->html(htmlspecialchars_decode($mail_content));
                    // ->text('html');
                }
            );

            return redirect()->route('setup_completed')->with('contact_name', $detail['name']);

            // return view($this->templatePath . '.contact.completed', $this->data);
        }
    }

    public function completed(Request $request)
    {
        return view($this->templatePath . '.setup.completed');
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
