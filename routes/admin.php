<?php 
// Http/Controllers/Admin/
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoryController;

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

        Route::prefix('settings')->group(function () {    
            Route::get('/', [SettingController::class, 'index'])->name('admin.setting');
            Route::post('/', [SettingController::class, 'update'])->name('admin.setting.update');
            Route::get('logo', function () {return view('admin.Setting.logo');})->name('admin.setting.logo');
            Route::get('footer-seo', function () {return view('admin.Setting.footer_seo');})->name('admin.setting.footer_seo');
            Route::get('social-links', function () {return view('admin.Setting.social_links');})->name('admin.setting.social_links');
            Route::get('analytics', function () {return view('admin.Setting.analytics');})->name('admin.setting.analytics');
            Route::get('payment-gateways', function () {return view('admin.Setting.payments');})->name('admin.setting.payment_gateways');
        });

        Route::prefix('catalog')->group(function () {    
            Route::get('kategorije', [CategoryController::class, 'index'])->name('admin.catalog.categories');
            Route::get('kategorije/novo', [CategoryController::class, 'create'])->name('admin.catalog.categories.create');
            Route::post('kategorije/novo', [CategoryController::class, 'store'])->name('admin.catalog.categories.store');
            Route::get('kategorije/{id}/uredi', [CategoryController::class, 'edit'])->name('admin.catalog.categories.edit');
            Route::patch('kategorije/{id}', [CategoryController::class, 'update'])->name('admin.catalog.categories.update');
            Route::get('kategorije/{id}', [CategoryController::class, 'destroy'])->name('admin.catalog.categories.delete');
        });

    });
});



