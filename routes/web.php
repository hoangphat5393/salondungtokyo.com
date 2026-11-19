<?php

// use Illuminate\Support\Facades\Response; // JSON response
// use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */


Route::get('cc', function () {
    Artisan::call('optimize:clear');
    // return "Cache cleared successfully!";
    return redirect()->route('index');
});



// Route::get('/', '\App\Http\Controllers\PageController@index')->middleware('verified')->name('index');
Route::get('/', '\App\Http\Controllers\PageController@index')->name('index');

// Route::post('checkout_payment', 'PaymentController@checkout')->name('checkout_payment');
Route::post('domestic_payment', 'PaymentController@domestic_payment')->name('domestic_payment');
Route::get('cancel_payment', 'PaymentController@cancel_payment')->name('cancel_payment');
Route::get('result_payment', 'PaymentController@result_payment')->name('result_payment');
Route::get('return_payment', 'PaymentController@return_payment')->name('return_payment');

// Route::get('test_payment', 'TestController')->name('test_payment');
// Route::post('test_payment', 'TestController@payment')->name('test_payment_post');
// Route::get('test_cancel_payment', 'TestController@cancel_payment')->name('test_cancel_payment');
// Route::get('test_confirm_payment', 'TestController@result_payment')->name('test_result_payment');
// Route::get('return_payment', 'TestController@return_payment')->name('test_return_url');

Route::group(['prefix' => 'auth'], function () {
    Route::get('register', 'CustomerController@registerCustomer')->name('registerCustomer');
    Route::post('register', 'Auth\RegisterController@register')->name('postRegisterCustomer');
    Route::get('register-success', 'CustomerController@createCustomerSuccess')->name('user.register.success');
    Route::get('login', 'CustomerController@showLoginForm')->name('user.login');
    Route::post('login', 'CustomerController@postLogin')->name('loginCustomerAction');

    // Route::post('/logout', 'Customer\CustomerLoginController@logout')->name('CustomerLogout');
    Route::get('logout', array('as' => 'customer.logout', 'uses' => 'CustomerController@logoutCustomer'));
    // Route::post('/nap-tai-khoan', 'PaymentController@checkout')->name('customer.vnpay');
});
Route::post('customer/login-or-register', 'CustomerController@loginOrregister')->name('login_or_register');

// Login facebook and google
Route::get('social/{provider}', 'RegisterAuthController@redirectToProvider')->name('auth.social');
Route::get('callback/{provider}', 'RegisterAuthController@handleProviderCallback')->name('auth.social.callback');

// User forget password
Route::group(['prefix' => 'forget'], function () {

    Route::get('password', 'Auth\ForgotPasswordController@forget')->name('forgetPassword');
    Route::post('password', 'Auth\ForgotPasswordController@actionForgetPassword')->name('actionForgetPassword');

    Route::get('password-step-2', 'Auth\ForgotPasswordController@forgetPassword_step2')->name('forgetPassword_step2');
    Route::post('password-step-2', 'Auth\ForgotPasswordController@actionForgetPassword_step2')->name('actionForgetPassword_step2');

    Route::get('password-step-3', 'Auth\ForgotPasswordController@forgetPassword_step3')->name('forgetPassword_step3');
    Route::post('password-step-3', 'Auth\ForgotPasswordController@actionForgetPassword_step3')->name('actionForgetPassword_step3');
});

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::get('verify', 'Auth\VerificationController@show')->name('auth.verify');
        Route::post('verify', 'Auth\VerificationController@verify');
        Route::post('resend', 'Auth\VerificationController@resend')->name('resend');
    });
});
Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'customer'], function () {
        Route::get('/', 'CustomerController@index')->name('customer.dashboard');
        Route::get('/thong-tin', array('as' => 'customer.profile', 'uses' => 'CustomerController@profile'));
        Route::post('/thong-tin', array('as' => 'customer.updateprofile', 'uses' => 'CustomerController@updateProfile'));
    });
});

// Route::group(['middleware' => 'verified'], function () {

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'customer'], function () {
        Route::get('my-orders', array('as' => 'customer.my-orders', 'uses' => 'CustomerController@myOrder'));
        Route::get('my-orders-detail/{id_cart}', array('as' => 'customer.myordersdetail', 'uses' => 'CustomerController@myOrderDetail'));
        Route::get('my-reviews', array('as' => 'customer.reviews', 'uses' => 'CustomerController@myReviews'));

        Route::get('quan-ly-tin-dang', array('as' => 'customer.post', 'uses' => 'CustomerController@myPost'));
        Route::get('refused', array('as' => 'customer.refused', 'uses' => 'CustomerController@refused'));

        // Route::get('/payment-point', array('as' => 'customer.payment.point', 'uses' => 'PaymentController@paymentPoint'));

        Route::get('change-pass', array('as' => 'customer.changePassword', 'uses' => 'CustomerController@changePassword'));
        Route::post('change-pass', array('as' => 'customer.post.ChangePassword', 'uses' => 'CustomerController@postChangePassword'));
        Route::post('post-reviews', array('as' => 'customer.post_reviews', 'uses' => 'CustomerController@postReviews'));

        Route::get('messages', 'CustomerController@messages')->name('customer.messages');
    });
});

Route::group(['prefix' => 'cart'], function () {
    Route::get('/', 'CartController@cart')->name('cart');
    Route::get('remove', 'CartController@removeCarts')->name('carts.remove');
    Route::post('update', 'CartController@updateCarts')->name('carts.update');
    // Route::get('/checkout', 'CartController@checkout')->name('cart.checkout');

    Route::post('checkout-confirm', 'CartController@checkoutConfirm')->name('cart.checkout.confirm');
    Route::get('checkout-checkemail', 'CartController@checkEmail')->name('cart.checkout.checkemail');
    Route::get('checkout-checkphone', 'CartController@checkphone')->name('cart.checkout.checkphone');

    Route::get('quick-buy-checkout-confirm', 'CartController@quickBuyConfirm')->name('quick_buy.get.confirm');
    Route::post('quick-buy-checkout-confirm', 'CartController@quickBuyConfirm')->name('quick_buy.checkout.confirm');

    Route::get('check-payment/{cart_id}', 'CartController@checkPayment')->name('cart.check_payment');

    Route::post('ajax/add', 'CartController@addCart')->name('cart.ajax.add');
    Route::post('ajax/remove', 'CartController@removeCart')->name('cart.ajax.remove');

    Route::post('ajax/get-shipping-cost', 'CartController@shipping')->name('cart.ajax.shipping');

    Route::get('checkout/success', 'CartController@success')->name('cart.checkout.success');
    Route::get('view/{id}', 'CartController@view')->name('cart.view');
});

Route::post('checkout', 'CartController@checkoutConfirm')->name('cart.checkout');
Route::get('checkout', 'CartController@checkoutConfirm');

Route::group(['prefix' => 'payment'], function () {
    Route::get('stripe', 'PayPalTestController@test');
    Route::post('stripe', 'PayPalTestController@testPost');

    Route::get('{cart_id}', 'PayPalTestController@paymentOrder')->name('payment.order');
});

// Route::get('payment', 'PayPalTestController@index');
Route::post('checkout-process', 'CartController@checkoutProcess')->name('cart_checkout.process');
Route::post('checkout-charge', 'PayPalTestController@charge')->name('cart.checkout.charge');
Route::get('payment-success/{id?}', 'PayPalTestController@paymentStrip_success');
Route::get('paymentsuccess', 'PayPalTestController@payment_success');
Route::get('paymenterror', 'PayPalTestController@payment_error');


// Request payment
Route::get('request-payment-success/{id}', 'CartController@requestPaymentSuccess')->name('request_payment_success');
Route::post('send-request-payment-success', 'CartController@post_requestPaymentSuccess')->name('request_payment_success.post');

// Subscription
Route::post('subscription', 'CustomerController@subscription')->name('subscription');

// Route::get('news.html', 'NewsController@index')->name('news');

// All Product
Route::get('product.html', '\App\Http\Controllers\ProductController@index')->name('product');

// Modules
$module = ['news', 'service', 'works'];

foreach ($module as $item) {

    $prefix_controller = ucfirst(Str::camel($item)) . 'Controller'; // postController

    // \App\Http\Controllers\NewsController@index
    // dd($prefix_controller);

    // List
    Route::get($item . '.html', $prefix_controller . '@index')->name($item);

    // Detail
    Route::get($item . '/{slug}-{id}.html', $prefix_controller . '@show')
        ->where(['slug' => '[a-zA-Z0-9$-_.+!]+', 'id' => '[0-9]+'])
        ->name($item . '.detail');

    // Category
    Route::get($item . '/{slug}.html', $prefix_controller . '@index')
        ->where(['slug' => '[a-zA-Z0-9$-_.+!]+'])
        ->name($item . '.category');
}

// // All News
// Route::get('news.html', '\App\Http\Controllers\NewsController@index')->name('news');

// // News detail
Route::get('news/{slug}-{id}.html', '\App\Http\Controllers\NewsController@newsDetail')
    ->where(['slug' => '[a-zA-Z0-9$-_.+!]+', 'id' => '[0-9]+'])
    ->name('news.detail');

// // News category
// Route::get('news/{slug}.html', '\App\Http\Controllers\NewsController@index')
//     ->where(['slug' => '[a-zA-Z0-9$-_.+!]+'])
//     ->name('news.category');

// Contact
Route::get('contact.html', 'ContactController@index')->name('contact.index');
Route::post('contact-submit', 'ContactController@submit')->name('contact.submit');
// Route::post('contact-confirmation', 'ContactController@confirmation')->name('contact.confirmation');
Route::get('contact-completed', 'ContactController@completed')->name('contact.completed');


Route::get('search', 'SearchController@index')->name('search');

// Page
Route::get('{slug}.html', 'PageController@page')->name('page');


// });

// Route::group(['prefix' => 'ajax'], function () {
//     Route::post('change-attr', 'ProductController@changeAttr')->name('ajax.attr.change');
//     Route::post('order-view', 'CustomerController@orderView');
// });
