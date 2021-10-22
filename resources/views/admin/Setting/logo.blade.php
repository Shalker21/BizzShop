@extends('admin.app')
@section('content')

    <section class="bg-blueGray-50">
        <div class="w-full lg:w-8/12 px-4 mx-auto mt-6">
            <div
                class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0">
                <form action="{{ route('admin.setting.update') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="rounded-t bg-white mb-0 px-6 py-6 dark:bg-darker dark:text-light">
                        <div class="text-center flex justify-between">
                            <h6 class="text-blueGray-700 text-xl font-bold">
                                Logo Web Stranice
                            </h6>
                            <button
                                class="bg-blue-500 text-white active:bg-blue-600 hover:bg-blue-400 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                                type="submit">
                                Spremi Promjene
                            </button>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-4">
                        <div class="">
                            <div class="grid grid-cols-2 gap-2">
                                <div class="m-5">
                                    @if (config('settings.site_logo') != null)
                                        <img src="{{ asset('storage/'.config('settings.site_logo')) }}" id="logoImg" style="width: 80px; height: auto;">
                                    @else
                                        <img src="https://via.placeholder.com/80x80?text=Placeholder+Image" id="logoImg" style="width: 80px; height: auto;">
                                    @endif
                                </div>
                                <div>
                                    <div class="flex items-center justify-center bg-grey-lighter">
                                        <label class="flex flex-col items-center bg-white text-blue-600 rounded-lg shadow-lg my-2 px-8 py-2 border border-blue cursor-pointer hover:text-blue-400 ">
                                            <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                                            </svg>
                                            <span class="mt-2 text-base leading-normal">Odaberi logo stranice</span>
                                            <input type='file' class="hidden" name="site_logo"/>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="grid grid-cols-2 gap-2">
                                <div class="m-5"> 
                                    @if (config('settings.site_favicon') != null)
                                    <img src="{{ asset('storage/'.config('settings.site_favicon')) }}" id="logoImg" style="width: 80px; height: auto;">
                                @else
                                    <img src="https://via.placeholder.com/80x80?text=Placeholder+Image" id="logoImg" style="width: 80px; height: auto;">
                                @endif
                                </div>
                                <div>
                                    <div class="flex items-center justify-center bg-grey-lighter">
                                        <label class="flex flex-col items-center bg-white text-blue-600 rounded-lg shadow-lg my-2 px-8 py-2 border border-blue cursor-pointer hover:text-blue-400 ">
                                            <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                                            </svg>
                                            <span class="mt-2 text-base leading-normal">Odaberi ikonu </span>
                                            <input type='file' class="hidden" name="site_favicon"/>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </section>
@endsection