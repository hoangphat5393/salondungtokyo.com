<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Backend\Payments;
use Auth, DB, File, Image, Config;

class PaymentController extends Controller
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
        $data = Payments::filter($request)->orderByDesc('id')->paginate(20)->appends($request->all());

        $total_item = $data->count();

        return view('backend.payment.index')->with(['data' => $data, 'total_item' => $total_item]);
    }

    public function create()
    {
        return view('backend.payment.single', $this->data);
    }

    public function edit($id)
    {
        $this->data['edit_data'] = Payments::find($id);
        if ($this->data['edit_data']) {
            return view('backend.payment.single', $this->data);
        } else {
            return view('404');
        }
    }

    public function post(Request $request) {}
}
