<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Libraries\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductPromotion;
use App\Jobs\ProcessImportData;
use Auth, DB, File, Image, Config;
use function Aws\filter;

class ProductController extends Controller
{

    public $list_promotion;
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

    public function index()
    {
        $appends = [
            'category_id' => request('category_id'),
            'search_name' => request('search_name'),
        ];
        if (Auth::guard('admin')->user()->admin_level == 99999) {

            $db = Product::select('*');
            if (request('category_id')) {
                $db->join('category_product', 'id', 'product_id');
                $db->where('category_id', request('category_id'));
            }

            if (request('search_name') != '') {
                $db->where('name', 'like', '%' . request('search_name') . '%');
            }

            $count_item = $db->count();
            $data_product = $db->orderByDesc('sort')->paginate(40)->appends($appends);
        } else {
            $data_product = Product::where('admin_id', '=', Auth::guard('admin')->user()->id)
                ->orderByDesc('sort')
                ->paginate(40)
                ->appends($appends);
            $count_item = Product::where('admin_id', '=', Auth::guard('admin')->user()->id)
                ->count();
        }
        return view('admin.product.index')->with(['data' => $data_product, 'total_item' => $count_item]);
    }

    public function create()
    {
        $data['variables_selected'] = [];
        $data['listUnit'] = $this->listUnit();

        return view('admin.product.single', $data);
    }

    public function edit($id)
    {
        $listUnit = $this->listUnit();

        $product_detail = Product::find($id);

        if ($product_detail) {
            return view('admin.product.single', compact('product_detail', 'listUnit'));
        } else {
            return view('404');
        }
    }

    public function post(Request $rq)
    {
        $data = request()->except(['_token',  'gallery', 'variable', 'category_id', 'created_at', 'submit', 'category_item', 'tab_lang', 'custom_field']);

        //id post
        $sid = $rq->id ?? 0;

        $data['slug'] = addslashes($rq->slug);
        // if ($data['slug'] == '') **
        $data['slug'] = Str::slug($data['name']);

        // $slug = addslashes($data['slug']);
        if (empty($slug) || $slug == '')
            $slug = Str::slug($data['name']);

        $data['price'] = $rq->price ? str_replace(',', '', $rq->price) : 0;

        $data['description'] = $rq->description ? htmlspecialchars($rq->description) : '';
        $data['content'] = $rq->content ? htmlspecialchars($rq->content) : '';
        $data['seo_title'] = $data['seo_title'] ? $data['seo_title'] : $data['name'];

        //lang
        $tab_langs = $rq->tab_lang ?? '';
        if (is_array($tab_langs)) {
            foreach ($tab_langs as $key => $lang) {
                $title_lang = 'name_' . $lang;
                $description = 'description_' . $lang;
                $content = 'content_' . $lang;

                $data['description_' . $lang] = $rq->$title_lang ? $rq->$title_lang : '';
                $data['description_' . $lang] = $rq->$description ? htmlspecialchars($rq->$description) : '';
                $data['content_' . $lang] = $rq->$content ? htmlspecialchars($rq->$content) : '';
            }
        }

        //xử lý gallery
        $galleries = $rq->gallery ?? '';
        if ($galleries != '') {
            $galleries = array_filter($galleries);
            $data['gallery'] = $galleries ? serialize($galleries) : '';
        }
        //end xử lý gallery

        $data['sort'] = $rq->sort ? addslashes($rq->sort) : 0;
        $data['admin_id'] = Auth::guard('admin')->user()->id;

        $save = $rq->submit ?? 'apply';

        if ($sid > 0) {
            $post_id = $sid;
            $respons = Product::where("id", $sid)->update($data);
        } else {
            $respons = Product::create($data);
            $id_insert = $respons->id;
            $post_id = $id_insert;

            // if sort = 0 => update sort
            Product::where("id", $post_id)->update(['sort' => $post_id]);

            // $db = Product::find(1);
            // $db->sort = $post_id;
            // $db->save();
        }

        // SAVE CATEGORY
        $category_id = $rq->category_id ?? '';

        if ($category_id != '') {
            $product = Product::find($post_id);
            $product->categories()->sync($category_id);
        }

        if ($save == 'apply') {
            $msg = "Product has been Updated";
            $url = route('admin.productEdit', array($post_id));
            Helpers::msg_move_page($msg, $url);
        } else {
            return redirect(route('admin.productList'));
        }
    }

    public function listUnit()
    {
        $unit = ['Unit', 'K', '1M', '1 Coin'];
        if (setting_option('price_unit')) {
            // $unit = array_map('trim', explode(',', setting_option('price_unit')));
            $unit = explode(',', setting_option('price_unit'));
        }
        return $unit;
    }

    public function import()
    {
        return view('admin.product.import');
    }
    public function importProcess()
    {
        if (request()->hasFile('file_input')) {
            $file = request()->file('file_input');
            $name = "excel-" . time() . '-' . $file->getClientOriginalName();
            $name = str_replace(' ', '-', $name);
            $url_folder_upload = "/excel-file/";
            $url_full_path = $url_folder_upload . $name;
            $file->move(public_path() . $url_folder_upload, $name);

            $importJob = new ProcessImportData('/public/' . $url_folder_upload . $name);
            $importJob->delay(\Carbon\Carbon::now()->addSeconds(3));
            dispatch($importJob);
            return view('admin.product.import', ['success' => 'File Excel của bạn sẽ được hoàn tất sau 2 phút!']);
        }
    }
}
