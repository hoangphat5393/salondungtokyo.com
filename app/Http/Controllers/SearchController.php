<?php

namespace App\Http\Controllers;

use App\Models\Frontend\Page;
use App\Traits\LocalizeController;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    use LocalizeController;

    public $data = [];

    public function index(Request $rq)
    {
        $keyword = $rq->input('keyword') ?: $rq->input('q');
        $this->data['keyword'] = $keyword;

        if ($keyword) {
            $this->data['news'] = Page::where('status', 1)
                ->where(function ($query) use ($keyword) {
                    $query->where('name', 'like', "%{$keyword}%")
                        ->orWhere('description', 'like', "%{$keyword}%")
                        ->orWhere('content', 'like', "%{$keyword}%");
                })
                ->paginate(9);
        } else {
            $this->data['news'] = Page::where('type', 'post')->where('status', 1)->latest()->paginate(9);
        }

        $this->data['seo'] = [
            'seo_title' => 'Tìm kiếm: '.($keyword ?: 'Tất cả').' | Salon Dũng Tokyo',
            'seo_image' => setting_option('logo'),
            'seo_description' => 'Kết quả tìm kiếm cho: '.$keyword,
            'seo_keyword' => $keyword,
        ];

        return view('frontend.news.index', $this->data);
    }
}
