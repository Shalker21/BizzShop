<?php 
// Http/Controllers/Admin/
use App\Http\Controllers\Admin\LoginController;

// prefix means in url => /admin/...
Route::prefix('admin')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('admin.login'); // admin/login/
    Route::post('login', [LoginController::class, 'login'])->name('admin.login.post');
    Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout'); // admin/logout/

    Route::get('/', function () { return view('admin.dashboard.index'); }); // admin/
});

