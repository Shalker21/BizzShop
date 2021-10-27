@extends('admin.app')
@section('content')

    <section class="bg-blueGray-50">
        <div class="w-full lg:w-8/12 px-4 mx-auto mt-6">
            <div
                class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0">
                <div class="rounded-t bg-white mb-0 px-6 py-6 dark:bg-darker dark:text-light">
                    <div class="text-center flex justify-between">
                        <h6 class="text-blueGray-700 text-xl font-bold">
                            Kategorije
                        </h6>
                        <a
                            href="{{ route('admin.catalog.categories.create') }}"
                            class="bg-blue-500 text-white active:bg-blue-600 hover:bg-blue-400 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150">
                            Nova Kategorija
                        </a>
                    </div>
                </div>
                <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                    <div class="w-full overflow-x-hidden">
                        <table class="w-full">
                            <thead>
                                <tr
                                    class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                    <th class="px-4 py-3">Slika</th>
                                    <th class="px-4 py-3">ID</th>
                                    <th class="px-4 py-3">Naziv</th>
                                    <th class="px-4 py-3">Istaknuto</th>
                                    <th class="px-4 py-3">Prikaz u navigaciji</th>
                                    <th class="px-4 py-3">Radnje</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @foreach ($categories as $category)
                                    <tr class="text-gray-700">
                                        <td class="px-4 py-3 border">
                                            <div class="flex items-center text-sm">
                                                <div class="relative w-8 h-8 mr-3 md:block"> <!-- FEAT/ add image -->
                                                    <img class="object-cover w-full h-full rounded"
                                                        src="https://images.pexels.com/photos/5212324/pexels-photo-5212324.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260"
                                                        alt="" loading="lazy" />
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-ms font-semibold border">{{ $category->id }}</td>
                                        <td class="px-4 py-3 border">
                                            <div class="flex items-center text-sm">
                                                <p class="font-semibold text-black">{{ $category->category_translation->name }}</p>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-xs border">
                                            <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-sm">
                                                @if ($category->featured)
                                                    DA
                                                    @else
                                                    NE
                                                @endif
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-sm border">
                                            <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-sm">
                                                @if ($category->menu)
                                                    DA
                                                    @else
                                                    NE
                                                @endif
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-sm border">
                                            <a href="#" class="bg-green-400 hover:bg-green-600 text-white font-bold py-2 px-4 mr-2 rounded">
                                                Uredi
                                            </a>
                                            <a href="#" class="bg-red-400 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                                                Obriši
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
