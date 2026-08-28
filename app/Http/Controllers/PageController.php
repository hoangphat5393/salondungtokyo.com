<?php

namespace App\Http\Controllers;

use App\Models\Backend\Album;
use App\Models\Frontend\Page;
use App\Models\Frontend\Product;
use App\Traits\LocalizeController;
use Illuminate\Support\Facades\View;

class PageController extends Controller
{
    use LocalizeController;

    public $data = [];

    // $this->templatePath
    public function index()
    {
        $page = Page::where('slug', 'home')->first();
        if (! $page) {
            $page = new Page([
                'title' => 'Salon Dũng Tokyo - Đẳng Cấp Tạo Mẫu Tóc Chuyên Nghiệp',
                'name' => 'Trang chủ',
                'slug' => 'home',
            ]);
        }
        $this->data['page'] = $page;

        $this->data['services'] = Page::where('type', 'service')
            ->where('status', 1)
            ->orderBy('sort', 'asc')
            ->orderByDesc('id')
            ->take(8)
            ->get();

        $this->data['albums'] = Album::where('status', 1)
            ->with('albumItems')
            ->orderBy('sort', 'asc')
            ->take(8)
            ->get();

        $this->data['posts'] = Page::where('type', 'post')
            ->where('status', 1)
            ->latest()
            ->take(6)
            ->get();

        $this->data['seo'] = [
            'seo_title' => $page->seo_title ?: $page->title ?: 'Salon Dũng Tokyo - Đẳng Cấp Tạo Mẫu Tóc',
            'seo_image' => $page->image ?: setting_option('logo'),
            'seo_description' => $page->seo_description ?: setting_option('seo_description') ?: 'Salon Dũng Tokyo chuyên uốn, duỗi, nhuộm, cắt tạo kiểu tóc thời thượng hàng đầu.',
            'seo_keyword' => $page->seo_keyword ?: setting_option('seo_keyword') ?: 'salon dung tokyo, salon toc dep, mau toc hot',
        ];

        return view('frontend.home', $this->data);
    }

    public function page($slug)
    {
        if ($slug == 'home' || $slug == 'trang-chu') {
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
                'seo_description' => $page->seo_description ?? '',
                'seo_keyword' => $page->seo_keyword ?? '',
            ];

            $this->data['page'] = $page;
            if ($page->type == 'landing_page') {
                $templateName = 'frontend.landing.';
            } else {
                $templateName = 'frontend.page.';
            }

            $fileName = $templateName.$slug;
            // if (!file_exists(public_path($fileName))) {
            // }

            // dd($fileName);

            if (View::exists($fileName)) {
                return view($fileName, $this->data)->compileShortcodes();
            } else {
                $fileName = $templateName.'page-'.$page->id;

                if (View::exists($fileName)) {
                    return view($fileName, $this->data)->compileShortcodes();
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
