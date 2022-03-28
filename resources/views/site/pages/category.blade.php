@extends('site.app')
@section('content')

    @include('site.partials.header')
    <!-- Main -->
    <main>
        <!-- Breadcrumb -->
        <div class="py-3 bg-gray-100">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 my-2">
                        <h1 class="m-0 h4 text-center text-lg-start">{{ $category->category_translation->name }}</h1>
                    </div>
                    <div class="col-lg-6 my-2">
                        <ol class="breadcrumb dark-link m-0 small justify-content-center justify-content-lg-end">
                            <li class="breadcrumb-item"><a class="text-nowrap" href="#"><i class="bi bi-home"></i>Početna</a></li>
                            <li class="breadcrumb-item text-nowrap active" aria-current="page">{{ $category->category_breadcrumbs->breadcrumb }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Breadcrumb -->
        <!-- Shop -->
        <section class="py-6">
            <div class="container">
                <!-- Product Box -->
                <div class="shop-top-bar d-flex pb-3">
                    <div class="layout-change">
                        <a class="btn btn-white btn-sm active" href="#"><i class="bi bi-grid"></i></a>
                        <a class="btn btn-white btn-sm" href="shop-filter-list.html"><i class="bi bi-view-stacked"></i></a>
                        <!-- Mobile Toggle -->
                        <button class="btn btn-sm w-auto px-3 small" type="button" data-bs-toggle="collapse" data-bs-target="#shop_filter" aria-controls="shop_filter" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fs-4 lh-1 bi bi-justify-left me-2"></i> Filter
                        </button>
                        <!-- End Mobile Toggle -->
                    </div>
                    <div class="shortby-dropdown ms-auto">
                        <div class="dropdown">
                            <a class="btn btn-white btn-sm border dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                Short by
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="#">Featured</a></li>
                                <li><a class="dropdown-item" href="#">Best selling</a></li>
                                <li><a class="dropdown-item" href="#">Alphabetically, A-Z</a></li>
                                <li><a class="dropdown-item" href="#">Alphabetically, Z-A</a></li>
                                <li><a class="dropdown-item" href="#">Price, low to high</a></li>
                                <li><a class="dropdown-item" href="#">Price, high to low</a></li>
                                <li><a class="dropdown-item" href="#">Date, old to new</a></li>
                                <li><a class="dropdown-item" href="#">Date, new to old</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Sidebar -->
                <div class="shadow collapse" id="shop_filter">
                    <div class="p-4 mb-4">
                        <div class="row">
                            <!-- Categories -->
                            <div class="col-lg-3 col-sm-6 shop-sidebar-block my-2">
                                <div class="shop-sidebar-title">
                                    <a class="h5" data-bs-toggle="collapse" href="#shop_categories" role="button" aria-expanded="true" aria-controls="shop_categories">Categories <i class="bi bi-chevron-up"></i></a>
                                </div>
                                <div class="shop-category-list collapse show" id="shop_categories">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link active">All Products</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link ">Men <span>(25)</span></a>
                                            <a data-bs-toggle="collapse" href="#shop_cat_1" role="button" aria-expanded="false" aria-controls="shop_cat_1" class="s-icon"></a>
                                            <div class="collapse" id="shop_cat_1">
                                                <ul class="nav nav-pills flex-column nav-hierarchy">
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link ">Topwear</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link ">Bottomwear</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link ">Footwear</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link ">Sports &amp; Active Wear</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link ">Women <span>(40)</span></a>
                                            <a data-bs-toggle="collapse" href="#shop_cat_2" role="button" aria-expanded="false" aria-controls="shop_cat_2" class="s-icon"></a>
                                            <div class="collapse" id="shop_cat_2">
                                                <ul class="nav nav-pills flex-column nav-hierarchy">
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link ">Indian &amp; Fusion Wear</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link ">Western Wear</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link ">Footwear</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link ">Beauty &amp; Personal Care</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link ">Kids <span>(35)</span></a>
                                            <a data-bs-toggle="collapse" href="#shop_cat_3" role="button" aria-expanded="false" aria-controls="shop_cat_3" class="s-icon"></a>
                                            <div class="collapse" id="shop_cat_3">
                                                <ul class="nav nav-pills flex-column nav-hierarchy">
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link ">Boys Clothing</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link ">Girls Clothing</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link ">Boys Footwear</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link ">Girls Footwear</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link ">Home &amp; Living <span>(80)</span></a>
                                            <a data-bs-toggle="collapse" href="#shop_cat_4" role="button" aria-expanded="false" aria-controls="shop_cat_4" class="s-icon"></a>
                                            <div class="collapse" id="shop_cat_4">
                                                <ul class="nav nav-pills flex-column nav-hierarchy">
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link ">Bed Linen &amp; Furnishing</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link ">Bath</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link ">Home Decor</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link ">Kitchen &amp; Table</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- End Categories -->
                            <!-- Color -->
                            <div class="col-lg-3 col-sm-6 shop-sidebar-block my-2">
                                <div class="shop-sidebar-title">
                                    <a class="h5" data-bs-toggle="collapse" href="#shop_Color" role="button" aria-expanded="true" aria-controls="shop_Color">Color <i class="bi bi-chevron-up"></i></a>
                                </div>
                                <div class="shop-sidebar-list collapse show" id="shop_Color">
                                    <ul>
                                        <li class="custom-checkbox checkbox-color">
                                            <input class="custom-control-input" id="colorsidebar1" type="checkbox" checked="">
                                            <label class="custom-control-label" style="color: #1F45FC;" for="colorsidebar1">
                                                <span class="text-body">
                                                    Royal Blue
                                                </span>
                                            </label>
                                        </li>
                                        <li class="custom-checkbox checkbox-color">
                                            <input class="custom-control-input" id="colorsidebar2" type="checkbox">
                                            <label class="custom-control-label" style="color: #FCD71E;" for="colorsidebar2">
                                                <span class="text-body">
                                                    Yellow
                                                </span>
                                            </label>
                                        </li>
                                        <li class="custom-checkbox checkbox-color">
                                            <input class="custom-control-input" id="colorsidebar3" type="checkbox">
                                            <label class="custom-control-label" style="color: #000;" for="colorsidebar3">
                                                <span class="text-body">
                                                    Black
                                                </span>
                                            </label>
                                        </li>
                                        <li class="custom-checkbox checkbox-color">
                                            <input class="custom-control-input" id="colorsidebar4" type="checkbox">
                                            <label class="custom-control-label" style="color: #f73636;" for="colorsidebar4">
                                                <span class="text-body">
                                                    Red
                                                </span>
                                            </label>
                                        </li>
                                        <li class="custom-checkbox checkbox-color">
                                            <input class="custom-control-input" id="colorsidebar5" type="checkbox" disabled="">
                                            <label class="custom-control-label" style="color: #17a2b8;" for="colorsidebar5">
                                                <span class="text-body">
                                                    Cyan
                                                </span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- End Color -->
                            <!-- Brands -->
                            <div class="col-lg-3 col-sm-6 shop-sidebar-block my-2">
                                <div class="shop-sidebar-title">
                                    <a class="h5" data-bs-toggle="collapse" href="#shop_brand" role="button" aria-expanded="true" aria-controls="shop_brand">Brands <i class="bi bi-chevron-up"></i></a>
                                </div>
                                <div class="shop-sidebar-list collapse show" id="shop_brand">
                                    <ul>
                                        <li class="custom-checkbox">
                                            <input class="custom-control-input" id="brand1" type="checkbox">
                                            <label class="custom-control-label" for="brand1">
                                                Adidas
                                            </label>
                                        </li>
                                        <li class="custom-checkbox">
                                            <input class="custom-control-input" id="brand2" type="checkbox">
                                            <label class="custom-control-label" for="brand2">
                                                Levis
                                            </label>
                                        </li>
                                        <li class="custom-checkbox">
                                            <input class="custom-control-input" id="brand3" type="checkbox">
                                            <label class="custom-control-label" for="brand3">
                                                Puma
                                            </label>
                                        </li>
                                        <li class="custom-checkbox">
                                            <input class="custom-control-input" id="brand4" type="checkbox" disabled="">
                                            <label class="custom-control-label" for="brand4">
                                                Roadster
                                            </label>
                                        </li>
                                        <li class="custom-checkbox">
                                            <input class="custom-control-input" id="brand5" type="checkbox">
                                            <label class="custom-control-label" for="brand5">
                                                Converse
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- End Brands -->
                            <!-- Brands -->
                            <div class="col-lg-3 col-sm-6 shop-sidebar-block my-2">
                                <div class="shop-sidebar-title">
                                    <a class="h5" data-bs-toggle="collapse" href="#shop_price" role="button" aria-expanded="true" aria-controls="shop_price">Price <i class="bi bi-chevron-up"></i></a>
                                </div>
                                <div class="shop-sidebar-list collapse show" id="shop_price">
                                    <ul>
                                        <li class="custom-checkbox">
                                            <input class="custom-control-input" id="price1" type="checkbox">
                                            <label class="custom-control-label" for="price1">
                                                $10.00 - $49.00
                                            </label>
                                        </li>
                                        <li class="custom-checkbox">
                                            <input class="custom-control-input" id="price2" type="checkbox">
                                            <label class="custom-control-label" for="price2">
                                                $50.00 - $99.00
                                            </label>
                                        </li>
                                        <li class="custom-checkbox">
                                            <input class="custom-control-input" id="price3" type="checkbox">
                                            <label class="custom-control-label" for="price3">
                                                $100.00 - $199.00
                                            </label>
                                        </li>
                                        <li class="custom-checkbox">
                                            <input class="custom-control-input" id="price4" type="checkbox">
                                            <label class="custom-control-label" for="price4">
                                                $200.00 and Up
                                            </label>
                                        </li>
                                    </ul>
                                    <div class="d-flex align-items-center pt-3">
                                        <!-- Input -->
                                        <input type="number" class="form-control form-control-sm" placeholder="$10.00" min="10">
                                        <!-- Divider -->
                                        <div class="text-gray-350 mx-2">‒</div>
                                        <!-- Input -->
                                        <input type="number" class="form-control form-control-sm" placeholder="$350.00" max="350">
                                    </div>
                                </div>
                            </div>
                            <!-- End Brands -->
                        </div>
                    </div>
                </div>
                <!-- End Sidebar -->
                <div class="row g-3">
                    @foreach ($products as $product)
                    
                        @if (count($product->variants) > 0)
                            @foreach ($product->variants as $variant)
                            <div class="col-sm-6 col-lg-3">
                                <div class="product-card-1">
                                    <div class="product-card-image">
                                        <div class="product-action">
                                            <a href="#" class="btn btn-outline-primary">
                                                <i class="bi bi-heart"></i>
                                            </a>
                                            <a href="#" class="btn btn-outline-primary">
                                                <i class="bi bi-arrow-left-right"></i>
                                            </a>
                                            <a data-bs-toggle="modal" data-bs-target="#px-quick-view" href="javascript:void(0)" class="btn btn-outline-primary">
                                                <i class="bi bi-eye-fill"></i>
                                            </a>
                                        </div>
                                        <div class="product-media">
                                            <a href="#">
                                                <img class="img-fluid" src="{{ Storage::disk('s3')->temporaryUrl($variant->images[0]->path, '+2 minutes') }}" title="" alt="">
                                            </a>
                                            <div class="product-cart-btn">
                                                <a href="#" class="btn btn-primary btn-sm w-100">
                                                    <i class="bi bi-cart"></i>
                                                    Dodaj u košaricu
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-card-info">
                                        <div class="product-meta small">
                                            @if ($category->parent && $category->parent->category_translation->slug !== 'root')<a href="{{ route('category.show', ['id' => $category->parent->id]) }}">{{ $category->parent->category_translation->name }}</a>@endif
                                            @if ($category->parent->parent && $category->parent->parent->category_translation->slug !== 'root')<a href="{{ route('category.show', ['id' => $category->parent->parent->id]) }}">{{ $category->parent->parent->category_translation->name }}</a>@endif
                                        </div>

                                        <h6 class="product-title">
                                            <a href="{{ route('product.show', ['id' => $variant->id]) }}">{{ $variant->variant_translation->name }}</a>
                                        </h6>
                                        <div class="product-price">
                                            @if ($variant->stock_item->unit_special_price === null || $variant->stock_item->unit_special_price === "")    
                                                <span class="text-primary">{{ $variant->stock_item->unit_price }}</span>
                                            @elseif (isset($variant->stock_item->unit_special_price))
                                                <span class="text-primary">{{ $variant->stock_item->unit_special_price }}</span>
                                                <del class="fs-sm text-muted">{{ $variant->stock_item->unit_price }}</del>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Product Box -->
                            @endforeach
                        @else
                        <div class="col-sm-6 col-lg-3">
                            <div class="product-card-1">
                                <div class="product-card-image">
                                    <div class="product-action">
                                        <a href="#" class="btn btn-outline-primary">
                                            <i class="bi bi-heart"></i>
                                        </a>
                                        <a href="#" class="btn btn-outline-primary">
                                            <i class="bi bi-arrow-left-right"></i>
                                        </a>
                                        <a data-bs-toggle="modal" data-bs-target="#px-quick-view" href="javascript:void(0)" class="btn btn-outline-primary">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                    </div>
                                    <div class="product-media">
                                        <a href="#">
                                            <img class="img-fluid" src="{{ Storage::disk('s3')->temporaryUrl($product->images[0]->path, '+2 minutes') }}" title="" alt="">
                                        </a>
                                        <div class="product-cart-btn">
                                            <a href="#" class="btn btn-primary btn-sm w-100">
                                                <i class="bi bi-cart"></i>
                                                Dodaj u košaricu
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-card-info">
                                    <div class="product-meta small">
                                        @if ($category->parent && $category->parent->category_translation->slug !== 'root')<a href="{{ route('category.show', ['id' => $category->parent->id]) }}">{{ $category->parent->category_translation->name }}</a>@endif
                                        @if ($category->parent->parent && $category->parent->parent->category_translation->slug !== 'root')<a href="{{ route('category.show', ['id' => $category->parent->parent->id]) }}">{{ $category->parent->parent->category_translation->name }}</a>@endif
                                    </div>

                                    <h6 class="product-title">
                                        <a href="{{ route('product.show', ['id' => $product->id]) }}">{{ $product->product_translation->name }}</a>
                                    </h6>
                                    <div class="product-price">
                                        @if ($product->stock_item->unit_special_price === null || $product->stock_item->unit_special_price === "")    
                                            <span class="text-primary">{{ $product->stock_item->unit_price }}</span>
                                        @elseif (isset($product->stock_item->unit_special_price))
                                            <span class="text-primary">{{ $product->stock_item->unit_special_price }}</span>
                                            <del class="fs-sm text-muted">{{ $product->stock_item->unit_price }}</del>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    
                    @endforeach  
                </div>
                <div class="shop-bottom-bar d-flex align-items-center pt-3 mt-3">
                    {{$products->links()}} 
                </div>
                <!-- End Product Box -->
            </div>
        </section>
        <!-- End Shop -->
    </main>
    <!-- End Main -->

    @include('site.partials.footer')
</div>
@endsection