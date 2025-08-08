<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Controllers\Controller;
use App\Models\Backend\Post;
use Auth, DB, File, Image, Config;

class CampaignController extends Controller
{
    public $data = [];
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
        $data_post = Post::filter($request)
            ->orderByDesc('sort')->where('type', 'campaign')
            ->paginate(20)
            ->appends($request->all());

        $total_item = $data_post->count();

        return view('backend.campaign.index')->with(['data' => $data_post, 'total_item' => $total_item]);
    }

    public function create()
    {
        return view('backend.campaign.single', $this->data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->except(['created_at', 'submit']);

        $data['type'] = 'campaign';

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
            $msg = "Campaign has been created successfully";
            // $url = route('admin.campaign.edit', array($insert_id));
            return redirect(route('admin.campaign.edit', array($insert_id)));
        } else {
            return redirect(route('admin.campaign.index'));
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Post $campaign, int $id)
    {
        $campaign = $campaign::find($id);
        return view('backend.campaign.show', compact('campaign'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $campaign, int $id)
    {
        $campaign = $campaign::findorfail($id);

        if ($campaign) {
            return view('backend.campaign.single', compact('campaign'));
        } else {
            return view('404');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $campaign)
    {
        $data = $request->except(['category_id', 'created_at', 'submit']);

        $data['type'] = 'campaign';

        if ($request->slug) {
            $data['slug'] = addslashes($request->slug);
        } else {
            $data['slug'] = Str::slug($data['name']);
        }

        $post = Post::findOrFail($request->id);
        $post->update($data);


        // SAVE CATEGORY
        $category_id = $request->category_id ?? [];
        $post->categories()->sync($category_id);

        $save = $request->submit ?? 'apply';
        if ($save == 'apply') {
            $msg = "Campaign has been updated successfully";
            $url = route('admin.campaign.edit', array($request->id));
            return redirect(route('admin.campaign.edit', array($request->id)));
        } else {
            return redirect(route('admin.campaign.index'));
        }
    }
}
