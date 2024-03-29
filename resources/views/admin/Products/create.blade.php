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
            <form action="{{ route('admin.catalog.products.store') }}" id="submit_store_product" method="POST" role="form" enctype="multipart/form-data">
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
                                name="submit_store_product"
                                id="submit_store_product">
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
                                    class="dark:text-gray-600 border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150 @error('name') border-2 border-red-600 @enderror"
                                    value="{{ old('name') }}">
                                    @error('name')
                                        <div class="text-red-600 font-light text-sm">{{ $message }}</div>
                                    @enderror
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
                                    value="{{ old('slug') }}">
                            </div>
                        </div>
                        <div class="w-full lg:w-2/12 px-4">
                            <div class="relative w-full mb-3">
                                <label class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                    Dostupno
                                </label>
                                <input id="enabled" name="enabled" type="checkbox" class="form-checkbox h-5 w-5 text-gray-600" checked>
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
                                    value="">
                                    @error('code')
                                        <div class="text-red-600 font-light text-sm">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>
                        <div class="w-full lg:w-6/12 px-4">
                            <div class="relative w-full mb-3">
                                <label
                                    class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2 ">
                                    Kratki Opis
                                </label>
                                <textarea id="short_description" name="short_description"
                                    class="dark:text-gray-600 border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150 @error('short_description') border-2 border-red-600 @enderror">
                                {{ old('short_description') }}</textarea>
                                @error('short_description')
                                    <div class="text-red-600 font-light text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="w-full lg:w-3/12 px-4">
                            <div class="relative w-full mb-3">
                                <label
                                    class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2 ">
                                    Ukupna Količina
                                </label>
                                <input type="text" id="quantity_total" name="quantity_total"
                                    class="dark:text-gray-600 border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150 @error('quantity_total') border-2 border-red-600 @enderror"
                                    value="{{ old('quantity_total') }}">
                                    @error('quantity_total')
                                        <div class="text-red-600 font-light text-sm">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>
                        <div class="w-full lg:w-4/12 px-4">
                            <div class="relative w-full mb-3">
                                <label class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                    Bez varijacija (želim jedinstveni proizvod)
                                </label>
                                <input id="no_variant" name="no_variant" type="checkbox" class="form-checkbox h-5 w-5 text-gray-600" checked>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-auto px-4 lg:px-10 py-10 pt-0" id="variant_fields">
                    <!-- OSNOVNE INFORMACIJE -->
                    <div class="flex flex-wrap mt-9 border-b-2 border-blue-200">
                        <small class="w-full lg:w12/12 pb-4 text-red-400">Ispunjavati podatke isključivo ako je proizvod jedinstveni (bez varijacija)</small>
                        <div class="w-full lg:w-4/12 px-4">
                            <div class="relative w-full mb-3">
                                <label
                                    class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2 ">
                                    Cijena (?)
                                </label>
                                <input type="text" id="unit_price" name="unit_price"
                                    class="dark:text-gray-600 border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150 @error('unit_price') border-2 border-red-600 @enderror"
                                    value="{{ old('unit_price') }}">
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
                                    class="dark:text-gray-600 border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150 @error('unit_special_price') border-2 border-red-600 @enderror"
                                    value="{{ old('unit_special_price') }}">
                                    @error('unit_special_price')
                                        <div class="text-red-600 font-light text-sm">{{ $message }}</div>
                                    @enderror
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
                                    value="{{ old('unit_special_price_from') }}">
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
                                    value="{{ old('unit_special_price_to') }}">
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
                                    value="">
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
                                    value="">
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
                                    value="">
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
                                    value="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                    <!-- OSNOVNE INFORMACIJE -->
                    <div class="flex flex-wrap mt-9 border-b-2 border-blue-200">
                        <div class="w-full lg:w-12/12 px-4">
                            <div class="relative w-full mb-3">
                                <label class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                    Opis
                                </label>
                                <textarea id="description" name="description"
                                    class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                {{ old('description') }}</textarea>
                            </div>
                        </div>
                        <div class="w-full lg:w-6/12 px-4">
                            <div class="relative w-full mb-3">
                                <label class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                    Brand
                                </label>
                                <div class="@error('brand_id') border-2 border-red-600 @enderror">
                                    <select name="brand_id" multiple id="brands">
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}" @if($brand->id == old('brand_id')) selected @endif>
                                                {{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('brand_id')
                                    <div class="text-red-600 font-light text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="w-full lg:w-6/12 px-4">
                            <div class="relative w-full mb-3">
                                <label class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                    Kategorije
                                </label>
                                <div class="@error('category_ids') border-2 border-red-600 @enderror">
                                    <select name="category_ids[]" multiple id="category_ids">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" @if (old('category_ids') !== null && in_array($category->id, old('category_ids')))
                                                selected
                                            @endif>
                                                {{ $category->category_breadcrumbs->breadcrumb }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('category_ids')
                                    <div class="text-red-600 font-light text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="w-full lg:w-6/12 px-4" id="variants_selection">
                            <div class="relative w-full mb-3">
                                <label class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                    Varijacije
                                </label>
                                <select name="variant_ids[]" multiple id="variant_ids">
                                    @foreach ($variants as $variant)
                                        <option value="{{ $variant->id }}">
                                            {{ $variant->variant_translation->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="w-full lg:w-6/12 px-4">
                            <div class="relative w-full mb-3">
                                <label class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                    Opcije
                                </label>
                                <select name="option_ids[]" multiple id="option_ids">
                                    @foreach ($options as $option)
                                        <option value="{{ $option->id }}">
                                            {{ $option->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="w-full lg:w-6/12 px-4">
                            <div class="relative w-full mb-3">
                                <label class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                    Vrijednosti opcija
                                </label>
                                <select name="optionValue_ids[]" multiple id="optionValue_ids">
                                    @foreach ($optionValues as $optionValue)
                                        <option value="{{ $optionValue->id }}">
                                            {{$optionValue->option->name}} => {{ $optionValue->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="w-full lg:w-6/12 px-4">
                            <div class="relative w-full mb-3">
                                <label class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                    Atributi
                                </label>
                                <select name="attribute_ids[]" multiple id="attribute_ids">
                                    @foreach ($attributes as $attribute)
                                        <option value="{{ $attribute->id }}">
                                            {{$attribute->type}} => {{ $attribute->type }}</option>
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
                                    @foreach ($attributeValues as $value)
                                        <option value="{{ $value->id }}">
                                            {{$value->value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="w-full lg:w-6/12 px-4">
                            <div class="relative w-full mb-3">
                                <label
                                    class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2 ">
                                    meta keywords
                                </label>
                                <input type="text" id="meta_keywords" name="meta_keywords"
                                    class="dark:text-gray-600 border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                    value="">
                            </div>
                        </div>
                        <div class="w-full lg:w-6/12 px-4 divide-y divide-yellow-500">
                            <div class="relative w-full mb-3">
                                <label class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                    meta opis
                                </label>
                                <textarea id="meta_description" name="meta_description"
                                    class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                </textarea>
                            </div>
                        </div>
                        <div class="w-full lg:w-12/12 px-4 border-b-2 border-blue-200 mb-5" id="photo_fields">  
                            <h2>Fotografije</h2>
                            <small class="dark:text-light text-red-600 text-xs mb-2">Ovdje odabirete fotografije isključivo ako je proizvod jedinstveni i ne sadrži nikakve varijacije!</small>
                            <ul class="divide-y-2 divide-gray-100" id="images_for_product">
                                <li class="single_image">
                                    <img class="productImage" src="https://dummyimage.com/640x360/fff/aaa" alt="Placeholder">
                                    <input type="file" name="product_images[]" onchange="previewFile(this)">
                                    <a href="#" class="delete" onclick="deleteParent(this)">Obriši</a>
                                </li>
                            </ul>
                            <div class="input-group-btn"> 
                                <a href="#" id="createNewImage" class="text-center bg-blue-500 text-white active:bg-blue-600 hover:bg-blue-400 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150">Nova slika</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
    
@endsection

@push('links')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <style>
        .productImage {
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
          input.setAttribute("name", "product_images[]");
          input.setAttribute("onchange", "previewFile(this)");
          
          var a = document.createElement("a");
          a.setAttribute("class", "delete");
          a.setAttribute("href", "#");
          a.setAttribute("onclick", "deleteParent(this)");
          a.innerHTML = "Obriši";
          
          var img = document.createElement("img");
          img.setAttribute("src", "https://dummyimage.com/640x360/fff/aaa");
          img.setAttribute("class", "productImage");

          li.appendChild(img);
          li.appendChild(input);
          li.appendChild(a);
          document.getElementById("images_for_product").appendChild(li);
      });

    });

    // delete node of image, input and button
    function deleteParent(el) {
        el.parentElement.remove();
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

    <script>
        
        jQuery('#brands').multiselect({
            columns: 1,
            search: true,
            placeholder: 'Odaberi brand',
        });

        jQuery('#category_ids').multiselect({
            columns: 1,
            search: true,
            placeholder: 'Odaberi kategorije',
            selectAll: true
        });

        jQuery('#variant_ids').multiselect({
            columns: 1,
            search: true,
            placeholder: 'Odaberi varijacije proizvoda',
            selectAll: true
        });

        jQuery('#option_ids').multiselect({
            columns: 1,
            search: true,
            placeholder: 'Odaberi opcije proizvoda',
            selectAll: true
        });

        jQuery('#optionValue_ids').multiselect({
            columns: 1,
            search: true,
            placeholder: 'Odaberi vrijednosti opcija proizvoda',
            selectAll: true
        });
        
        jQuery('#attribute_ids').multiselect({
            columns: 1,
            search: true,
            placeholder: 'Odaberi Atribute proizvoda',
            selectAll: true
        });

        jQuery('#attributeValue_ids').multiselect({
            columns: 1,
            search: true,
            placeholder: 'Odaberi vrijednost Atributa',
            selectAll: true
        });

        jQuery('#width_measuring_unit_option_value_id').multiselect({
            columns: 1,
            search: true,
            placeholder: '-',
        });

        jQuery('#height_measuring_unit_option_value_id').multiselect({
            columns: 1,
            search: true,
            placeholder: '-',
        });

        jQuery('#depth_measuring_unit_option_value_id').multiselect({
            columns: 1,
            search: true,
            placeholder: '-',
        });

        jQuery('#weight_measuring_unit_option_value_id').multiselect({
            columns: 1,
            search: true,
            placeholder: '-',
        });

        var checkbox = document.querySelector("input[name=no_variant]");
        
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                document.getElementById("variant_fields").style.display = "block";
                document.getElementById("photo_fields").style.display = "block";
                document.getElementById("variants_selection").style.display = "block";
            } else {
                document.getElementById("variant_fields").style.display = "none";
                document.getElementById("photo_fields").style.display = "none";
                document.getElementById("variants_selection").style.display = "none";
            }
        });

        document.getElementById("generate_number").addEventListener("click", generate_number);
        
        document.getElementById("name").addEventListener("keyup", function (event) {
            document.getElementById("slug").value = document.getElementById("name").value.toLowerCase();
        });

        function generate_number() {
            document.getElementById("code").value = Date.now();
            //console.log(Date.now());
        }
    </script>

    <!-- scripts for date selecting -->
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
