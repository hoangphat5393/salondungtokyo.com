<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Backend\Album;
use App\Models\Backend\Contact;
use App\Models\Backend\Page;
use App\Models\Backend\Setting;
use App\Models\Backend\User;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $totalServices = Page::where('type', 'service')->count();
        $totalAlbums = Album::count();
        $totalContacts = Contact::count();
        $totalPosts = Page::where('type', 'post')->count();
        $totalUsers = User::count();
        $totalSetting = Setting::count();

        $latestContacts = Contact::latest()->take(10)->get();
        $latestServices = Page::where('type', 'service')->latest()->take(5)->get();

        return view('backend.home', compact(
            'totalServices',
            'totalAlbums',
            'totalContacts',
            'totalPosts',
            'totalUsers',
            'totalSetting',
            'latestContacts',
            'latestServices'
        ));
    }
}
