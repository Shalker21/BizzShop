@extends('site.app')
@section('content')
    <div>

        <div id="carousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carousel" data-slide-to="0" class="active"></li>
                <li data-target="#carousel" data-slide-to="1"></li>
                <li data-target="#carousel" data-slide-to="2"></li>
            </ol>

            <div class="carousel-inner" role="listbox">

                <div class="carousel-item active" style="background: #25c;">
                    <div class="caption">
                        <h1>Create and share your whatever</h1>
                        <h2>Make it easy for you to do whatever this thing does.</h2>
                    </div>
                </div>

                <div class="carousel-item" style="background: #52c;">
                    <div class="caption">
                        <h1>Something and share your whatever</h1>
                        <h2>Else it easy for you to do whatever this thing does.</h2>

                        <a class="big-button" href="" title="">Create Project</a>
                        <div class="clear"></div>
                        <a class="view-demo" href="" title="">View Demo</a>
                    </div>
                </div>

                <div class="carousel-item"
                    style="background-image: url('https://images.unsplash.com/photo-1476553986076-d59060d397e4?ixlib=rb-1.2.1&auto=format&fit=crop&w=1989&q=80'); background-size: cover;">
                    <div class="caption">
                        <h1>Create and share your whatever</h1>
                        <h2>Make it easy for you to do whatever this thing does.</h2>
                    </div>
                </div>

            </div>

            <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>

        </div>
      </div>

    <!-- woman and man -->
    <div class="d-md-flex flex-md-equal w-100 my-md-3 pl-md-3 border">
        <div class="bg-dark w-100 mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center text-white overflow-hidden" style="background-image: url('https://images.unsplash.com/photo-1476553986076-d59060d397e4?ixlib=rb-1.2.1&auto=format&fit=crop&w=1989&q=80'); background-size: cover;">
            <div class="my-3 py-3">
                <h2 class="display-5">Muškarci</h2>
                <p class="lead">Odaberi muške artikle</p>
            </div>
            <div class="mx-auto" style="">
              <a href="#" class="btn btn-primary rounded m-2 p-3">Pogledaj</a>
            </div>
        </div>
        <div class="bg-dark w-100 mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center text-white overflow-hidden" style="background-image: url('https://images.unsplash.com/photo-1476553986076-d59060d397e4?ixlib=rb-1.2.1&auto=format&fit=crop&w=1989&q=80'); background-size: cover;">
            <div class="my-3 py-3">
                <h2 class="display-5">Žene</h2>
                <p class="lead">Odaberi ženske artikle</p>
            </div>
            <div class="mx-auto" style="">
              <a href="#" class="btn btn-primary rounded m-2 p-3">Pogledaj</a>
            </div>
        </div>
    </div>

    <!-- main section -->
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
                        <h6 class="text-uppercase">Processor</h6> <span>--</span>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <div class="form-check"> <input class="form-check-input" type="checkbox" value=""
                                id="flexCheckDefault"> <label class="form-check-label" for="flexCheckDefault"> Intel Core i7
                            </label> </div> <span>3</span>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <div class="form-check"> <input class="form-check-input" type="checkbox" value=""
                                id="flexCheckChecked" checked> <label class="form-check-label" for="flexCheckChecked"> Intel
                                Core i6 </label> </div> <span>4</span>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <div class="form-check"> <input class="form-check-input" type="checkbox" value=""
                                id="flexCheckChecked" checked> <label class="form-check-label" for="flexCheckChecked"> Intel
                                Core i3 </label> </div> <span>14</span>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <div class="form-check"> <input class="form-check-input" type="checkbox" value=""
                                id="flexCheckChecked" checked> <label class="form-check-label" for="flexCheckChecked"> Intel
                                Centron </label> </div> <span>8</span>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <div class="form-check"> <input class="form-check-input" type="checkbox" value=""
                                id="flexCheckChecked" checked> <label class="form-check-label" for="flexCheckChecked"> Intel
                                Pentinum </label> </div> <span>14</span>
                    </div>
                </div>
                <div class="brand p-2">
                    <div class="heading d-flex justify-content-between align-items-center">
                        <h6 class="text-uppercase">Brand</h6> <span>--</span>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <div class="form-check"> <input class="form-check-input" type="checkbox" value=""
                                id="flexCheckDefault"> <label class="form-check-label" for="flexCheckDefault"> Apple
                            </label> </div> <span>13</span>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <div class="form-check"> <input class="form-check-input" type="checkbox" value=""
                                id="flexCheckChecked" checked> <label class="form-check-label" for="flexCheckChecked"> Asus
                            </label> </div> <span>4</span>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <div class="form-check"> <input class="form-check-input" type="checkbox" value=""
                                id="flexCheckChecked" checked> <label class="form-check-label" for="flexCheckChecked"> Dell
                            </label> </div> <span>24</span>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <div class="form-check"> <input class="form-check-input" type="checkbox" value=""
                                id="flexCheckChecked" checked> <label class="form-check-label" for="flexCheckChecked">
                                Lenovo </label> </div> <span>18</span>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <div class="form-check"> <input class="form-check-input" type="checkbox" value=""
                                id="flexCheckChecked" checked> <label class="form-check-label" for="flexCheckChecked"> Acer
                            </label> </div> <span>44</span>
                    </div>
                </div>
                <div class="type p-2 mb-2">
                    <div class="heading d-flex justify-content-between align-items-center">
                        <h6 class="text-uppercase">Type</h6> <span>--</span>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <div class="form-check"> <input class="form-check-input" type="checkbox" value=""
                                id="flexCheckDefault"> <label class="form-check-label" for="flexCheckDefault"> Hybrid
                            </label> </div> <span>23</span>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <div class="form-check"> <input class="form-check-input" type="checkbox" value=""
                                id="flexCheckChecked" checked> <label class="form-check-label" for="flexCheckChecked">
                                Laptop </label> </div> <span>24</span>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <div class="form-check"> <input class="form-check-input" type="checkbox" value=""
                                id="flexCheckChecked" checked> <label class="form-check-label" for="flexCheckChecked">
                                Desktop </label> </div> <span>14</span>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <div class="form-check"> <input class="form-check-input" type="checkbox" value=""
                                id="flexCheckChecked" checked> <label class="form-check-label" for="flexCheckChecked">
                                Touch </label> </div> <span>28</span>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <div class="form-check"> <input class="form-check-input" type="checkbox" value=""
                                id="flexCheckChecked" checked> <label class="form-check-label" for="flexCheckChecked">
                                Tablets </label> </div> <span>44</span>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row g-2">
                    <div class="col-md-4">
                        <div class="product py-4"> <span class="off bg-success">-25% OFF</span>
                            <div class="text-center"> <img src="https://i.imgur.com/nOFet9u.jpg" width="200"> </div>
                            <div class="about text-center">
                                <h5>XRD Active Shoes</h5> <span>$1,999.99</span>
                            </div>
                            <div class="cart-button mt-3 px-2 d-flex justify-content-between align-items-center"> <button
                                    class="btn btn-primary text-uppercase">Add to cart</button>
                                <div class="add"> <span class="product_fav"><i
                                            class="fa fa-heart-o"></i></span> <span class="product_fav"><i
                                            class="fa fa-opencart"></i></span> </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="product py-4"> <span class="off bg-warning">SALE</span>
                            <div class="text-center"> <img src="https://i.imgur.com/VY0R9aV.png" width="200"> </div>
                            <div class="about text-center">
                                <h5>Hygen Smart watch </h5> <span>$123.43</span>
                            </div>
                            <div class="cart-button mt-3 px-2 d-flex justify-content-between align-items-center"> <button
                                    class="btn btn-primary text-uppercase">Add to cart</button>
                                <div class="add"> <span class="product_fav"><i
                                            class="fa fa-heart-o"></i></span> <span class="product_fav"><i
                                            class="fa fa-opencart"></i></span> </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="product py-4">
                            <div class="text-center"> <img src="https://i.imgur.com/PSGrLdz.jpg" width="200"> </div>
                            <div class="about text-center">
                                <h5>Acer surface book 2.5</h5> <span>$1,999.99</span>
                            </div>
                            <div class="cart-button mt-3 px-2 d-flex justify-content-between align-items-center"> <button
                                    class="btn btn-primary text-uppercase">Add to cart</button>
                                <div class="add"> <span class="product_fav"><i
                                            class="fa fa-heart-o"></i></span> <span class="product_fav"><i
                                            class="fa fa-opencart"></i></span> </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="product py-4"> <span class="off bg-success">-10% OFF</span>
                            <div class="text-center"> <img src="https://i.imgur.com/OdRSpXG.jpg" width="200"> </div>
                            <div class="about text-center">
                                <h5>Dell XPS Surface</h5> <span>$1,245.89</span>
                            </div>
                            <div class="cart-button mt-3 px-2 d-flex justify-content-between align-items-center"> <button
                                    class="btn btn-primary text-uppercase">Add to cart</button>
                                <div class="add"> <span class="product_fav"><i
                                            class="fa fa-heart-o"></i></span> <span class="product_fav"><i
                                            class="fa fa-opencart"></i></span> </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="product py-4">
                            <!-- <span class="off bg-success">-25% OFF</span> -->
                            <div class="text-center"> <img src="https://i.imgur.com/X2AwTCY.jpg" width="200"> </div>
                            <div class="about text-center">
                                <h5>Acer surface book 5.5</h5> <span>$2,999.99</span>
                            </div>
                            <div class="cart-button mt-3 px-2 d-flex justify-content-between align-items-center"> <button
                                    class="btn btn-primary text-uppercase">Add to cart</button>
                                <div class="add"> <span class="product_fav"><i
                                            class="fa fa-heart-o"></i></span> <span class="product_fav"><i
                                            class="fa fa-opencart"></i></span> </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="product py-4"> <span class="off bg-success">-5% OFF</span>
                            <div class="text-center"> <img src="https://i.imgur.com/QQwcBpF.png" width="200"> </div>
                            <div class="about text-center">
                                <h5>Xps smart watch 5.0</h5> <span>$999.99</span>
                            </div>
                            <div class="cart-button mt-3 px-2 d-flex justify-content-between align-items-center"> <button
                                    class="btn btn-primary text-uppercase">Add to cart</button>
                                <div class="add"> <span class="product_fav"><i
                                            class="fa fa-heart-o"></i></span> <span class="product_fav"><i
                                            class="fa fa-opencart"></i></span> </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="product py-4"> <span class="off bg-warning">SALE</span>
                            <div class="text-center"> <img src="https://i.imgur.com/PSGrLdz.jpg" width="200"> </div>
                            <div class="about text-center">
                                <h5>Acer surface book 8.5</h5> <span>$3,999.99</span>
                            </div>
                            <div class="cart-button mt-3 px-2 d-flex justify-content-between align-items-center"> <button
                                    class="btn btn-primary text-uppercase">Add to cart</button>
                                <div class="add"> <span class="product_fav"><i
                                            class="fa fa-heart-o"></i></span> <span class="product_fav"><i
                                            class="fa fa-opencart"></i></span> </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="product py-4">
                            <div class="text-center"> <img src="https://i.imgur.com/m22OQy9.jpg" width="200"> </div>
                            <div class="about text-center">
                                <h5>Tyko Running shoes</h5> <span>$99.99</span>
                            </div>
                            <div class="cart-button mt-3 px-2 d-flex justify-content-between align-items-center"> <button
                                    class="btn btn-primary text-uppercase">Add to cart</button>
                                <div class="add"> <span class="product_fav"><i
                                            class="fa fa-heart-o"></i></span> <span class="product_fav"><i
                                            class="fa fa-opencart"></i></span> </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="product py-4">
                            <div class="text-center"> <img src="https://i.imgur.com/OdRSpXG.jpg" width="200"> </div>
                            <div class="about text-center">
                                <h5>Dell surface book 5</h5> <span>$1,999.99</span>
                            </div>
                            <div class="cart-button mt-3 px-2 d-flex justify-content-between align-items-center"> <button
                                    class="btn btn-primary text-uppercase">Add to cart</button>
                                <div class="add"> <span class="product_fav"><i
                                            class="fa fa-heart-o"></i></span> <span class="product_fav"><i
                                            class="fa fa-opencart"></i></span> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('links')
    <style>
        .carousel-inner {
            width: 100%;
            display: inline-block;
            position: relative;
        }

        .carousel-inner {
            padding-top: 43.25%;
            display: block;
            content: "";
        }

        .carousel-item {
            position: absolute;
            top: 0;
            bottom: 0;
            right: 0;
            left: 0;
            background: skyblue;
            background: no-repeat center center scroll;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        .caption {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translateX(-50%) translateY(-50%);
            width: 60%;
            z-index: 9;
            margin-top: 20px;
            text-align: center;
        }

        .caption h1 {
            color: #fff;
            font-size: 52px;
            font-weight: 700;
            margin-bottom: 23px;
        }

        .caption h2 {
            color: rgba(255, 255, 255, .75);
            font-size: 26px;
            font-weight: 300;
        }

        a.big-button {
            color: #fff;
            font-size: 19px;
            font-weight: 700;
            text-transform: uppercase;
            background: #eb7a00;
            background: rgba(255, 0, 0, 0.75);
            padding: 28px 35px;
            border-radius: 3px;
            margin-top: 80px;
            margin-bottom: 0;
            display: inline-block;
        }

        a.big-button:hover {
            text-decoration: none;
            background: rgba(255, 0, 0, 0.9);
        }

        a.view-demo {
            color: #fff;
            font-size: 21px;
            font-weight: 700;
            display: inline-block;
            margin-top: 35px;
        }

        a.view-demo:hover {
            text-decoration: none;
            color: #333;
        }

        .carousel-indicators .active {
            background: #fff;
        }

        .carousel-indicators li {
            background: rgba(255, 255, 255, 0.4);
            border-top: 20px solid;
            z-index: 15;
        }

    </style>
@endpush
