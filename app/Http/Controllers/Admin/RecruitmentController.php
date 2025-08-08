<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Backend\Recruitment;
use Auth, DB, File, Image, Config;

class RecruitmentController extends Controller
{
    public $data = [];
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(Request $request)
    {
        // $appends = [
        //     'category_id' => request('category_id'),
        //     'search_name' => request('search_name'),
        // ];
        // if (Auth::guard('admin')->user()->admin_level == 99999) {
        //     $db = Recruitment::select('*');

        //     if (request('search_name') != '') {
        //         $db->where('name', 'like', '%' . request('search_name') . '%');
        //     }
        //     $count_item = $db->count();
        //     $data_post = $db->orderByDesc('id')->paginate(20)->appends($appends);
        // } else {
        //     $data_post = Recruitment::where('admin_id', '=', Auth::guard('admin')->user()->id)
        //         ->orderByDesc('id')
        //         ->paginate(20)
        //         ->appends($appends);
        //     $count_item = Recruitment::where('admin_id', '=', Auth::guard('admin')->user()->id)
        //         ->count();
        // }

        $data = Recruitment::filter($request)
            ->orderByDesc('id')
            ->paginate(20)
            ->appends($request->all());

        $count_item = $data->count();

        return view('backend.recruitment.index')->with(['data' => $data, 'total_item' => $count_item]);
    }

    public function create()
    {
        return view('backend.recruitment.single', $this->data);
    }

    public function edit($id)
    {
        $this->data['contact'] = Recruitment::find($id);
        if ($this->data['contact']) {
            return view('backend.recruitment.single', $this->data);
        } else {
            return view('404');
        }
    }

    public function post(Request $request)
    {
        $data = request()->except(['_token',  'gallery', 'category_id', 'created_at', 'submit', 'tab_lang', 'custom_field']);

        // id post
        $sid = $request->id ?? 0;

        $data['slug'] = addslashes($request->slug);
        // if ($data['slug'] == '') **
        $data['slug'] = Str::slug($data['name']);

        // $slug = addslashes($data['slug']);
        if (empty($slug) || $slug == '')
            $slug = Str::slug($data['name']);

        $data['description'] = $data['description'] ? htmlspecialchars($data['description']) : '';
        $data['content'] = $data['content'] ? htmlspecialchars($data['content']) : '';
        $data['seo_title'] = $data['seo_title'] ? $data['seo_title'] : $data['name'];

        //xử lý gallery
        $galleries = $request->gallery ?? '';
        if ($galleries != '') {
            $galleries = array_filter($galleries);
            $data['gallery'] = $galleries ? serialize($galleries) : '';
        }
        //end xử lý gallery

        // $data['admin_id'] = Auth::guard('admin')->user()->id;

        $save = $request->submit ?? 'apply';

        if ($sid > 0) {
            $post_id = $sid;
            $respons = Recruitment::where("id", $sid)->update($data);
        } else {
            $respons = Recruitment::create($data);
            $insert_id = $respons->id;
            $post_id = $insert_id;

            // if sort = 0 => update sort
            Recruitment::where("id", $post_id)->update(['sort' => $post_id]);
        }

        // SAVE CATEGORY
        $category_id = $request->category_id ?? '';
        if ($category_id != '') {
            $product = Recruitment::find($post_id);
            $product->categories()->sync($category_id);
        }

        if ($save == 'apply') {
            // $msg = "Post has been Updated";
            // $url = route('admin.postEdit', array($post_id));
            // Helpers::msg_move_page($msg, $url);
            return redirect(route('admin.postEdit', array($post_id)));
        } else {
            return redirect(route('admin.postList'));
        }
    }
}
