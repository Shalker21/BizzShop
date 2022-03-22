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
            <form action="{{ route('admin.webshop.inventory.update', ['id' => $inventory->id]) }}" method="POST" role="form" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                @if (session('success'))
                <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                    <div class="w-full overflow-x-hidden">
                        <div class="bg-blue-300 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
                            <div class="flex">
                                <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                                <div>
                                    
                                    <p class="font-bold">{{ session('success') }}</p>
                                    
                                </div>
                            </div>
                        </div>    
                    </div>
                </div> 
            @endif
                <div class="rounded-t bg-white mb-0 px-6 py-6 dark:bg-darker dark:text-light">
                    <div class="text-center flex justify-between">
                        <h6 class="text-blueGray-700 text-xl font-bold">
                            Nova Vrijednost
                        </h6>
                        <div class="lg:w-4/12">
                            <button
                                class="bg-blue-500 text-white active:bg-blue-600 hover:bg-blue-400 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                                name="submit_store_product"
                                type="submit">
                                Spremi Promjene
                            </button>
                            <a href="{{ route('admin.webshop.inventory') }}"
                                class="bg-green-500 text-white active:bg-green-600 hover:bg-green-400 font-bold uppercase text-xs px-4 py-2 mt-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150">
                                Odustani
                            </a>
                        </div>
                    </div>
                </div>
                <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                    <div class="flex flex-wrap mt-9">
                        <div class="w-full lg:w-6/12 px-4">
                            <div class="relative w-full mb-3">
                                <label
                                    class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2 ">
                                    Naziv Spremišta
                                </label>
                                <input type="text" id="name" name="name"
                                    class="dark:text-gray-600 border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150 @error('name') border-2 border-red-600 @enderror"
                                    value="{{ $inventory->name }}">
                                    @error('name')
                                        <div class="text-red-600 font-light text-sm">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>
                        <div class="w-full lg:w-3/12 px-4">
                            <div class="relative w-full mb-3">
                                <p
                                    class="bg-blue-400 text-white active:bg-blue-600 hover:bg-blue-400 font-bold uppercase text-xs px-1 py-1 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                                    id="generate_number">
                                    Generiraj novi Kod
                                </p>
                                <label
                                    class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2 ">
                                    Jedinstveni Kod
                                </label>
                                <input type="text" id="code" name="code"
                                    class="dark:text-gray-600 border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150 @error('code') border-2 border-red-600 @enderror"
                                    value="{{ $inventory->code }}">
                                    @error('code')
                                        <div class="text-red-600 font-light text-sm">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>
                        <div class="w-full lg:w-6/12 px-4">
                            <div class="relative w-full mb-3">
                                <label class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                    Lokacija (adresa) 
                                </label>
                                <input type="text" id="location" name="location"
                                    class="dark:text-gray-600 border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150 @error('location') border-2 border-red-600 @enderror"
                                    value="{{ $inventory->location }}">
                                    @error('location')
                                        <div class="text-red-600 font-light text-sm">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>
                        <div class="w-full lg:w-6/12 px-4">
                            <div class="relative w-full mb-3">
                                <label class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                     Ažuriraj količine proizvoda u skladištu
                                </label>
                                <a class="bg-blue-400 text-white active:bg-blue-600 hover:bg-blue-400 font-bold uppercase text-xs px-1 py-1 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150" href="{{ route('admin.webshop.inventorySourceStock.edit', ['inventory_id' => $inventory->id]) }}">Ažuriraj</a>
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

        document.getElementById("generate_number").addEventListener("click", generate_number);
        function generate_number() {
            document.getElementById("code").value = Date.now();
        }
        
    </script>
@endpush