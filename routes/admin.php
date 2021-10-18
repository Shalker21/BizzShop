<?php 

Route::view('/admin', 'admin.dashboard.index');
Route::view('/admin/login', 'admin.auth.login');
Route::view('/admin/register', 'admin.auth.register');

// prefix means in url => /admin/...
Route::prefix('admin')->group(function () {
    Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login'); // admin/login/
    Route::post('login', 'Admin\LoginController@login')->name('admin.login.post');
    Route::get('logout', 'Admin\LoginController@logout')->name('admin.logout'); // admin/logout/

    Route::get('/', function () { return view('admin.dashboard.index'); }); // admin/
});

