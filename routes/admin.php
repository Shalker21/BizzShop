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

        Route::get('settings', [SettingController::class, 'index'])->name('admin.setting');
        Route::post('settings', [SettingController::class, 'update'])->name('admin.setting.update');
        Route::get('settings/logo', function () {return view('admin.Setting.logo');})->name('admin.setting.logo');
        Route::get('settings/footer-seo', function () {return view('admin.Setting.footer_seo');})->name('admin.setting.footer_seo');
        Route::get('settings/social-links', function () {return view('admin.Setting.social_links');})->name('admin.setting.social_links');
        Route::get('settings/analytics', function () {return view('admin.Setting.analytics');})->name('admin.setting.analytics');
        Route::get('settings/payment-gateways', function () {return view('admin.Setting.payments');})->name('admin.setting.payment_gateways');



    });
    
});



