<!DOCTYPE HTML>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - {{ config('app.name') }}</title>

    @include('site.partials.styles')
    @stack('links')
    @include('site.partials.styles')
</head>

<body>
    
    <div class="container">
        @yield('content')
    </div>
    
    @include('site.partials.scripts')
    @stack('scripts')
</body>

</html>
