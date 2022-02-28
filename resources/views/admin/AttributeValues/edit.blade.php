@extends('admin.app')
@section('content')
<section class="bg-blueGray-50">
    <div class="w-full lg:w-8/12 px-4 mx-auto mt-6">
        <div
            class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0">
            @if ($errors->any())
                <div class="flex items-center bg-red-500 text-white text-sm font-bold rounded px-4 py-3 mb-5" role="alert">
                    <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li> - {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('admin.catalog.attributeValue.store') }}" method="POST" role="form" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="rounded-t bg-white mb-0 px-6 py-6 dark:bg-darker dark:text-light">
                    <div class="text-center flex justify-between">
                        <h6 class="text-blueGray-700 text-xl font-bold">
                            Nova Vrijednost Atributa
                        </h6>
                        <div class="lg:w-4/12">
                            <button
                                class="bg-blue-500 text-white active:bg-blue-600 hover:bg-blue-400 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                                name="submit_store_product"
                                type="submit">
                                Spremi Promjene
                            </button>
                            <a href="{{ URL::previous() }}"
                                class="bg-green-500 text-white active:bg-green-600 hover:bg-green-400 font-bold uppercase text-xs px-4 py-2 mt-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150">
                                Odustani
                            </a>
                        </div>
                    </div>
                </div>
                <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                    <!-- OSNOVNE INFORMACIJE -->
                    <div class="flex flex-wrap mt-9 border-b-2 border-blue-200">
                        <div class="w-full lg:w-12/12 px-4">
                            
                        <h2 class="border-b-2 border-blue-200 mb-5">Osnovne Informacije</h2>
                        </div>
                        <div class="w-full lg:w-5/12 px-4">
                            <div class="relative w-full mb-3">
                                <label
                                    class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2 ">
                                    Vrijednost Atributa
                                </label>
                                <input type="text" id="value" name="value"
                                    class="dark:text-gray-600 border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150 @error('value') border-2 border-red-600 @enderror"
                                    value="{{ $attributeValue->value }}">
                                    @error('value')
                                        <div class="text-red-600 font-light text-sm">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>
                        <div class="w-full lg:w-6/12 px-4">
                            <div class="relative w-full mb-3">
                                <label class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                    Proizvod
                                </label>
                                <div class="@error('product_id') border-2 border-red-600 @enderror">
                                    <select name="product_id" multiple id="product_id">
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}" @if ($attributeValue->product_id != null && $product->id === $attributeValue->product_id)
                                                selected
                                        @endif>
                                                {{ $product->product_translation->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('product_id')
                                    <div class="text-red-600 font-light text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="w-full lg:w-6/12 px-4">
                            <div class="relative w-full mb-3">
                                <label class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                    Atribut
                                </label>
                                <div class="@error('product_id') border-2 border-red-600 @enderror">
                                    <select name="attribute_id" id="attribute_id">
                                        @foreach ($attributes as $attribute)
                                            <option value="{{ $attribute->id }}" @if ($attributeValue->product_id != null && $product->id === $attributeValue->product_id)
                                                selected
                                        @endif>
                                                {{ $attribute->type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('attribute_id')
                                    <div class="text-red-600 font-light text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
    
@endsection

@push('scripts')
    <script>

        jQuery('#attribute_id').multiselect({
            columns: 1,
            search: true,
            placeholder: 'Odaberi Atribut',
        });
        
    </script>
@endpush