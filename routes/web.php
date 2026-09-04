<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Salon Dũng Tokyo
|--------------------------------------------------------------------------
*/

Route::get('cc', function () {
    Artisan::call('optimize:clear');

    return redirect()->route('index');
});

// Trang chủ Salon
Route::get('/', 'PageController@index')->name('index');

// Dịch vụ & Bảng giá
Route::get('service.html', 'ServiceController@index')->name('service');
Route::get('service/{slug}-{id}.html', 'ServiceController@show')
    ->where(['slug' => '[a-zA-Z0-9$-_.+!]+', 'id' => '[0-9]+'])
    ->name('service.detail');
Route::get('service/{slug}.html', 'ServiceController@index')
    ->where(['slug' => '[a-zA-Z0-9$-_.+!]+'])
    ->name('service.category');

// Xu hướng & Tin tức làm tóc
Route::get('news.html', 'NewsController@index')->name('news');
Route::get('news/{slug}-{id}.html', 'NewsController@newsDetail')
    ->where(['slug' => '[a-zA-Z0-9$-_.+!]+', 'id' => '[0-9]+'])
    ->name('news.detail');
Route::get('news/{slug}.html', 'NewsController@index')
    ->where(['slug' => '[a-zA-Z0-9$-_.+!]+'])
    ->name('news.category');

// Đặt lịch & Liên hệ
Route::get('contact.html', 'ContactController@index')->name('contact.index');
Route::get('contact', 'ContactController@index')->name('contact');
Route::post('contact-submit', 'ContactController@submit')->name('contact.submit');
Route::post('contact', 'ContactController@submit');
Route::get('contact-completed', 'ContactController@completed')->name('contact.completed');
Route::get('contact-completed.html', 'ContactController@completed')->name('contact_completed');

// Tìm kiếm
Route::get('search', 'SearchController@index')->name('search');

// Trang đơn (Chính sách, Giới thiệu)
Route::get('{slug}.html', 'PageController@page')->name('page');
