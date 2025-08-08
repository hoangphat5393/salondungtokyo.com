<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NewsCategory, App\Models\Work, App\Page;
use App\Category;
use DB;

class WorksController extends Controller
{

    public $data = [];

    // All categories
    public function index($slug = '')
    {
        // All works
        // $works = Work::where('status', 1)->orderbyDesc('sort')->orderbyDesc('name')->paginate(10);
        $works = Work::where('status', 1)->orderbyDesc('sort')->orderbyDesc('name')->get();
        $categories = Category::where(['status' => 1, 'type' => 'work'])->get();

        // Lastest news
        // $feature_news = Work::where('status', 1)
        //     ->orderbyDesc('id')
        //     ->limit(1)
        //     ->get();

        // default data
        $this->data['categories'] = $categories;
        $this->data['works'] = $works;

        // extra data
        // $this->data['feature_news'] = $feature_news;

        // dd($slug);
        // if has slug then get single category data
        if ($slug) {
            return $this->categoryDetail($slug);
        }

        return view('theme.works.index', $this->data)->compileShortcodes();
    }

    // Single category
    public function categoryDetail($slug)
    {
        $category = Category::where('slug', $slug)->first();

        if ($category) {
            $this->data['category'] = $category;

            $this->data['category_child'] = $category->children();

            $this->data['works'] = $work = $category->works()
                ->where('status', 1)
                ->orderbyDesc('sort')
                ->orderbyDesc('name')
                ->paginate(6);

            $this->data['seo'] = [
                'seo_title' => $category->seo_title != '' ? $category->seo_title : $category->name,
                'seo_image' => $category->image,
                'seo_description'   => $category->seo_description ?? '',
                'seo_keyword'   => $category->seo_keyword ?? '',
            ];
            // return view($this->templatePath . '.news.index', $this->data);

            // Nếu chỉ có 1 bài viết thì điều hướng tới bài vô bài viết đó luôn
            // if ($work->count() == 1) {
            //     return $this->newsDetail($work->first()->slug);
            // }
            return view('theme.works.category', $this->data)->compileShortcodes();
        } else
            return view('errors.404');
        // return $this->newsDetail($slug);
    }

    // News detail
    public function show($slug)
    {
        $work = Work::where('slug', $slug)->first();

        // All category
        // $categories = Category::where(['status' => 1, 'type' => 'post', 'parent' => 0])->get();

        // default data
        // $this->data['categories'] = $categories;
        $this->data['work'] = $work;

        $this->data['seo'] = [
            'seo_title' => $work->seo_title != '' ? $work->seo_title : $work->name,
            'seo_image' => $work->image,
            'seo_description'   => $work->seo_description ?? '',
            'seo_keyword'   => $work->seo_keyword ?? '',
        ];


        return view('theme.works.single', $this->data)->compileShortcodes();
    }
}
