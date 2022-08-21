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
                        <h1 class="m-0 h4 text-center text-lg-start"><a href="{{ route('category.show', ['id' => $category->id]) }}">{{ $category->category_translation->name }}</a></h1>
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
                        <!-- Mobile Toggle -->
                        <button class="btn btn-sm w-auto px-3 small" type="button" data-bs-toggle="collapse" data-bs-target="#shop_filter" aria-controls="shop_filter" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fs-4 lh-1 bi bi-justify-left me-2"></i> Filter
                        </button>
                        <!-- End Mobile Toggle -->
                    </div>
                </div>
                <!-- Sidebar -->
                <div class="shadow collapse" id="shop_filter">
                    <form action="{{ route('product.filter') }}" method="GET">
                        @csrf
                        @method('GET')
                        <input type="hidden" value="{{ $category->id }}" name="hidden_category_id" id="hidden_category_id">
                    <div class="p-4 mb-4">
                        <div class="row">
                            <!-- Categories -->
                            <div class="col-lg-3 col-sm-6 shop-sidebar-block my-2">
                                <div class="shop-sidebar-title">
                                    <a class="h5" data-bs-toggle="collapse" href="#shop_categories" role="button" aria-expanded="true" aria-controls="shop_categories">Kategorije <i class="bi bi-chevron-up"></i></a>
                                </div>
                                <div class="shop-category-list collapse show" id="shop_categories">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link active">Svi proizvodi</a>
                                        </li>
                                        @foreach ($category_root->children as $category)
                                            <li class="nav-item">
                                                <a href="{{ route('category.show', ['id' => $category->id]) }}" class="nav-link ">{{ $category->category_translation->name }} <span>(25)</span></a>
                                                <a data-bs-toggle="collapse" href="#shop_cat_1" role="button" aria-expanded="false" aria-controls="shop_cat_1" class="s-icon"></a>
                                                <div class="collapse" id="shop_cat_1">
                                                    <ul class="nav nav-pills flex-column nav-hierarchy">
                                                        @foreach ($category->children as $child_1)
                                                        <li class="nav-item">
                                                            <a href="{{ route('category.show', ['id' => $child_1->id]) }}" class="nav-link "> - {{ $child_1->category_translation->name }}</a>
                                                            <div class="collapse" id="shop_cat_1">
                                                                <ul class="nav nav-pills flex-column nav-hierarchy">
                                                                    @foreach ($child_1->children as $child_2)
                                                                    <li class="nav-item">
                                                                        <a href="{{ route('category.show', ['id' => $child_2->id]) }}" class="nav-link ">{{ $child_2->category_translation->name }}</a>
                                                                    </li> 
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </li> 
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </li>
                                        @endforeach
                                        
                                        
                                    </ul>
                                </div>
                            </div>
                            <!-- End Categories -->

                            @if (count($options_from_variants) > 0)
                                @foreach ($options_from_variants as $option)
                                <div class="col-lg-3 col-sm-6 shop-sidebar-block my-2">
                                    <div class="shop-sidebar-title">
                                        <a class="h5" data-bs-toggle="collapse" href="#shop_Color" role="button" aria-expanded="true" aria-controls="shop_Color">{{ $option->name}} <i class="bi bi-chevron-up"></i></a>
                                    </div>
                                    <div class="shop-sidebar-list collapse show" id="shop_Color">
                                        <ul>
                                            @php
                                                $i = 0;
                                            @endphp
                                            @foreach ($option->values as $value)
                                                
                                                <li class="custom-checkbox checkbox-color">
                                                    <input name="selectedOptionValues_ids[]" class="form-check-input" type="checkbox" value="{{ $value->id }}">
                                                    <label class="form-check-label">
                                                        <span class="text-body">
                                                            {{ $value->value }}
                                                        </span>
                                                    </label>
                                                </li> 
                                                @php
                                                    $i++;
                                                @endphp
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                @endforeach
                            @endif

                            @if (count($options_from_single_products) > 0)
                                @foreach ($options_from_single_products as $option)
                                <div class="col-lg-3 col-sm-6 shop-sidebar-block my-2">
                                    <div class="shop-sidebar-title">
                                        <a class="h5" data-bs-toggle="collapse" href="#shop_Color" role="button" aria-expanded="true" aria-controls="shop_Color">{{ $option->name}} <i class="bi bi-chevron-up"></i></a>
                                    </div>
                                    <div class="shop-sidebar-list collapse show" id="shop_Color">
                                        <ul>
                                            @php
                                                $i = 0;
                                            @endphp
                                            @foreach ($option->values as $value)
                                                
                                                <li class="custom-checkbox checkbox-color">
                                                    <input name="selectedOptionValues_ids[]" class="form-check-input" type="checkbox" value="{{ $value->id }}">
                                                    <label class="form-check-label">
                                                        <span class="text-body">
                                                            {{ $value->value }}
                                                        </span>
                                                    </label>
                                                </li> 
                                                @php
                                                    $i++;
                                                @endphp
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                            
                            <!-- End Color -->
                            <!-- Brands -->
                            <div class="col-lg-3 col-sm-6 shop-sidebar-block my-2">
                                <div class="shop-sidebar-title">
                                    <a class="h5" data-bs-toggle="collapse" href="#shop_brand" role="button" aria-expanded="true" aria-controls="shop_brand">Brandovi <i class="bi bi-chevron-up"></i></a>
                                </div>
                                <div class="shop-sidebar-list collapse show" id="shop_brand">
                                    <ul>
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach ($brands as $brand)
                                            <li class="custom-checkbox">
                                                <input name="selectedBrand_ids[]" class="form-check-input" type="checkbox" value="{{ $brand->id }}">
                                                    <label class="form-check-label">
                                                        <span class="text-body">
                                                            {{ $brand->name }}
                                                        </span>
                                                    </label>
                                            </li> 
                                        @endforeach
                                        @php
                                            $i++;
                                        @endphp
                                    </ul>
                                </div>
                            </div>
                            <!-- End Brands -->

                            <div class="col-lg-3 col-sm-6 shop-sidebar-block my-2">
                                <div class="shop-sidebar-title">
                                    <a class="h5" data-bs-toggle="collapse" href="#shop_price" role="button" aria-expanded="true" aria-controls="shop_price">Cijena <i class="bi bi-chevron-up"></i></a>
                                </div>
                                <div class="shop-sidebar-list collapse show" id="shop_price">
                                    <div class="d-flex align-items-center pt-3">
                                        <!-- Input -->
                                        <input name="price_from" type="number" value="" class="form-control form-control-sm" placeholder="10.00{{ $currency_symbol }}">
                                        <!-- Divider -->
                                        <div class="text-gray-350 mx-2">‒</div>
                                        <!-- Input -->
                                        <input name="price_to" type="number" value="" class="form-control form-control-sm" placeholder="350.00{{ $currency_symbol }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 shop-sidebar-block my-2">
                                <button type="submit" class="btn btn-primary px-3 py-1 m-2">Filtriraj</button>  
                            </div>
                            <!-- End Brands -->
                        </div>
                    </div>
                    </form>
                </div>
                <!-- End Sidebar -->
                <div class="row g-3">
                    @if (count($variants) > 0 || count($single_products) > 0)
                    
                        @if (count($variants) > 0)
                
                            @foreach ($variants as $variant)
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
                                                <a href="{{ route('product.show', ['id' => $variant->id]) }}" class="btn btn-primary btn-sm w-100">
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
                                            @if ($variant->stock_item !== null)
                                                @if (
                                                    $variant->stock_item->unit_special_price === null ||
                                                    $variant->stock_item->unit_special_price === "" || 
                                                    $variant->stock_item->unit_special_price == 0 || 
                                                    $variant->stock_item->unit_special_price === "0"
                                                    )    
                                                    <span class="text-primary">{{ $variant->stock_item->unit_price . " " . \Setting::get('currency_symbol') }}</span>
                                                @endif
                                                @if (
                                                    $variant->stock_item->unit_special_price !== null && 
                                                    $variant->stock_item->unit_special_price !== "" && 
                                                    $variant->stock_item->unit_special_price != 0 &&
                                                    $variant->stock_item->unit_special_price !== "0"
                                                    )
                                                    <span class="text-primary">{{ $variant->stock_item->unit_special_price . " " . \Setting::get('currency_symbol')}}</span>
                                                    <del class="fs-sm text-muted">{{ $variant->stock_item->unit_price . " " . \Setting::get('currency_symbol')}}</del>
                                                @endif
                                            @endif
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Product Box -->
                            @endforeach
                        
                        @endif
                        
                        @if (count($single_products) > 0)
                            @foreach ($single_products as $single_product)
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
                                            @if (isset($single_product->images[0]->path))
                                                <img class="img-fluid" src="{{ Storage::disk('s3')->temporaryUrl($single_product->images[0]->path, '+2 minutes') }}" title="" alt="">
                                            @else
                                                <img class="img-fluid" src="" title="" alt="">
                                            @endif
                                            </a>
                                            <div class="product-cart-btn">
                                                <a href="{{ route('product.show', ['id' => $single_product->id]) }}" class="btn btn-primary btn-sm w-100">
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
                                            <a href="{{ route('product.show', ['id' => $single_product->id]) }}">{{ $single_product->product_translation->name }}</a>
                                        </h6>
                                        <div class="product-price">
                                            @if ($single_product->stock_item !== null)

                                                @if ($single_product->stock_item->unit_special_price === null || $single_product->stock_item->unit_special_price === "")    
                                                    <span class="text-primary">{{ $single_product->stock_item->unit_price }}</span>
                                                @elseif (isset($single_product->stock_item->unit_special_price))
                                                    <span class="text-primary">{{ $single_product->stock_item->unit_special_price }}</span>
                                                    <del class="fs-sm text-muted">{{ $single_product->stock_item->unit_price }}</del>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Product Box -->
                            @endforeach
                        
                        @endif
                     @else
                     <h6>Nema željenih proizvoda, pokušajte drugim filterima!</h6>
                     @endif
                </div>
                <div class="shop-bottom-bar d-flex align-items-center pt-3 mt-3">
                    {{$variants->appends(Request::all())->links()}} 
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