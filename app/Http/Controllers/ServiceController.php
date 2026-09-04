<?php

namespace App\Http\Controllers;

use App\Models\Frontend\Page;
use App\Traits\LocalizeController;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    use LocalizeController;

    public $data = [];

    // All services
    public function index($slug = '')
    {
        $this->data['services'] = Page::where('type', 'service')
            ->where('status', 1)
            ->orderBy('sort', 'asc')
            ->orderByDesc('id')
            ->paginate(12);

        $this->data['seo'] = [
            'seo_title' => 'Dịch Vụ & Bảng Giá | Salon Dũng Tokyo',
            'seo_image' => setting_option('logo'),
            'seo_description' => 'Bảng giá dịch vụ làm tóc, uốn, duỗi, nhuộm, phục hồi tóc chuyên nghiệp tại Salon Dũng Tokyo.',
            'seo_keyword' => 'bang gia salon dung tokyo, dich vu lam toc, uon toc, nhuom toc',
        ];

        return view('frontend.service.index', $this->data);
    }

    // Service detail
    public function show($slug, $id = null)
    {
        $service = Page::where('type', 'service')
            ->where('status', 1)
            ->where(function ($query) use ($slug, $id) {
                if ($id) {
                    $query->where('id', $id);
                } else {
                    $query->where('slug', $slug);
                }
            })
            ->first();

        if (! $service) {
            return redirect()->route('service');
        }

        $this->data['service'] = $service;
        $this->data['seo'] = [
            'seo_title' => $service->seo_title ?: $service->name,
            'seo_image' => $service->image ?: setting_option('logo'),
            'seo_description' => $service->seo_description ?: Str::limit(strip_tags($service->description ?: $service->content), 150),
            'seo_keyword' => $service->seo_keyword ?? '',
        ];

        return view('frontend.service.index', $this->data);
    }
}
