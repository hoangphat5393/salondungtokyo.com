<?php

namespace App\Http\Controllers;

use Carbon\Carbon, Cart, Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Gornymedia\Shortcodes\Facades\Shortcode;
use App\Models\Backend\Category;
use App\Models\Frontend\Page;
use App\Models\Frontend\Product;

class PageController extends Controller
{
    use \App\Traits\LocalizeController;

    public $data = [];

    // $this->templatePath
    public function index()
    {
        $page = Page::where('slug', 'home')->first();
        $this->data['page'] = $page;

        // $this->data['categories'] = Category::where('status', 1)
        //     ->where(['type' => 'product', 'parent' => 0])
        //     ->orderby('sort', 'asc')
        //     ->get();

        // $this->data['products'] = \App\Models\Frontend\Product::orderbyDesc('id')->limit(5)->get();

        // $this->data['flash_sale'] = (new Product)->FlashSale();

        $this->data['page'] = $page;


        $this->data['seo'] = [
            'seo_title' =>  $page->seo_title ?? $page->title,
            'seo_image' => $page->image,
            'seo_description' => $page->seo_description ?? '',
            'seo_keyword' => $page->seo_keyword ?? '',
        ];

        return view('frontend.home', $this->data)->compileShortcodes();
    }

    public function page($slug)
    {
        if ('home' == $slug || 'trang-chu' == $slug) {
            return $this->index();
        }

        // $this->data['listLocation'] = $this->listLocation();

        $page = Page::where(['slug' => $slug, 'status' => 1])->first();

        if ($page) {
            // if ($page->template == 'project')
            //     return $this->project($slug);

            // if ($slug == 'about')
            //     return $this->about($slug);

            // if ($slug == 'product')
            //     return $this->product($slug);

            $this->data['seo'] = [
                'seo_title' => $page->seo_title != '' ? $page->seo_title : $page->title,
                'seo_image' => $page->image,
                'seo_description'   => $page->seo_description ?? '',
                'seo_keyword'   => $page->seo_keyword ?? '',
            ];

            $this->data['page'] = $page;
            if ($page->type == 'landing_page') {
                $templateName = 'frontend.landing.';
            } else
                $templateName =  'frontend.page.';


            $fileName = $templateName . $slug;
            // if (!file_exists(public_path($fileName))) {
            // }

            // dd($fileName);

            if (View::exists($fileName)) {
                return view($fileName,  $this->data)->compileShortcodes();
            } else {
                $fileName = $templateName . 'page-' . $page->id;

                if (View::exists($fileName)) {
                    return view($fileName,  $this->data)->compileShortcodes();
                } else {
                    return view('frontend.page.index', ['data' => $this->data])->compileShortcodes();
                }
            }
        } else {
            // return view('errors.404');
            return redirect(route('index'));
        }
    }

    public function testPage()
    {
        return view('frontend.test')->compileShortcodes();
    }

    // public function product($slug)
    // {
    //     return \App::call('App\Http\Controllers\ProductController@index',  [
    //         "slug" => $slug
    //     ]);
    // }

    // public function listLocation()
    // {
    //     $data = array(
    //         'mienbac'   => 'Miền Bắc',
    //         'mientrung'   => 'Miền Trung',
    //         'miennam'   => 'Miền Nam'
    //     );
    //     return $data;
    // }
}
