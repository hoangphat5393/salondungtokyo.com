<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use Route;
use App\User;
use App\Models\Theme, App\Models\Category_Theme, App\Models\Join_Category_Theme;
use App\Models\Variable_Theme;
use App\Models\Theme_Join_Variable_Theme;
use App\Models\Discount_code;
use App\Models\Discount_for_brand;
use App\Libraries\Helpers;
use App\Facades\WebService;
use App\Models\Wishlist;
use Cart;

use Illuminate\Support\Facades\Cache;
use App\Http\Filters\ProductFilter;

class AjaxController extends Controller
{
    use \App\Traits\LocalizeController;
    public function post_ajax_left()
    {
        return view('adminwp.ajax.post_ajax_left');
    }
    public function cate_ajax_left()
    {
        return view('adminwp.ajax.cate_ajax_left');
    }
    public function process_postcontent()
    {
        return view('adminwp.ajax.process_postcontent');
    }
    public function customers_details()
    {
        return view('adminwp.load.customers_details');
    }
    public function process_order()
    {
        return view('adminwp.ajax.process_order');
    }
    public function process_discount()
    {
        return view('adminwp.ajax.process_discount');
    }
    public function process_discount_for_brand()
    {
        return view('adminwp.ajax.process_discount_for_brand');
    }
    public function updateStatus()
    {
        return view('adminwp.ajax.process_status');
    }
    public function updateStoreStatus()
    {
        return view('adminwp.ajax.process_store_status');
    }
    public function check_regiser(Request $rq)
    {
        $data_user = User::all();
        if ($rq->email) {
            foreach ($data_user as $row) {
                if ($rq->email == $row->email) {
                    return 1;
                }
            }
        }
        if ($rq->phone) {
            foreach ($data_user as $row) {
                if ($rq->phone == $row->phone) {
                    return 1;
                }
            }
        }
    }
    public function getDistrict()
    {
        $html = '';
        $id_province = $_POST['data'];
        $district = DB::table('district')
            ->join('province', 'district.provinceid', '=', 'province.provinceid')
            ->where('province.name', '=', $id_province)
            ->orderBy('district.order_sort', 'DESC')
            ->orderBy('district.name', 'ASC')
            ->select('district.*')
            ->get();
        $html .= '<option value="">Chọn Quận/Huyện</option>';
        foreach ($district as $item) {
            $html .= '<option value="' . $item->name . '">' . $item->name . '</option>';
        }
        return $html;
    }

    public function getWard()
    {
        $html = '';
        $id_district = $_POST['data'];
        $ward = DB::table('ward')
            ->join('district', 'district.districtid', '=', 'ward.districtid')
            ->where('district.name', '=', $id_district)
            ->orderBy('ward.name', 'ASC')
            ->select('ward.*')
            ->get();
        $html .= '<option value="">Chọn Phường/Xã</option>';
        foreach ($ward as $item) {
            $html .= '<option value="' . $item->name . '">' . $item->name . '</option>';
        }
        return $html;
    }
}
