@extends('admin.app')
@section('content')
<section class="bg-blueGray-50">

    <div class="w-full lg:w-11/12 px-4 mx-auto mt-6">
        <div
            class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0">
            <div class="rounded-t bg-white mb-0 px-6 py-6 dark:bg-darker dark:text-light">
                <div class="text-center flex justify-between">
                    <h6 class="text-blueGray-700 text-xl font-bold">
                        Proizvodi
                    </h6>
                    <a
                        href="{{ route('admin.catalog.products.create') }}"
                        class="bg-blue-500 text-white active:bg-blue-600 hover:bg-blue-400 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150">
                        Novi Proizvod
                    </a>
                </div>
            </div>
            <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                <div class="w-full overflow-x-hidden">
                    <table class="w-full" id="sampleTable">
                        <thead>
                            <tr
                                class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                <th class="px-4 py-3">ID</th>
                                <th class="px-4 py-3">Naziv</th>
                                <th class="px-4 py-3">Radnje</th>
                            </tr>
                        </thead>
                        <tbody id="admin_products_index_search" class="bg-white">
                            @foreach ($products as $product)
                                                                    
                                    <tr class="text-gray-700">
                                        
                                        <td class="px-4 py-3 text-ms font-semibold border">{{ $product->id }}</td>
                                        <td class="px-4 py-3 border">
                                            <div class="flex items-center text-sm">
                                                <p class="font-semibold text-black">{{ $product->product_translation->name }}</p>
                                            </div>
                                        </td>
                                        
                                        <td class="text-sm border">
                                            <a href="#" class="bg-green-400 hover:bg-green-600 text-white font-bold py-2 px-3 m-3 rounded">
                                                Uredi
                                            </a>
                                            <a href="#" class="bg-red-400 hover:bg-red-600 text-white font-bold py-2 px-3 rounded">
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
@push('scripts')
    <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
    <script>
        $(function(){
          $("#sampleTable").dataTable({
          });
        })
        </script>
@endpush