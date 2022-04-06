@extends('admin.app')
@section('content')

    <section class="bg-blueGray-50">
        <div class="w-full lg:w-11/12 px-4 mx-auto mt-6">
            <div
                class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0">
                <div class="rounded-t bg-white mb-0 px-6 py-6 dark:bg-darker dark:text-light">
                    <div class="text-center flex justify-between">
                        <h6 class="text-blueGray-700 text-xl font-bold">
                            Narudžba Detaljno
                        </h6>
                    </div>
                </div>
                
                <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                    <div class="w-full overflow-x-hidden">
                        <hr>
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        ID
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Naziv
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Količina
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Cijena
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Specijal Cijena
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product_id => $data)
                                    <tr class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                            {{ $data[1]['order_id'] }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $data[0]['product_name'] }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $data[1]['quantity'] }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $data[1]['price'] }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $data[1]['special_price'] }}
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