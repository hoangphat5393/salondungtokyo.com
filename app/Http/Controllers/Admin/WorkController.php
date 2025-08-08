<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Work;
use App\Http\Requests\StoreWorkRequest;
use App\Http\Requests\UpdateWorkRequest;
use App\Libraries\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $works = Work::filter($request)->orderByDesc('sort')->paginate(20)
            ->appends($request->all());

        $total_item = $works->count();

        return view('admin.work.index', compact('works', 'total_item'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.work.single');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWorkRequest $request)
    {
        $data = $request->except(['category_id', 'created_at', 'submit']);

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
        $data['admin_id'] = Auth::guard('admin')->user()->id;

        $work = Work::create($data);
        $insert_id = $work->id;

        // Update sort
        $work->update(['sort' => $insert_id]);

        // SAVE CATEGORY
        $category_id = $request->category_id ?? '';
        if ($category_id != '') {
            $work->categories()->sync($category_id);
        }

        $save = $request->submit ?? 'apply';

        if ($save == 'apply') {
            $msg = "Post has been created successfully";
            $url = route('admin.work.edit', array($insert_id));
            Helpers::msg_move_page($msg, $url);
        } else {
            return redirect(route('admin.work.index'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Work $work, int $id)
    {
        $work = $work::find($id);
        return view('admin.work.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Work $work, int $id)
    {
        $work = $work::findorfail($id);

        if ($work) {
            return view('admin.work.single', compact('work'));
        } else {
            return view('404');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWorkRequest $request, Work $work)
    {
        $data = $request->except(['category_id', 'created_at', 'submit', 'admin_id']);

        if ($request->slug) {
            $data['slug'] = addslashes($request->slug);
        } else {
            $data['slug'] = Str::slug($data['name']);
        }

        $work = Work::findOrFail($request->id);
        $work->update($data);

        // SAVE CATEGORY
        $category_id = $request->category_id ?? [];
        $work->categories()->sync($category_id);
        // if ($category_id != '') {
        //     $work->categories()->sync($category_id);
        // }

        $save = $request->submit ?? 'apply';

        if ($save == 'apply') {
            $msg = "Post has been updated successfully";
            $url = route('admin.work.edit', array($request->id));
            Helpers::msg_move_page($msg, $url);
        } else {
            return redirect(route('admin.work.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Work $work, int $id)
    {
        $work->find($id)->destroy();
        return redirect()->route('admin.work.index')->with('success', 'Post deleted successfully.');
    }
}
