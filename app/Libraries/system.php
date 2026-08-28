<?php

// use App\Libraries\Helpers;
use App\Models\Backend\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

// use App\Models\SettingCost;
// use App\Models\Backend\ShopCurrency;

// use App\Models\Backend\Setting;
// Product kind
define('SC_PRODUCT_SINGLE', 0);
define('SC_PRODUCT_BUILD', 1);
define('SC_PRODUCT_GROUP', 2);

// Product property
define('SC_PROPERTY_PHYSICAL', 'physical');
define('SC_PROPERTY_DOWNLOAD', 'download');

// list ID admin guard
define('SC_GUARD_ADMIN', ['1']); // admin

// list ID language guard
define('SC_GUARD_LANGUAGE', ['1', '2']); // vi, en

// list ID currency guard
define('SC_GUARD_CURRENCY', ['1', '2']); // vndong , usd

// list ID ROLES guard
define('SC_GUARD_ROLES', ['1', '2']); // admin, only view

define('SC_PRICE_FILTER', [1 => 'Từ 0 - 1.000.000 đ', 2 => 'Từ 1.000.000 đ - 3.000.000 đ', 3 => 'Từ 3.000.000 đ - 5.000.000 đ', 4 => 'Từ 5.000.000 đ - 10.000.000 đ', 5 => 'Từ 10.000.000 đ - Trở lên']); // price filter

/**
 * Admin define
 */
define('SC_ADMIN_MIDDLEWARE', ['web', 'admin']);
define('SC_FRONT_MIDDLEWARE', ['web', 'front']);
define('SC_API_MIDDLEWARE', ['api', 'api.extent']);
define('SC_CONNECTION', 'mysql');
define('SC_CONNECTION_LOG', 'mysql');

// Prefix url admin
define('SC_ADMIN_PREFIX', env('ADMIN_PREFIX', 'admin'));

if (! function_exists('setting_option')) {
    function setting_option($variable = '')
    {
        $data = null;
        if (Cache::has('theme_option')) {
            $cached = Cache::get('theme_option');
            if (is_array($cached)) {
                $data = Setting::hydrate($cached);
            } else {
                Cache::forget('theme_option');
            }
        }

        if (! $data) {
            $data = Setting::get();
            Cache::forever('theme_option', $data->toArray());
        }

        if ($data) {
            $option = $data->where('name', $variable)->first();

            if ($option) {
                $content = $option->content;
                if ($option->type == 'editor' || $option->type == 'text') {
                    $content = htmlspecialchars_decode(htmlspecialchars_decode($content));
                }

                return $content;
            }
        }

        return '';
    }
}

// if (!function_exists('setting_cost')) {
//     function setting_cost($variable = '')
//     {
//         $data = SettingCost::get();
//         if ($data) {
//             $option = $data->where('name', $variable)->first();
//             // dd($option);
//             if ($option) {
//                 $content = $option->content;
//                 if ($option->type == 'editor' || $option->type == 'text')
//                     $content = htmlspecialchars_decode(htmlspecialchars_decode($content));
//                 return $content;
//             }
//         }
//     }
// }

// if (!function_exists('get_template')) {
//     function get_template()
//     {
//         return Helpers::getTemplatePath();
//     }
// }

// if (!function_exists('render_price')) {
//     function render_price(float $money, $currency = null, $rate = null, $space_between_symbol = false, $useSymbol = true)
//     {
//         return ShopCurrency::render($money, $currency, $rate, $space_between_symbol, $useSymbol);
//     }
// }

if (! function_exists('render_option_name')) {
    function render_option_name($att)
    {
        if ($att) {
            $att_array = explode('__', $att);
            if (isset($att_array[0])) {
                return $att_array[0];
            }
        }
    }
}

// if (!function_exists('render_option_price')) {
//     function render_option_price($att)
//     {
//         if ($att) {
//             $att_array = explode('__', $att);
//             if (isset($att_array[2]))
//                 return render_price($att_array[2]);
//             elseif (isset($att_array[1]))
//                 return render_price($att_array[1]);
//         }
//     }
// }
// if (!function_exists('auto_code')) {
//     function auto_code($code = 'Order', $cart_id = 0)
//     {
//         $number_start = 5000;
//         // $strtime_conver=strtotime(date('d-m-Y H:i:s'));
//         // $strtime=substr($strtime_conver,-4);
//         // $rand=substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 4);
//         $string_rand = $code . '-' . ($number_start + $cart_id);
//         return $string_rand;
//     }
// }

if (! function_exists('get_image')) {
    function get_image($item_image = '')
    {
        $defaultImage = asset('upload/images/placeholder_salon.jpg');

        if (empty($item_image)) {
            return $defaultImage;
        }

        // URL online
        if (str_starts_with($item_image, 'http://') || str_starts_with($item_image, 'https://')) {
            return $item_image;
        }

        // replace space code
        $cleaned = str_replace('%20', ' ', ltrim($item_image, '/'));

        if (file_exists(public_path($cleaned))) {
            return asset($cleaned);
        }

        if (file_exists(public_path('upload/images/'.$cleaned))) {
            return asset('upload/images/'.$cleaned);
        }

        return $defaultImage;
    }
}

if (! function_exists('setting_phone')) {
    function setting_phone($phone = '')
    {
        $string = Str::swap([
            '(' => '',
            ')' => '',
            '.' => '',
            ' ' => '',
        ], $phone);

        return $string;
    }
}
