<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAlbumRequest;
use App\Http\Requests\UpdateAlbumRequest;
use App\Models\Backend\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public $data = [];

    /**
     * Valid columns in `albums` table (`id`, `name`, `name_en`, `sort`, `status`).
     *
     * @var array<int, string>
     */
    protected array $albumColumns = [
        'name',
        'name_en',
        'sort',
        'status',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $album = Album::withCount('items')
            ->with(['items' => fn ($q) => $q->select('id', 'album_id', 'image')->orderBy('sort')])
            ->filter($request)
            ->orderByDesc('sort')
            ->paginate(20)
            ->appends($request->all());

        $total_item = $album->total();

        return view('backend.album.index', compact('album', 'total_item'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.album.single', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAlbumRequest $request)
    {
        $data = $request->only($this->albumColumns);
        $data['name'] = $request->input('name') ?? $request->input('title') ?? '';

        $respons = Album::create($data);
        $insert_id = $respons->id;

        if (empty($data['sort'])) {
            $respons->update(['sort' => $insert_id]);
        }

        $save = $request->submit ?? 'apply';
        if ($save == 'apply') {
            return redirect(route('admin.album.edit', $insert_id))->with('success', __('Thêm album thành công!'));
        }

        return redirect(route('admin.album.index'))->with('success', __('Thêm album thành công!'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        Album::findOrFail($id);

        return redirect()->route('admin.album.edit', $id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $album = Album::findOrFail($id);
        $this->data['album'] = $album;
        $this->data['album_items'] = $album->items()->orderBy('sort', 'asc')->get();

        return view('backend.album.single', $this->data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAlbumRequest $request, $id)
    {
        $sid = (int) ($id ?: ($request->id ?? 0));
        $data = $request->only($this->albumColumns);

        if ($sid > 0) {
            $album = Album::findOrFail($sid);
            $album->update($data);
        }

        $save = $request->submit ?? 'apply';
        if ($save == 'apply') {
            return redirect(route('admin.album.edit', [$sid]))->with('success', __('Cập nhật album thành công!'));
        }

        return redirect(route('admin.album.index'))->with('success', __('Cập nhật album thành công!'));
    }

    public function destroy(string $id)
    {
        $album = Album::findOrFail($id);
        $album->albumItems()->delete();
        $album->delete();

        return redirect()->route('admin.album.index')->with('success', __('Đã xóa album thành công!'));
    }

    public function library(Request $request)
    {
        return view('backend.album.library');
    }
}
