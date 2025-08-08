<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Backend\Shortcode;
use App\Http\Requests\StoreShortcodeRequest;
use App\Http\Requests\UpdateShortcodeRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ShortcodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Shortcode::filter($request)->orderByDesc('sort')->paginate(20)->appends($request->all());

        $total_item = $data->count();

        return view('backend.shortcode.index', compact('data', 'total_item'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.shortcode.single');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreShortcodeRequest $request)
    {
        $data = request()->except(['category_id', 'created_at', 'submit']);

        $data['handle_id'] = addslashes($request->handle_id);
        if (!$request->handle_id)
            $data['handle_id'] = Str::slug($data['name']);

        $data['description'] = $data['description'] ? htmlspecialchars($data['description']) : '';
        $data['content'] = $data['content'] ? htmlspecialchars($data['content']) : '';

        // ADMIN ID
        $data['admin_id'] = Auth::guard('admin')->user()->id;

        $shortcode = Shortcode::create($data);
        $insert_id = $shortcode->id;

        // Update sort
        $shortcode->update(['sort' => $insert_id]);

        $save = $request->submit ?? 'apply';

        if ($save == 'apply') {
            // $msg = "Shortcode has been created successfully";
            return redirect(route('admin.shortcode.edit', array($insert_id)));
        } else {
            return redirect(route('admin.shortcode.index'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Shortcode $shortcode, $id)
    {
        $shortcode = Shortcode::find($id);
        return view('backend.shortcode.show', compact('shortcode'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shortcode $shortcode, $id)
    {
        $shortcode = Shortcode::findorfail($id);

        if ($shortcode) {
            return view('backend.shortcode.single', compact('shortcode'));
        } else {
            return view('404');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShortcodeRequest $request, Shortcode $shortcode)
    {
        $data = request()->except(['created_at', 'submit', 'admin_id']);

        $data['handle_id'] = addslashes($request->handle_id);
        if (!$request->handle_id)
            $data['handle_id'] = Str::slug($data['name']);

        $shortcode = Shortcode::findOrFail($request->id);
        $shortcode->update($data);

        $save = $request->submit ?? 'apply';

        if ($save == 'apply') {
            // $msg = "Shortcode has been updated successfully";
            return redirect(route('admin.shortcode.edit', array($request->id)));
        } else {
            return redirect(route('admin.shortcode.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shortcode $shortcode, $id)
    {
        $shortcode->find($id)->delete();
        return redirect()->route('admin.shortcode.index')->with('success', 'Post deleted successfully.');
    }
}
