<?php

namespace App\Http\Controllers;

use Carbon\Carbon, Cart, Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Frontend\Category;
use Gornymedia\Shortcodes\Facades\Shortcode;
use App\Models\Frontend\Page as Page;

class PageController extends Controller
{
    use \App\Traits\LocalizeController;

    public $data = [];

    // $this->templatePath
    public function index()
    {
        // $this->localized();
        $page = Page::where('slug', 'home')->first();
        $this->data['page'] = $page;


        $this->data['categories'] = Category::where('status', 1)
            ->where('type', 'product')
            ->where('parent', 0)
            ->orderby('sort', 'asc')
            ->get();

        // $this->data['products'] = \App\Product::orderbyDesc('id')->limit(5)->get();

        // $this->data['flash_sale'] = (new Product)->FlashSale();

        $this->data['page'] = $page;

        $this->data['seo'] = [
            'seo_title' => $page->seo_title ?? '',
            'seo_image' => $page->image ?? '',
            'seo_description'   => $page->seo_description ?? '',
            'seo_keyword'   => $page->seo_keyword ?? '',
        ];

        // return view($this->templatePath . '.home', $this->data)->compileShortcodes();
        return view('frontend.home', $this->data)->compileShortcodes();
    }

    public function page($slug)
    {
        // $this->localized();
        if ('home' == $slug || 'trangchu' == $slug) {
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
            $templateName = $this->templatePath . '.page.' . $slug;

            if (View::exists($templateName)) {
                return view($templateName,  $this->data)->compileShortcodes();
            } else {
                return view($this->templatePath . '.page.index', ['data' => $this->data])->compileShortcodes();
            }
        } else {
            return view('errors.404');
        }
    }

    // public function product($slug)
    // {
    //     return \App::call('App\Http\Controllers\ProductController@index',  [
    //         "slug" => $slug
    //     ]);
    // }

    // public function about($slug)
    // {
    //     return \App::call('App\Http\Controllers\AboutController@index',  [
    //         "slug" => $slug
    //     ]);
    // }

    public function listLocation()
    {
        $data = array(
            'mienbac'   => 'Miền Bắc',
            'mientrung'   => 'Miền Trung',
            'miennam'   => 'Miền Nam'
        );
        return $data;
    }
}
