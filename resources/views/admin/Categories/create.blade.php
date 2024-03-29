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
                <form action="{{ route('admin.catalog.categories.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="rounded-t bg-white mb-0 px-6 py-6 dark:bg-darker dark:text-light">
                        <div class="text-center flex justify-between">
                            <h6 class="text-blueGray-700 text-xl font-bold">
                                Nova Kategorija
                            </h6>
                            <div class="lg:w-4/12">
                                <button
                                    class="bg-blue-500 text-white active:bg-blue-600 hover:bg-blue-400 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
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
                        <div class="flex flex-wrap mt-9">
                            <div class="w-full lg:w-6/12 px-4">
                                <div class="relative w-full mb-3">
                                    <label
                                        class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2 ">
                                        Naziv kategorije
                                    </label>
                                    <input type="text" id="name" name="name"
                                        class="dark:text-gray-600 border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150 @error('name') border-2 border-red-600 @enderror"
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <div class="text-red-600 font-light text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="w-full lg:w-6/12 px-4">
                                <div class="relative w-full mb-3">
                                    <label class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                        Opis kategorije
                                    </label>
                                    <textarea id="description" name="description"
                                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150 @error('description') border-2 border-red-600 @enderror">
                                    {{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="text-red-600 font-light text-sm">{{ $message }}</div>
                                    @enderror 
                                </div>
                            </div>
                            <div class="w-full lg:w-4/12 px-4">
                                <div class="relative w-full mb-3">
                                    <label class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                        Roditelj kategorije
                                    </label>
                                    <div class="relative inline-flex">
                                        <svg class="w-2 h-2 absolute top-0 right-0 m-4 pointer-events-none"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                            <path
                                                d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"
                                                fill="#648299" fill-rule="nonzero" />
                                        </svg>
                                        <select id="parent_id" name="parent_id"
                                            class="border border-gray-300 rounded text-gray-600 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none @error('parent_id') border-2 border-red-600 @enderror">
                                            <option value="0">Odaberi kategoriju</option>
                                            @foreach ($categories as $c)
                                                <option value="{{ $c->id . "|" . $c->category_breadcrumbs->id }}" >{{ $c->category_breadcrumbs->breadcrumb }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('parent_id')
                                        <div class="text-red-600 font-light text-sm">{{ $message }}</div>
                                    @enderror 
                                </div>
                            </div>
                            <div class="w-full lg:w-4/12 px-4">
                                <div class="relative w-full mb-3">
                                    <label class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                        Istaknuto na glavnoj stranici
                                    </label>
                                    <input name="featured" type="checkbox" class="form-checkbox h-5 w-5 text-gray-600">
                                </div>
                            </div>
                            <div class="w-full lg:w-4/12 px-4">
                                <div class="relative w-full mb-3">
                                    <label class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                        Prikaži u navigaciji stranice
                                    </label>
                                    <input name="menu" type="checkbox" class="form-checkbox h-5 w-5 text-gray-600">
                                </div>
                            </div>
                            <div class="w-full lg:w-12/12 px-4 border-b-2 border-blue-200 mb-5">  
                                <h2 class="mb-2">Slika Kategorije</h2>
                                <ul class="divide-y-2 divide-gray-100 mb-2" id="image_for_brand">
                                    <li class="single_image">
                                        <img class="categoryImage" src="https://dummyimage.com/640x360/fff/aaa" alt="Placeholder">
                                        <input type="file" name="category_image" onchange="previewFile(this)">
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <small>* root je glavna kategorija koja se ne prikazuje u navigaciji, na root se vežu prve kategorije zatim hijararhijski dalje po želji</small>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('links')
    <style>
        .categoryImage {
            width: 100px;
            height: 120px;
        }
    </style>
@endpush

@push('scripts')
    <script type="text/javascript">
        
        // preview image on input change
        function previewFile(input){
            var file = input.files[0];
    
            if(file){
                var reader = new FileReader();
                reader.onload = function(){
                    input.parentElement.querySelector('img').src = reader.result;
                }
                
                reader.readAsDataURL(file);
            }
        }
    </script> 
@endpush