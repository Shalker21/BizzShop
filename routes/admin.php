<?php 
// Http/Controllers/Admin/
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\SettingController;

// prefix means in url => /admin/...
Route::prefix('admin')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('admin.login'); // admin/login/
    Route::post('login', [LoginController::class, 'login'])->name('admin.login.post');
    Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout'); // admin/logout/

    // used when admin is authenticated 
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/', function () { // admin/
            return view('admin.dashboard.index');
        })->name('admin.dashboard');
    });

    Route::get('settings', [SettingController::class, 'index'])->name('admin.setting');
    
});



