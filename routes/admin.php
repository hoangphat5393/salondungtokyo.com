<?php

// use CodeZero\LocalizedRoutes\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

// use App\Http\Controllers\Admin\PageController;
// use App\Http\Controllers\Admin\AlbumController;

// Route xử lý cho admin

// Route::localized(function () {

Route::namespace('Admin')->group(function () {

    Route::get('login', 'LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'LoginController@login');
    Route::match(['get', 'post'], 'logout', 'LoginController@logout')->name('admin.logout');
    Route::get('404', 'AdminController@error')->name('admin.error');

    // Route::get('/404', array(
    //     'as' => 'adminError',
    //     'uses' => 'AdminController@error'
    // ));

    Route::group(['middleware' => ['auth:admin']], function () {

        Route::get('/', 'HomeController@index')->name('admin.dashboard');
        Route::post('cc', 'AdminController@clearCache')->name('admin.cache.clear');

        // Router của quản trị viên sẽ được viết trong group này, còn chức năng của user sẽ viết ngoài route
        Route::group(['middleware' => 'checkAdminPermission'], function () {

            // Setting cost
            // Route::group(['prefix' => 'setting-cost'], function () {
            //     Route::get('/', 'SettingCostController@index')->name('admin_setting_cost');
            //     Route::post('/', 'SettingCostController@store');
            // });

            // Xử lý users admin
            Route::group(['prefix' => 'user'], function () {
                Route::get('', 'UserController@index')->name('admin.user.index');
                Route::get('create', 'UserController@create')->name('admin.user.create');
                Route::post('', 'UserController@store')->name('admin.user.store');
                Route::get('{id}', 'UserController@show')->name('admin.user.show');
                Route::get('{id}/edit', 'UserController@edit')->name('admin.user.edit');
                Route::put('{id}', 'UserController@update')->name('admin.user.update');
                Route::delete('{id}', 'UserController@destroy')->name('admin.user.destroy');
            });

            Route::group(['prefix' => 'role'], function () {
                Route::get('', 'Auth\RoleController@index')->name('admin.role.index');
                Route::get('create', 'Auth\RoleController@create')->name('admin.role.create');
                Route::post('', 'Auth\RoleController@store')->name('admin.role.store');
                Route::get('{id}', 'Auth\RoleController@show')->name('admin.role.show');
                Route::get('{id}/edit', 'Auth\RoleController@edit')->name('admin.role.edit');
                Route::put('{id}', 'Auth\RoleController@update')->name('admin.role.update');
                Route::delete('{id}', 'Auth\RoleController@destroy')->name('admin.role.destroy');
            });

            Route::group(['prefix' => 'permission'], function () {
                Route::get('', 'Auth\PermissionController@index')->name('admin.permission.index');
                Route::get('create', 'Auth\PermissionController@create')->name('admin.permission.create');
                Route::post('', 'Auth\PermissionController@store')->name('admin.permission.store');
                Route::get('{id}', 'Auth\PermissionController@show')->name('admin.permission.show');
                Route::get('{id}/edit', 'Auth\PermissionController@edit')->name('admin.permission.edit');
                Route::put('{id}', 'Auth\PermissionController@update')->name('admin.permission.update');
                Route::delete('{id}', 'Auth\PermissionController@destroy')->name('admin.permission.destroy');
            });

            Route::group(['prefix' => 'accounts', 'as' => 'apermissioncount.'], function () {
                Route::get('/', ['as' => 'index', 'uses' => 'Auth\PermissionController@index']);
            });

            // Route::get('product', 'ProductController@index')->name('admin.product.index');
            // Route::get('product/create', 'ProductController@create')->name('admin.product.create');
            // Route::post('product', 'ProductController@store')->name('admin.product.store');
            // Route::get('product/{product}', 'ProductController@show')->name('admin.product.show');
            // Route::get('product/{product}/edit', 'ProductController@edit')->name('admin.product.edit');
            // Route::put('product/{product}', 'ProductController@update')->name('admin.product.update');
            // Route::delete('product/{product}', 'ProductController@destroy')->name('admin.product.destroy');

            // Xử lý users
            Route::get('list-users', 'AdminController@listUsers')->name('admin.listUsers');
            Route::get('user/{id}', 'AdminController@userDetail')->name('admin.userDetail');
            Route::post('users/{id}', 'AdminController@postUserDetail')->name('admin.postUserDetail');
            Route::get('add-users', 'AdminController@addUsers')->name('admin.addUsers');
            Route::post('add-users', 'AdminController@postAddUsers')->name('admin.postAddUsers');
            Route::get('delete-user/{id}', 'AdminController@deleteUser')->name('admin.delUser');
        });
        // End checkAdminPermission

        Route::group(['prefix' => 'album_item'], function () {
            // Route::post('create', 'AlbumItemController@store')->name('admin.albumItemCreate');
            // Route::get('{id}', 'AlbumItemController@edit')->name('admin.albumItemEdit');

            // Route::get('', 'AlbumItemController@index')->name('albums.albumItem.index');
            Route::get('{id}', 'AlbumItemController@show')->name('albums.albumItem.show');
            Route::get('{id}/edit', 'AlbumItemController@edit')->name('admin.albumItem.edit');
            Route::put('{post}', 'AlbumItemController@update')->name('admin.albumItem.update');
            Route::delete('{id}', 'AlbumItemController@destroy')->name('admin.albumItem.destroy');

            // Other method
            Route::post('ajax_update_sort', 'AlbumItemController@ajaxUpdateSort')->name('admin.albumItem.ajax_update_sort');
        });

        Route::get('album-library', 'AlbumController@library')->name('admin.album.library');

        Route::get('album/{ablum_id}/album_item/create', 'AlbumItemController@create')->name('admin.album.albumItem.create');
        Route::post('album/{ablum_id}/album_item', 'AlbumItemController@store')->name('admin.album.albumItem.store');
        Route::post('album/{ablum_id}/storeMultiple', 'AlbumItemController@storeMultiple')->name('admin.album.storeMultiple');

        $admin_module = ['contact', 'email-template', 'page', 'post', 'service', 'album'];
        $modules_with_category = ['service', 'post'];

        foreach ($admin_module as $item) {

            // Module data
            $prefix_controller = ucfirst(Str::camel($item)).'Controller'; // postController
            $prefix_name = 'admin.'.$item; // admin.post

            // List / index
            Route::get($item, $prefix_controller.'@index')->name($prefix_name.'.index');

            // Create
            Route::get($item.'/create', $prefix_controller.'@create')->name($prefix_name.'.create');
            Route::post($item, $prefix_controller.'@store')->name($prefix_name.'.store');

            // Show
            Route::get($item.'/{id}', $prefix_controller.'@show')->name($prefix_name.'.show');

            // Edit
            Route::get($item.'/{id}/edit', $prefix_controller.'@edit')->name($prefix_name.'.edit');
            Route::put($item.'/{id}', $prefix_controller.'@update')->name($prefix_name.'.update');

            // Delete
            Route::delete($item.'/{id}', $prefix_controller.'@destroy')->name($prefix_name.'.destroy');

            // Module Category
            if (in_array($item, $modules_with_category)) {
                $prefix_controller = ucfirst(Str::camel($item)).'CategoryController';
                $prefix_category_name = 'admin.'.$item.'-category';

                // List / index
                Route::get($item.'-category', $prefix_controller.'@index')->name($prefix_category_name.'.index');

                // Create
                Route::get($item.'-category/create', $prefix_controller.'@create')->name($prefix_category_name.'.create');
                Route::post($item.'-category', $prefix_controller.'@store')->name($prefix_category_name.'.store');

                // Show
                Route::get($item.'-category/{id}', $prefix_controller.'@show')->name($prefix_category_name.'.show');

                // Edit
                Route::get($item.'-category/{id}/edit', $prefix_controller.'@edit')->name($prefix_category_name.'.edit');
                Route::put($item.'-category/{id}', $prefix_controller.'@update')->name($prefix_category_name.'.update');

                // Delete
                Route::delete($item.'-category/{id}', $prefix_controller.'@destroy')->name($prefix_category_name.'.destroy');
            }
        }

        // // Product
        // Route::get('product', 'ProductController@index')->name('admin.product.index');
        // Route::get('product/create', 'ProductController@create')->name('admin.product.create');
        // Route::post('product', 'ProductController@store')->name('admin.product.store');
        // Route::get('product/{product}', 'ProductController@show')->name('admin.product.show');
        // Route::get('product/{product}/edit', 'ProductController@edit')->name('admin.product.edit');
        // Route::put('product/{product}', 'ProductController@update')->name('admin.product.update');
        // Route::delete('product/{product}', 'ProductController@destroy')->name('admin.product.destroy');

        // Change password
        Route::get('change-password', 'AdminController@changePassword')->name('admin.change-password');
        Route::post('change-password', 'AdminController@postChangePassword')->name('admin.postChangePassword');
        Route::get('check-password', 'AjaxController@checkPassword')->name('admin.checkPassword');

        // Ajax replicate (copy data)
        Route::post('bulk-delete', 'AjaxController@ajax_delete')->name('admin.bulk.delete');
        Route::post('bulk-replicate', 'AjaxController@ajax_replicate')->name('admin.bulk.replicate');
        Route::post('quick-change', 'AjaxController@ajax_quickchange')->name('admin.quick-change');
        Route::post('delete-id', 'AjaxController@ajax_delete')->name('admin.ajax_delete');
        Route::post('replicate-id', 'AjaxController@ajax_replicate')->name('admin.ajax_replicate');
        Route::post('album-item/update-sort', 'AlbumItemController@ajaxUpdateSort')->name('admin.albumItem.update_sort');

        Route::group(['prefix' => 'admin-menu'], function () {
            Route::get('/', 'AdminMenuController@index')->name('admin.admin-menu.index');
            Route::post('create', 'AdminMenuController@postCreate')->name('admin.admin-menu.store');
            Route::get('edit/{id}', 'AdminMenuController@edit')->name('admin.admin-menu.edit');
            Route::post('edit/{id}', 'AdminMenuController@postEdit')->name('admin.admin-menu.update');
            Route::post('delete', 'AdminMenuController@deleteList')->name('admin.admin-menu.destroy');
            Route::post('update_sort', 'AdminMenuController@updateSort')->name('admin.admin-menu.update_sort');

            // Legacy alias
            Route::get('alias/index', 'AdminMenuController@index')->name('admin_menu.index');
            Route::post('alias/create', 'AdminMenuController@postCreate')->name('admin_menu.create');
            Route::get('alias/edit/{id}', 'AdminMenuController@edit')->name('admin_menu.edit');
            Route::post('alias/delete', 'AdminMenuController@deleteList')->name('admin_menu.delete');
            Route::post('alias/update_sort', 'AdminMenuController@updateSort')->name('admin_menu.update_sort');
        });

        // Theme-option
        Route::group(['prefix' => 'theme-option'], function () {
            Route::get('/', 'AdminController@getThemeOption')->name('admin.theme-option');
            Route::post('/', 'AdminController@postThemeOption')->name('admin.theme-option.post');
            Route::post('update-sort', 'AdminController@ajaxUpdateSort')->name('admin.theme-option.update_sort');
            Route::post('ajax_update_sort', 'AdminController@ajaxUpdateSort')->name('admin.theme-option.ajax_update_sort');
        });

        Route::group(['prefix' => 'theme-css'], function () {
            Route::get('/', 'AdminController@getCSS')->name('admin.css.get');
            Route::put('/', 'AdminController@updateCSS')->name('admin.css.update');
        });

        Route::get('menu', 'MenuCustomController@index')->name('admin.menu.index');
        // Route::get('menu/create', 'MenuCustomController@index')->name('admin.menu.create');
        Route::post('menu', 'MenuCustomController@store')->name('admin.menu.store');
        // Route::get('menu/{menu}', 'MenuCustomController@show')->name('admin.menu.show');
        // Route::get('menu/{menu}/edit', 'MenuCustomController@edit')->name('admin.menu.edit');
        Route::put('menu/{menu}', 'MenuCustomController@update')->name('admin.menu.update');
        Route::delete('menu/{menu}', 'MenuCustomController@destroy')->name('admin.menu.destroy');

        // Menu Items
        Route::post('menu/generatemenu', 'MenuCustomController@generatemenucontrol')->name('admin.menu.generate');

        Route::post('menu/{menu}/menuitems', 'MenuCustomController@menuItemStore')->name('admin.menu.menuItem.store');
        Route::post('menu/{menu}/updateMenuItem', 'MenuCustomController@updateitem')->name('admin.menu.menuItem.update');
        Route::delete('menu/{menu}/{menuitems}', 'MenuCustomController@destroyitemmenu')->name('admin.menu.menuItem.destroy');
        Route::get('menu/update_menu_url', 'MenuCustomController@updateMenuUrl')->name('admin.menu.updateUrl');
    });
});
// });
