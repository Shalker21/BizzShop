<div class="sticky-top">  

      <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container">
          <div class="collapse navbar-collapse" id="mynavbar">
            <ul class="navbar-nav me-auto"></ul>
            <ul class="navbar-nav text-right list-inline d-flex">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Košarica (0)</a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Link</a></li>
                    <li><a class="dropdown-item" href="#">Another link</a></li>
                    <li><a class="dropdown-item" href="#">A third link</a></li>
                    <li><a class="dropdown-item btn btn-primary" href="#">Detaljnije</a></li>
                  </ul>
                </li>
              </ul>
          </div>
        </div>
      </nav>
    
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="javascript:void(0)">TRAŽI PROIZVODE</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mynavbar">
          <ul class="navbar-nav me-auto">
            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0)"> - upiši kategoriju ili proizvod</a>
            </li>
          </ul>
          <form class="d-flex">
            <input class="form-control me-2" type="text" placeholder="Search">
            <button class="btn btn-primary" type="button">Traži</button>
          </form>
        </div>
      </div>
</nav>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="#">BizzShop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav"  aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="main_nav">
            <ul class="navbar-nav">
                <li class="nav-item active"> <a class="nav-link" href="#">Početna </a> </li>
                @foreach ($categories as $category)
                    <li class="nav-item dropdown has-megamenu">
                        <a class="nav-link dropdown-toggle" href="{{ route('category.show', ['id' => $category->id]) }}" data-bs-toggle="dropdown">{{ $category->category_translation->name }}</a>
                    @if (count($category->childrens) > 0)
                        <div class="dropdown-menu megamenu" role="menu">
                            <div class="row g-3">
                                @foreach ($category->childrens as $children)
                                <div class="col-lg-3 col-6">
                                    <div class="col-megamenu">
                                        <a href="{{ route('category.show', ['id' => $children->id]) }}" class="title"><h6>{{$children->category_translation->name}}</h6></a>

                                        @if (count($children->childrens) > 0)
                                        <ul class="list-unstyled">
                                            @foreach ($children->childrens as $child)
                                                    <li><a href="#">{{$child->category_translation->name}}</a></li>    
                                            @endforeach
                                        </ul>
                                        @endif

                                        
                                    </div>  <!-- col-megamenu.// -->
                                </div><!-- end col-3 -->
                                @endforeach
                            </div><!-- end row --> 
                        </div> <!-- dropdown-mega-menu.// -->
                    </li>
                    @else
                    </li>
                    @endif
                @endforeach
                
                <li class="nav-item"><a class="nav-link" href="#"> O nama </a></li>
                <li class="nav-item"><a class="nav-link" href="#"> Kontakt </a></li>
            </ul>
        </div> <!-- navbar-collapse.// -->
    </div> <!-- container.// -->
</nav>

</div>
