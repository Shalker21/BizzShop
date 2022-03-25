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
            <div class="bg-no-repeat bg-cover bg-right-center px-8" style="background-image: url(../static/img/electronic/1600x900.jpg);">
                <div class="container">
                    <div class="row min-vh-85 align-items-center py-12">
                        <div class="col-lg-6 py-8 pe-xl-10">
                            <h6 class="fw-500 text-white mb-4">You're Looking Good</h6>
                            <h1 class="display-4 fw-600 text-white">Final Clearance Up to 80% Off</h1>
                            <div class="pt-4">
                                <a class="btn btn-outline-white" href="#">Discover More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-no-repeat bg-cover bg-right-center px-8" style="background-image: url(../static/img/electronic/1600x900.jpg);">
                <div class="container">
                    <div class="row min-vh-85 align-items-center py-12">
                        <div class="col-lg-6 py-8 pe-xl-10">
                            <h6 class="fw-500 text-white mb-4">You're Looking Good</h6>
                            <h1 class="display-4 fw-600 text-white">Final Clearance Up to 80% Off</h1>
                            <div class="pt-4">
                                <a class="btn btn-outline-white" href="#">Discover More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Home Slider -->
        <!-- Section -->
        <section class="section pt-0">
            <div class="container">
                <div class="bg-white rounded mt-n10 p-3 position-relative shadow">
                    <div class="row g-3">
                        <div class="col-lg-4">
                            <div class="min-h-250px bg-center bg-cover rounded d-flex flex-column align-items-center justify-content-center" style="background-image: url(../static/img/electronic/1000x1000.jpg);">
                                <div class="w-100 text-center">
                                    <h6 class="text-uppercase fw-lighten text-white mb-2">NEW IN</h6>
                                    <h3 class="fw-400 h3 text-white">Canyon <br />Star Raider</h3>
                                    <div class="pt-2">
                                        <a class="btn btn-white btn-sm" href="#">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="min-h-250px bg-center bg-cover rounded d-flex flex-column align-items-center justify-content-center" style="background-image: url(../static/img/electronic/1000x1000.jpg);">
                                <div class="w-100 text-center">
                                    <h6 class="text-uppercase fw-lighten text-white mb-2">NEW IN</h6>
                                    <h3 class="fw-400 h3 text-white">Canyon <br />Star Raider</h3>
                                    <div class="pt-2">
                                        <a class="btn btn-white btn-sm" href="#">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="min-h-250px bg-center bg-cover rounded d-flex flex-column align-items-center justify-content-center" style="background-image: url(../static/img/electronic/1000x1000.jpg);">
                                <div class="w-100 text-center">
                                    <h6 class="text-uppercase fw-lighten text-white mb-2">NEW IN</h6>
                                    <h3 class="fw-400 h3 text-white">Canyon <br />Star Raider</h3>
                                    <div class="pt-2">
                                        <a class="btn btn-white btn-sm" href="#">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                            <h3 class="h4 mb-0">Hot Trending Products</h3>
                        </div>
                        <div class="col-auto col-md-6 text-end">
                            <a href="#">View All <i class="bi bi-arrow-right"></i></a>
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
                    <div class="p-2">
                        <div class="product-card-8">
                            <div class="product-card-image">
                                <div class="badge-ribbon">
                                    <span class="badge bg-danger">Sale</span>
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
                                        <img class="img-fluid" src="../static/img/electronic/1000x1000.jpg" title="" alt="">
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
                                    <a href="#">Fine-knit sweater</a>
                                </h6>
                                <div class="product-price">
                                    <span class="text-primary">$28.<small>50</small></span>
                                    <del class="fs-sm text-muted">$38.<small>50</small></del>
                                </div>
                                <div class="product-cart-btn">
                                    <a href="#" class="btn btn-primary btn-sm w-100">
                                        <i class="fi-shopping-cart"></i>
                                        Add to cart
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-2">
                        <div class="product-card-8">
                            <div class="product-card-image">
                                <div class="badge-ribbon">
                                    <span class="badge bg-danger">Sale</span>
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
                                        <img class="img-fluid" src="../static/img/electronic/1000x1000.jpg" title="" alt="">
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
                                    <a href="#">Fine-knit sweater</a>
                                </h6>
                                <div class="product-price">
                                    <span class="text-primary">$28.<small>50</small></span>
                                    <del class="fs-sm text-muted">$38.<small>50</small></del>
                                </div>
                                <div class="product-cart-btn">
                                    <a href="#" class="btn btn-primary btn-sm w-100">
                                        <i class="fi-shopping-cart"></i>
                                        Add to cart
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-2">
                        <div class="product-card-8">
                            <div class="product-card-image">
                                <div class="badge-ribbon">
                                    <span class="badge bg-danger">Sale</span>
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
                                        <img class="img-fluid" src="../static/img/electronic/1000x1000.jpg" title="" alt="">
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
                                    <a href="#">Fine-knit sweater</a>
                                </h6>
                                <div class="product-price">
                                    <span class="text-primary">$28.<small>50</small></span>
                                    <del class="fs-sm text-muted">$38.<small>50</small></del>
                                </div>
                                <div class="product-cart-btn">
                                    <a href="#" class="btn btn-primary btn-sm w-100">
                                        <i class="fi-shopping-cart"></i>
                                        Add to cart
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-2">
                        <div class="product-card-8">
                            <div class="product-card-image">
                                <div class="badge-ribbon">
                                    <span class="badge bg-danger">Sale</span>
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
                                        <img class="img-fluid" src="../static/img/electronic/1000x1000.jpg" title="" alt="">
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
                                    <a href="#">Fine-knit sweater</a>
                                </h6>
                                <div class="product-price">
                                    <span class="text-primary">$28.<small>50</small></span>
                                    <del class="fs-sm text-muted">$38.<small>50</small></del>
                                </div>
                                <div class="product-cart-btn">
                                    <a href="#" class="btn btn-primary btn-sm w-100">
                                        <i class="fi-shopping-cart"></i>
                                        Add to cart
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-2">
                        <div class="product-card-8">
                            <div class="product-card-image">
                                <div class="badge-ribbon">
                                    <span class="badge bg-danger">Sale</span>
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
                                        <img class="img-fluid" src="../static/img/electronic/1000x1000.jpg" title="" alt="">
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
                                    <a href="#">Fine-knit sweater</a>
                                </h6>
                                <div class="product-price">
                                    <span class="text-primary">$28.<small>50</small></span>
                                    <del class="fs-sm text-muted">$38.<small>50</small></del>
                                </div>
                                <div class="product-cart-btn">
                                    <a href="#" class="btn btn-primary btn-sm w-100">
                                        <i class="fi-shopping-cart"></i>
                                        Add to cart
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-2">
                        <div class="product-card-8">
                            <div class="product-card-image">
                                <div class="badge-ribbon">
                                    <span class="badge bg-danger">Sale</span>
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
                                        <img class="img-fluid" src="../static/img/electronic/1000x1000.jpg" title="" alt="">
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
                                    <a href="#">Fine-knit sweater</a>
                                </h6>
                                <div class="product-price">
                                    <span class="text-primary">$28.<small>50</small></span>
                                    <del class="fs-sm text-muted">$38.<small>50</small></del>
                                </div>
                                <div class="product-cart-btn">
                                    <a href="#" class="btn btn-primary btn-sm w-100">
                                        <i class="fi-shopping-cart"></i>
                                        Add to cart
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-2">
                        <div class="product-card-8">
                            <div class="product-card-image">
                                <div class="badge-ribbon">
                                    <span class="badge bg-danger">Sale</span>
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
                                        <img class="img-fluid" src="../static/img/electronic/1000x1000.jpg" title="" alt="">
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
                                    <a href="#">Fine-knit sweater</a>
                                </h6>
                                <div class="product-price">
                                    <span class="text-primary">$28.<small>50</small></span>
                                    <del class="fs-sm text-muted">$38.<small>50</small></del>
                                </div>
                                <div class="product-cart-btn">
                                    <a href="#" class="btn btn-primary btn-sm w-100">
                                        <i class="fi-shopping-cart"></i>
                                        Add to cart
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Product section -->
        <!-- Section -->
        <section class="section pt-0">
            <div class="container">
                <div class="section-heading section-heading-01">
                    <div class="row align-items-center">
                        <div class="col-auto col-md-6">
                            <h3 class="h4 mb-0">Popular Categories</h3>
                        </div>
                        <div class="col-auto col-md-6 text-end">
                            <a href="#">View All <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row gy-4">
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="p-2 rounded d-flex align-items-center position-relative hover-scale" style="background-color: #eee;">
                            <div class="col px-4">
                                <h5 class="mb-0"><a href="#" class="stretched-link text-reset">Accessories</a></h5>
                                <span>2 items</span>
                            </div>
                            <div class="avatar avatar-xl hover-scale-in">
                                <img height="80" src="../static/img/electronic/1000x1000.jpg" title="" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="p-2 rounded d-flex align-items-center position-relative hover-scale" style="background-color: #eee;">
                            <div class="col px-4">
                                <h5 class="mb-0"><a href="#" class="stretched-link text-reset">Air Pods</a></h5>
                                <span>2 items</span>
                            </div>
                            <div class="avatar avatar-xl hover-scale-in">
                                <img height="80" src="../static/img/electronic/1000x1000.jpg" title="" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="p-2 rounded d-flex align-items-center position-relative hover-scale" style="background-color: #eee;">
                            <div class="col px-4">
                                <h5 class="mb-0"><a href="#" class="stretched-link text-reset">Air Tag</a></h5>
                                <span>2 items</span>
                            </div>
                            <div class="avatar avatar-xl hover-scale-in">
                                <img height="80" src="../static/img/electronic/1000x1000.jpg" title="" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="p-2 rounded d-flex align-items-center position-relative hover-scale" style="background-color: #eee;">
                            <div class="col px-4">
                                <h5 class="mb-0"><a href="#" class="stretched-link text-reset">iPhone</a></h5>
                                <span>2 items</span>
                            </div>
                            <div class="avatar avatar-xl hover-scale-in">
                                <img height="80" src="../static/img/electronic/1000x1000.jpg" title="" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="p-2 rounded d-flex align-items-center position-relative hover-scale" style="background-color: #eee;">
                            <div class="col px-4">
                                <h5 class="mb-0"><a href="#" class="stretched-link text-reset">iPhone 12</a></h5>
                                <span>2 items</span>
                            </div>
                            <div class="avatar avatar-xl hover-scale-in">
                                <img height="80" src="../static/img/electronic/1000x1000.jpg" title="" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="p-2 rounded d-flex align-items-center position-relative hover-scale" style="background-color: #eee;">
                            <div class="col px-4">
                                <h5 class="mb-0"><a href="#" class="stretched-link text-reset">iPhone 13</a></h5>
                                <span>2 items</span>
                            </div>
                            <div class="avatar avatar-xl hover-scale-in">
                                <img height="80" src="../static/img/electronic/1000x1000.jpg" title="" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="p-2 rounded d-flex align-items-center position-relative hover-scale" style="background-color: #eee;">
                            <div class="col px-4">
                                <h5 class="mb-0"><a href="#" class="stretched-link text-reset">iOs 15</a></h5>
                                <span>2 items</span>
                            </div>
                            <div class="avatar avatar-xl hover-scale-in">
                                <img height="80" src="../static/img/electronic/1000x1000.jpg" title="" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="p-2 rounded d-flex align-items-center position-relative hover-scale" style="background-color: #eee;">
                            <div class="col px-4">
                                <h5 class="mb-0"><a href="#" class="stretched-link text-reset">Shop More</a></h5>
                                <span>2 items</span>
                            </div>
                            <div class="avatar avatar-xl hover-scale-in">
                                <img height="80" src="../static/img/electronic/1000x1000.jpg" title="" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Section -->
        <!-- Count Down -->
        <div class="container">
            <div class="bg-cover bg-no-repeat rounded" style="background-image: url(../static/img/electronic/1000x1000.jpg);">
                <div class="row justify-content-center py-5">
                    <div class="col-md-8 col-lg-6 col-xxl-5 py-lg-8">
                        <div class="p-4 p-xl-6 bg-white text-center">
                            <h6 class="mb-2 text-primary">Hurry up! Limited time offer</h6>
                            <h3 class="h1">Gaming Headset <br /> Brilliant Lighting Effect</h3>
                            <div class="count-down count-down-01 justify-content-center py-4" data-countdown="January 01, 2023 15:00:00"></div>
                            <div>
                                <a class="btn btn-primary" href="#">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Count Down -->
        <!-- Section -->
        <section class="section">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-4">
                        <div class="sm-title-02 mb-4 d-flex">
                            <h5 class="m-0">
                                New Arrivals
                            </h5>
                            <a class="text-primary fw-500 small text-uppercase ms-auto" href="#">View All</a>
                        </div>
                        <div class="product-card-4 rounded overflow-hidden">
                            <div class="product-card-image">
                                <a href="#">
                                    <img src="../static/img/electronic/1000x1000.jpg" title="" alt="">
                                </a>
                            </div>
                            <div class="product-card-info">
                                <h6 class="product-title">
                                    <a href="#" tabindex="0">Fine-knit sweater</a>
                                </h6>
                                <div class="product-price">
                                    <span class="text-primary">$28.<small>50</small></span>
                                    <del class="fs-sm text-muted">$38.<small>50</small></del>
                                </div>
                                <div class="produc-card-cart">
                                    <a class="link-effect" href="#">Buy Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="product-card-4 rounded overflow-hidden">
                            <div class="product-card-image">
                                <a href="#">
                                    <img src="../static/img/electronic/1000x1000.jpg" title="" alt="">
                                </a>
                            </div>
                            <div class="product-card-info">
                                <h6 class="product-title">
                                    <a href="#" tabindex="0">Fine-knit sweater</a>
                                </h6>
                                <div class="product-price">
                                    <span class="text-primary">$28.<small>50</small></span>
                                    <del class="fs-sm text-muted">$38.<small>50</small></del>
                                </div>
                                <div class="produc-card-cart">
                                    <a class="link-effect" href="#">Buy Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="product-card-4 rounded overflow-hidden">
                            <div class="product-card-image">
                                <a href="#">
                                    <img src="../static/img/electronic/1000x1000.jpg" title="" alt="">
                                </a>
                            </div>
                            <div class="product-card-info">
                                <h6 class="product-title">
                                    <a href="#" tabindex="0">Fine-knit sweater</a>
                                </h6>
                                <div class="product-price">
                                    <span class="text-primary">$28.<small>50</small></span>
                                    <del class="fs-sm text-muted">$38.<small>50</small></del>
                                </div>
                                <div class="produc-card-cart">
                                    <a class="link-effect" href="#">Buy Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="sm-title-02 mb-4 d-flex">
                            <h5 class="m-0">
                                New Arrivals
                            </h5>
                            <a class="text-primary fw-500 small text-uppercase ms-auto" href="#">View All</a>
                        </div>
                        <div class="product-card-4 rounded overflow-hidden">
                            <div class="product-card-image">
                                <a href="#">
                                    <img src="../static/img/electronic/1000x1000.jpg" title="" alt="">
                                </a>
                            </div>
                            <div class="product-card-info">
                                <h6 class="product-title">
                                    <a href="#" tabindex="0">Fine-knit sweater</a>
                                </h6>
                                <div class="product-price">
                                    <span class="text-primary">$28.<small>50</small></span>
                                    <del class="fs-sm text-muted">$38.<small>50</small></del>
                                </div>
                                <div class="produc-card-cart">
                                    <a class="link-effect" href="#">Buy Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="product-card-4 rounded overflow-hidden">
                            <div class="product-card-image">
                                <a href="#">
                                    <img src="../static/img/electronic/1000x1000.jpg" title="" alt="">
                                </a>
                            </div>
                            <div class="product-card-info">
                                <h6 class="product-title">
                                    <a href="#" tabindex="0">Fine-knit sweater</a>
                                </h6>
                                <div class="product-price">
                                    <span class="text-primary">$28.<small>50</small></span>
                                    <del class="fs-sm text-muted">$38.<small>50</small></del>
                                </div>
                                <div class="produc-card-cart">
                                    <a class="link-effect" href="#">Buy Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="product-card-4 rounded overflow-hidden">
                            <div class="product-card-image">
                                <a href="#">
                                    <img src="../static/img/electronic/1000x1000.jpg" title="" alt="">
                                </a>
                            </div>
                            <div class="product-card-info">
                                <h6 class="product-title">
                                    <a href="#" tabindex="0">Fine-knit sweater</a>
                                </h6>
                                <div class="product-price">
                                    <span class="text-primary">$28.<small>50</small></span>
                                    <del class="fs-sm text-muted">$38.<small>50</small></del>
                                </div>
                                <div class="produc-card-cart">
                                    <a class="link-effect" href="#">Buy Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="sm-title-02 mb-4 d-flex">
                            <h5 class="m-0">
                                New Arrivals
                            </h5>
                            <a class="text-primary fw-500 small text-uppercase ms-auto" href="#">View All</a>
                        </div>
                        <div class="product-card-4 rounded overflow-hidden">
                            <div class="product-card-image">
                                <a href="#">
                                    <img src="../static/img/electronic/1000x1000.jpg" title="" alt="">
                                </a>
                            </div>
                            <div class="product-card-info">
                                <h6 class="product-title">
                                    <a href="#" tabindex="0">Fine-knit sweater</a>
                                </h6>
                                <div class="product-price">
                                    <span class="text-primary">$28.<small>50</small></span>
                                    <del class="fs-sm text-muted">$38.<small>50</small></del>
                                </div>
                                <div class="produc-card-cart">
                                    <a class="link-effect" href="#">Buy Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="product-card-4 rounded overflow-hidden">
                            <div class="product-card-image">
                                <a href="#">
                                    <img src="../static/img/electronic/1000x1000.jpg" title="" alt="">
                                </a>
                            </div>
                            <div class="product-card-info">
                                <h6 class="product-title">
                                    <a href="#" tabindex="0">Fine-knit sweater</a>
                                </h6>
                                <div class="product-price">
                                    <span class="text-primary">$28.<small>50</small></span>
                                    <del class="fs-sm text-muted">$38.<small>50</small></del>
                                </div>
                                <div class="produc-card-cart">
                                    <a class="link-effect" href="#">Buy Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="product-card-4 rounded overflow-hidden">
                            <div class="product-card-image">
                                <a href="#">
                                    <img src="../static/img/electronic/1000x1000.jpg" title="" alt="">
                                </a>
                            </div>
                            <div class="product-card-info">
                                <h6 class="product-title">
                                    <a href="#" tabindex="0">Fine-knit sweater</a>
                                </h6>
                                <div class="product-price">
                                    <span class="text-primary">$28.<small>50</small></span>
                                    <del class="fs-sm text-muted">$38.<small>50</small></del>
                                </div>
                                <div class="produc-card-cart">
                                    <a class="link-effect" href="#">Buy Now</a>
                                </div>
                            </div>
                        </div>
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
