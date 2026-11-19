<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ExportPage;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Models\Backend\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class PageController extends Controller
{
    public $data = [];

    /**
     * Valid columns in `pages` table (aligned with vattunongnghiep58 & 3nong).
     *
     * @var array<int, string>
     */
    protected array $pageColumns = [
        'slug',
        'name',
        'description',
        'content',
        'icon',
        'image',
        'seo_title',
        'seo_keyword',
        'seo_description',
        'type',
        'sort',
        'status',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pages = Page::filter($request)->where(['type' => 'page'])
            ->orderByDesc('id')
            ->orderByDesc('name')
            ->orderBy('sort', 'asc')
            ->paginate(50)
            ->appends($request->all());

        $total_item = $pages->total();

        return view('backend.page.index', compact('pages', 'total_item'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.page.single');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePageRequest $request)
    {
        $data = $this->preparePayload($request);
        $data['type'] = 'page';
        $data['user_id'] = Auth::guard('admin')->user()->id ?? 1;

        $response = Page::create($data);
        $insert_id = $response->id;

        if (empty($data['sort'])) {
            $response->update(['sort' => $insert_id]);
        }

        $fileName = "page-{$insert_id}.blade.php";
        $filePath = resource_path("views/frontend/page/{$fileName}");

        if (! File::exists($filePath)) {
            $fileContent = "@extends('frontend.layouts.master')\n\n@section('content')\n<h1>{$response->name}</h1>\n{$response->content}\n@endsection";
            File::ensureDirectoryExists(resource_path('views/frontend/page'));
            File::put($filePath, $fileContent);
        }

        $save = $request->submit ?? 'apply';
        if ($save == 'apply') {
            return redirect()->route('admin.page.edit', $insert_id)->with('success', __('Thêm trang thành công!'));
        }

        return redirect(route('admin.page.index'))->with('success', __('Thêm trang thành công!'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page, $id)
    {
        $page->findOrFail($id);

        return redirect()->route('admin.page.edit', $id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page, $id)
    {
        $page = $page->findOrFail($id);

        return view('backend.page.single', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePageRequest $request, $id)
    {
        $pageId = $id ?: $request->input('id');
        $page = Page::findOrFail($pageId);

        $data = $this->preparePayload($request, $page);
        $page->update($data);

        $save = $request->submit ?? $request->submit_form ?? 'apply';
        if ($save == 'apply') {
            return redirect()->route('admin.page.edit', $page->id)->with('success', __('Cập nhật trang thành công!'));
        }

        return redirect(route('admin.page.index'))->with('success', __('Cập nhật trang thành công!'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page, $id)
    {
        $page->findOrFail($id)->delete();

        return redirect()->route('admin.page.index')->with('success', __('Xóa trang thành công!'));
    }

    public function export()
    {
        return Excel::download(new ExportPage, 'test.xlsx');
    }

    /**
     * Sanitize and whitelist fields for `pages` table (prevents Unknown column 'template' / 'title').
     *
     * @return array<string, mixed>
     */
    protected function preparePayload(Request $request, ?Page $existing = null): array
    {
        $data = $request->only($this->pageColumns);

        $name = $request->input('name') ?? $request->input('title') ?? ($existing?->name ?? '');
        $data['name'] = $name;

        if (! empty($request->slug)) {
            $data['slug'] = addslashes($request->slug);
        } else {
            $data['slug'] = Str::slug($name);
        }

        $data['seo_title'] = ! empty($data['seo_title']) ? $data['seo_title'] : $name;

        return $data;
    }
}
