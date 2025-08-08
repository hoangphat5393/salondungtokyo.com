<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Backend\PostCategory;
use App\Models\Backend\Category;
use App\Http\Requests\StorePostCategoryRequest;
use App\Http\Requests\UpdatePostCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class PostCategoryController extends Controller
{
    public $data = [];
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Category::filter($request)
            ->where(['type' => 'post', 'parent' => 0])
            ->orderBy('sort', 'asc')->paginate(20)
            ->appends($request->all());

        $total_item = $data->count();

        return view('backend.post-category.index', compact('data', 'total_item'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.post-category.single');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostCategoryRequest $request)
    {
        $data = request()->except(['created_at', 'submit']);

        if ($request->slug) {
            $data['slug'] = addslashes($request->slug);
        } else {
            $data['slug'] = Str::slug($data['name']);
        }

        $data['name_en'] = $data['name_en'] ?? $data['name'];
        $data['seo_title'] = $data['seo_title'] ? $data['seo_title'] : $data['name'];

        // Category Type
        $data['type'] = 'post';

        // ADMIN ID
        $data['user_id'] = Auth::guard('admin')->user()->id;

        $response = Category::create($data);
        $insert_id = $response->id;

        // Update sort
        $response->update(['sort' => $insert_id]);

        $save = $request->submit ?? 'apply';

        if ($save == 'apply') {
            $msg = "Category has been created successfully";
            return redirect(route('admin.post-category.edit', array($insert_id)));
        } else {
            return redirect(route('admin.post-category.index'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PostCategory $postCategory, int $id)
    {
        $category = Category::find($id);
        return view('backend.work-category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PostCategory $postCategory, int $id)
    {
        // $this->data['category'] = Category::find($id);
        $category = Category::find($id);
        if ($category) {
            return view('backend.post-category.single', compact('category'));
            // return view('admin.post-category.single', ['data' => $this->data]);
        } else {
            return view('404');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostCategoryRequest $request, PostCategory $postCategory)
    {
        $data = request()->except(['created_at', 'submit', 'admin_id']);

        if ($request->slug) {
            $data['slug'] = addslashes($request->slug);
        } else {
            $data['slug'] = Str::slug($data['name']);
        }

        $data['name_en'] = $data['name_en'] ?? $data['name'];

        // id post
        $sid = $request->id ?? 0;

        $postCategory = Category::findOrFail($sid);
        $postCategory->update($data);

        $save = $request->submit ?? 'apply';

        if ($save == 'apply') {
            $msg = "Post category has been updated successfully";
            return redirect(route('admin.post-category.edit', array($sid)));
        } else {
            return redirect(route('admin.post-category.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostCategory $postCategory, int $id)
    {
        $postCategory->find($id)->destroy();
        return redirect()->route('admin.post-category.index')->with('success', 'Post category deleted successfully.');
    }
}
