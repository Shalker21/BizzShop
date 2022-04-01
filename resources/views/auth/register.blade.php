

@extends('site.app')
@section('content')
    @include('site.partials.header')
    
    <main>
        <!-- Breadcrumb -->
        <div class="py-3 bg-gray-100">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 my-2">
                        <h1 class="m-0 h4 text-center text-lg-start">Register Now</h1>
                    </div>
                    <div class="col-lg-6 my-2">
                        <ol class="breadcrumb dark-link m-0 small justify-content-center justify-content-lg-end">
                            <li class="breadcrumb-item"><a class="text-nowrap" href="#"><i class="bi bi-home"></i>Home</a></li>
                            <li class="breadcrumb-item text-nowrap active" aria-current="page">Register</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Breadcrumb -->
        <!-- signup page -->
        <div class="section">
            <div class="container">
                <div class="justify-content-center row">
                    <div class="col-lg-10 col-xxl-6">
                        <div class="card">
                            <div class="card-header bg-transparent py-3">
                                <h3 class="h4 mb-0">Registracija </h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('login') }}" method="POST" role="form">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="first_name" class="form-label">Ime<span class="text-danger">*</span></label>
                                                <input type="text" name="first_name" id="first_name" class="form-control @error('first_name') is-invalid @enderror" placeholder="first_name">
                                            </div>
                                            @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="last_name" class="form-label">Prezime<span class="text-danger">*</span></label>
                                                <input type="text" name="last_name" id="last_name" class="form-control @error('last_name') is-invalid @enderror" placeholder="last_name">
                                            </div>
                                            @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="E-mail">
                                            </div>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label col" for="password">Password<span class="text-danger">*</span></label>
                                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="*********">
                                            </div>
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label col" for="confirm_password">Potvrdi Password<span class="text-danger">*</span></label>
                                                <input type="password" name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror" id="confirm_password" placeholder="*********">
                                            </div>
                                            @error('confirm_password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="address" class="form-label">Adresa stanovanja<span class="text-danger">*</span></label>
                                                <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" placeholder="address">
                                            </div>
                                            @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="city" class="form-label">Grad<span class="text-danger">*</span></label>
                                                <input type="text" name="city" id="city" class="form-control @error('city') is-invalid @enderror" placeholder="city">
                                            </div>
                                            @error('city')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        
                                    </div>
                                    <div class="form-check mb-4">
                                        <input class="form-check-input" type="checkbox" value="" id="form2Example3" checked />
                                        <label class="form-check-label" for="form2Example3"> Prihvacam uvijete </label>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <div class="col">
                                            <button type="submit" class="btn btn-primary">
                                                Stvori Account
                                            </button>
                                        </div>
                                        <div class="col-12 col-sm text-sm-end mt-3 mt-sm-0">
                                            <span class="text-muted">Imate Account? <a href="sign-up.html">Prijavite se</a></span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end signup -->
    </main>
    <!-- End Main -->

    @include('site.partials.footer')

</div>

@endsection
