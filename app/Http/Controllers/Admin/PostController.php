<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Backend\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $posts = Post::filter($request)
            ->orderByDesc('sort')
            ->paginate(20)
            ->appends($request->all());

        $total_item = $posts->count();

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
    public function store(StorePostRequest $request)
    {
        $data = $request->except(['created_at', 'submit', 'category_id']);

        $data['type'] = 'post';

        if ($request->slug) {
            $data['slug'] = addslashes($request->slug);
        } else {
            $data['slug'] = Str::slug($data['name']);
        }

        $data['description'] = $data['description'] ? htmlspecialchars($data['description']) : '';
        $data['description_en'] = $data['description_en'] ? htmlspecialchars($data['description_en']) : '';
        $data['content'] = $data['content'] ? htmlspecialchars($data['content']) : '';
        $data['content_en'] = $data['content_en'] ? htmlspecialchars($data['content_en']) : '';

        $data['seo_title'] = $data['seo_title'] ? $data['seo_title'] : $data['name'];

        //xử lý gallery
        // $galleries = $request->gallery ?? '';
        // if ($galleries != '') {
        //     $galleries = array_filter($galleries);
        //     $data['gallery'] = $galleries ? serialize($galleries) : '';
        // }

        // ADMIN ID
        $data['user_id'] = Auth::guard('admin')->user()->id;

        // dd($data);
        $post = Post::create($data);
        $insert_id = $post->id;

        // Update sort
        $post->update(['sort' => $insert_id]);

        // SAVE CATEGORY
        $category_id = $request->category_id ?? [];
        $post->categories()->sync($category_id);

        $save = $request->submit ?? 'apply';
        if ($save == 'apply') {
            $msg = "Post has been created successfully";
            return redirect(route('admin.post.edit', array($insert_id)));
        } else {
            return redirect(route('admin.post.index'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post, int $id)
    {
        $post = $post::find($id);
        return view('backend.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post, int $id)
    {
        $post = $post::findorfail($id);

        if ($post) {
            return view('backend.post.single', compact('post'));
        } else {
            return view('404');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->except(['category_id', 'created_at', 'submit', 'user_id']);

        $data['type'] = 'post';

        if ($request->slug) {
            $data['slug'] = addslashes($request->slug);
        } else {
            $data['slug'] = Str::slug($data['name']);
        }

        $post = Post::findOrFail($request->id);
        $post->update($data);

        // SAVE CATEGORY
        $category_id = $request->category_id ?? '';

        if ($category_id != '') {
            $post->categories()->sync($category_id);
        }

        if ($request->submit_form == 'apply') {
            $msg = "Post has been updated successfully";
            // $url = route('admin.page.edit', $request->id);
            // Redirect to detail
            return redirect()->route('admin.post.edit', $request->id)->with('success', $msg);
        } else {
            return redirect(route('admin.post.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post, int $id)
    {
        $post->find($id)->destroy();
        return redirect()->route('admin.post.index')->with('success', 'Post deleted successfully.');
    }
}
