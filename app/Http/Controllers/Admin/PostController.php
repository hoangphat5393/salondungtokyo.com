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
        $data = $request->except(['created_at', 'submit', 'category_id', '_token']);

        $name = $data['name'] ?? $request->input('title') ?? '';
        $data['name'] = $name;

        if (! empty($request->slug)) {
            $data['slug'] = addslashes($request->slug);
        } else {
            $data['slug'] = Str::slug($name);
        }

        $data['seo_title'] = ! empty($data['seo_title']) ? $data['seo_title'] : $name;
        $data['seo_keyword'] = ! empty($data['seo_keyword']) ? $data['seo_keyword'] : $name;
        $data['seo_description'] = ! empty($data['seo_description']) ? $data['seo_description'] : (! empty($data['description']) ? Str::limit(strip_tags($data['description']), 160) : '');

        $data['type'] = 'post';
        $data['user_id'] = Auth::guard('admin')->user()->id ?? 1;

        $post = Page::create($data);

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
        $post = Page::where('type', 'post')->findOrFail($id);

        return view('backend.post.show', compact('post'));
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
        $data = $request->except(['category_id', 'created_at', 'submit', 'admin_id', '_token', '_method']);

        $name = $data['name'] ?? $request->input('title') ?? $post->name;
        $data['name'] = $name;

        if (! empty($request->slug)) {
            $data['slug'] = addslashes($request->slug);
        } else {
            $data['slug'] = Str::slug($name);
        }

        $data['seo_title'] = ! empty($data['seo_title']) ? $data['seo_title'] : $name;
        $data['seo_keyword'] = ! empty($data['seo_keyword']) ? $data['seo_keyword'] : $name;
        $data['seo_description'] = ! empty($data['seo_description']) ? $data['seo_description'] : (! empty($data['description']) ? Str::limit(strip_tags($data['description']), 160) : '');

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
}
