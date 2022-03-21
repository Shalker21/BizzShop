@extends('admin.app')
@section('content')

    <section class="bg-blueGray-50">
        <div class="w-full lg:w-11/12 px-4 mx-auto mt-6">
            <div
                class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0">
                <div class="rounded-t bg-white mb-0 px-6 py-6 dark:bg-darker dark:text-light">
                    <div class="text-center flex justify-between">
                        <h6 class="text-blueGray-700 text-xl font-bold">
                            Ažuriraj količinu proizvoda u skladištu
                        </h6>
                    </div>
                </div>
                
                <div class="rounded-t bg-white mb-0 px-6 py-6 dark:bg-darker dark:text-light">
                    <p>NAZIV SKLADIŠTA: {{$inventory->name}}</p>
                    <p>KOD SKLADIŠTA: {{ $inventory->code }}</p>
                    <p>LOKACIJA: {{$inventory->location}}</p>
                </div>
                <input type="hidden" value="{{$inventory->id}}" id="inventory_id" />
                <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                    <div class="w-full overflow-x-hidden">
                        <hr>
                        <table class="w-full stripe cell-border compact hover order-column row-border" id="sourceStockTable">
                            <thead>
                                <tr
                                    class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                    <th class="px-4 py-3">ID</th>
                                    <th class="px-4 py-3">Proizvod</th>
                                    <th class="px-4 py-3">Varijacija</th>
                                    <th class="px-4 py-3">Dostupna količina</th>
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
            $('#sourceStockTable').DataTable({
                "serverSide": true,
                "processing": true,
                "ajax": {
                    "url": "{{route('admin.webshop.getInventorySourceStocks')}}",
                    "dataType": "json",
                    "type": "POST",
                    "data":{ _token: "{{csrf_token()}}", inventory_id: document.getElementById('inventory_id').value},
                    },
                "columns": [
                    { "data": 'id' },
                    { "data": 'product_name' },
                    { "data": 'variant_name' },
                    { "data": 'available_stock' },
                ]
            });
        });
    </script>
@endpush