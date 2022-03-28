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
                                    <a class="btn btn-outline-white" href="#">Otkrij ovdje</a>
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
                        
                        @foreach ($newestProducts as $new_product)

                            <div class="col-lg-4 border rounded">
                                <div class="min-h-250px bg-center bg-cover rounded d-flex flex-column align-items-center justify-content-center" style="background-image: url('{{ Storage::disk('s3')->temporaryUrl($new_product->variants[0]->images[0]->path, '+2 minutes') }}');">
                                    <div class="w-100 text-center">
                                        <h6 class="text-uppercase fw-lighten text-white mb-2">NOVO</h6>
                                        <h3 class="fw-400 h3 text-white">{{ $new_product->product_translation->name }}</h3>
                                        <div class="pt-2">
                                            <a class="btn btn-white btn-sm" href="#">Kupi odmah</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
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
                                        <div class="product-action">
                                            <a href="#" class="btn btn-outline-primary">
                                                <i class="fi-heart"></i>
                                            </a>
                                            <a href="#" class="btn btn-outline-primary">
                                                <i class="fi-repeat"></i>
                                            </a>
                                            <a data-bs-toggle="modal" data-bs-target="#px-quick-view" href="javascript:void(0)" class="btn btn-outline-primary">
                                                <i class="fi-eye"></i>
                                            </a>
                                        </div>
                                        <div class="product-media">
                                            <a href="#">
                                                <img class="img-fluid" src="{{ Storage::disk('s3')->temporaryUrl($product->images[0]->path, '+2 minutes') }}" title="" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product-card-info">
                                        <div class="rating-star text">
                                            <i class="bi bi-star-fill active"></i>
                                            <i class="bi bi-star-fill active"></i>
                                            <i class="bi bi-star-fill active"></i>
                                            <i class="bi bi-star-fill active"></i>
                                            <i class="bi bi-star"></i>
                                        </div>
                                        <h6 class="product-title">
                                            <a href="#">{{ $product->product_translation->name }}</a>
                                        </h6>
                                        <div class="product-price">
                                            <span class="text-primary">{{ $product->stock_item->unit_price }}</span>
                                            <del class="fs-sm text-muted">{{ $product->stock_item->unit_price }}</del>
                                        </div>
                                        <div class="product-cart-btn">
                                            <a href="#" class="btn btn-primary btn-sm w-100">
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
                                            <div class="product-action">
                                                <a href="#" class="btn btn-outline-primary">
                                                    <i class="fi-heart"></i>
                                                </a>
                                                <a href="#" class="btn btn-outline-primary">
                                                    <i class="fi-repeat"></i>
                                                </a>
                                                <a data-bs-toggle="modal" data-bs-target="#px-quick-view" href="javascript:void(0)" class="btn btn-outline-primary">
                                                    <i class="fi-eye"></i>
                                                </a>
                                            </div>
                                            <div class="product-media">
                                                <a href="#">
                                                    <img class="img-fluid" src="{{ Storage::disk('s3')->temporaryUrl($variant->images[0]->path, '+2 minutes') }}" title="" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-card-info">
                                            <h6 class="product-title">
                                                <a href="#">{{ $variant->variant_translation->name }}</a>
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
                                                <a href="#" class="btn btn-primary btn-sm w-100">
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
                        @foreach ($newestProducts as $product)
                            <div class="product-card-4 rounded overflow-hidden">
                                <div class="product-card-image">
                                    <a href="#">
                                        <img src="{{ Storage::disk('s3')->temporaryUrl($product->variants[0]->images[0]->path, '+2 minutes') }}" title="" alt="">
                                    </a>
                                </div>
                                <div class="product-card-info">
                                    <h6 class="product-title">
                                        <a href="#" tabindex="0">{{ $product->variants[0]->variant_translation->name }}</a>
                                    </h6>
                                    <div class="product-price">
                                        <div class="product-price">
                                            @if ($product->variants[0]->stock_item->unit_special_price === null || $product->variants[0]->stock_item->unit_special_price === "")    
                                                <span class="text-primary">{{ $product->variants[0]->stock_item->unit_price }}</span>
                                            @elseif (isset($product->variants[0]->stock_item->unit_special_price))
                                                <span class="text-primary">{{ $product->variants[0]->stock_item->unit_special_price }}</span>
                                                <del class="fs-sm text-muted">{{ $product->variants[0]->stock_item->unit_price }}</del>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="produc-card-cart">
                                        <a class="link-effect" href="#">Kupi odmah</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="sm-title-02 mb-4 d-flex">
                            <h5 class="m-0">
                                Na popustu
                            </h5>
                        </div>

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
                                                    <a href="#" tabindex="0">{{ $variant->variant_translation->name }}</a>
                                                </h6>
                                                <div class="product-price">
                                                    <div class="product-price">
                                                        <span class="text-primary">{{ $variant->stock_item->unit_special_price }}</span>
                                                        <del class="fs-sm text-muted">{{ $variant->stock_item->unit_price }}</del>
                                                    </div>
                                                </div>
                                                <div class="produc-card-cart">
                                                    <a class="link-effect" href="#">Kupi odmah</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!-- End Section -->
        <!-- Section -->
        <section class="section pt-0">
            <div class="container">
                <div class="section-heading section-heading-01">
                    <div class="row align-items-center">
                        <div class="col-auto col-md-6">
                            <h3 class="h4 mb-0">From The Blog</h3>
                        </div>
                        <div class="col-auto col-md-6 text-end">
                            <a href="#">View All <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card rounded overflow-hidden">
                            <a href="#">
                                <img class="card-img-top" src="../static/img/electronic/1000x1000.jpg" title="" alt="">
                            </a>
                            <div class="position-absolute top-0 start-0 mt-3 ms-3 bg-white d-flex flex-column align-items-center px-3 py-2">
                                <span class="h4 m-0">25</span>
                                <small>MAR</small>
                            </div>
                            <div class="card-body">
                                <h5>
                                    <a class="text-reset" href="#">Make your Marketing website</a>
                                </h5>
                                <p class="m-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>
                            </div>
                            <div class="card-footer d-flex">
                                <a class="text-dark" href="#">Read More</a>
                                <span class="ms-auto">Mar 11 2022</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card rounded overflow-hidden">
                            <a href="#">
                                <img class="card-img-top" src="../static/img/electronic/1000x1000.jpg" title="" alt="">
                            </a>
                            <div class="position-absolute top-0 start-0 mt-3 ms-3 bg-white d-flex flex-column align-items-center px-3 py-2">
                                <span class="h4 m-0">25</span>
                                <small>MAR</small>
                            </div>
                            <div class="card-body">
                                <h5>
                                    <a class="text-reset" href="#">Make your Marketing website</a>
                                </h5>
                                <p class="m-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>
                            </div>
                            <div class="card-footer d-flex">
                                <a class="text-dark" href="#">Read More</a>
                                <span class="ms-auto">Mar 11 2022</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card rounded overflow-hidden">
                            <a href="#">
                                <img class="card-img-top" src="../static/img/electronic/1000x1000.jpg" title="" alt="">
                            </a>
                            <div class="position-absolute top-0 start-0 mt-3 ms-3 bg-white d-flex flex-column align-items-center px-3 py-2">
                                <span class="h4 m-0">25</span>
                                <small>MAR</small>
                            </div>
                            <div class="card-body">
                                <h5>
                                    <a class="text-reset" href="#">Make your Marketing website</a>
                                </h5>
                                <p class="m-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>
                            </div>
                            <div class="card-footer d-flex">
                                <a class="text-dark" href="#">Read More</a>
                                <span class="ms-auto">Mar 11 2022</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card rounded overflow-hidden">
                            <a href="#">
                                <img class="card-img-top" src="../static/img/electronic/1000x1000.jpg" title="" alt="">
                            </a>
                            <div class="position-absolute top-0 start-0 mt-3 ms-3 bg-white d-flex flex-column align-items-center px-3 py-2">
                                <span class="h4 m-0">25</span>
                                <small>MAR</small>
                            </div>
                            <div class="card-body">
                                <h5>
                                    <a class="text-reset" href="#">Make your Marketing website</a>
                                </h5>
                                <p class="m-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>
                            </div>
                            <div class="card-footer d-flex">
                                <a class="text-dark" href="#">Read More</a>
                                <span class="ms-auto">Mar 11 2022</span>
                            </div>
                        </div>
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
