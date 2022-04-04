@extends('admin.app')
@section('content')

    <section class="bg-blueGray-50">
        <div class="w-full lg:w-11/12 px-4 mx-auto mt-6">
            <div
                class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0">
                <div class="rounded-t bg-white mb-0 px-6 py-6 dark:bg-darker dark:text-light">
                    <div class="text-center flex justify-between">
                        <h6 class="text-blueGray-700 text-xl font-bold">
                            Narudžbe
                        </h6>
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
                                    <th class="px-4 py-3">broj narudžbe</th>
                                    <th class="px-4 py-3">Ime</th>
                                    <th class="px-4 py-3">Prezime</th>
                                    <th class="px-4 py-3">Adresa naručitelja</th>
                                    <th class="px-4 py-3">Grad</th>
                                    <th class="px-4 py-3">kontakt</th>
                                    <th class="px-4 py-3">Ukupno</th>
                                    <th class="px-4 py-3">metoda plačanja</th>
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
                    "url": "{{route('admin.webshop.getOrders')}}",
                    "dataType": "json",
                    "type": "POST",
                    "data":{ _token: "{{csrf_token()}}"},
                    },
                "columns": [
                    { "data": 'id' },
                    { "data": 'order_number' },
                    { "data": 'first_name' },
                    { "data": 'last_name' },
                    { "data": 'address_name' },
                    { "data": 'city' },
                    { "data": 'phone_number' },
                    { "data": 'total' },
                    { "data": 'payment_method' },
                    { "data": "options" },
                ]
            });
        });
    </script>
@endpush