@extends('admin.app')
@section('content')

<div class="flex justify-center items-center h-screen">
<!--actual component start-->
<div x-data="setup()">
    <ul class="flex justify-center items-center my-4">
        <template x-for="(tab, index) in tabs" :key="index">
            <li class="cursor-pointer py-2 px-4 text-gray-500 border-b-8"
                :class="activeTab===index ? 'text-green-500 border-green-500' : ''" @click="activeTab = index"
                x-text="tab"></li>
        </template>
    </ul>

    <div class="w-80 bg-white p-16 text-center mx-auto border">
        <div x-show="activeTab===0">Content 1</div>
        <div x-show="activeTab===1">Content 2</div>
        <div x-show="activeTab===2">Content 3</div>
        <div x-show="activeTab===3">Content 4</div>
    </div>

    <ul class="flex justify-center items-center my-4">
        <template x-for="(tab, index) in tabs" :key="index">
            <li class="cursor-pointer py-3 px-4 rounded transition"
                :class="activeTab===index ? 'bg-green-500 text-white' : ' text-gray-500'" @click="activeTab = index"
                x-text="tab"></li>
        </template>
    </ul>
    
    <div class="flex gap-4 justify-center border-t p-4">
        <button
            class="py-2 px-4 border rounded-md border-blue-600 text-blue-600 cursor-pointer uppercase text-sm font-bold hover:bg-blue-500 hover:text-white hover:shadow"
            @click="activeTab--" x-show="activeTab>0"
            >Back</button>
        <button
            class="py-2 px-4 border rounded-md border-blue-600 text-blue-600 cursor-pointer uppercase text-sm font-bold hover:bg-blue-500 hover:text-white hover:shadow"
            @click="activeTab++" x-show="activeTab<tabs.length-1"
            >Next</button>
    </div>
</div>
<!--actual component end-->
</div>

<script>
function setup() {
return {
  activeTab: 0,
  tabs: [
      "Tab No.1",
      "Tab No.2",
      "Tab No.3",
      "Tab No.4",
  ]
};
};
</script>
  @endsection