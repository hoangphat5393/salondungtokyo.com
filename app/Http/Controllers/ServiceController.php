<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\NewsCategory;
use App\Service;
use App\Traits\LocalizeController;

class ServiceController extends Controller
{
    use LocalizeController;

    public $data = [];

    // All categories
    public function index($slug = '')
    {
        // All category
        // $categories = Category::where(['status' => 1, 'type' => 'post', 'parent' => 0])->get();

        // All news
        $services = Service::where('status', 1)
            ->orderbyDesc('sort')
            ->paginate(10);

        // Lastest news
        // $feature_news = Service::where('status', 1)
        //     ->orderbyDesc('id')
        //     ->limit(1)
        //     ->get();

        // default data
        // $this->data['categories'] = $categories;
        $this->data['services'] = $services;

        // extra data
        // $this->data['feature_news'] = $feature_news;

        // dd($slug);
        // if has slug then get single category data
        if ($slug) {
            return $this->categoryDetail($slug);
        }

        return view('theme.service.index', $this->data)->compileShortcodes();
    }

    // Single category
    public function categoryDetail($slug)
    {
        $category = NewsCategory::where('slug', $slug)->first();

        if ($category) {
            $this->data['category'] = $category;
            $this->data['category_child'] = $category->children();

            $this->data['news'] = $news = $category->posts()
                ->where('status', 1)
                ->orderbyDesc('created_at')
                ->orderbyDesc('id')
                ->paginate(6);

            $this->data['seo'] = [
                'seo_title' => $category->seo_title != '' ? $category->seo_title : $category->name,
                'seo_image' => $category->image,
                'seo_description' => $category->seo_description ?? '',
                'seo_keyword' => $category->seo_keyword ?? '',
            ];
            // return view($this->templatePath . '.news.index', $this->data);

            // Nếu chỉ có 1 bài viết thì điều hướng tới bài vô bài viết đó luôn
            // if ($news->count() == 1) {
            //     return $this->newsDetail($news->first()->slug);
            // }
            return view('theme.news.category', $this->data)->compileShortcodes();
        } else {
            return view('errors.404');
        }
        // return $this->newsDetail($slug);
    }

    // Service detail
    public function show($slug)
    {
        $service = Service::where('slug', $slug)->first();

        // dd($service);

        // All category
        // $categories = Category::where(['status' => 1, 'type' => 'service', 'parent' => 0])->get();

        // default data
        // $this->data['categories'] = $categories;
        $this->data['service'] = $service;

        // Recently news
        // $this->data['recently_news'] = $tintuc->news()
        //     ->where('status', 1)
        //     ->where('id', '<>', $news->id)
        //     ->limit(4)
        //     ->orderby('created_at', 'desc')
        //     ->get();

        // Latest news
        // $this->data['latest_news'] = $tintuc->news()
        //     ->where('status', 1)
        //     ->where('id', '<>', $news->id)
        //     ->limit(4)
        //     ->orderby('id', 'desc')
        //     ->get();

        // Related News
        // $this->data['related_news'] = $tintuc->news()
        //     ->where('status', 1)
        //     ->where('id', '<>', $news->id)
        //     ->limit(4)
        //     ->get();

        $this->data['seo'] = [
            'seo_title' => $service->seo_title != '' ? $service->seo_title : $service->name,
            'seo_image' => $service->image,
            'seo_description' => $service->seo_description ?? '',
            'seo_keyword' => $service->seo_keyword ?? '',
        ];

        return view('theme.service.single', $this->data)->compileShortcodes();
    }
}
