@extends('site.app')
@section('content')
    @include('site.partials.header')
    <!-- Main -->
    <main>
        <!-- Home Slider -->
        <div class="slick-carousel slick-nav-rounded" data-slick='{
            "slidesToShow": 1,
            "slidesToScroll": 1,
            "arrows": true,
            "fade": true,
            }'>
            @foreach ($category_root->children as $category)
                <div class="bg-no-repeat bg-cover bg-right-center px-8" style="background-image: url('{{ Storage::disk('s3')->temporaryUrl($category->category_image->path, '+2 minutes') }}');">)
                    <div class="container">
                        <div class="row min-vh-85 align-items-center py-12">
                            <div class="col-lg-6 py-8 pe-xl-10">
                                <h6 class="fw-500 text-white mb-4">{{ strtoupper($category->category_translation->name) }}</h6>
                                <h1 class="display-4 fw-600 text-white">{{ $category->category_translation->description }}</h1>
                                <div class="pt-4">
                                    <a class="btn btn-outline-white" href="{{ route('category.show', ['id' => $category->id]) }}">Otkrij ovdje</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- End Home Slider -->
        <!-- Section -->
        <section class="section pt-0">
            <div class="container">
                <div class="bg-white rounded mt-n10 p-3 position-relative shadow">
                    <div class="row g-3">
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($newestProducts as $new_product)

                        @if ($new_product->variants)
                            @foreach ($new_product->variants as $variant)
                            <div class="col-lg-4 border rounded">
                                <div class="min-h-250px bg-center bg-cover rounded d-flex flex-column align-items-center justify-content-center" style="background-image: url('{{ Storage::disk('s3')->temporaryUrl($variant->images[0]->path, '+2 minutes') }}');">
                                    <div class="w-100 text-center">
                                        <h6 class="text-uppercase fw-lighten text-white mb-2">NOVO</h6>
                                        <h3 class="fw-400 h3 text-white">{{ $variant->variant_translation->name }}</h3>
                                        <div class="pt-2">
                                            
                                            <a class="btn btn-white btn-sm" href="{{ route('product.show', ['id' => $variant->id]) }}">Kupi odmah</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php
                            $i++;
                            if ($i > 2) {
                                break;
                            }
                            @endphp
                            @endforeach
                            @else
                            <div class="col-lg-4 border rounded">
                                <div class="min-h-250px bg-center bg-cover rounded d-flex flex-column align-items-center justify-content-center" style="background-image: url('{{ Storage::disk('s3')->temporaryUrl($new_product->images[0]->path, '+2 minutes') }}');">
                                    <div class="w-100 text-center">
                                        <h6 class="text-uppercase fw-lighten text-white mb-2">NOVO</h6>
                                        <h3 class="fw-400 h3 text-white">{{ $new_product->product_translation->name }}</h3>
                                        <div class="pt-2">
                                            
                                            <a class="btn btn-white btn-sm" href="{{ route('product.show', ['id' => $new_product->id])  }}">Kupi odmah</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @endforeach
                        
                    </div>
                </div>
            </div>
        </section>
        <!-- End Section -->
        <!-- Product section -->
        <section class="section pt-0">
            <div class="container">
                <div class="section-heading section-heading-01">
                    <div class="row align-items-center">
                        <div class="col-auto col-md-6">
                            <h3 class="h4 mb-0">Popularni Proizvodi</h3>
                        </div>
                    </div>
                </div>
                <div class="slick-carousel slick-nav-rounded slick-nav-rounded-sm slick-nav-dark" data-slick='{
                    "slidesToShow": 6,
                    "slidesToScroll": 1,
                    "centerMode": false,
                    "focusOnSelect": true,
                    "infinite": true,
                    "autoplay": false,
                    "responsive": [
                        {
                            "breakpoint":1200,
                            "settings":{
                                "slidesToShow": 6
                            }
                        },
                        {
                            "breakpoint":992,
                            "settings":{
                                "slidesToShow": 4
                            }
                        },
                        {
                            "breakpoint":768,
                            "settings":{
                                "slidesToShow": 3
                            }
                        },
                        {
                            "breakpoint":576,
                            "settings":{
                                "slidesToShow": 2
                            }
                        }
                    ]
                    }'>
                    <!-- FIXME: Here it goes popular products (sort by most buying products?? or something ) -->
                    @foreach ($products as $product)
                        
                        @if (isset($product['unit_price']))
                            <div class="p-2">
                                <div class="product-card-8">
                                    <div class="product-card-image">
                                        <div class="badge-ribbon">
                                            <span class="badge bg-danger">Trend</span>
                                        </div>
                                        </div>
                                        <div class="product-media">
                                            <a href="#">
                                                <img class="img-fluid" src="{{ Storage::disk('s3')->temporaryUrl($product->images[0]->path, '+2 minutes') }}" title="" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product-card-info">
                                        <h6 class="product-title">
                                            <a href="{{ route('product.show', ['id' => $product->id]) }}">{{ $product->product_translation->name }}</a>
                                        </h6>
                                        <div class="product-price">
                                            <span class="text-primary">{{ $product->stock_item->unit_price }}</span>
                                            <del class="fs-sm text-muted">{{ $product->stock_item->unit_price }}</del>
                                        </div>
                                        <div class="product-cart-btn">
                                            <a href="{{ route('product.show', ['id' => $product->id]) }}" class="btn btn-primary btn-sm w-100">
                                                <i class="fi-shopping-cart"></i>
                                                Detaljnije
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @else

                            @foreach ($product->variants as $variant)
                            
                                <div class="p-2">
                                    <div class="product-card-8">
                                        <div class="product-card-image">
                                            <div class="badge-ribbon">
                                                <span class="badge bg-danger">Trend</span>
                                            </div>
                                            <div class="product-media">
                                                <a href="#">
                                                    <img class="img-fluid" src="{{ Storage::disk('s3')->temporaryUrl($variant->images[0]->path, '+2 minutes') }}" title="" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-card-info">
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
                                            <div class="product-cart-btn">
                                                <a href="{{ route('product.show', ['id' => $variant->id]) }}" class="btn btn-primary btn-sm w-100">
                                                    <i class="fi-shopping-cart"></i>
                                                    Detaljnije
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach

                        @endif
                        
                        
                    @endforeach
                    
                </div>
            </div>
        </section>
        <!-- End Product section -->
        
        <!-- Section -->
        <section class="section">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-4">
                        <div class="sm-title-02 mb-4 d-flex">
                            <h5 class="m-0">
                                Novi proizvodi
                            </h5>
                        </div>
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($newestProducts as $product)
                            @if ($product->variants)
                                @foreach ($product->variants as $variant)
                                <div class="product-card-4 rounded overflow-hidden">
                                    <div class="product-card-image">
                                        <a href="#">
                                            <img src="{{ Storage::disk('s3')->temporaryUrl($variant->images[0]->path, '+2 minutes') }}" title="" alt="">
                                        </a>
                                    </div>
                                    <div class="product-card-info">
                                        <h6 class="product-title">
                                            <a href="{{ route('product.show', ['id' => $variant->id]) }}" tabindex="0">{{ $variant->variant_translation->name }}</a>
                                        </h6>
                                        <div class="product-price">
                                            <div class="product-price">
                                                @if ($variant->stock_item->unit_special_price === null || $variant->stock_item->unit_special_price === "")    
                                                    <span class="text-primary">{{ $variant->stock_item->unit_price }}</span>
                                                @elseif (isset($variant->stock_item->unit_special_price))
                                                    <span class="text-primary">{{ $variant->stock_item->unit_special_price }}</span>
                                                    <del class="fs-sm text-muted">{{ $variant->stock_item->unit_price }}</del>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="produc-card-cart">
                                            <a class="link-effect" href="{{ route('product.show', ['id' => $variant->id]) }}">Kupi odmah</a>
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $i++;
                                    if ($i > 2) {
                                        break;
                                    }
                                @endphp
                                @endforeach
                            @else
                            <div class="product-card-4 rounded overflow-hidden">
                                <div class="product-card-image">
                                    <a href="#">
                                        <img src="{{ Storage::disk('s3')->temporaryUrl($product->images[0]->path, '+2 minutes') }}" title="" alt="">
                                    </a>
                                </div>
                                <div class="product-card-info">
                                    <h6 class="product-title">
                                        <a href="{{ route('product.show', ['id' => $product->id]) }}" tabindex="0">{{ $product->variant_translation->name }}</a>
                                    </h6>
                                    <div class="product-price">
                                        <div class="product-price">
                                            @if ($product->stock_item->unit_special_price === null || $product->stock_item->unit_special_price === "")    
                                                <span class="text-primary">{{ $product->stock_item->unit_price }}</span>
                                            @elseif (isset($product->stock_item->unit_special_price))
                                                <span class="text-primary">{{ $product->stock_item->unit_special_price }}</span>
                                                <del class="fs-sm text-muted">{{ $product->stock_item->unit_price }}</del>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="produc-card-cart">
                                        <a class="link-effect" href="{{ route('product.show', ['id' => $product->id]) }}">Kupi odmah</a>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="sm-title-02 mb-4 d-flex">
                            <h5 class="m-0">
                                Na popustu
                            </h5>
                        </div>
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($products as $product)
                            @if (count($product->variants) > 0)
                                @foreach ($product->variants as $variant)
                                    @if (isset($variant->stock_item->unit_special_price) && $variant->stock_item->unit_special_price !== "")
                                        <div class="product-card-4 rounded overflow-hidden">
                                            <div class="product-card-image">
                                                <a href="#">
                                                    <img src="{{ Storage::disk('s3')->temporaryUrl($variant->images[0]->path, '+2 minutes') }}" title="" alt="">
                                                </a>
                                            </div>
                                            <div class="product-card-info">
                                                <h6 class="product-title">
                                                    <a href="{{ route('product.show', ['id' => $variant->id]) }}" tabindex="0">{{ $variant->variant_translation->name }}</a>
                                                </h6>
                                                <div class="product-price">
                                                    <div class="product-price">
                                                        <span class="text-primary">{{ $variant->stock_item->unit_special_price }}</span>
                                                        <del class="fs-sm text-muted">{{ $variant->stock_item->unit_price }}</del>
                                                    </div>
                                                </div>
                                                <div class="produc-card-cart">
                                                    <a class="link-effect" href="{{ route('product.show', ['id' => $variant->id]) }}">Kupi odmah</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @php
                                        $i++;
                                        if ($i > 2) {
                                            break;
                                        }
                                    @endphp
                                @endforeach
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!-- End Section -->
        
    </main>
    <!-- End Main -->

    @include('site.partials.footer')

</div>
<!-- 
===================================
    Wrapper End
===================================
-->

@endsection
