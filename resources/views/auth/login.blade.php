<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
<main style="max-width:420px;margin:40px auto;padding:20px;border:1px solid #ddd;border-radius:8px;">
    <h1>Iniciar sesión</h1>

    @if(session('status'))
        <div style="color:green;">{{ session('status') }}</div>
    @endif

    @if($errors->any())
        <div style="color:#b00020;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="/login">
        @csrf
        <label>Email</label>
        <input name="email" type="email" value="{{ old('email') }}" required autofocus style="width:100%;margin:6px 0 12px;">

        <label>Contraseña</label>
        <input name="password" type="password" required style="width:100%;margin:6px 0 12px;">

        <label style="display:flex;align-items:center;gap:8px;margin:6px 0 12px;">
            <input type="checkbox" name="remember"> Recuérdame
        </label>

        <button type="submit" class="w-full py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">Entrar</button>
    </form>

    <div style="margin-top:16px;display:flex;justify-content:space-between;">
        <a href="/register">Crear cuenta</a>
        <a href="/forgot-password">¿Olvidaste tu contraseña?</a>
    </div>

    <div style="margin-top:24px;text-align:center;">
        <a href="/privacidad">Política de privacidad</a>
    </div>
</main>
</body>
</html>


