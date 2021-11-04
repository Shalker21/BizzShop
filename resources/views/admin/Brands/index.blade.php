@extends('admin.app')
@section('content')

    <section class="bg-blueGray-50">
        <div class="w-full lg:w-11/12 px-4 mx-auto mt-6">
            <div
                class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0">
                <div class="rounded-t bg-white mb-0 px-6 py-6 dark:bg-darker dark:text-light">
                    <div class="text-center flex justify-between">
                        <h6 class="text-blueGray-700 text-xl font-bold">
                            Brandovi
                        </h6>
                        <a
                            href="{{ route('admin.catalog.brands.create') }}"
                            class="bg-blue-500 text-white active:bg-blue-600 hover:bg-blue-400 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150">
                            Novi Brand
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
                                    <th class="px-4 py-3">Radnje</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @foreach ($brands as $brand)
                                    <tr class="text-gray-700">
                                        <td class="px-4 py-3 border">
                                            <div class="flex items-center text-sm">
                                                <div class="relative w-8 h-8 mr-3 md:block">
                                                    @if ($brand->logo_path)
                                                        <img class="object-cover w-full h-full rounded"
                                                        src="{{ asset('storage/'.$brand->logo_path) }}"
                                                        alt="" loading="lazy" />                                                            
                                                    @else
                                                        <img class="object-cover w-full h-full rounded"
                                                        src="https://via.placeholder.com/80x80?text=Placeholder+Image"
                                                        alt="" loading="lazy" />
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-ms font-semibold border">{{ $brand->id }}</td>
                                        <td class="px-4 py-3 border">
                                            <div class="flex items-center text-sm">
                                                <p class="font-semibold text-black">{{ $brand->name }}</p>
                                            </div>
                                        </td>
                                        <td class="flex text-sm border">
                                            <a href="{{ route('admin.catalog.brands.edit', ['id' => $brand->id]) }}" class="bg-green-400 hover:bg-green-600 text-white font-bold py-2 px-3 m-3 rounded">
                                                Uredi
                                            </a>
                                            <form action="{{ route('admin.catalog.brands.delete', ['id' => $brand->id]) }}" method="POST" role="form" enctype="multipart/form-data">
                                                @csrf
                                                @method('DELETE')
                                            
                                            <button type="submit" class="bg-red-400 hover:bg-red-600 text-white font-bold py-2 px-3 mt-3 rounded">
                                                Obriši
                                            </button>
                                        </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{!!$brands->render()!!}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection