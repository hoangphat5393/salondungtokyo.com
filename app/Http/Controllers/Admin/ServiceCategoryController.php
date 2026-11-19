<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Backend\Category;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ServiceCategoryController extends Controller
{
    public $data = [];

    /**
     * Valid columns in `categories` table.
     *
     * @var array<int, string>
     */
    protected array $categoryColumns = [
        'slug',
        'type',
        'name',
        'name_en',
        'description',
        'description_en',
        'content',
        'content_en',
        'icon',
        'image',
        'cover',
        'parent',
        'hot',
        'recommended',
        'sort',
        'status',
        'admin_id',
        'seo_title',
        'seo_keyword',
        'seo_description',
    ];

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
        }

        return view('backend.layouts.empty');
    }

    public function store(Request $request)
    {
        $data = $this->preparePayload($request);
        $data['admin_id'] = Auth::guard('admin')->user()->id ?? 1;

        $category = Category::create($data);

        if (empty($data['sort'])) {
            $category->update(['sort' => $category->id]);
        }

        $save = $request->submit ?? 'save';
        if ($save == 'apply') {
            return redirect()->route('admin.service-category.edit', $category->id)->with('success', __('Thêm danh mục dịch vụ thành công!'));
        }

        return redirect()->route('admin.service-category.index')->with('success', __('Thêm danh mục dịch vụ thành công!'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $data = $this->preparePayload($request, $category);

        $category->update($data);

        $save = $request->submit ?? 'save';
        if ($save == 'apply') {
            return redirect()->route('admin.service-category.edit', $id)->with('success', __('Cập nhật danh mục dịch vụ thành công!'));
        }

        return redirect()->route('admin.service-category.index')->with('success', __('Cập nhật danh mục dịch vụ thành công!'));
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.service-category.index')->with('success', __('Xóa danh mục dịch vụ thành công!'));
    }

    /**
     * Sanitize and whitelist fields for `categories` table.
     *
     * @return array<string, mixed>
     */
    protected function preparePayload(Request $request, ?Category $existing = null): array
    {
        $data = $request->only($this->categoryColumns);

        $name = $request->input('name') ?? $request->input('title') ?? ($existing?->name ?? '');
        $data['name'] = $name;

        if (! empty($request->slug)) {
            $data['slug'] = addslashes($request->slug);
        } else {
            $data['slug'] = Str::slug($name);
        }

        $data['seo_title'] = ! empty($data['seo_title']) ? $data['seo_title'] : $name;
        $data['seo_keyword'] = ! empty($data['seo_keyword']) ? $data['seo_keyword'] : $name;
        $data['seo_description'] = ! empty($data['seo_description'])
            ? $data['seo_description']
            : (! empty($data['description']) ? Str::limit(strip_tags($data['description']), 160) : '');

        return $data;
    }
}
