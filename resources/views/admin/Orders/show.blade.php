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
                        <h6 class="text-blueGray-700 text-xl font-bold pl-5">
                            Proizvodi
                        </h6>
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
                                    <th scope="col" class="px-6 py-3">
                                        Odabrane opcije
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
                                            {{ $data[1]['price'] . " kn"}}
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($data[1]['special_price'] > 0)
                                                {{ $data[1]['special_price'] . " kn" }}
                                            @else
                                                /
                                            @endif
                                            
                                        </td>
                                        <td class="px-6 py-4">
                                            @foreach ($data[1]['selected_options_with_values'] as $option => $value)
                                                <p>{{ $option  . " => " . $value }}</p>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="my-5">
                            <span class="text-blueGray-700 text-xl font-bold pl-5">
                                Cijena za naplatu:
                            </span>
                            <span> {{$orderData->total}} Kn</span>
                        </div>
                        
                    </div>
                </div>

                <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                    <div class="w-full overflow-x-hidden">
                        <hr>
                        <h6 class="text-blueGray-700 text-xl font-bold pl-5">
                            Podaci za dostavu
                        </h6>
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Ime i Prezime
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Email
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Adresa
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Grad
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Kontakt
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Način plaćanja
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Status plaćanja
                                    </th>

                                    <th scope="col" class="px-6 py-3">
                                        Pošiljka Poslana
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Datum narudžbe
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                        {{$orderData->first_name . " " . $orderData->last_name}}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{$orderData->email}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$orderData->address}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$orderData->city}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$orderData->phone_number}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$orderData->payment_method}}
                                    </td>
                                    <td class="px-6 py-4">
                                        @php
                                            if ($orderData->paid) {
                                                echo "PLAĆENO";
                                            } else {
                                                echo "NEPLAĆENO";
                                            }
                                        @endphp 
                                    </td>
                                    <td class="px-6 py-4">
                                        @php
                                            if ($orderData->ordered) {
                                                echo "DA";
                                            } else {
                                                echo "NE";
                                            }
                                        @endphp 
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$orderData->created_at}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                @if (!$orderData->paid)
                <div class="rounded-t bg-white mb-0 px-6 py-1 dark:bg-darker dark:text-light">
                    <div class="text-center flex justify-between">
                        <form action="{{ route('admin.webshop.orders.update', ['id' => $orderData->id]) }}" method="POST"
                            role="form" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="paid" value="1">
                            <div class="lg:w-4/12">
                                <button
                                    class="bg-blue-500 text-white active:bg-blue-600 hover:bg-blue-400 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                                    type="submit">
                                    Plaćeno
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                @endif
                @if (!$orderData->ordered)
                <div class="rounded-t bg-white mb-0 px-6 py-1 dark:bg-darker dark:text-light">
                    <div class="text-center flex justify-between">
                        <form action="{{ route('admin.webshop.orders.update', ['id' => $orderData->id]) }}" method="POST"
                            role="form" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="ordered" value="1">
                            <div class="lg:w-4/12">
                                <button
                                    class="bg-blue-500 text-white active:bg-blue-600 hover:bg-blue-400 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                                    type="submit">
                                    Dostavljeno
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                @endif
                
                
                
            </div>
        </div>
    </section>
@endsection