@extends('site.app')
@section('content')

    @include('site.partials.header')

    <main>
        <!-- Breadcrumb -->
        <div class="py-3 bg-gray-100">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 my-2">
                        <h1 class="m-0 h4 text-center text-lg-start">Proizvod</h1>
                    </div>
                    <div class="col-lg-6 my-2">
                        <ol class="breadcrumb dark-link m-0 small justify-content-center justify-content-lg-end">
                            <li class="breadcrumb-item"><a class="text-nowrap" href="{{ route('home') }}"><i class="bi bi-home"></i>Početna</a></li>
                            <li class="breadcrumb-item text-nowrap active" aria-current="page">
                                @if ($variant->variant_translation)
                                    {{ $variant->variant_translation->name }}   
                                    @else                                
                                    {{ $variant->product_translation->name }}     
                                @endif
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Breadcrumb -->
        <!-- Product Details -->
            @if ($errors->any())

        <div class="alert alert-danger" role="alert">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>Morate odabrati opcije proizvoda</li>
                    @endforeach
                </ul>
            </div> 
        </div>
        @endif   
        
        <section class="product-details py-6">
            <div class="container">
                <div class="row">
                    <!-- Product Gallery -->
                    <div class="col-lg-6 lightbox-gallery product-gallery">
                        <div class="slick-carousel product-slider" data-slick='{
                                "slidesToShow": 1,
                                "slidesToScroll": 1,
                                "arrows": false,
                                "fade": true,
                                "asNavFor": ".product-thumb"
                            }'>
                            
                            @if (count($variant->images) > 0)
                                
                                @foreach ($variant->images as $variant_image)
                                
                                <div>
                                    <a class="gallery-link" href="{{ Storage::disk('s3')->temporaryUrl($variant_image->path, '+2 minutes'); }}"><i class="bi bi-arrows-fullscreen"></i></a>
                                    <img src="{{ Storage::disk('s3')->temporaryUrl($variant_image->path, '+2 minutes'); }}" class="img-fluid" title="" alt="">
                                </div>

                                @endforeach

                            @endif

                        </div>
                        <div class="slick-carousel product-thumb mt-3" data-slick='{
                                "slidesToShow": 5,
                                "slidesToScroll": 1,
                                "asNavFor": ".product-slider",
                                "centerMode": true,
                                "focusOnSelect": true,
                                "centerPadding": "40px",
                                "responsive": [
                                    {
                                        "breakpoint":1200,
                                        "settings":{
                                            "slidesToShow": 5
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
                                            "slidesToShow": 4
                                        }
                                    },
                                    {
                                        "breakpoint":576,
                                        "settings":{
                                            "slidesToShow": 3
                                        }
                                    }
                                ]
                            }'>

                                @if (count($variant->images) > 0)
                                    
                                    @foreach ($variant->images as $variant_image)
                                    
                                    <div class="pe-2">
                                        <img src="{{ Storage::disk('s3')->temporaryUrl($variant_image->path, '+2 minutes'); }}" class="img-fluid" title="" alt="">
                                    </div>

                                    @endforeach

                                @endif
                            
                        </div>
                    </div>
                    <!-- End Product Gallery -->
                    <!-- Product Details -->
                    <div class="col-lg-6 ps-lg-5">
                        <div class="product-detail pt-4 pt-lg-0">
                            <div class="products-brand pb-2">
                                <span>{{ $brand->name }}</span>
                            </div>
                            <div class="products-title mb-2">
                                <h4 class="h4">
                                    @if ($variant->variant_translation)
                                    {{ $variant->variant_translation->name }}   
                                    @else                                
                                    {{ $variant->product_translation->name }}     
                                    @endif
                                </h4>
                            </div>
                            <div class="product-description">
                                <p>
                                @if ($variant->product)
                                {{ $variant->product->product_translation->short_description }}
                                @else                                
                                {{ $variant->product_translation->short_description }}     
                                @endif
                                </p>
                            </div>
                            <div class="product-attribute">
                                <form action="{{ route('addToCart', ['id' => $variant->id]) }}" method="POST">
                                @csrf
                                @method("POST")

                                @foreach ($options as $option)

                                <label class="fs-6 text-dark pb-2 fw-500">{{ $option->name }}</label>
                                <div class="nav-thumbs nav mb-3">
                                    @foreach ($option->values as $value)
                                    <div class="form-check radio-text form-check-inline me-2">
                                        <input class="form-check-input" type="checkbox" name="selected_option_value[]" id="selected_option_value_{{ $value->id }}" value="{{$value->id}}">
                                        <label class="radio-text-label" for="selected_option_value_{{ $value->id }}">{{ $value->value }}</label>
                                    </div>

                                    @endforeach
                                    
                                </div>    
                                
                                @endforeach
                                
                            </div>
                            <div class="product-price fs-3 fw-500 mb-2">
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
                            <div class="product-detail-actions d-flex flex-wrap pt-3">
                                <div class="cart-qty me-3 mb-3">
                                    <div class="dec qty-btn">-</div>
                                    <input class="cart-qty-input form-control" type="text" name="quantity" value="1">
                                    <div class="inc qty-btn">+</div>
                                </div>
                                <div class="cart-button mb-3 d-flex">
                                    <button class="btn btn-dark me-3" type="submit">
                                        <i class="bi bi-cart"></i> Dodaj u košaru
                                    </button>
                                </div>
                            </div>
                            </form>    
                            <div class="product-info-buttons nav pt-4">
                                <a href="#" class="ms-auto" data-bs-toggle="modal" data-bs-target="#px_ask_modal"><i class="bi bi-envelope ms-auto"></i>Pitaj o proizvodu</a>
                            </div>
                            <div class="pt-3 border-top mt-3 small">
                                <p class="theme-link mb-2">
                                    <label class="m-0 text-dark">kategorije:</label>
                                    @if ($variant->product)
                                        @foreach ($categories as $category)
                                            @if (in_array($category->id, $variant->product->category_ids))
                                                <a href="{{ route('category.show', ['id' => $category->id]) }}">{{ $category->category_translation->name }}</a>,
                                            @endif
                                        @endforeach
                                    @else
                                        @foreach ($categories as $category)
                                            @if (in_array($category->id, $variant->category_ids))
                                                <a href="{{ route('category.show', ['id' => $category->id]) }}">{{ $category->category_translation->name }}</a>,
                                            @endif
                                        @endforeach
                                    @endif
                                </p>
                                <p class="theme-link mb-2">
                                    <label class="m-0 text-dark">Tagovi:</label>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- End Product Details -->
                </div>
            </div>
        </section>
        <!-- End Product Details -->
        <!-- Product Tabs -->
        <section class="pb-6 py-md-6 pb-lg-10 pt-lg-5">
            <div class="container">
                <div class="product-tabs">
                    <ul class="nav product-nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a href="#" class="nav-link active" id="pd_description_tab" data-bs-toggle="tab" data-bs-target="#pd_description" role="tab" aria-controls="pd_description" aria-selected="true">Opis</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="#" class="nav-link" id="pd_information_tab" data-bs-toggle="tab" data-bs-target="#px_information" role="tab" aria-controls="px_information" aria-selected="false">Atributi</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="pd_description" role="tabpanel" aria-labelledby="pd_description_tab">
                            <div class="row">
                                <div class="col-lg-7 pe-lg-10">
                                    <h5>Opis</h5>
                                    <p>
                                        @if ($variant->product)
                                        {{ $variant->product->product_translation->description }}
                                        @else                                
                                        {{ $variant->product_translation->description }}     
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="px_information" role="tabpanel" aria-labelledby="pd_information_tab">
                            <div class="row">
                                <div class="col-lg-6">
                                    <table class="table text-sm">
                                        <tbody>
                                            @foreach ($attributes as $attribute)
                                                <tr>
                                                    <th class="fw-500 text-dark">{{ $attribute->type }}</th>
                                                    @if (count($attribute->values) > 0)
                                                        @foreach ($attribute->values as $value)                                                    
                                                            <td class="text-muted">{{ $value->value }}</td>  
                                                        @endforeach
                                                    @endif
                                                </tr>    
                                            @endforeach
                                            
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Product Tabs -->
        <!-- You may also like -->
        <section class="section bg-gray-100">
            <div class="container">
                <div class="row justify-content-center mb-4 mb-lg-6">
                    <div class="col-lg-6 text-center">
                        <h3 class="h2 mb-2">Slični proizvodi</h3>
                    </div>
                </div>
                <div class="slick-carousel slick-nav-dark" data-slick='{
                    "slidesToShow": 4,
                    "slidesToScroll": 1,
                    "focusOnSelect": true,
                    "infinite": false,
                    "responsive": [
                        {
                            "breakpoint":1200,
                            "settings":{
                                "slidesToShow": 4
                            }
                        },
                        {
                            "breakpoint":992,
                            "settings":{
                                "slidesToShow": 3
                            }
                        },
                        {
                            "breakpoint":768,
                            "settings":{
                                "slidesToShow": 2
                            }
                        },
                        {
                            "breakpoint":576,
                            "settings":{
                                "slidesToShow": 1
                            }
                        }
                    ]
                }'>
                    <div class="p-2">
                        <div class="product-card-1">
                            <div class="product-card-image">
                                <div class="badge-ribbon">
                                    <span class="badge bg-danger">Sale</span>
                                </div>
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
                                        <img class="img-fluid" src="../static/img/1000x1000.jpg" title="" alt="">
                                    </a>
                                    <div class="product-cart-btn">
                                        <a href="#" class="btn btn-primary btn-sm w-100">
                                            <i class="bi bi-cart"></i>
                                            Add to cart
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-card-info">
                                <div class="product-meta small">
                                    <a href="#">Clothing</a>, <a href="#">Men</a>
                                </div>
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
                            </div>
                        </div>
                    </div>
                    <div class="p-2">
                        <div class="product-card-1">
                            <div class="product-card-image">
                                <div class="badge-ribbon">
                                    <span class="badge bg-danger">Sale</span>
                                </div>
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
                                        <img class="img-fluid" src="../static/img/1000x1000.jpg" title="" alt="">
                                    </a>
                                    <div class="product-cart-btn">
                                        <a href="#" class="btn btn-primary btn-sm w-100">
                                            <i class="bi bi-cart"></i>
                                            Add to cart
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-card-info">
                                <div class="product-meta small">
                                    <a href="#">Clothing</a>, <a href="#">Men</a>
                                </div>
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
                            </div>
                        </div>
                    </div>
                    <div class="p-2">
                        <div class="product-card-1">
                            <div class="product-card-image">
                                <div class="badge-ribbon">
                                    <span class="badge bg-danger">Sale</span>
                                </div>
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
                                        <img class="img-fluid" src="../static/img/1000x1000.jpg" title="" alt="">
                                    </a>
                                    <div class="product-cart-btn">
                                        <a href="#" class="btn btn-primary btn-sm w-100">
                                            <i class="bi bi-cart"></i>
                                            Add to cart
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-card-info">
                                <div class="product-meta small">
                                    <a href="#">Clothing</a>, <a href="#">Men</a>
                                </div>
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
                            </div>
                        </div>
                    </div>
                    <div class="p-2">
                        <div class="product-card-1">
                            <div class="product-card-image">
                                <div class="badge-ribbon">
                                    <span class="badge bg-danger">Sale</span>
                                </div>
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
                                        <img class="img-fluid" src="../static/img/1000x1000.jpg" title="" alt="">
                                    </a>
                                    <div class="product-cart-btn">
                                        <a href="#" class="btn btn-primary btn-sm w-100">
                                            <i class="bi bi-cart"></i>
                                            Add to cart
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-card-info">
                                <div class="product-meta small">
                                    <a href="#">Clothing</a>, <a href="#">Men</a>
                                </div>
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
                            </div>
                        </div>
                    </div>
                    <div class="p-2">
                        <div class="product-card-1">
                            <div class="product-card-image">
                                <div class="badge-ribbon">
                                    <span class="badge bg-danger">Sale</span>
                                </div>
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
                                        <img class="img-fluid" src="../static/img/1000x1000.jpg" title="" alt="">
                                    </a>
                                    <div class="product-cart-btn">
                                        <a href="#" class="btn btn-primary btn-sm w-100">
                                            <i class="bi bi-cart"></i>
                                            Add to cart
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-card-info">
                                <div class="product-meta small">
                                    <a href="#">Clothing</a>, <a href="#">Men</a>
                                </div>
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
                            </div>
                        </div>
                    </div>
                    <div class="p-2">
                        <div class="product-card-1">
                            <div class="product-card-image">
                                <div class="badge-ribbon">
                                    <span class="badge bg-danger">Sale</span>
                                </div>
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
                                        <img class="img-fluid" src="../static/img/1000x1000.jpg" title="" alt="">
                                    </a>
                                    <div class="product-cart-btn">
                                        <a href="#" class="btn btn-primary btn-sm w-100">
                                            <i class="bi bi-cart"></i>
                                            Add to cart
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-card-info">
                                <div class="product-meta small">
                                    <a href="#">Clothing</a>, <a href="#">Men</a>
                                </div>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End You may also like -->
    </main>

    @include('site.partials.footer')
</div>
@endsection