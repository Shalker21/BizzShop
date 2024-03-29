@extends('admin.app')
@section('content')

    <section class="bg-blueGray-50">
        <div class="w-full lg:w-11/12 px-4 mx-auto mt-6">
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
            @if (session('create'))
                <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                    <div class="w-full overflow-x-hidden">
                        <div class="bg-green-300 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
                            <div class="flex">
                                <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                                <div>
                                    
                                    <p class="font-bold">{{ session('create') }}</p>
                                    
                                </div>
                            </div>
                        </div>    
                    </div>
                </div> 
            @endif
            @if (session('update'))
                <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                    <div class="w-full overflow-x-hidden">
                        <div class="bg-green-300 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
                            <div class="flex">
                                <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                                <div>
                                    
                                    <p class="font-bold">{{ session('update') }}</p>
                                    
                                </div>
                            </div>
                        </div>    
                    </div>
                </div> 
            @endif
            @if (session('delete'))
                <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                    <div class="w-full overflow-x-hidden">
                        <div class="bg-red-300 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
                            <div class="flex">
                                <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                                <div>
                                    
                                    <p class="font-bold">{{ session('delete') }}</p>
                                    
                                </div>
                            </div>
                        </div>    
                    </div>
                </div> 
            @endif
            <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="table stripe cell-border compact hover order-column row-border" id="categoriesTable">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">ID</th>
                            <th scope="col" class="px-4 py-3">Naziv</th>
                            <th scope="col" class="px-4 py-3">Roditelj</th>
                            <th scope="col" class="px-4 py-3">Istaknuto</th>
                            <th scope="col" class="px-4 py-3">Prikaz u navigaciji</th>
                            <th scope="col" class="px-4 py-3">Radnje</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            // DataTable
            $('#categoriesTable').DataTable({
                "serverSide": true,
                "processing": true,
                "ajax": {
                    "url": "{{route('admin.catalog.categories.getCategories')}}",
                    "dataType": "json",
                    "type": "POST",
                    "data":{ _token: "{{csrf_token()}}"},
                    },
                "columns": [
                    { "data": 'id' },
                    { "data": 'name' },
                    { "data": 'parent' },
                    { "data": 'featured' },
                    { "data": 'menu' },
                    { "data": "options" },
                ]
            });
        });
    </script>
@endpush
