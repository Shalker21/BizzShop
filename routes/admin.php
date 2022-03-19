<?php 
// Http/Controllers/Admin/

// use Illuminate\Support\Facades\Route; FIXME: it's required in web.php
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Admin\ProductVariantController;
use App\Http\Controllers\Admin\ProductOptionController;
use App\Http\Controllers\Admin\ProductOptionValueController;
use App\Http\Controllers\Admin\ProductAttributeController;
use App\Http\Controllers\Admin\ProductAttributeValueController;

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
            // =========== CATEGORIES ===========
            Route::get('kategorije', [CategoryController::class, 'index'])->name('admin.catalog.categories');
            Route::post('getCategories', [CategoryController::class, 'getCategories'])->name('admin.catalog.categories.getCategories'); // ajax 
            Route::get('kategorije/novo', [CategoryController::class, 'create'])->name('admin.catalog.categories.create');
            Route::post('kategorije/novo', [CategoryController::class, 'store'])->name('admin.catalog.categories.store');
            Route::get('kategorije/{id}/uredi', [CategoryController::class, 'edit'])->name('admin.catalog.categories.edit');
            Route::patch('kategorije/{id}', [CategoryController::class, 'update'])->name('admin.catalog.categories.update');
            Route::get('kategorije/{id}', [CategoryController::class, 'destroy'])->name('admin.catalog.categories.delete');

            // =========== BRAND ===========
            Route::get('brandovi', [BrandController::class, 'index'])->name('admin.catalog.brands');
            Route::get('brandovi/novo', [BrandController::class, 'create'])->name('admin.catalog.brands.create');
            Route::post('getBrands', [BrandController::class, 'getBrands'])->name('admin.catalog.brands.getBrands'); // ajax 
            Route::post('brandovi', [BrandController::class, 'store'])->name('admin.catalog.brands.store');
            Route::get('brandovi/{id}/uredi', [BrandController::class, 'edit'])->name('admin.catalog.brands.edit');
            Route::patch('brandovi', [BrandController::class, 'update'])->name('admin.catalog.brands.update');
            Route::get('brandovi/{id}', [BrandController::class, 'destroy'])->name('admin.catalog.brands.delete');

            // =========== PRODUCTS ===========
            Route::get('proizvodi', [ProductController::class, 'index'])->name('admin.catalog.products');
            Route::post('getProducts', [ProductController::class, 'getProducts'])->name('admin.catalog.getProducts'); // ajax 
            Route::get('proizvodi/novo', [ProductController::class, 'create'])->name('admin.catalog.products.create'); 
            Route::post('proizvodi/store', [ProductController::class, 'store'])->name('admin.catalog.products.store');
            //Route::post('storeImage', [ProductImageController::class, 'store'])->name('admin.catalog.products.images.upload');
            Route::get('proizvodi/{id}/uredi', [ProductController::class, 'edit'])->name('admin.catalog.products.edit');
            Route::patch('proizvodi/{id}/uredi', [ProductController::class, 'update'])->name('admin.catalog.products.update');  
            Route::get('proizvodi/{id}', [ProductController::class, 'destroy'])->name('admin.catalog.products.delete');
            
            // Delete and update images of product or variant
            Route::delete('deleteImage/{id}/{image_id}', [ProductImageController::class, 'destroy'])->name('admin.catalog.products.deleteImage');
            Route::post('updateImage/{id}/{image_id?}', [ProductImageController::class, 'update'])->name('admin.catalog.products.updateImage');

            // =========== VARIANTS ===========
            Route::get('varijacije', [ProductVariantController::class, 'index'])->name('admin.catalog.variants');
            Route::post('getProductVariants', [ProductVariantController::class, 'getProductVariants'])->name('admin.catalog.getProductVariants'); // ajax 
            Route::get('varijacije/novo', [ProductVariantController::class, 'create'])->name('admin.catalog.variants.create'); 
            Route::post('varijacije/novo', [ProductVariantController::class, 'store'])->name('admin.catalog.variants.store');
            Route::get('varijacije/{id}/uredi', [ProductVariantController::class, 'edit'])->name('admin.catalog.variants.edit');
            Route::patch('varijacije/{id}/uredi', [ProductVariantController::class, 'update'])->name('admin.catalog.variants.update'); 

            // =========== OPTIONS ===========
            Route::get('opcije', [ProductOptionController::class, 'index'])->name('admin.catalog.options');
            Route::post('getProductOptions', [ProductOptionController::class, 'getProductOptions'])->name('admin.catalog.getProductOptions'); // ajax 
            Route::get('opcije/novo', [ProductOptionController::class, 'create'])->name('admin.catalog.options.create');
            Route::post('opcije/novo', [ProductOptionController::class, 'store'])->name('admin.catalog.options.store');
            Route::get('opcije/{id}/uredi', [ProductOptionController::class, 'edit'])->name('admin.catalog.options.edit');
            Route::patch('opcije/{id}/uredi', [ProductOptionController::class, 'update'])->name('admin.catalog.options.update');

            // =========== OPTION VALUES ===========
            Route::get('vrijednostiOpcija', [ProductOptionValueController::class, 'index'])->name('admin.catalog.optionValues');
            Route::post('getOptionValues', [ProductOptionValueController::class, 'getOptionValues'])->name('admin.catalog.getOptionValues'); // ajax 
            Route::get('vrijednosti/novo', [ProductOptionValueController::class, 'create'])->name('admin.catalog.optionValues.create');
            Route::post('vrijednosti/novo', [ProductOptionValueController::class, 'store'])->name('admin.catalog.optionValues.store');
            Route::get('vrijednosti/{id}/uredi', [ProductOptionValueController::class, 'edit'])->name('admin.catalog.optionValues.edit');
            Route::patch('vrijednosti/{id}/uredi', [ProductOptionValueController::class, 'update'])->name('admin.catalog.optionValues.update');

            // =========== ATTRIBUTES ===========
            Route::get('atributi', [ProductAttributeController::class, 'index'])->name('admin.catalog.attributes');
            Route::post('getProductAttributes', [ProductAttributeController::class, 'getProductAttributes'])->name('admin.catalog.getProductAttributes'); // ajax 
            Route::get('atributi/novo', [ProductAttributeController::class, 'create'])->name('admin.catalog.attributes.create');
            Route::post('atributi/novo', [ProductAttributeController::class, 'store'])->name('admin.catalog.attributes.store'); 
            Route::get('atributi/{id}/uredi', [ProductAttributeController::class, 'edit'])->name('admin.catalog.attributes.edit');
            Route::patch('atributi/{id}', [ProductAttributeController::class, 'update'])->name('admin.catalog.attributes.update'); 
            Route::delete('atributi/{id}', [ProductAttributeController::class, 'destroy'])->name('admin.catalog.attributes.delete');  
            
            // =========== ATTRIBUTE VALUES ===========
            Route::get('vrijednostiAtributa', [ProductAttributeValueController::class, 'index'])->name('admin.catalog.attributeValues');
            Route::post('getProductAttributeValues', [ProductAttributeValueController::class, 'getProductAttributeValues'])->name('admin.catalog.getProductAttributeValues'); // ajax 
            Route::get('vrijednostiAtributa/novo', [ProductAttributeValueController::class, 'create'])->name('admin.catalog.attributeValues.create');
            Route::post('vrijednostiAtributa/novo', [ProductAttributeValueController::class, 'store'])->name('admin.catalog.attributeValues.store');
            Route::get('vrijednostiAtributa/{id}/uredi', [ProductAttributeValueController::class, 'edit'])->name('admin.catalog.attributeValues.edit');
            Route::patch('vrijednostiAtributa/{id}', [ProductAttributeValueController::class, 'update'])->name('admin.catalog.attributeValues.update'); 
            Route::delete('vrijednostiAtributa/{id}', [ProductAttributeValueController::class, 'destroy'])->name('admin.catalog.attributeValues.delete'); 
        });

    });
});



