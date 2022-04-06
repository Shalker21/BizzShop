<!-- Search START -->
<div class="px-search-full collapse bg-dark p-3 z-index-999 position-fixed w-100 top-0" id="search-open">
    <div class="container position-relative">
        <div class="row vh-100 justify-content-center">
            <div class="col-lg-8 pt-12">
                <h2 class="h1">
                    <span class="d-block text-white">Pretraga</span>
                </h2>
                <form action="{{ route('product.search') }}" method="GET" class="position-relative w-100">
                    @csrf
                    @method('GET')

                    <div class="mb-3 input-group">
                        <!-- Search input -->
                        <input class="form-control border-0 shadow-none" type="text" name="search_bar" placeholder="Pretraži ..." value="">
                        <!-- Search button -->
                        <button type="submit" class="btn btn-primary shadow-none">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>
            <!-- Search button close START -->
            <a class="search-close" data-bs-toggle="collapse" href="javascript:void(0)" data-bs-target="#search-open" aria-expanded="true">
                <i class="bi bi-x p-0 lh-1"></i>
            </a>
            <!-- Search button close END -->
        </div>
    </div>
</div>
<!-- Search END -->