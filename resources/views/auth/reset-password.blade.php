<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Restablecer contraseña</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
<main style="max-width:420px;margin:40px auto;padding:20px;border:1px solid #ddd;border-radius:8px;">
    <h1>Restablecer contraseña</h1>

    @if($errors->any())
        <div style="color:#b00020;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="/reset-password">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <label>Email</label>
        <input name="email" type="email" value="{{ old('email') }}" required style="width:100%;margin:6px 0 12px;">

        <label>Nueva contraseña</label>
        <input name="password" type="password" required style="width:100%;margin:6px 0 12px;">

        <label>Confirmar contraseña</label>
        <input name="password_confirmation" type="password" required style="width:100%;margin:6px 0 12px;">

        <button type="submit" class="w-full py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">Actualizar contraseña</button>
    </form>

    <div style="margin-top:16px;text-align:center;">
        <a href="/login">Volver a iniciar sesión</a>
    </div>
</main>
</body>
</html>


