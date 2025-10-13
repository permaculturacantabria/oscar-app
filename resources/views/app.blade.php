<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Emociona - Diario de Sesiones</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    
    <!-- Temporary: Basic styles until Vite assets are built -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8fafc;
        }
        #app {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .loading {
            text-align: center;
            color: #6b7280;
        }
    </style>
    
    <!-- Conditional Vite Assets (only if built) -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.jsx'])
    @endif
</head>
<body class="antialiased">
    <div id="app">
        <div class="loading">
            <h1>Emociona - Diario de Sesiones</h1>
            <p>Cargando aplicación...</p>
            <small>Si esta página no cambia, es posible que necesites compilar los assets del frontend.</small>
        </div>
    </div>
</body>
</html>