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
                <form action="{{ route('admin.catalog.variants.update', ['id' => $variant->id]) }}" method="POST" role="form"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="rounded-t bg-white mb-0 px-6 py-6 dark:bg-darker dark:text-light">
                        <div class="text-center flex justify-between">
                            <h6 class="text-blueGray-700 text-xl font-bold">
                                Nova Varijacija
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
                            <div class="w-full lg:w-6/12 px-4">
                                <div class="relative w-full mb-3">
                                    <label
                                        class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2 ">
                                        Naziv
                                    </label>
                                    <input type="text" id="name" name="name"
                                        class="dark:text-gray-600 border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150 @error('name') border-2 border-red-600 @enderror"
                                        value="{{ $variant->variant_translation->name }}">
                                    @error('name')
                                        <div class="text-red-600 font-light text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="w-full lg:w-4/12 px-4">
                                <div class="relative w-full mb-3">
                                    <p class="bg-blue-400 text-white active:bg-blue-600 hover:bg-blue-400 font-bold uppercase text-xs px-1 py-1 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                                        id="generate_number">
                                        Generiraj novi Kod
                                    </p>
                                    <label
                                        class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2 ">
                                        Jedinstveni Kod
                                    </label>
                                    <input type="text" id="code" name="code"
                                        class="dark:text-gray-600 border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150 @error('code') border-2 border-red-600 @enderror"
                                        value="{{ $variant->code }}">
                                    @error('code')
                                        <div class="text-red-600 font-light text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="w-full lg:w-2/12 px-4">
                                <div class="relative w-full mb-3">
                                    <label class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                        Dostupno
                                    </label>
                                    <input name="available" type="checkbox" class="form-checkbox h-5 w-5 text-gray-600"
                                    @if ($variant->available) checked @endif>
                                </div>
                            </div>
                            <div class="w-full lg:w-4/12 px-4">
                                <div class="relative w-full mb-3">
                                    <label class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                        Proizvod
                                    </label>
                                    <div class="@error('product_id') border-2 border-red-600 @enderror">
                                        <select name="product_id" multiple id="product_id">
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}" @if ($product->id == $variant->product_id)
                                                    selected
                                            @endif>
                                                    {{ $product->product_translation->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('product_id')
                                        <div class="text-red-600 font-light text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="w-full lg:w-4/12 px-4">
                                <div class="relative w-full mb-3">
                                    <label class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                        Opcije
                                    </label>
                                    <div class="@error('product_id') border-2 border-red-600 @enderror">
                                        <select name="option_ids[]" multiple id="option_ids">
                                            @foreach ($options as $option)
                                                <option value="{{ $option->id }}" @if ($variant->option_ids != null && in_array($option->id, $variant->option_ids))
                                                    selected
                                            @endif>
                                                    {{ $option->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('product_id')
                                        <div class="text-red-600 font-light text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="w-full lg:w-4/12 px-4">
                                <div class="relative w-full mb-3">
                                    <label class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                        Vrijednosti opcija
                                    </label>
                                    <div class="@error('product_id') border-2 border-red-600 @enderror">
                                        <select name="optionValue_ids[]" multiple id="optionValue_ids">
                                            @foreach ($optionValues as $optionValue)
                                                <option value="{{ $optionValue->id }}" @if ($variant->optionValue_ids != null && in_array($optionValue->id, $variant->optionValue_ids))
                                                    selected
                                            @endif>
                                                    {{ $optionValue->value }}
                                                </option>
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
                                        Atributi
                                    </label>
                                    <select name="attribute_ids[]" multiple id="attribute_ids">
                                        @foreach ($attributes as $attribute)
                                            <option value="{{ $attribute->id }}" @if ($variant->attribute_ids != null && in_array($attribute->id, $variant->attribute_ids))
                                                selected
                                        @endif>
                                                {{$attribute->type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="w-full lg:w-6/12 px-4">
                                <div class="relative w-full mb-3">
                                    <label class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                        Vrijednosti Atributa
                                    </label>
                                    <select name="attributeValue_ids[]" multiple id="attributeValue_ids">
                                        @if (!$attributeValues->isEmpty())
                                            @foreach ($attributeValues as $value)
                                                <option value="{{ $value->id }}" @if ($variant->attributeValue_ids != null && in_array($value->id, $variant->attributeValue_ids))
                                                    selected
                                            @endif>
                                                    {{$value->value}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="w-full lg:w-6/12 px-4">
                                <div class="relative w-full mb-3">
                                    <label class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                        Skladišta <span class="text-red-600">Nije spojeno na ERP, ne selektirati!</span>
                                    </label>
                                    <select name="inventory_ids[]" multiple id="inventory_ids">
                                        @foreach ($inventories as $inventory)
                                            <option value="{{ $inventory->id }}" @if ($variant->inventory_ids != null && in_array($inventory->id, $variant->inventory_ids))
                                                selected
                                            @endif>
                                                {{$inventory->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="w-full lg:w-4/12 px-4">
                                <div class="relative w-full mb-3">
                                    <label
                                        class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2 ">
                                        Širina (?)
                                    </label>
                                    <input type="text" id="width" name="width"
                                        class="dark:text-gray-600 border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                        value="{{ $variant->width }}">
                                    <select name="width_measuring_unit" multiple class="measuring_unit">
                                        @foreach ($optionValues as $optionValue)
                                                <option value="{{ $optionValue->id }}">
                                                    {{ $optionValue->value }}
                                                </option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="w-full lg:w-4/12 px-4">
                                <div class="relative w-full mb-3">
                                    <label
                                        class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2 ">
                                        Visina (?)
                                    </label>
                                    <input type="text" id="height" name="height"
                                        class="dark:text-gray-600 border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                        value="{{ $variant->height }}">
                                    <select name="height_measuring_unit" multiple class="measuring_unit">
                                        @foreach ($optionValues as $optionValue)
                                            <option value="{{ $optionValue->id }}">
                                                {{ $optionValue->value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="w-full lg:w-4/12 px-4">
                                <div class="relative w-full mb-3">
                                    <label
                                        class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2 ">
                                        Dubina (?)
                                    </label>
                                    <input type="text" id="depth" name="depth"
                                        class="dark:text-gray-600 border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                        value="{{ $variant->depth }}">
                                    <select name="depth_measuring_unit" multiple class="measuring_unit">
                                        @foreach ($optionValues as $optionValue)
                                                <option value="{{ $optionValue->id }}">
                                                    {{ $optionValue->value }}
                                                </option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="w-full lg:w-4/12 px-4">
                                <div class="relative w-full mb-3">
                                    <label
                                        class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2 ">
                                        Težina (?)
                                    </label>
                                    <input type="text" id="weight" name="weight"
                                        class="dark:text-gray-600 border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                        value="{{ $variant->weight }}">
                                    <select name="weight_measuring_unit" multiple class="measuring_unit">
                                        @foreach ($optionValues as $optionValue)
                                                <option value="{{ $optionValue->id }}">
                                                    {{ $optionValue->value }}
                                                </option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="w-full lg:w-4/12 px-4">
                                <div class="relative w-full mb-3">
                                    <label
                                        class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2 ">
                                        Količina
                                    </label>
                                    <input type="text" id="quantity" name="quantity"
                                        class="dark:text-gray-600 border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150 @error('quantity') border-2 border-red-600 @enderror"
                                        value="{{ $variant->stock_item->quantity }}">
                                    @error('quantity')
                                        <div class="text-red-600 font-light text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="w-full lg:w-4/12 px-4">
                                <div class="relative w-full mb-3">
                                    <label
                                        class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2 ">
                                        Cijena
                                    </label>
                                    <input type="text" id="unit_price" name="unit_price"
                                        class="dark:text-gray-600 border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150 @error('unit_price') border-2 border-red-600 @enderror"
                                        value="{{ $variant->stock_item->unit_price }}">
                                    @error('unit_price')
                                        <div class="text-red-600 font-light text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="w-full lg:w-4/12 px-4">
                                <div class="relative w-full mb-3">
                                    <label
                                        class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2 ">
                                        Specijalna Cijena (?)
                                    </label>
                                    <input type="text" id="unit_special_price" name="unit_special_price"
                                        class="dark:text-gray-600 border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                        value="{{ $variant->stock_item->unit_special_price }}">
                                </div>
                            </div>
                            <div class="w-full lg:w-4/12 px-4">
                                <div class="relative w-full mb-3">
                                    <label
                                        class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2 ">
                                        Specijalna Cijena od(?)
                                    </label>
                                    <input type="text" id="unit_special_price_from" name="unit_special_price_from"
                                        class="dark:text-gray-600 border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                        value="{{ $variant->stock_item->unit_special_price_from }}">
                                </div>

                            </div>
                            <div class="w-full lg:w-4/12 px-4">
                                <div class="relative w-full mb-3">
                                    <label
                                        class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2 ">
                                        Specijalna Cijena do(?)
                                    </label>
                                    <input type="text" id="unit_special_price_to" name="unit_special_price_to"
                                        class="dark:text-gray-600 border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                        value="{{ $variant->stock_item->unit_special_price_to }}">
                                </div>
                            </div>
                            <div class="w-full lg:w-12/12 px-4 border-b-2 border-blue-200 mb-5">  
                                <h2>Fotografije</h2>
                                <ul class="divide-y-2 divide-gray-100" id="images_for_variant">
                                    @forelse ($variant->images as $variant_image)
                                        <li class="single_image">
                                            <img class="variantImage" src="{{Storage::disk('s3')->temporaryUrl($variant_image->path, '+2 minutes')}}" alt="Placeholder">
                                            <input type="file" name="variant_images[]" onchange="previewFile(this)">
                                            <input type="hidden" id="var_id" value="{{ $variant->id }}">
                                            <input type="hidden" id="image_id" value="{{ $variant_image->id }}">
                                            <a href="#" class="update" onclick="updateImage(this)">Update</a>
                                            <a href="#" class="delete" onclick="deleteParent(this)">Obriši</a>
                                        </li>
                                    @empty
                                        <li class="single_image">
                                            <img class="variantImage" src="https://dummyimage.com/640x360/fff/aaa" alt="Placeholder">
                                            <input type="file" name="variant_images[]" onchange="previewFile(this)">
                                            <input name="var_id" type="hidden" id="var_id" value="{{ $variant->id }}">
                                            <input name="image_id" type="hidden" id="image_id" value="">
                                            <a href="#" class="delete" onclick="deleteParent(this)">Obriši</a>
                                        </li>
                                    @endforelse
                                </ul>
                                <div class="input-group-btn"> 
                                    <a href="#" id="createNewImage" class="text-center bg-blue-500 text-white active:bg-blue-600 hover:bg-blue-400 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150">Nova slika</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <input type="hidden" id="variant_id_hidden" value="{{ $variant->id }}">
            </div>
        </div>
    </section>
@endsection

@push('links')
    <style>
        .variantImage {
            width: 100px;
            height: 120px;
        }
    </style>
@endpush
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {

            $("#createNewImage").click(function(){ 
                var li = document.createElement("li");
                li.setAttribute("class", "single_image");
                
                var input = document.createElement("input");
                input.setAttribute("type", "file");
                input.setAttribute("name", "variant_images[]");
                input.setAttribute("onchange", "previewFile(this)");

                var input_image_id_null = document.createElement("input");
                input_image_id_null.setAttribute("name", "image_id");
                input_image_id_null.setAttribute("type", "hidden");
                input_image_id_null.value = null;
                
                var a_delete = document.createElement("a");
                a_delete.setAttribute("class", "delete");
                a_delete.setAttribute("href", "#");
                a_delete.setAttribute("onclick", "deleteParent(this)");
                a_delete.innerHTML = "Obriši";
                
                var img = document.createElement("img");
                img.setAttribute("src", "https://dummyimage.com/640x360/fff/aaa");
                img.setAttribute("class", "variantImage");

                li.appendChild(img);
                li.appendChild(input);
                li.appendChild(input_image_id_null);
                li.appendChild(a_delete);
                document.getElementById("images_for_variant").appendChild(li);
            });

        });

        function updateImage(el) {
            var variant_id = document.getElementById('variant_id_hidden').value;
            var image_id = el.parentElement.querySelector('#image_id').value;
            var file = el.parentElement.querySelector('input[name="variant_images[]"').files[0];
            var formData = new FormData(); // we use formData because I don't know another way to deliver file instance to php
            
            formData.append("_token", '{{csrf_token()}}');
            formData.append('variant_id', variant_id);
            if(image_id !== ""){formData.append('image_id', image_id)};
            formData.append('folder', 'variants');
            formData.append('file', file);

            var url = '{{ route("admin.catalog.products.updateImage", [":id"]) }}';
            url = url.replace(':id', variant_id);

            if (typeof variant_id !== 'undefined' && typeof file !== 'undefined') {
                $.ajax({
                    url: url,
                    type: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function(data) {
                        window.location.reload();
                    },
                    error: function(data) {
                        console.log("Error upload image: " + data);
                    }
                });
            }
        }

        // delete node of image, input and button
        function deleteParent(el) {
            var variant_id = el.parentElement.querySelector('#var_id').value;
            var image_id = el.parentElement.querySelector('#image_id').value;
            
            var path = el.parentElement.querySelector('img').src.split('variants/');
            var p = path[1].split('?'); // we split path beacuase it gets long url from s3, but for deleting we just need products/product_id/image_name_stored_in_amazon
            
            var url = '{{ route("admin.catalog.products.deleteImage", [":id", ":image_id"]) }}';
            url = url.replace(':id', variant_id);
            url = url.replace(':image_id', image_id);

            el.parentElement.remove(); 
            
            if (typeof variant_id !== 'undefined') {
                $.ajax({
                    url: url,
                    type: "DELETE",
                    cache: false,
                    data: {
                        _token:'{{ csrf_token() }}',
                        variant_id: variant_id,
                        image_id: image_id,
                        path: 'variants/'+p[0],
                    },
                    success: function(data) {
                        console.log("Deleted Image: " + data);
                    },
                    error: function(e) {
                        alert('Error' + e);
                    }
                });
            }
        }

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
    <!-- Need to be first, before date picker, otherwise it will not upload multiselect dropdown -->
    <script>
        jQuery('#product_id').multiselect({
            columns: 1,
            search: true,
            placeholder: 'Odaberi relacijski proizvod',
        });

        jQuery('#option_ids').multiselect({
            columns: 1,
            search: true,
            placeholder: 'Odaberi opcije',
        });

        jQuery('#inventory_ids').multiselect({
            columns: 1,
            search: true,
            placeholder: 'Odaberi skladista',
        });

        jQuery('#attributeValue_ids').multiselect({
            columns: 1,
            search: true,
            placeholder: 'Odaberi opcije',
        });

        jQuery('#attribute_ids').multiselect({
            columns: 1,
            search: true,
            placeholder: 'Odaberi opcije',
        });

        jQuery('#optionValue_ids').multiselect({
            columns: 1,
            search: true,
            placeholder: 'Odaberi vrijednosti opcija',
        });

        jQuery('.measuring_unit').multiselect({
            columns: 1,
            search: false,
            placeholder: '-',
        });
        

        document.getElementById("generate_number").addEventListener("click", generate_number);

        function generate_number() {
            document.getElementById("code").value = Date.now();
            //console.log(Date.now());
        }

    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script>
        $(function() {
            var dateFormat = "mm/dd/yy",
                from = $("#unit_special_price_from")
                .datepicker({
                    defaultDate: "+1w",
                    changeMonth: true,
                    numberOfMonths: 1
                })
                .on("change", function() {
                    to.datepicker("option", "minDate", getDate(this));
                }),
                to = $("#unit_special_price_to").datepicker({
                    defaultDate: "+1w",
                    changeMonth: true,
                    numberOfMonths: 1
                })
                .on("change", function() {
                    from.datepicker("option", "maxDate", getDate(this));
                });

            function getDate(element) {
                var date;
                try {
                    date = $.datepicker.parseDate(dateFormat, element.value);
                } catch (error) {
                    date = null;
                }

                return date;
            }
        });
    </script>

@endpush