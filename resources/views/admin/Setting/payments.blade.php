@extends('admin.app')
@section('content')

    <section class="bg-blueGray-50">
        <div class="w-full lg:w-8/12 px-4 mx-auto mt-6">
            <div
                class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0">
                <form action="{{ route('admin.setting.update') }}" method="POST" role="form">
                    @csrf
                    <div class="rounded-t bg-white mb-0 px-6 py-6 dark:bg-darker dark:text-light">
                        <div class="text-center flex justify-between">
                            <h6 class="text-blueGray-700 text-xl font-bold">
                                Generalne Postavke
                            </h6>
                            <button
                                class="bg-blue-500 text-white active:bg-blue-600 hover:bg-blue-400 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                                type="submit">
                                Spremi Promjene
                            </button>
                        </div>
                    </div>
                    <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                        <div class="flex flex-wrap mt-9">
                            <div class="w-full px-4">
                                <label class="block text-left" style="max-width: 400px;">
                                    <span class="text-gray-700 dark:text-light">Stripe Payment Metoda</span>
                                    <select name="stripe_payment_method" id="stripe_payment_method" class="form-select block w-full mt-1 mb-2">
                                        <option value="1" {{ (config('settings.stripe_payment_method')) == 1 ? 'selected' : '' }}>Enabled</option>
                                        <option value="0" {{ (config('settings.stripe_payment_method')) == 0 ? 'selected' : '' }}>Disabled</option>
                                    </select>
                                  </label>
                            </div>
                            <div class="w-full px-4">
                                <div class="relative w-full mb-3">
                                    <label class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                        htmlfor="grid-password">
                                        Key
                                    </label>
                                    <input type="text"
                                        id="stripe_key"
                                        name="stripe_key"
                                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                        value="{{ config('settings.stripe_key') }}">
                                </div>
                            </div>
                            <div class="w-full px-4">
                                <div class="relative w-full mb-3">
                                    <label class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                        htmlfor="grid-password">
                                        Secret Key
                                    </label>
                                    <input type="text"
                                        id="stripe_secret_key"
                                        name="stripe_secret_key"    
                                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                        value="{{ config('settings.stripe_secret_key') }}">
                                </div>
                            </div>
                            <hr>
                            <div class="w-full px-4">
                                <label class="block text-left" style="max-width: 400px;">
                                    <span class="text-gray-700 dark:text-light">PayPal Payment Metoda</span>
                                    <select name="paypal_payment_method" id="paypal_payment_method" class="form-select block w-full mt-1">
                                        <option value="1" {{ (config('settings.paypal_payment_method')) == 1 ? 'selected' : '' }}>Enabled</option>
                                        <option value="0" {{ (config('settings.paypal_payment_method')) == 0 ? 'selected' : '' }}>Disabled</option>
                                    </select>
                                  </label>
                            </div>
                            <div class="w-full px-4">
                                <div class="relative w-full mb-3">
                                    <label class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                        htmlfor="grid-password">
                                        Cliend id
                                    </label>
                                    <input type="text"
                                        id="paypal_client_id"
                                        name="paypal_client_id"
                                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                        value="{{ config('settings.paypal_client_id') }}">
                                </div>
                            </div>
                            <div class="w-full px-4">
                                <div class="relative w-full mb-3">
                                    <label class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                        htmlfor="grid-password">
                                        Secret id
                                    </label>
                                    <input type="text"
                                        id="paypal_secret_od"
                                        name="paypal_secret_id"    
                                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                        value="{{ config('settings.paypal_secret_id') }}">
                                </div>
                            </div>
                            <hr>
                            <div class="w-full px-4">
                                <label class="block text-left" style="max-width: 400px;">
                                    <span class="text-gray-700 dark:text-light">Corvus Pay</span>
                                    <select name="corvus_payment_method" id="corvus_payment_method" class="form-select block w-full mt-1">
                                    </select>
                                  </label>
                            </div>
                            <div class="w-full px-4">
                                <div class="relative w-full mb-3">
                                    <label class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                        htmlfor="grid-password">
                                        -
                                    </label>
                                    <input type="text"
                                        id="corvus_key"
                                        name="corvus_key"
                                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                        value="DODATI NAKNADNO FUNKCIONALNOST">
                                </div>
                            </div>
                            <div class="w-full px-4">
                                <div class="relative w-full mb-3">
                                    <label class="dark:text-light block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                        htmlfor="grid-password">
                                        -
                                    </label>
                                    <input type="text"
                                        id="corvus_secret_key"
                                        name="corvus_secret_key"    
                                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                        value="">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection