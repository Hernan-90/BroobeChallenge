<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        
        <title>Challenge PHP - Broobe</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    </head>
    <body >
        <header class="header-section centered">
            @if( true)
                <a href={{ route('index') }} class="centered"><img src="{{ asset('img/broobe.png') }}" alt="Logo Broobe" class="logo"></a>
            @endif
            <ul class="centered gap-30">
                <li><a href={{ route('home') }} class="navLink left-side {{ Route::currentRouteName() === 'home' ? 'active' : '' }}">Run Metric</a></li>
                <li><a href={{ route('history') }} class="navLink {{ Route::currentRouteName() === 'history' ? 'active' : '' }}">Metric History</a></li>
            </ul>
        </header>
        <main class="main-section centered">
            @yield('content')
        </main>
    </body>
</html>