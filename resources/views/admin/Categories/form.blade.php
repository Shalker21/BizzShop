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
                    class="dark:text-gray-600 border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                    value="{{ old('name', optional($category ?? null)->category_translation->name) }}">
            </div>
        </div>
        <div class="w-full lg:w-6/12 px-4">
            <div class="relative w-full mb-3">
                <label class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2">
                    Opis kategorije
                </label>
                <textarea id="description" name="description"
                    class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                    {{ old('description', optional($category ?? null)->category_translation->description) }}
                </textarea>
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
                        class="border border-gray-300 rounded text-gray-600 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none">
                        <option value="0">Odaberi kategoriju</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_translation->name }}</option>
                        @endforeach
                    </select>
                </div>
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
        <div class="w-full lg:w-12/12 px-4">
            <div class="grid grid-cols-1 gap-4">
                <div id="">
                    <category-image-preview/>
                </div>
            </div>
        </div>

    </div>
</div>