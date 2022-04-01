<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="../index.html">
            BizzShop (staviti logo image) 
            <!--<img src="../static/img/logo.svg" title="" alt="">-->
        </a>
        <!-- Logo -->
        <!-- Menu -->

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">Početna</a>
                </li>
                @foreach ($nav_categories as $category)

                    @if ($category->menu)
                    <li class="dropdown dropdown-full nav-item">
                        <a href="{{ route('category.show', ['id' => $category->id]) }}" class="nav-link">{{ $category->category_translation->name }}</a>
                        
                        @if (count($category->childrens) > 0)
                            <label class="px-dropdown-toggle mob-menu"></label>
                            <div class="dropdown-menu dropdown-mega-menu py-3">
                                <div class="container-fluid px-sm-3">
                                    <div class="row gy-4">
                                        @foreach ($category->childrens as $category_child_1)
                                            @if ($category_child_1->menu)
                                            <div class="col-6 col-md-3 col-xl-2">
                                                <h6 class="sm-title-02 mb-3">
                                                    <a href="{{ route('category.show', ['id' => $category_child_1->id]) }}">{{ $category_child_1->category_translation->name }}</a>
                                                </h6>
                                                @if (count($category_child_1->childrens) > 0)

                                                <ul class="list-unstyled link-style-1">
                                                @foreach ($category_child_1->childrens as $category_child_2)
                                                @if ($category_child_2->menu)                                                
                                                    <li><a href="{{ route('category.show', ['id' => $category_child_2->id]) }}">{{ $category_child_2->category_translation->name }}</a></li>
                                                @endif
                                                @endforeach
                                                </ul>

                                                @endif
                                            </div>
                                            @endif
                                        @endforeach

                                        <!-- main image in nav dropdown -->
                                        <div class="col-12 col-md-3 col-xl-6 d-flex flex-column">
                                            <div class="min-h-250px bg-center bg-cover d-flex align-items-center justify-content-center" style="background-image: url({{ Storage::disk('s3')->temporaryUrl($category->category_image->path, '+2 minutes') }});">
                                                <div class="text-center px-4 py-3">
                                                    <h6 class="text-uppercase text-white mb-3">{{ strtoupper($category->category_translation->name) }}</h6>
                                                    <h3 class="fw-600 h4 text-white">Pretraži u kategoriji {{ $category->category_translation->name }}</h3>
                                                    <div class="pt-2">
                                                        <a class="btn btn-white btn-sm" href="{{ route('category.show', ['id' => $category->id]) }}">Pretraži</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>    
                        @endif
                        
                    </li>                    
                    @endif
                    
                @endforeach
            </ul>
        </div>
        <!-- End Menu -->
        <div class="nav flex-nowrap align-items-center header-right">
            <!-- Nav Search-->
            <div class="nav-item">
                <a class="nav-link collapsed" data-bs-toggle="collapse" href="javascript:void(0)" data-bs-target="#search-open" aria-expanded="false">
                    <i class="bi bi-search"> </i>
                </a>
            </div>
            <!-- Cart -->
            <div class="nav-item">
                <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modalMiniCart" href="javascript:void(0)">
                    @php
                        $total = 0;

                        if (session('cart')) {

                            foreach (session('cart') as $id => $data){
                                
                                $total += $data['item_qty'];
                                
                            }
                        }
                    @endphp
                    <span class="" data-cart-items="{{ $total }}">
                        <i class="bi bi-cart"> </i>
                    </span>
                </a>
            </div>
            <!-- Mobile Toggle -->
            <button class="navbar-toggler ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- End Mobile Toggle -->
        </div>
    </div>
</nav>