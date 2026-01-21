<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Todo Kanban App</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/script.js') }}" defer></script>
</head>

<body>
    <div class="app-container">
        <nav class="navbar">
            <div class="logo">
                <a href="{{ route('projects.index') }}">My Todo</a>
            </div>
            <!-- Add other nav items if needed -->
        </nav>

        <main class="main-content">
            @yield('content')
        </main>
    </div>
</body>

</html>