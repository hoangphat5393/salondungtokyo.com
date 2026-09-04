<?php

namespace App\Http\Controllers;

use App\Models\Frontend\Page;
use App\Traits\LocalizeController;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    use LocalizeController;

    public $data = [];

    // All news / posts
    public function index($slug = '')
    {
        $this->data['news'] = Page::where('type', 'post')
            ->where('status', 1)
            ->orderBy('sort', 'asc')
            ->orderByDesc('created_at')
            ->paginate(9);

        $this->data['seo'] = [
            'seo_title' => 'Xu Hướng Tóc & Tin Tức | Salon Dũng Tokyo',
            'seo_image' => setting_option('logo'),
            'seo_description' => 'Cập nhật tin tức, xu hướng tạo mẫu tóc và bí quyết chăm sóc tóc đẹp từ Salon Dũng Tokyo.',
            'seo_keyword' => 'tin tuc toc, xu huong mau toc, cham soc toc',
        ];

        return view('frontend.news.index', $this->data);
    }

    // News detail
    public function newsDetail($slug, $id = null)
    {
        $post = Page::where('type', 'post')
            ->where('status', 1)
            ->where(function ($query) use ($slug, $id) {
                if ($id) {
                    $query->where('id', $id);
                } else {
                    $query->where('slug', $slug);
                }
            })
            ->firstOrFail();

        $this->data['post'] = $post;
        $this->data['related_posts'] = Page::where('type', 'post')
            ->where('status', 1)
            ->where('id', '<>', $post->id)
            ->latest()
            ->take(3)
            ->get();

        $this->data['seo'] = [
            'seo_title' => $post->seo_title ?: $post->name,
            'seo_image' => $post->image ?: setting_option('logo'),
            'seo_description' => $post->seo_description ?: Str::limit(strip_tags($post->description ?: $post->content), 150),
            'seo_keyword' => $post->seo_keyword ?? '',
        ];

        return view('frontend.news.detail', $this->data);
    }

    public function show($slug)
    {
        return $this->newsDetail($slug);
    }
}
