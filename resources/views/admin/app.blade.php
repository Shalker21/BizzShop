<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <style>
        :root {
        --light: #edf2f9;
        --dark: #152e4d;
        --darker: #12263f;
        
        --color-red: #dc2626;
        --color-green: #16a34a;
        --color-blue: #2563eb;
        --color-cyan: #0891b2;
        --color-teal: #0d9488;
        --color-fuchsia: #c026d3;
        --color-orange: #ea580c;
        --color-yellow: #ca8a04;
        --color-violet: #7c3aed;
        }
        
        [x-cloak] { display: none; }
        
        .dark .dark\:text-light {
        color: var(--light);
        }
        
        .dark .dark\:bg-dark {
        background-color: var(--dark);
        }
        
        .dark .dark\:bg-darker {
        background-color: var(--darker);
        }
        
        .dark .dark\:text-gray-300 {
        color: #D1D5DB;
        }
        
        .dark .dark\:text-blue-500 {
        color: #3B82F6;
        }
        
        .dark .dark\:text-blue-100 {
        color: #DBEAFE;
        }
        
        .dark .dark\:hover\:text-light:hover {
        color: var(--light);
        }
        
        .dark .dark\:border-blue-800 {
        border-color: #1e40af;
        }
        
        .dark .dark\:border-blue-700 {
        border-color: #1D4ED8;
        }
        
        .dark .dark\:bg-blue-600 {
            background-color: #2563eb;
        }
        
        .dark .dark\:hover\:bg-blue-600:hover {
        background-color: #2563eb;
        }
        
        .hover\:overflow-y-auto:hover {
            overflow-y: auto;
        }
    </style>
</head>
<body class="bg-gray-200" style="background: #edf2f7;">
        <div id="app">
            @yield('content')
        </div>
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</body>
</html>