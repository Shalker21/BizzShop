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
                <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                    <div class="w-full overflow-x-hidden">
                        <hr>
                        <table class="w-full stripe cell-border compact hover order-column row-border" id="categoriesTable">
                            <thead>
                                <tr
                                    class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                    <th class="px-4 py-3">ID</th>
                                    <th class="px-4 py-3">Naziv</th>
                                    <th class="px-4 py-3">Roditelj</th>
                                    <th class="px-4 py-3">Istaknuto</th>
                                    <th class="px-4 py-3">Prikaz u navigaciji</th>
                                    <th class="px-4 py-3">Radnje</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
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
