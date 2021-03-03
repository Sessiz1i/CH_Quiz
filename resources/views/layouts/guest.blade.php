<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $header }} - {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style> a { color: inherit; text-decoration: none; } a:hover { color: inherit; text-decoration: none; } a:not([href]):not([class]) { color: inherit; text-decoration: none; }  a:not([href]):not([class]):hover { color: inherit; text-decoration: none; } </style>
    <style>
        .sticky-gb {
            position: -webkit-sticky;
            position: sticky;
            top: 205px;
            z-index: 1000;
        }
        *{
            margin: 0;
            padding: 0;
        }
    </style>
@livewireStyles

<!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
</head>
<body class="font-sans antialiased bg-gray-100">
<x-jet-banner/>
<div class="sticky-top">
@livewire('navigation-menu')

<!-- Page Heading -->
    @if(isset($header))
        <header class="bg-white sm:shadow-lg">
            <div class="px-4 py-6 pb-3 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <h3 class="font-semibold leading-tight text-gray-600 text-center">
                    {{ $header }}
                </h3>
            </div>
        </header>
@endif
</div>
<!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
<x-sweet-alert/>
@stack('modals')

@livewireScripts
</body>
</html>
