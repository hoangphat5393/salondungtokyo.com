<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Backend\Page;
use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Libraries\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class PageController extends Controller
{
    public $data = [];

    public $page_type = ['post', 'page'];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pages = Page::filter($request)->orderByDesc('sort')->where('type', 'page')->paginate(20)->appends($request->all());

        $total_item = $pages->count();

        return view('backend.page.index', compact('pages', 'total_item'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.page.single', ['page_type' => $this->page_type]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePageRequest $request)
    {
        $data = $request->except(['created_at', 'submit']);

        if ($request->slug) {
            $data['slug'] = addslashes($request->slug);
        } else {
            $data['slug'] = Str::slug($data['name']);
        }
        $data['seo_title'] = $data['seo_title'] ? $data['seo_title'] : $data['name'];

        $data['type'] = 'page';

        // ADMIN ID
        $data['user_id'] = Auth::guard('admin')->user()->id;

        // dd($data);
        $response = Page::create($data);
        $insert_id = $response->id;

        // Update sort
        $response->update(['sort' => $insert_id]);

        $save = $request->submit ?? 'apply';

        if ($save == 'apply') {
            return redirect(route('admin.page.edit', $insert_id));
        } else {
            return redirect(route('admin.page.index'));
        }

        // if ($save == 'apply') {
        //     $msg = "Page has been created successfully";
        //     $url = route('admin.page.edit', array($insert_id));
        //     Helpers::msg_move_page($msg, $url);
        // } else {
        //     return redirect(route('admin.page.index'));
        // }

    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page, $id)
    {
        $page = $page->findorfail($id);
        return view('backend.page.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page, $id)
    {
        $page = $page->findorfail($id);
        $page_type = $this->page_type;
        if ($page) {
            return view('backend.page.single', compact('page', 'page_type'));
        } else {
            return view('404');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePageRequest $request, Page $page)
    {
        $data = request()->except(['created_at', 'submit', 'admin_id']);

        if ($request->slug) {
            $data['slug'] = addslashes($request->slug);
        } else {
            $data['slug'] = Str::slug($data['name']);
        }

        $data['type'] = 'page';

        $page = Page::findOrFail($request->id);
        $page->update($data);

        if ($request->submit_form == 'apply') {
            $msg = "Page has been updated successfully";
            $url = route('admin.page.edit', array($request->id));
            Helpers::msg_move_page($msg, $url);
        } else {
            return redirect(route('admin.page.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page, $id)
    {
        $page->find($id)->delete();
        return redirect()->route('admin.page.index')->with('success', 'Page deleted successfully.');
    }
}
