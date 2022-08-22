@extends('site.app')
@section('content')
@include('site.partials.header')

<main>
    <!-- Breadcrumb -->
    <div class="py-3 bg-gray-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 my-2">
                    <h1 class="m-0 h4 text-center text-lg-start">Plačanje</h1>
                </div>
                <div class="col-lg-6 my-2">
                    <ol class="breadcrumb dark-link m-0 small justify-content-center justify-content-lg-end">
                        <li class="breadcrumb-item"><a class="text-nowrap" href="{{ route('home') }}"><i class="bi bi-home"></i>Početna</a></li>
                        <li class="breadcrumb-item text-nowrap active" aria-current="page">Plačanje</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb -->
    <!-- Table -->
    <div class="py-6">
        <div class="container">
            @error('type')
                <div class="text-red-600 font-light text-sm">{{ $message }}</div>
            @enderror
            <form action="{{ route('checkout.placeOrder') }}" method="POST" id="payment-form">
                @csrf
                @method('POST')

                <div class="row flex-row-reverse">
                    <!-- sidebar -->
                    <div class="col-lg-5 ps-lg-5">
                        <div class="card">
                            <div class="card-body">
                                <ul class="list-unstyled m-0 p-0">
                                    @php
                                        $total = 0;
                                        $total_without_discount = 0;
                                        $discount_total = 0;
                                    @endphp
                                    @if (session('cart'))
                                        <input type="hidden" name="cart_data" value="{{ base64_encode(serialize(session('cart'))) }}">

                                        @foreach (session('cart') as $id => $data)
                                        @php
                                            if ($data['unit_special_price']) {
                                                $total += (float)$data['unit_special_price'] * (float)$data['item_qty'];
                                                $discount_total +=  ((float)$data['unit_price'] - (float)$data['unit_special_price']) * (float)$data['item_qty'];
                                            } else {
                                                $total += (float)$data['unit_price'] * (float)$data['item_qty'];
                                            }
                                            $total_without_discount += (int)$data['unit_price'] * (float)$data['item_qty'];
                                        @endphp
                                            <li class="pb-3 mb-3 border-bottom">
                                                <div class="row align-items-center">
                                                    <div class="col-4 col-md-2 col-lg-2">
                                                        <!-- Image -->
                                                        <a href="#">
                                                            
                                                            @if ($data['variant_image'] !== "")
                                                            <img class="img-fluid border" src="{{ Storage::disk('s3')->temporaryUrl($data['variant_image'], '+2 minutes') }}" alt="...">
                                                            @else
                                                                <img src="" class="img-fluid" width="100" alt="">
                                                            @endif
                                                        </a>
                                                    </div>
                                                    <div class="col-8">
                                                        <!-- Title -->
                                                        <p class="mb-1">
                                                            <a class="text-dark fw-500" href="{{ route('product.show', ['id' => $id]) }}">{{ $data['name'] }}</a>
                                                            @if (!empty($data['unit_special_price']))
                                                            <p class="text-primary">{{ $data['unit_special_price']. " ". \Setting::get('currency_symbol') }}</p>
                                                            <del class="fs-sm text-muted">{{ $data['unit_price'] . " ". \Setting::get('currency_symbol')}}</del> 
                                                            @else
                                                            <p class="text-primary">{{ $data['unit_price']. " ". \Setting::get('currency_symbol') }}</p>
                                                            @endif 
                                                        </p>
                                                        <p class="mb-1">
                                                            {{ $data['item_qty'] }}
                                                        </p>
                                                        <!-- Remove -->
                                                        <a class="small link-danger ms-auto" href="{{ route('removeProductFromCart', ['id' => $id]) }}">
                                                            <i class="bi bi-x"></i> Obriši
                                                        </a>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                                <ul class="list-unstyled m-0">
                                    <li class="d-flex justify-content-between align-items-center border-top pt-3 mt-3">
                                        <h6 class="me-2">Ukupno bez popusta: </h6><span class="text-end text-dark">{{ $total_without_discount . " ". \Setting::get('currency_symbol')}}</span>
                                        <input type="hidden" name="total_without_discount" value="{{ $total_without_discount }}">
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center border-top pt-3 mt-3">
                                        <h6 class="me-2">Popust: </h6><span class="text-end text-dark">{{ $discount_total . " ". \Setting::get('currency_symbol')}}</span>
                                        <input type="hidden" name="discount_total" value="{{ $discount_total }}">
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center border-top pt-3 mt-3">
                                        <h6 class="me-2">Ukupno: </h6><span class="text-end text-dark">{{ $total ." ". \Setting::get('currency_symbol') }}</span>
                                        <input type="hidden" name="total" value="{{ $total }}">
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="border-bottom mb-4 pb-3">Podaci za dostavu</h5>
                                
                                    <div class="row">
                                        <div class="col-sm-6 mb-3">
                                            <label class="form-label">Ime</label>
                                            <input type="text" class="form-control @error('first_name') border border-danger @enderror" name="first_name" value="{{ old('first_name') }}">
                                            @error('first_name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6 mb-3">
                                            <label class="form-label">Prezime</label>
                                            <input type="text" class="form-control @error('last_name') border border-danger @enderror" name="last_name" value="{{ old('last_name') }}">
                                            @error('last_name') value="{{ old('name') }}"
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        </div>
                                        <div class="col-sm-6 mb-3">
                                            <label class="form-label">Email adresa</label>
                                            <input type="email" class="form-control @error('email') border border-danger @enderror" name="email" value="{{ old('email') }}">
                                            @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        </div>
                                        <div class="col-sm-6 mb-3">
                                            <label class="form-label">Adresa stanovanja</label>
                                            <input type="text" class="form-control @error('address') border border-danger @enderror" name="address" value="{{ old('address') }}">
                                            @error('address')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        </div>
                                        <div class="col-sm-6 mb-3">
                                            <label class="form-label">Grad</label>
                                            <input type="text" class="form-control @error('city') border border-danger @enderror" name="city" value="{{ old('city') }}">
                                            @error('city')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        </div>
                                        <div class="col-sm-6 mb-3">
                                            <label class="form-label">Poštanski broj</label>
                                            <input type="text" class="form-control @error('zip_number') border border-danger @enderror" name="zip_number" value="{{ old('zip_number') }}">
                                            @error('zip_number')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        </div>
                                        <div class="col-sm-6 mb-3">
                                            <label class="form-label">Broj telefona</label>
                                            <input type="text" class="form-control @error('phone_number') border border-danger @enderror" name="phone_number" value="{{ old('phone_number') }}">
                                            @error('phone_number')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        </div>
                                    </div>
                                
                            </div>
                        </div>
                        <div class="accordion accordion-alt pt-4" id="payment-methods">
                            <div class="card mb-3 shadow-none border">
                                <div class="card-header p-0 position-relative bg-transparent">
                                    <div class="form-check m-3" data-bs-toggle="collapse" data-bs-target="#credit-card">
                                        <input class="form-check-input @error('payment_method') border border-danger @enderror" type="radio" id="flexRadioDefault1" name="payment_method" value="card_payment" checked>
                                        <label class="form-check-label h6 m-0 w-100 stretched-link" for="flexRadioDefault1">
                                            Kartica
                                        </label>
                                    </div>
                                </div>
                                <div class="collapse show" id="credit-card" data-bs-parent="#payment-methods">
                                    <div class="card-body p-3">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="cc-name">Ime i Prezime na kartici</label>
                                            <input class="form-control @error('cc-name') border border-danger @enderror" type="text" id="cc-name" data-format="card" placeholder="ime i prezime" name="cc-name">
                                            @error('cc-name')                                            
                                               <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="cc-number">Broj kartice</label>
                                            <input class="form-control @error('card_no') border border-danger @enderror" type="text" id="cc-number" data-format="card" placeholder="0000 0000 0000 0000" name="card_no">
                                            @error('card_no')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        </div>
                                        <div class="g-2 row">
                                            <div class="col-7 form-group mb-1">
                                                <label class="form-label" for="cc-expiry">Mjesec isteka kartice</label>
                                                <input class="form-control @error('expiry_month') border border-danger @enderror" type="text" id="expiry_month" data-format="date" placeholder="mm" name="expiry_month">
                                                @error('expiry_month')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            </div>
                                            <div class="col-7 form-group mb-1">
                                                <label class="form-label" for="cc-expiry">Godina isteka kartice</label>
                                                <input class="form-control @error('expiry_year') border border-danger @enderror" type="text" id="expiry_year" data-format="date" placeholder="yy" name="expiry_year">
                                                @error('expiry_year')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            </div>
                                            <div class="col-5 form-group mb-1">
                                                <label class="form-label" for="cc-cvc">CVC</label>
                                                <input class="form-control @error('cvv') border border-danger @enderror" type="password" id="cc-cvc" data-format="cvc" placeholder="000" name="cvv">
                                                @error('cvv')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card shadow-none border">
                                <div class="card-header p-0 position-relative bg-transparent">
                                    <div class="form-check m-3 collapsed" data-bs-toggle="collapse" data-bs-target="#paypal">
                                        <input class="form-check-input" type="radio" name="payment_method"  value="cash_payment" id="paypal-radio1">
                                        <label class="form-check-label h6 m-0 stretched-link" for="paypal-radio1">
                                            Plaćanje pouzećem
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pt-4">
                            <button type="submit" class="btn btn-primary w-100" name="submit_button">Narudžba</button>
                            <p class="m-0 pt-3">Prihvaćam uvijete <a href="#">Terms & Conditions</a>, <a href="#">privacy and returns</a> pritiskom na tipku narudžba!</p>
                        </div>
                    </div>
                </div>

            </form>

        </div>
    </div>
    <!--Table -->
</main>
<!-- End Main -->

@include('site.partials.footer')
</div>
@endsection