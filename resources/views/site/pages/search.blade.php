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
                        <h1 class="m-0 h4 text-center text-lg-start">Tražili ste: {{ $search_query }}</h1>
                    </div>
                    <div class="col-lg-6 my-2">
                        <ol class="breadcrumb dark-link m-0 small justify-content-center justify-content-lg-end">
                            <li class="breadcrumb-item"><a class="text-nowrap" href="{{ route('home') }}"><i class="bi bi-home"></i>Početna</a></li>
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
                       
                        <!-- End Mobile Toggle -->
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
                                        <div class="product-media">
                                            <a href="#">
                                                <img class="img-fluid" src="{{ Storage::disk('s3')->temporaryUrl($variant->images[0]->path, '+2 minutes') }}" title="" alt="">
                                            </a>
                                            <div class="product-cart-btn">
                                                <a href="{{ route('product.show', ['id' => $variant->id]) }}" class="btn btn-primary btn-sm w-100">
                                                    <i class="bi bi-cart"></i>
                                                    Detaljnije
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-card-info">
                                        

                                        <h6 class="product-title">
                                            <a href="{{ route('product.show', ['id' => $variant->id]) }}">{{ $variant->variant_translation->name }}</a>
                                        </h6>
                                        <div class="product-price">
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Product Box -->
                            @endforeach
                        @else
                        <!-- Single Product (no variants) -->
                        <div class="col-sm-6 col-lg-3">
                            <div class="product-card-1">
                                <div class="product-card-image">
                                    <div class="product-media">
                                        <a href="#">
                                            <img class="img-fluid" src="{{ Storage::disk('s3')->temporaryUrl($product->images[0]->path, '+2 minutes') }}" title="" alt="">
                                        </a>
                                        <div class="product-cart-btn">
                                            <a href="{{ route('product.show', ['id' => $product->id]) }}" class="btn btn-primary btn-sm w-100">
                                                <i class="bi bi-cart"></i>
                                                Detaljnije
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-card-info">
                                    

                                    <h6 class="product-title">
                                        <a href="{{ route('product.show', ['id' => $product->id]) }}">{{ $product->product_translation->name }}</a>
                                    </h6>
                                    <div class="product-price">
                                        @if (
                                                $product->stock_item->unit_special_price === null ||
                                                $product->stock_item->unit_special_price === "" || 
                                                $product->stock_item->unit_special_price == 0 || 
                                                $product->stock_item->unit_special_price === "0"
                                                )    
                                                <span class="text-primary">{{ $product->stock_item->unit_price . " " . \Setting::get('currency_symbol') }}</span>
                                            @endif
                                            @if (
                                                $product->stock_item->unit_special_price !== null && 
                                                $product->stock_item->unit_special_price !== "" && 
                                                $product->stock_item->unit_special_price != 0 &&
                                                $product->stock_item->unit_special_price !== "0"
                                                )
                                                <span class="text-primary">{{ $product->stock_item->unit_special_price . " " . \Setting::get('currency_symbol')}}</span>
                                                <del class="fs-sm text-muted">{{ $product->stock_item->unit_price . " " . \Setting::get('currency_symbol')}}</del>
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