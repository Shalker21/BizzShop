
<!-- Login Popup START -->
<div class="modal fade" id="topbarlogin">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <div class="modal-title p-3">
                    <h5 class="m-0 text-white">Prijavi se u svoj korisnički račun!</h5>
                    <p class="m-0 text-white">Molimo Vas prijavite se svojim korisničkim podacima.</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="w-100 p-3">
                    <!-- Form START -->
                    <form>
                        <div class="mb-3">
                            <label class="form-label" for="exampleInputEmail1">E-mail adresa</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="E-mail">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="*********">
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Ostani prijavljen?</label>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-sm-4">
                                <button type="submit" class="btn btn-dark">Prijava</button>
                            </div>
                            <div class="col-sm-8 text-sm-end">
                                <span class="text-muted">Nemate korisnički račun? <a href="sign-up.html">Registriraj se</a></span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login Popup END -->
<!-- Mini Cart -->
<div class="modal px-modal-right fade" id="modalMiniCart" tabindex="-1" role="dialog" aria-hidden="true">
    <!-- Shopping Cart -->
    <div class="modal-dialog px-modal-vertical">
        <div class="modal-content">
            <!-- Header-->
            <div class="modal-header border-bottom">
                <h6 class="m-0 fw-bold">
                    Košarica
                </h6>
                <!-- Close -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <!-- List group -->
                <ul class="list-unstyled m-0 p-0">
                    @php
                        $total = 0;
                        $total_without_discount = 0;
                        $discount_total = 0;
                    @endphp
                    
                    @if(session('cart'))
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
                        <li class="py-3 border-bottom">
                            <div class="row align-items-center">
                                <div class="col-4">
                                    <!-- Image -->
                                    <a href="#">
                                        <img class="img-fluid border" src="{{ Storage::disk('s3')->temporaryUrl($data['variant_image'], '+2 minutes') }}" alt="...">
                                    </a>
                                </div>
                                <div class="col-8">
                                    <!-- Title -->
                                    <p class="mb-2">
                                        <a class="text-dark fw-500" href="{{ route('product.show', ['id' => $id]) }}">{{ $data['name'] }}</a>
                                        @if (!empty($data['unit_special_price']))
                                        <span class="text-primary">{{ $data['unit_special_price'] }} kn</span>
                                        <del class="fs-sm text-muted">{{ $data['unit_price'] }} kn</del> 
                                        @else
                                        <span class="text-primary">{{ $data['unit_price'] }} kn</span>
                                        @endif  
                                    </p>
                                    
                                    <!--Footer -->
                                    <div class="d-flex align-items-center">
                                        <a class="small text-dark ms-auto" href="{{ route('removeProductFromCart', ['id' => $id]) }}">
                                            <i class="bi bi-x"></i> Obriši
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach 
                    @endif
                    
                </ul>
            </div>
            <!-- Footer -->
            <div class="mt-auto p-3 pt-0">
                <div class="row g-0 pt-2 mt-2 border-top fw-bold text-dark">
                    <div class="col-8">
                        <span class="text-dark">Ukupno:</span>
                    </div>
                    <ul>
                        <li class="d-flex justify-content-between align-items-center border-top pt-3 mt-3">
                            <h6 class="me-2">Ukupno bez popusta: </h6><span class="text-end text-dark">{{ $total_without_discount }} kn</span>
                        </li>
                        <li class="d-flex justify-content-between align-items-center border-top pt-3 mt-3">
                            <h6 class="me-2">Popust: </h6><span class="text-end text-dark">{{ $discount_total}} kn</span>
                        </li>
                        <li class="d-flex justify-content-between align-items-center border-top pt-3 mt-3">
                            <h6 class="me-2">Ukupno: </h6><span class="text-end text-dark">{{ $total}} kn</span>
                        </li>
                    </ul>
                </div>
                <div class="pt-4">
                    @if (session()->get('cart'))
                    <a class="btn btn-block btn-dark w-100 mb-3" href={{ route('checkout.index') }}>Nastavite na plačanje</a>
                    @endif
                    <a class="btn btn-block btn-outline-dark w-100" href="{{ route('showCart') }}">Detaljnije</a>
                </div>
            </div>
            <!-- Buttons -->
        </div>
    </div>
</div>
<!-- End Mini Cart -->

<!-- End shipping-->
<!-- Ask About Product-->
<div class="modal-askform-view modal fade" id="px_ask_modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ask about product</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Your Name</label>
                                <input type="text" class="form-control" placeholder="Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Email address</label>
                                <input type="email" class="form-control" placeholder="E-mail">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label" for="exampleInputEmail1">Subject</label>
                                <input type="text" class="form-control" placeholder="Subject">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label" for="exampleInputEmail1">Your Message</label>
                                <textarea class="form-control" rows="5" placeholder="Your Message"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Ask About Product-->