@extends('admin.app')
@section('content')
    <section class="bg-blueGray-50">
        <div class="w-full lg:w-8/12 px-4 mx-auto mt-6">
            <div
                class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0">
                @if ($errors->any())
                    <div class="flex items-center bg-red-500 text-white text-sm font-bold rounded px-4 py-3 mb-5"
                        role="alert">
                        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path
                                d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
                        </svg>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li> - {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('admin.catalog.products.update') }}" method="POST" role="form"
                    enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="rounded-t bg-white mb-0 px-6 py-6 dark:bg-darker dark:text-light">
                        <div class="text-center flex justify-between">
                            <h6 class="text-blueGray-700 text-xl font-bold">
                                Novi Proizvod
                            </h6>
                            <div class="lg:w-4/12">
                                <button
                                    class="bg-blue-500 text-white active:bg-blue-600 hover:bg-blue-400 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                                    name="submit_store_product" type="submit">
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
                                        Naziv
                                    </label>
                                    <input type="text" id="name" name="name"
                                        class="dark:text-gray-600 border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                        value="{{ $product->product_translation->name }}">
                                </div>
                            </div>
                            <div class="w-full lg:w-5/12 px-4">
                                <div class="relative w-full mb-3">
                                    <label
                                        class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2 ">
                                        Slug
                                    </label>
                                    <input type="text" id="slug" name="slug"
                                        class="dark:text-gray-600 border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                        value="{{ $product->product_translation->slug }}">
                                </div>
                            </div>
                            <div class="w-full lg:w-2/12 px-4">
                                <div class="relative w-full mb-3">
                                    <label class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                        Dostupno
                                    </label>
                                    <input id="enabled" name="enabled" type="checkbox"
                                        class="form-checkbox h-5 w-5 text-gray-600" @if ($product->enabled) checked @endif>
                                </div>
                            </div>
                            <div class="w-full lg:w-3/12 px-4">
                                <div class="relative w-full mb-3">
                                    <label
                                        class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2 ">
                                        Jedinstveni Kod
                                    </label>
                                    <input type="text" id="code" name="code"
                                        class="dark:text-gray-600 border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                        value="{{ $product->code }}">
                                </div>
                            </div>
                            <div class="w-full lg:w-6/12 px-4">
                                <div class="relative w-full mb-3">
                                    <label
                                        class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2 ">
                                        Kratki Opis
                                    </label>
                                    <textarea id="short_description" name="short_description"
                                        class="dark:text-gray-600 border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                            {{ $product->product_translation->short_description }}
                                        </textarea>
                                </div>
                            </div>
                            <div class="w-full lg:w-3/12 px-4">
                                <div class="relative w-full mb-3">
                                    <label
                                        class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2 ">
                                        Ukupna Količina
                                    </label>
                                    <input type="text" id="quantity_total" name="quantity_total"
                                        class="dark:text-gray-600 border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                        value="{{ $product->quantity_total }}">
                                </div>
                            </div>
                            <div class="w-full lg:w-12/12 px-4">
                                <div class="relative w-full mb-3">
                                    <label class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                        Opis
                                    </label>
                                    <textarea id="description" name="description"
                                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                            {{ $product->product_translation->description }}
                                        </textarea>
                                </div>
                            </div>
                            <div class="w-full lg:w-6/12 px-4">
                                <div class="relative w-full mb-3">
                                    <label class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                        Kategorije
                                    </label>
                                    <select name="languageSelect[]" multiple id="languageSelect">
                                        @foreach ($categories as $category)
                                        <option value="{{$category->category_breadcrumbs->breadcrumb}}">{{$category->category_breadcrumbs->breadcrumb}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="w-full lg:w-6/12 px-4">
                            <div class="relative w-full mb-3">
                                <label class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                    Varijacije
                                </label>
                                
                            </div>
                        </div>
                        <div class="w-full lg:w-6/12 px-4">
                            <div class="relative w-full mb-3">
                                <label class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                    Opcije
                                </label>
                            </div>
                        </div>
                        <div class="w-full lg:w-6/12 px-4">
                            <div class="relative w-full mb-3">
                                <label class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                    Vrijednosti opcija
                                </label>
                            </div>
                        </div>
                        <div class="w-full lg:w-6/12 px-4">
                            <div class="relative w-full mb-3">
                                <label class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2 ">
                                    meta keywords
                                </label>
                                <input type="text" id="meta_keywords" name="meta_keywords"
                                    class="dark:text-gray-600 border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                    value="UPISI META KEYS">
                            </div>
                        </div>
                        <div class="w-full lg:w-6/12 px-4 divide-y divide-yellow-500">
                            <div class="relative w-full mb-3">
                                <label class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                    meta opis
                                </label>
                                <textarea id="meta_description" name="meta_description"
                                    class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                            META VELIKI OPIS
                                        </textarea>
                            </div>
                        </div>
                    </div>
            </div>
            </form>
            <div class="flex flex-wrap mt-4 border-b-2 border-blue-200">
                <div class="w-full lg:w-12/12 px-4 border-b-2 border-blue-200 mb-5">
                    <h2>Fotografije</h2>
                    <small class="dark:text-light text-red-600 text-xs mb-2">Ovdje odabirete fotografije isključivo ako
                        je proizvod jedinstveni i ne sadrži nikakve varijacije!</small>
                </div>
                <div class="w-full lg:w-12/12 px-4">
                    <div class="relative w-full mb-3">
                        <form action="" class="dropzone dropzone border-gray-200 border-dashed" id="dropzone"
                            style="border: 2px dashed rgba(0,0,0,0.3)">
                            <input type="hidden" name="product_id" value="">
                            {{ csrf_field() }}
                            <svg version="1.1" class="h-8 text-grey mr-2" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 60 60"
                                style="enable-background:new 0 0 60 60;" xml:space="preserve">
                                <g>
                                    <path
                                        d="M50.975,20.694c-0.527-9-7.946-16.194-16.891-16.194c-5.43,0-10.688,2.663-13.946,7.008
                                                    c-0.074-0.039-0.153-0.065-0.228-0.102c-0.198-0.096-0.399-0.188-0.605-0.269c-0.115-0.045-0.23-0.086-0.346-0.127
                                                    c-0.202-0.071-0.406-0.133-0.615-0.19c-0.116-0.031-0.231-0.063-0.349-0.09c-0.224-0.051-0.452-0.09-0.683-0.124
                                                    c-0.102-0.015-0.202-0.035-0.305-0.047C16.677,10.523,16.341,10.5,16,10.5c-4.962,0-9,4.037-9,9c0,0.129,0.007,0.255,0.016,0.381
                                                    C2.857,22.148,0,26.899,0,31.654C0,38.737,5.762,44.5,12.845,44.5H18c0.552,0,1-0.447,1-1s-0.448-1-1-1h-5.155
                                                    C6.865,42.5,2,37.635,2,31.654c0-4.154,2.705-8.466,6.432-10.253L9,21.13V20.5c0-0.123,0.008-0.249,0.015-0.375l0.009-0.175
                                                    l-0.012-0.188C9.007,19.675,9,19.588,9,19.5c0-3.859,3.14-7,7-7c0.309,0,0.614,0.027,0.917,0.067
                                                    c0.078,0.01,0.155,0.023,0.232,0.036c0.268,0.044,0.532,0.102,0.792,0.177c0.034,0.01,0.069,0.016,0.102,0.026
                                                    c0.286,0.087,0.565,0.198,0.838,0.322c0.069,0.031,0.137,0.065,0.205,0.099c0.242,0.119,0.479,0.251,0.707,0.399
                                                    C21.72,14.875,23,17.039,23,19.5c0,0.553,0.448,1,1,1s1-0.447,1-1c0-2.754-1.246-5.219-3.2-6.871
                                                    C24.666,8.879,29.388,6.5,34.084,6.5c7.744,0,14.178,6.135,14.848,13.887c-1.022-0.072-2.553-0.109-4.083,0.125
                                                    c-0.546,0.083-0.921,0.593-0.838,1.139c0.075,0.495,0.501,0.85,0.987,0.85c0.05,0,0.101-0.004,0.152-0.012
                                                    c2.224-0.336,4.543-0.021,4.684-0.002C54.49,23.372,58,27.661,58,32.472C58,38.001,53.501,42.5,47.972,42.5H44
                                                    c-0.552,0-1,0.447-1,1s0.448,1,1,1h3.972C54.604,44.5,60,39.104,60,32.472C60,26.983,56.173,22.06,50.975,20.694z" />
                                    <path
                                        d="M31.708,30.794c-0.092-0.093-0.203-0.166-0.326-0.217c-0.244-0.101-0.52-0.101-0.764,0
                                                    c-0.123,0.051-0.233,0.124-0.326,0.217l-7.999,7.999c-0.391,0.391-0.391,1.023,0,1.414C22.488,40.402,22.744,40.5,23,40.5
                                                    s0.512-0.098,0.707-0.293L30,33.914V54.5c0,0.553,0.448,1,1,1s1-0.447,1-1V33.914l6.293,6.293C38.488,40.402,38.744,40.5,39,40.5
                                                    s0.512-0.098,0.707-0.293c0.391-0.391,0.391-1.023,0-1.414L31.708,30.794z" />
                                </g>
                            </svg>

                            <div class="dz-default dz-message"><span class="block text-grey">Drag & drop slike ili
                                    jednostavno pritisnite unutar okvira</span></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

@endsection

@push('links')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css" rel="stylesheet">
    
<link rel="stylesheet" href="https://phpcoder.tech/multiselect/css/jquery.multiselect.css">

    <style>
        
    </style>

@endpush
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js"></script>
    <script src="https://phpcoder.tech/multiselect/js/jquery.multiselect.js"></script>
    <script>
        Dropzone.autoDiscover = false;
        jQuery('#languageSelect').multiselect({
    columns: 1,
    search: true,
    placeholder: 'Odaberi kategorije',
});
        $(document).ready(function() {
       
            let myDropzone = new Dropzone("#dropzone", {
                paramName: "image",
                addRemoveLinks: true,
                maxFilesize: 4,
                parallelUploads: 2,
                uploadMultiple: false,
                url: "{{ route('admin.catalog.products.images.upload') }}",
                autoProcessQueue: false,
            });
            myDropzone.on("queuecomplete", function(file) {
                window.location.reload();
                showNotification('Completed', 'Uspješno spremljene fotografije', 'success', 'fa-check');
            });
            $('#submit_store_product').click(function() {
                if (myDropzone.files.length === 0) {
                    showNotification('Error', 'Molimo vas, odaberite fotogrrafije!', 'danger', 'fa-close');
                } else {
                    myDropzone.processQueue();
                }
            });

            function showNotification(title, message, type, icon) {
                $.notify({
                    title: title + ' : ',
                    message: message,
                    icon: 'fa ' + icon
                }, {
                    type: type,
                    allow_dismiss: true,
                    placement: {
                        from: "top",
                        align: "right"
                    },
                });
            }
        });

        
    </script>
@endpush
