@extends('admin.app')
@section('content')
<div class="container mx-auto px-20 pt-10">
<div class="flex flex-col w-full" style="cursor: auto;">
  <div class="grid gap-4 grid-cols-1 sm:grid-cols-2 my-2 w-full">
    <div class="metric-card bg-blue-200 dark:bg-blue-blue border border-blue-800 dark:border-blue-800 rounded-lg p-4 max-w-72 w-full" style="cursor: auto;">
      <a aria-label="Unsplash Downloads" target="_blank" rel="noopener noreferrer" href="https://stackdiary.com/">
        <div class="flex items-center text-blue-900 dark:text-blue-100" style="cursor: auto;">Broj Ostvarenih Narudžba</div>
      </a>
      <p class="mt-2 text-3xl font-bold spacing-sm text-blue-800 dark:text-white" style="cursor: auto;">{{$countOrder}}</p>
    </div>
    <div class="metric-card bg-green-200 dark:bg-green-green border border-green-800 dark:border-green-800 rounded-lg p-4 max-w-72 w-full" style="cursor: auto;">
      <a aria-label="Unsplash Downloads" target="_blank" rel="noopener noreferrer" href="https://stackdiary.com/">
        <div class="flex items-center text-green-900 dark:text-green-100" style="cursor: auto;">Ukupan prihod (u kunama)</div>
      </a>
      <p class="mt-2 text-3xl font-bold spacing-sm text-green-800 dark:text-white" style="cursor: auto;">{{$sumOrders}}</p>
    </div>
    <div class="metric-card bg-purple-200 dark:bg-purple-purple border border-purple-800 dark:border-purple-800 rounded-lg p-4 max-w-72 w-full" style="cursor: auto;">
      <a aria-label="Unsplash Downloads" target="_blank" rel="noopener noreferrer" href="https://stackdiary.com/">
        <div class="flex items-center text-purple-900 dark:text-purple-100" style="cursor: auto;">Ukupan broj proizvoda (i varijacije)</div>
      </a>
      <p class="mt-2 text-3xl font-bold spacing-sm text-blue-800 dark:text-white" style="cursor: auto;">{{$productsCount}}</p>
    </div>
  </div>
</div>
</div>
   
@endsection
