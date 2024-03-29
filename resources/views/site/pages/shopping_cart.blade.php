@extends('site.app')
@section('content')

    @include('site.partials.header')
    
    <main>
        <!-- Breadcrumb -->
        <div class="py-3 bg-gray-100">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-6 my-2">
                        <h1 class="m-0 h4 text-center text-lg-start">Košarica</h1>
                    </div>
                    <div class="col-6 my-2">
                        <ol class="breadcrumb dark-link m-0 small justify-content-center justify-content-lg-end">
                            <li class="breadcrumb-item"><a class="text-nowrap" href="{{ route('home') }}"><i class="bi bi-home"></i>Početna</a></li>
                            <li class="breadcrumb-item text-nowrap active" aria-current="page">Košarica</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Breadcrumb -->
        <!-- Cart Table -->
        <div class="py-6">
            <div class="container">
                <!-- Cart Table -->
                <div class="table-content table-responsive cart-table-content">
                    <table class="table table-bordered align-middle">
                        <thead>
                            <tr class="text-uppercase">
                                <th class="text-dark text-center fw-500 text-nowrap">Slika</th>
                                <th class="text-dark text-center fw-500 text-nowrap">Naziv proizvoda</th>
                                <th class="text-dark text-center fw-500 text-nowrap">Cijena</th>
                                <th class="text-dark text-center fw-500 text-nowrap">Količina</th>
                                <th class="text-dark text-center fw-500 text-nowrap">Opcije proizvoda</th>
                                <th class="text-dark fw-500 text-end text-nowrap">Radnja</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = 0;
                                $total_without_discount = 0;
                                $discount_total = 0;
                            @endphp
                            @if (session('cart')) 
                                @foreach (session('cart') as $id => $data)
                                @php
                                    if ($data['unit_special_price']) {
                                        $total += (float)$data['unit_special_price'] * (float)$data['item_qty'];
                                        $discount_total +=  ((float)$data['unit_price'] - (float)$data['unit_special_price']) * (float)$data['item_qty'];
                                    } else {
                                        $total += (float)$data['unit_price'] * (float)$data['item_qty'];
                                    }
                                    $total_without_discount += (float)$data['unit_price'] * (float)$data['item_qty'];
                                @endphp
                                <tr>
                                    <td class="text-center product-thumbnail">
                                        
                                        @if ($data['variant_image'] !== "")
                                        <a class="text-reset" href="#"><img src="{{ Storage::disk('s3')->temporaryUrl($data['variant_image'], '+2 minutes') }}" class="img-fluid" width="100" alt=""></a>
                                            @else
                                            <a class="text-reset" href="#"><img src="" class="img-fluid" width="100" alt=""></a>
                                            @endif
                                    </td>
                                    <td class="text-center product-name"><a class="text-reset" href="{{ route('product.show', ['id' => $id]) }}">
                                        {{$data['name']}}  
                                    </a>
                                    </td>
                                    <td class="text-center product-price-cart">
                                        @if (!empty($data['unit_special_price']))
                                        <span class="text-primary">{{ $data['unit_special_price']. " ". \Setting::get('currency_symbol') }}</span>
                                        <del class="fs-sm text-muted">{{ $data['unit_price'] . " ". \Setting::get('currency_symbol')}}</del> 
                                        @else
                                        <span class="text-primary">{{ $data['unit_price']. " ". \Setting::get('currency_symbol') }}</span>
                                        @endif 
                                    </td>
                                    <form action="{{ route('updateProductFromCart', ['id' => $id]) }}" method="POST">
                                    @csrf
                                    <td class="text-center product-quantity">
                                        <div class="cart-qty d-inline-flex">
                                            <div class="dec qty-btn">-</div>
                                            <input class="cart-qty-input form-control" type="text" name="quantity" value="{{ $data['item_qty'] }}">
                                            <div class="inc qty-btn">+</div>
                                        </div>
                                    </td>
                                    <td class="text-center product-price-cart">
                                        @foreach ($data['options_with_selected_values'] as $option)
                                            
                                        <span class="text-primary">{{ $option->name }}</span>
                                            <ul>
                                            @foreach ($option->values as $value)
                                                <li>{{ $value->value }}</li>           
                                            @endforeach
                                            </ul>
                                        
                                        @endforeach
                                    </td>
                                    <td class="product-remove text-end text-nowrap">
                                        <button type="submit" class="btn btn-sm btn-outline-secondary text-nowrap px-3"><i class="bi bi-pencil-square lh-1"></i> <span class="d-none d-md-inline-block">Ažuriraj</span></button>
                                        <a href="{{ route('removeProductFromCart', ['id' => $id]) }}" class="btn btn-sm btn-outline-danger text-nowrap px-3"><i class="bi bi-x lh-1"></i> <span class="d-none d-md-inline-block">Obriši</span></a>
                                    </td>

                                    </form>
                                </tr>
                                @endforeach
                            @endif
                           
                        </tbody>
                    </table>
                </div>
                <!-- Cart Table -->
                <div class="d-flex">
                    <div>
                        <a class="btn btn-outline-dark" href="{{ route('home') }}">
                            <i class="ci-arrow-left mt-sm-0 me-1"></i>
                            <span class="d-none d-sm-inline">Nastavi kupovati</span>
                        </a>
                    </div>
                </div>
                <div class="row flex-row-reverse pt-4">
                    <div class="col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-header bg-transparent py-3">
                                <h6 class="m-0 mb-1">Ukupno</h6>
                            </div>
                            <div class="card-body ">
                                <ul class="list-unstyled">
                                    <li class="d-flex justify-content-between align-items-center border-top pt-3 mt-3">
                                        <h6 class="me-2">Ukupno bez popusta: </h6><span class="text-end text-dark">{{ $total_without_discount . " ". \Setting::get('currency_symbol')}}</span>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center border-top pt-3 mt-3">
                                        <h6 class="me-2">Popust: </h6><span class="text-end text-dark">{{ $discount_total . " ". \Setting::get('currency_symbol')}}</span>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center border-top pt-3 mt-3">
                                        <h6 class="me-2">Ukupno: </h6><span class="text-end text-dark">{{ $total . " ". \Setting::get('currency_symbol')}}</span>
                                    </li>
                                </ul>
                                <div class="d-grid gap-2 mx-auto">
                                    <a class="btn btn-primary" href="{{ route('checkout.index') }}">Nastavi na plačanje</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Cart Table -->
    </main>
    <!-- End Main -->

    @include('site.partials.footer')
</div>
@endsection