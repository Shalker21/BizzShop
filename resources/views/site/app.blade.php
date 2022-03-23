<!DOCTYPE HTML>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - {{ config('app.name') }}</title>

    @stack('links')
    @include('site.partials.styles')
    
    
</head>

<body>
    
    @include('site.partials.header')
    <div class="container">
        @yield('content')
    </div>
    
    @stack('scripts')
    @include('site.partials.scripts')
    
</body>

</html>
