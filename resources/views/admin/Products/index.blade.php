@extends('admin.app')
@section('content')

    <section class="bg-blueGray-50">
        <div class="w-full lg:w-8/12 px-4 mx-auto mt-6">
            <a class="bg-blue-400 px-4 py-3 rounded" href="{{ route('admin.catalog.products.create') }}">Nova kategorija</a>

            @foreach ($products as $product)
                <p>{{ $product->id }}</p>
                <p>{{ $product->product_translation->name }}</p>
            @endforeach

        </div>
    </section>
@endsection