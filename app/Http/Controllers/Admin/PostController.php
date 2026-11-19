<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Models\Backend\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
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
        $posts = Page::filter($request)
            ->where('type', 'post')
            ->orderByDesc('sort')
            ->orderByDesc('id')
            ->paginate(20)
            ->appends($request->all());

        $total_item = $posts->total();

        return view('backend.post.index', compact('posts', 'total_item'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.post.single');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePageRequest $request)
    {
        $data = $this->preparePayload($request);
        $data['type'] = 'post';
        $data['user_id'] = Auth::guard('admin')->user()->id ?? 1;

        $post = Page::create($data);

        if (empty($data['sort'])) {
            $post->update(['sort' => $post->id]);
        }

        $save = $request->submit ?? 'save';
        if ($save == 'apply') {
            return redirect()->route('admin.post.edit', $post->id)->with('success', __('Thêm bài viết thành công!'));
        }

        return redirect()->route('admin.post.index')->with('success', __('Thêm bài viết thành công!'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        Page::where('type', 'post')->findOrFail($id);

        return redirect()->route('admin.post.edit', $id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Page::where('type', 'post')->findOrFail($id);

        return view('backend.post.single', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePageRequest $request, string $id)
    {
        $post = Page::where('type', 'post')->findOrFail($id);
        $data = $this->preparePayload($request, $post);
        $data['type'] = 'post';

        $post->update($data);

        $save = $request->submit ?? 'save';
        if ($save == 'apply') {
            return redirect()->route('admin.post.edit', $id)->with('success', __('Cập nhật bài viết thành công!'));
        }

        return redirect()->route('admin.post.index')->with('success', __('Cập nhật bài viết thành công!'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Page::where('type', 'post')->findOrFail($id);
        $post->delete();

        return redirect()->route('admin.post.index')->with('success', __('Xóa bài viết thành công!'));
    }

    /**
     * Sanitize and whitelist fields for `pages` table (prevents Unknown column 'title' / 'name_en').
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

        $data['description'] = ! empty($data['description']) ? htmlspecialchars($data['description']) : '';
        $data['content'] = ! empty($data['content']) ? htmlspecialchars($data['content']) : '';
        $data['seo_title'] = ! empty($data['seo_title']) ? $data['seo_title'] : $name;
        $data['seo_keyword'] = ! empty($data['seo_keyword']) ? $data['seo_keyword'] : $name;
        $data['seo_description'] = ! empty($data['seo_description'])
            ? $data['seo_description']
            : (! empty($data['description']) ? Str::limit(strip_tags(htmlspecialchars_decode($data['description'])), 160) : '');

        return $data;
    }
}
