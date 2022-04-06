@extends('site.app')
@section('content')
@include('site.partials.header')

<div class="container">
    <hr>
    <h3>Uspješna Narudžba</h3>
    <p>Narudzbu smo poslali na <b>{{ $email }}</b></p>
</div>

@include('site.partials.footer')
</div>
@endsection