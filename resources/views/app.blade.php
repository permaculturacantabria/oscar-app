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
    
    <!-- Vite Assets - CSP Compliant -->
    @if (file_exists(public_path('build/manifest.json')))
        @vite(['resources/js/app-csp.jsx'])
    @else
        <!-- Fallback CSS -->
        <link rel="stylesheet" href="{{ asset('resources/css/app.css') }}">
    @endif
</head>
<body class="antialiased">
    <div id="app">
        <div class="loading">
            <h1>Emociona - Diario de Sesiones</h1>
            <p>Cargando aplicación...</p>
            <small>Si esta página no cambia, revisa la consola del navegador para ver errores.</small>
        </div>
    </div>

    <!-- Error handling script -->
    <script>
        // Show any JavaScript errors
        window.addEventListener('error', function(e) {
            console.error('JavaScript Error:', e.error);
            document.querySelector('.loading p').textContent = 'Error al cargar la aplicación. Revisa la consola.';
        });
        
        // Timeout to show if React doesn't mount
        setTimeout(function() {
            const loadingDiv = document.querySelector('.loading');
            if (loadingDiv && loadingDiv.style.display !== 'none') {
                console.warn('React app did not mount after 10 seconds');
                loadingDiv.innerHTML = '<h1>Emociona - Diario de Sesiones</h1><p>La aplicación React no se ha cargado.</p><small>Revisa la consola del navegador (F12) para ver errores específicos.</small>';
            }
        }, 10000);
    </script>
</body>
</html>