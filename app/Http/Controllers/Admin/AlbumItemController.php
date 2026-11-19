<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAlbumItemRequest;
use App\Http\Requests\UpdateAlbumItemRequest;
use App\Models\Backend\AlbumItem;
use Illuminate\Http\Request;

class AlbumItemController extends Controller
{
    /**
     * Valid columns in `album_items` table.
     *
     * @var array<int, string>
     */
    protected array $albumItemColumns = [
        'album_id',
        'sub_name',
        'sub_name_en',
        'name',
        'name_en',
        'description',
        'description_en',
        'image',
        'image_en',
        'video',
        'video_en',
        'link',
        'link_en',
        'link_name',
        'link_name_en',
        'target',
        'sort',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($parent_id)
    {
        $dataResponse = [
            'title_head' => 'Thêm item',
            'parent' => $parent_id,
            'image' => '/upload/images/placeholder.png',
        ];

        return response()->json([
            'view' => view('backend.album.includes.form', $dataResponse)->render(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAlbumItemRequest $request, $album_id)
    {
        $data = $request->only($this->albumItemColumns);
        $data['album_id'] = (int) $album_id;
        $data['description'] = htmlspecialchars((string) ($data['description'] ?? ''));
        $data['description_en'] = htmlspecialchars((string) ($data['description_en'] ?? ''));

        $last_item = AlbumItem::where('album_id', $album_id)->orderBy('sort', 'desc')->first();

        if ($last_item && empty($data['sort'])) {
            $data['sort'] = (int) $last_item->sort + 1;
        }

        AlbumItem::create($data);

        $album_items = AlbumItem::where('album_id', $album_id)->orderBy('sort', 'asc')->get();

        $view = view('backend.album.includes.album-items', ['album_items' => $album_items])->render();

        return response()->json(['view' => $view]);
    }

    /**
     * Display the specified resource.
     */
    public function show(AlbumItem $albumItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AlbumItem $albumItem, $id)
    {
        $albumItem = AlbumItem::findOrFail($id);

        if ($albumItem) {
            $parent = $albumItem->album_id;

            $dataResponse = [
                'title_head' => 'Sửa slider',
                'album_item' => $albumItem,
                'parent' => $parent,
            ];

            return response()->json([
                'view' => view('backend.album.includes.form', $dataResponse)->render(),
            ]);
        }

        return response('404 data Not Found');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAlbumItemRequest $request, $id)
    {
        $data = $request->only($this->albumItemColumns);
        $data['description'] = htmlspecialchars((string) ($data['description'] ?? ''));
        $data['description_en'] = htmlspecialchars((string) ($data['description_en'] ?? ''));

        $album_item = AlbumItem::findOrFail($id);
        $album_item->update($data);

        $album_items = AlbumItem::where('album_id', $album_item->album_id)->orderBy('sort', 'asc')->get();

        $view = view('backend.album.includes.album-items', ['album_items' => $album_items])->render();

        return response()->json(['view' => $view]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AlbumItem $albumItem, int $id)
    {
        if ($id) {
            $albumItem = AlbumItem::findOrFail($id);
            $album_id = $albumItem->album_id;

            $albumItem->delete();

            $album_items = AlbumItem::where('album_id', $album_id)->orderBy('sort', 'asc')->get();
            $view = view('backend.album.includes.album-items', ['album_items' => $album_items, 'album_id' => $album_id])->render();

            return response()->json(['view' => $view]);
        }

        return response('404 data Not Found');
    }

    public function ajaxUpdateSort(Request $request)
    {
        $sort = $request->input('sort');

        if ($sort) {
            foreach ($sort as $index => $id) {
                $item = AlbumItem::find($id);
                if ($item) {
                    $item->update(['sort' => $index]);
                }
            }

            return response()->json(['Update success' => true]);
        }

        return response('404 data Not Found');
    }

    /**
     * Stored multiple items.
     */
    public function storeMultiple(Request $request, int $album_id)
    {
        $fileUrls = $request->input('fileUrls', []);

        if (! is_array($fileUrls) || empty($fileUrls)) {
            return response()->json([
                'success' => false,
                'message' => 'Danh sách ảnh trống',
                'data' => '',
                'errors' => [],
            ], 422);
        }

        $data = [];

        try {
            $lastSort = (int) AlbumItem::where('album_id', $album_id)->max('sort');
            $now = now();

            foreach ($fileUrls as $index => $fileUrl) {
                $ex = explode('/', $fileUrl);

                $data[] = [
                    'name' => end($ex),
                    'name_en' => end($ex),
                    'image' => $fileUrl,
                    'image_en' => $fileUrl,
                    'album_id' => $album_id,
                    'sort' => $lastSort + $index + 1,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }

            AlbumItem::insert($data);

            $album_items = AlbumItem::where('album_id', $album_id)->orderBy('sort', 'asc')->get();

            return response()->json([
                'success' => true,
                'message' => 'Insert thành công',
                'data' => [],
                'view' => view('backend.album.includes.album-items', ['album_items' => $album_items])->render(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Insert thất bại',
                'data' => '',
                'errors' => [
                    'code' => $e->getCode(),
                    'details' => $e->getMessage(),
                ],
            ]);
        }
    }
}
