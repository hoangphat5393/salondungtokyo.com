<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Backend\Setting;
use App\Models\Backend\Addtocard;
use App\Models\Backend\User;
use App\Models\Backend\Menu, App\Models\Backend\MenuItems;
use Auth, DB, File, Image, Redirect, Cache, Hash, Exception;
// use App\Exports\CustomerExport, App\Exports\OrderExport, App\Exports\ProductExport;
// use Maatwebsite\Excel\Facades\Excel;
// use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Averages\Mean;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {}

    public $data = [];

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function error()
    {
        return view('errors.404')->compileShortcodes();
    }
    public function changePassword()
    {
        return view('backend.change-password')->compileShortcodes();
    }

    public function userDetail($id)
    {
        $user = User::find($id);

        return view('backend.users.detail', ['user' => $user])->compileShortcodes();
    }

    public function deleteUser($id)
    {
        //$loadDelete = User::find($id)->delete();

        //delete products
        // $productDelete = Theme::all();
        // if($loadDelete){
        //   foreach($productDelete as $value){
        //     if($value->admin_id==$id){
        //             $value->delete();
        //         }
        //     }
        // }

        // $msg = "Customer account has been Delete";
        // $url = route('admin.listUsers');
        return redirect(route('admin.listUsers'));
        // Helpers::msg_move_page($msg, $url);
    }

    public function postChangePassword(Request $rq)
    {
        $user = Auth::guard('admin')->user();
        $id = $user->id;
        $current_pass = $user->password;

        if ($rq->check_pass_value == 'off') {

            //no change pass
            $data = array(
                'email' => $rq->email,
                'name' => $rq->name,
                'phone' => $rq->phone,
                'address' => $rq->address,
            );
        } else {

            //change pass
            if (Hash::check($rq->current_password, $user->password)) {
                if ($rq->new_password == $rq->confirm_password) {
                    $data = array(
                        'email' => $rq->email,
                        'name' => $rq->name,
                        'password' => bcrypt($rq->new_password),
                        'phone' => $rq->phone,
                        'address' => $rq->address,
                    );
                } else {
                    $msg = 'Mật khẩu xác nhận không trùng khớp';
                    return Redirect::back()->withErrors($msg);
                }
            } else {
                $msg = 'Mật khẩu hiện tại không chính xác';
                return Redirect::back()->withErrors($msg);
            }
        }

        User::where("id", "=", $id)->update($data);;
        return redirect(route('admin.change-password'));
    }

    public function listUsers()
    {
        $data_user = User::get();
        return view('backend.users.index')->with(['data_user' => $data_user])->compileShortcodes();
    }

    public function getThemeOption()
    {
        return view('backend.setting.theme-option')->compileShortcodes();
    }

    public function postThemeOption(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $data_option = $data['header_option'];
        $i = 0;
        $list_option = [];
        // dd($data_option);
        if ($data_option) {
            foreach ($data_option as $key => $option) {
                $type = $key;
                foreach ($option['name'] as $index => $item) {
                    $content = htmlspecialchars($option['value'][$index]);
                    if ($type == 'editor')
                        $content = htmlspecialchars($content);
                    $option_db = Setting::updateOrCreate(
                        [
                            'name'  => $item
                        ],
                        [
                            'content'   => $content,
                            'type'   => $type,
                            'sort'   => $i,
                        ]
                    );
                    $list_option[] = $option_db->id;
                    $i++;
                }
            }
        }
        //delete;
        Setting::whereNotIn('id', $list_option)->delete();
        Cache::forget('theme_option');
        // $msg = "Option has been registered";
        // $url = route('admin.theme-option');
        return redirect(route('admin.theme-option'));
    }

    public function getCSS()
    {
        // $scssPath = resource_path('sass/user_custom.scss');
        $cssPath = public_path('assets/css/user_custom.css');

        // Đọc nội dung file custom.scss
        $scssContent = file_exists($cssPath) ? file_get_contents($cssPath) : '';

        return view('backend.setting.theme-css', compact('scssContent'));
    }

    public function updateCSS(Request $request)
    {

        // $scssPath = resource_path('sass/user_custom.scss');
        $cssPath = public_path('assets/css/user_custom.css');

        // Lưu nội dung mới vào file user_custom.scss
        file_put_contents($cssPath, $request->input('css_content'));

        // Chạy lệnh npm run prod
        // $process = new Process(['npm', 'run', 'prod']);
        // $process->setWorkingDirectory(base_path()); // Đảm bảo chạy trong thư mục gốc của dự án Laravel
        // $process->run();

        // // Kiểm tra nếu có lỗi khi chạy lệnh npm
        // if (!$process->isSuccessful()) {
        //     throw new ProcessFailedException($process);
        // }

        // Chuyển hướng lại trang edit với thông báo thành công
        return redirect()->route('admin.css.get')->with('success', 'SCSS file updated and compiled successfully!');
    }

    public function ajaxUpdateSort(Request $request)
    {
        $sort = $request->input('sort');

        if ($sort) {
            // Xử lý logic cập nhật thứ tự các mục theo yêu cầu
            // Ví dụ: Lưu thứ tự mới vào cơ sở dữ liệu
            foreach ($sort as $index => $id) {
                // Cập nhật thứ tự cho từng mục, giả sử bạn có model Setting
                Setting::find($id)->update(['sort' => $index]);
            }
            return response()->json(['Update success' => true]);
        } else {
            return response('404 data Not Found');
        }
    }
}
