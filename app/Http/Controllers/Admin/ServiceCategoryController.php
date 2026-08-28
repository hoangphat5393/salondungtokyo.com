<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Backend\Category;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceCategoryController extends Controller
{
    public $data = [];

    public function __construct()
    {
        $this->data['title_head'] = __('Danh mục Dịch vụ Salon');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $categories = Category::where(['parent' => 0])->orderBy('sort', 'asc')->paginate(20);
        $total_item = $categories->total();
        $childrenMap = Category::orderBy('sort', 'asc')->get()->groupBy('parent');

        return view('backend.service-category.index', compact('categories', 'total_item', 'childrenMap'));
    }

    public function create()
    {
        $childrenMap = Category::where('status', 1)->orderBy('sort', 'asc')->get()->groupBy('parent');

        return view('backend.service-category.single', ['data' => $this->data, 'childrenMap' => $childrenMap]);
    }

    public function edit($id)
    {
        $this->data['category'] = Category::find($id);
        if ($this->data['category']) {
            $childrenMap = Category::where('status', 1)->orderBy('sort', 'asc')->get()->groupBy('parent');

            return view('backend.service-category.single', ['data' => $this->data, 'category' => $this->data['category'], 'childrenMap' => $childrenMap]);
        } else {
            return view('backend.layouts.empty');
        }
    }

    public function store(Request $request)
    {
        $data = $request->except(['created_at', 'submit']);

        if (! empty($request->slug)) {
            $data['slug'] = addslashes($request->slug);
        } else {
            $data['slug'] = Str::slug($data['name']);
        }

        $data['seo_title'] = ! empty($data['seo_title']) ? $data['seo_title'] : $data['name'];
        $data['seo_keyword'] = ! empty($data['seo_keyword']) ? $data['seo_keyword'] : $data['name'];
        $data['seo_description'] = ! empty($data['seo_description']) ? $data['seo_description'] : (! empty($data['description']) ? Str::limit(strip_tags($data['description']), 160) : '');

        Category::create($data);

        return redirect()->route('admin.service-category.index')->with('success', __('Thêm danh mục dịch vụ thành công!'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $data = $request->except(['created_at', 'submit']);

        if (! empty($request->slug)) {
            $data['slug'] = addslashes($request->slug);
        } else {
            $data['slug'] = Str::slug($data['name']);
        }

        $data['seo_title'] = ! empty($data['seo_title']) ? $data['seo_title'] : $data['name'];
        $data['seo_keyword'] = ! empty($data['seo_keyword']) ? $data['seo_keyword'] : $data['name'];
        $data['seo_description'] = ! empty($data['seo_description']) ? $data['seo_description'] : (! empty($data['description']) ? Str::limit(strip_tags($data['description']), 160) : '');

        $category->update($data);

        return redirect()->route('admin.service-category.index')->with('success', __('Cập nhật danh mục dịch vụ thành công!'));
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.service-category.index')->with('success', __('Xóa danh mục dịch vụ thành công!'));
    }
}
