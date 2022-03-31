@extends('site.app')

@section('content')
@include('site.partials.header')
    
<main>
    <!-- Breadcrumb -->
    <div class="py-3 bg-gray-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 my-2">
                    <h1 class="m-0 h4 text-center text-lg-start">Prijava</h1>
                </div>
                <div class="col-lg-6 my-2">
                    <ol class="breadcrumb dark-link m-0 small justify-content-center justify-content-lg-end">
                        <li class="breadcrumb-item"><a class="text-nowrap" href="{{ route('home') }}"><i class="bi bi-home"></i>Početna</a></li>
                        <li class="breadcrumb-item text-nowrap active" aria-current="page">Login</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb -->
    <!-- login page -->
    <div class="section">
        <div class="container">
            <div class="justify-content-center row">
                <div class="col-lg-5 col-xxl-4">
                    <div class="card">
                        <div class="card-header bg-transparent py-3">
                            <h3 class="h4 mb-0">Prijava </h3>
                        </div>
                        <div class="card-body">
                            <form class="">
                                <div class="form-group mb-3">
                                    <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                                    <input type="text" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="E-mail">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <div class="row align-items-center">
                                        <label class="form-label col" for="password">Password<span class="text-danger">*</span></label>
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="*********">
                                </div>
                                <!-- Checkbox -->
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Prijava') }}
                                    </button>
                                </div>
                            </form>
                            <div class="pt-4 text-center">
                                <span class="text-muted">Nemate Account? <a href="{{ route('register') }}">Registriraj se</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end login -->
</main>
<!-- End Main -->
@include('site.partials.footer')

</div>
@endsection
