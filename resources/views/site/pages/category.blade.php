@extends('site.app')
@section('content')
<div class="container-fluid mt-5 mb-5">
    <div class="row g-2">
        <div class="col-md-3">
            <div class="t-products p-2">
                <h6 class="text-uppercase">Computer & Periferals</h6>
                <div class="p-lists">
                    <div class="d-flex justify-content-between mt-2"> <span>Laptops</span> <span>23</span> </div>
                    <div class="d-flex justify-content-between mt-2"> <span>Desktops</span> <span>46</span> </div>
                    <div class="d-flex justify-content-between mt-2"> <span>Monitors</span> <span>13</span> </div>
                    <div class="d-flex justify-content-between mt-2"> <span>Mouse</span> <span>33</span> </div>
                    <div class="d-flex justify-content-between mt-2"> <span>Keyboard</span> <span>12</span> </div>
                    <div class="d-flex justify-content-between mt-2"> <span>Printer</span> <span>53</span> </div>
                    <div class="d-flex justify-content-between mt-2"> <span>Mobiles</span> <span>203</span> </div>
                    <div class="d-flex justify-content-between mt-2"> <span>CPU</span> <span>23</span> </div>
                </div>
            </div>
            <div class="processor p-2">
                <div class="heading d-flex justify-content-between align-items-center">
                    <h6 class="text-uppercase">Opcije</h6> <span>--</span>
                </div>
                @foreach ($options as $option)
                    <div class="d-flex justify-content-between mt-2">
                        <div class="form-check"> <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"> <label class="form-check-label" for="flexCheckDefault"> {{ $option->values->value }}</label> </div> <span>3</span>
                    </div>
                @endforeach
                <div class="d-flex justify-content-between mt-2">
                    <div class="form-check"> <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"> <label class="form-check-label" for="flexCheckDefault"> Intel Core i7 </label> </div> <span>3</span>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <div class="form-check"> <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked> <label class="form-check-label" for="flexCheckChecked"> Intel Core i6 </label> </div> <span>4</span>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <div class="form-check"> <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked> <label class="form-check-label" for="flexCheckChecked"> Intel Core i3 </label> </div> <span>14</span>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <div class="form-check"> <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked> <label class="form-check-label" for="flexCheckChecked"> Intel Centron </label> </div> <span>8</span>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <div class="form-check"> <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked> <label class="form-check-label" for="flexCheckChecked"> Intel Pentinum </label> </div> <span>14</span>
                </div>
            </div>
            <div class="brand p-2">
                <div class="heading d-flex justify-content-between align-items-center">
                    <h6 class="text-uppercase">Brand</h6> <span>--</span>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <div class="form-check"> <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"> <label class="form-check-label" for="flexCheckDefault"> Apple </label> </div> <span>13</span>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <div class="form-check"> <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked> <label class="form-check-label" for="flexCheckChecked"> Asus </label> </div> <span>4</span>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <div class="form-check"> <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked> <label class="form-check-label" for="flexCheckChecked"> Dell </label> </div> <span>24</span>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <div class="form-check"> <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked> <label class="form-check-label" for="flexCheckChecked"> Lenovo </label> </div> <span>18</span>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <div class="form-check"> <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked> <label class="form-check-label" for="flexCheckChecked"> Acer </label> </div> <span>44</span>
                </div>
            </div>
            <div class="type p-2 mb-2">
                <div class="heading d-flex justify-content-between align-items-center">
                    <h6 class="text-uppercase">Type</h6> <span>--</span>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <div class="form-check"> <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"> <label class="form-check-label" for="flexCheckDefault"> Hybrid </label> </div> <span>23</span>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <div class="form-check"> <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked> <label class="form-check-label" for="flexCheckChecked"> Laptop </label> </div> <span>24</span>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <div class="form-check"> <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked> <label class="form-check-label" for="flexCheckChecked"> Desktop </label> </div> <span>14</span>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <div class="form-check"> <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked> <label class="form-check-label" for="flexCheckChecked"> Touch </label> </div> <span>28</span>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <div class="form-check"> <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked> <label class="form-check-label" for="flexCheckChecked"> Tablets </label> </div> <span>44</span>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row g-2">
                @forelse ($products as $product)
                    <div class="col-md-4">
                        <div class="product py-4"> <span class="off bg-success">-25% OFF</span>
                            <div class="text-center"> <img src="{{ Storage::disk('s3')->temporaryUrl($product->images[0]->path, '+2 minutes') }}" width="200"> </div>
                            <div class="about text-center">
                                <h5>{{ $product->product_translation->name }}</h5>
                                <p>{{ $product->product_translation->short_description }}</p>
                                <span>{{ $product->stock_item->unit_price }} Kn</span>
                            </div>
                            <div class="cart-button mt-3 px-2 d-flex justify-content-between align-items-center"> <button class="btn btn-primary text-uppercase">Add to cart</button>
                                <div class="add"> <span class="product_fav"><i class="fa fa-heart-o"></i></span> <span class="product_fav"><i class="fa fa-opencart"></i></span> </div>
                            </div>
                        </div>
                    </div>
                @empty
                    NEMA PROIZVODA!
                @endforelse
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection