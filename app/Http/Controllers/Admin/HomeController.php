<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Backend\Page;
use App\Models\Backend\Post;
use App\Models\Backend\User;
use App\Models\Backend\Setting;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest:admin')->except('logout');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalPosts = Post::where(['type' => 'post', 'status' => '1'])->count();
        $totalUsers = User::count();
        $totalSetting = Setting::count();

        return view('backend.home', compact('totalPosts', 'totalUsers', 'totalSetting'));
    }
}
