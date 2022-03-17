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
                @if (Session::get('success'))
                    <div class="flex items-center bg-red-500 text-white text-sm font-bold rounded px-4 py-3 mb-5"
                    role="alert">
                    <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path
                            d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
                    </svg>
                    <ul>
                        <li>{{ Session::get('success') }}</li>
                    </ul>
            </div>
                @endif
                <form action="{{ route('admin.catalog.products.update', ['id' => $product->id]) }}" method="POST" role="form"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
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
                                    <p class="bg-blue-400 text-white active:bg-blue-600 hover:bg-blue-400 font-bold uppercase text-xs px-1 py-1 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                                        id="generate_number">
                                        Generiraj novi Kod
                                    </p>
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
                            <div class="border-b-2 border-blue-200 w-full"></div>
                            <small class="w-full lg:w12/12 pb-4 text-red-400">Ispunjavati podatke isključivo ako je proizvod jedinstveni (bez varijacija) </small>
                            <div class="w-full lg:w-4/12 px-4">
                                <div class="relative w-full mb-3">
                                    <label
                                        class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2 ">
                                        Cijena (?)
                                    </label>
                                    <input type="text" id="unit_price" name="unit_price"
                                        class="dark:text-gray-600 border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150 @error('unit_price') border-2 border-red-600 @enderror"
                                        value="{{ $product->stock_item->unit_price ?? '' }}">
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
                                        value="{{ $product->stock_item->unit_special_price ?? '' }}">
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
                                        value="{{ $product->stock_item->unit_special_price_from ?? '' }}">
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
                                        value="{{ $product->stock_item->unit_special_price_to ?? '' }}">
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
                                        value="{{ $product->width ?? '' }}">
                                    <select name="width_measuring_unit_option_value_id" multiple id="width_measuring_unit_option_value_id" class="measuring_unit">
                                        @foreach ($optionValues as $optionValue)
                                            @if ($optionValue->option->name == 'MJERNE JEDINICE ZA DULJINU')
                                                <option value="{{ $optionValue->id }}" @if ($product->stock_item->width_measuring_unit_option_value_id ?? '' && $optionValue->id == $product->stock_item->width_measuring_unit_option_value_id)
                                                    selected
                                                @endif>
                                                    {{ $optionValue->value }}
                                                </option>
                                            @endif
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
                                        value="{{ $product->height ?? '' }}">
                                    <select name="height_measuring_unit_option_value_id" multiple id="height_measuring_unit_option_value_id" class="measuring_unit">
                                        @foreach ($optionValues as $optionValue)
                                            @if ($optionValue->option->name == 'MJERNE JEDINICE ZA DULJINU')
                                                <option value="{{ $optionValue->id }}" @if ($product->stock_item->height_measuring_unit_option_value_id ?? '' && $optionValue->id == $product->stock_item->height_measuring_unit_option_value_id)
                                                    selected
                                                @endif>
                                                    {{ $optionValue->value }}
                                                </option>
                                            @endif
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
                                        value="{{ $product->depth ?? '' }}">
                                    <select name="depth_measuring_unit_option_value_id" multiple id="depth_measuring_unit_option_value_id" class="measuring_unit">
                                        @foreach ($optionValues as $optionValue)
                                            @if ($optionValue->option->name == 'MJERNE JEDINICE ZA DULJINU')
                                                <option value="{{ $optionValue->id }}" @if ($product->stock_item->depth_measuring_unit_option_value_id ?? '' && $optionValue->id == $product->stock_item->depth_measuring_unit_option_value_id)
                                                    selected
                                                @endif>
                                                    {{ $optionValue->value }}
                                                </option>
                                            @endif
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
                                        value="{{ $product->weight ?? '' }}">
                                    <select name="weight_measuring_unit_option_value_id" multiple id="weight_measuring_unit_option_value_id" class="measuring_unit">
                                        @foreach ($optionValues as $optionValue)
                                            @if ($optionValue->option->name == 'MJERNE JEDINICE ZA MASU')
                                                <option value="{{ $optionValue->id }}" @if ($product->stock_item->weight_measuring_unit_option_value_id ?? '' && $optionValue->id == $product->stock_item->weight_measuring_unit_option_value_id)
                                                    selected
                                                @endif> 
                                                    {{ $optionValue->value }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="border-b-2 border-blue-200 w-full mb-5"></div>
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
                                        Brand
                                    </label>
                                    <div class="@error('brand') border-2 border-red-600 @enderror">
                                        <select name="brand_id" id="brands">
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}">
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
                                    <select name="category_ids[]" multiple id="category_ids">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" @if ($product->category_ids != null && in_array($category->id, $product->category_ids))
                                                selected
                                        @endif>
                                        {{ $category->category_breadcrumbs->breadcrumb }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="w-full lg:w-6/12 px-4">
                                <div class="relative w-full mb-3">
                                    <label class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                        Varijacije
                                    </label>
                                    <select name="variant_ids[]" multiple id="variant_ids">
                                        @foreach ($variants as $variant)
                                            <option value="{{ $variant->id }}" @if ($product->variant_ids != null && in_array($variant->id, $product->variant_ids))
                                                selected
                                        @endif>
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
                                            <option value="{{ $option->id }}" @if ($product->option_ids != null && in_array($option->id, $product->option_ids))
                                                selected
                                        @endif>
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
                                            <option value="{{ $optionValue->id }}" @if ($product->optionValue_ids != null && in_array($optionValue->id, $product->optionValue_ids))
                                                selected
                                        @endif>
                                        {{ $optionValue->option->name }} => {{ $optionValue->value }}</option>
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
                                            <option value="{{ $attribute->id }}" @if ($product->attribute_ids != null && in_array($attribute->id, $product->attribute_ids))
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
                                        @foreach ($attributeValues as $value)
                                            <option value="{{ $value->id }}" @if ($product->attributeValue_ids != null && in_array($value->id, $product->attributeValue_ids))
                                                selected
                                        @endif>
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
                        <small class="dark:text-light text-red-600 text-xs mb-2">Ovdje odabirete fotografije isključivo ako je proizvod jedinstveni i ne sadrži nikakve varijacije!</small>
                        </div>
                        <div class="w-full lg:w-12/12 px-4">
                            <div class="relative w-full mb-3">
                                <div class="file-upload">
                                    <div class="file-select">
                                        <div class="file-select-button" id="fileName">Odaberi Slike</div>
                                        <div class="file-select-name" id="noFile"></div>
                                        <input type="file" id="product_images" name="product_images[]" multiple />
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-xs-12 xol-sm-12">
                                    <output id="list">
                                        @foreach ($product->images as $image)
                                        <span>
                                            <img width="100" class="thumb" src="{{ Storage::url($image->path) }}"  />
                                            <button onclick='deleteImage()'>delete</button>
                                        </span>
                                        @endforeach
                                    </output>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('scripts')
    <script>
        function deleteImage() { 
            var index = Array.from(document.getElementById('list').children).indexOf(event.target.parentNode)
            document.querySelector("#list").removeChild( document.querySelectorAll('#list span')[index]);
            totalFiles.splice(index, 1);
            console.log(totalFiles);
        }

        var totalFiles = [];
        function handleFileSelect(evt) {
            var files = evt.target.files; // FileList object

            // Loop through the FileList and render image files as thumbnails.
            for (var i = 0, f; f = files[i]; i++) {

            // Only process image files.
            if (!f.type.match('image.*')) {
                continue;
            }
            
            totalFiles.push(f)

            var reader = new FileReader();

            // Closure to capture the file information.
            reader.onload = (function(theFile) {
                return function(e) {
                // Render thumbnail.
                var span = document.createElement('span');
                span.innerHTML = ['<img width=100 class="thumb" src="', e.target.result,
                                    '" title="', escape(theFile.name), '"/>', "<button onclick='deleteImage()'>delete</button>"].join('');

                document.getElementById('list').insertBefore(span, null);
                };
            })(f);

            // Read in the image file as a data URL.
            reader.readAsDataURL(f);
            }
        }

        document.getElementById('product_images').addEventListener('change', handleFileSelect, false);
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
            placeholder: 'Odaberi atribute proizvoda',
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
        



        document.getElementById("generate_number").addEventListener("click", generate_number);

        document.getElementById("name").addEventListener("keyup", function(event) {
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
