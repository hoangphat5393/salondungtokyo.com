<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Backend\LandingPage;
use App\Http\Requests\StoreLandingPageRequest;
use App\Http\Requests\UpdateLandingPageRequest;
use App\Models\Backend\Page;
use Auth, DB, File, Image;

class LandingPageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(Request $request)
    {
        $landing_pages = Page::filter($request)->where(['type' => 'landing_page'])
            ->orderBydesc('id')
            ->orderBydesc('name')
            ->orderBy('sort', 'asc')
            ->paginate(50)
            ->appends($request->all());

        $total_item = $landing_pages->count();
        return view('backend.landing-page.index', compact('landing_pages', 'total_item'));
    }


    public function create()
    {
        return view('backend.landing-page.single');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLandingPageRequest $request)
    {
        $data = $request->except(['created_at', 'submit', 'category_id']);

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

        // ADMIN ID
        $data['user_id'] = Auth::guard('admin')->user()->id;

        $data['type'] = 'landing_page';

        $response = Page::create($data);
        $insert_id = $response->id;

        // Update sort
        $response->update(['sort' => $insert_id]);


        // Tạo file blade
        $fileName = "page-{$insert_id}.blade.php";
        $filePath = resource_path("views/frontend/landing/{$fileName}");

        // Kiểm tra nếu file đã tồn tại, nếu chưa có thì tạo file
        if (!File::exists($filePath)) {

            // Nội dung mặc định trong file
            $fileContent = "@extends('frontend.layouts.master')\n\n@section('content')\n<h1>{$response->name}</h1>\n{$response->content}\n@endsection";

            // dd($fileName, $filePath, $fileContent);

            // Tạo thư mục nếu chưa tồn tại
            File::ensureDirectoryExists(resource_path('views/frontend/landing'));

            // Ghi nội dung vào file
            File::put($filePath, $fileContent);
        }


        $save = $request->submit ?? 'apply';
        if ($save == 'apply') {
            $msg = "landing page has been created successfully";
            // $url = route('admin.landing-page.edit', array($insert_id));
            return redirect(route('admin.landing-page.edit', array($insert_id)));
        } else {
            return redirect(route('admin.landing-page.index'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $landing_page, int $id)
    {
        $landing_page = $landing_page::find($id);
        return view('backend.landing-page.show', compact('landing_page'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $landing_page, int $id)
    {
        $landing_page = Page::where('id', $id)->first();

        if ($landing_page) {
            return view('backend.landing-page.single')->with(['landing_page' => $landing_page]);
        } else {
            return view('404');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLandingPageRequest $request, Page $landing_pages)
    {
        $data = request()->except(['created_at', 'submit', 'tab_lang', 'custom_field']);

        if ($request->slug) {
            $data['slug'] = addslashes($request->slug);
        } else {
            $data['slug'] = Str::slug($data['name']);
        }

        $data['seo_title'] = $data['seo_title'] ? $data['seo_title'] : $data['name'];

        $data['type'] = 'landing_page';

        $save = $request->submit ?? 'apply';

        // ADMIN ID
        // $data['admin_id'] = Auth::guard('admin')->user()->id;


        $landing_pages = Page::findOrFail($request->id);
        $landing_pages->update($data);


        $save = $request->submit ?? 'apply';
        if ($save == 'apply') {
            $msg = "Landing Page has been Updated";
            return redirect(route('admin.landing-page.edit', array($request->id)));
        } else {
            return redirect(route('admin.landing-page.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $landing_page, int $id)
    {
        $landing_page->find($id)->destroy();
        return redirect()->route('admin.landing-page.index')->with('success', 'Landing Page deleted successfully.');
    }
}
