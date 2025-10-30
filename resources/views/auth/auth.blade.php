<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Accede a Emociona</title>
    <link rel="stylesheet" href="/css/app.css">
    <style>
        body { background:#f7f5f0; font-family: Inter, system-ui, sans-serif; }
        .card { background:#fff; border:1px solid #eceae4; border-radius:12px; box-shadow:0 6px 16px rgba(0,0,0,0.06); }
        .tab { cursor:pointer; padding:12px 16px; border-bottom:2px solid transparent; }
        .tab.active { border-color:#ff931e; color:#1a1a1a; font-weight:600; }
        .link { color:#1a1a1a; text-decoration:underline; }
    </style>
</head>
<body>
<main style="max-width:960px;margin:40px auto;padding:16px;">
    <div class="card" style="overflow:hidden;">
        <div style="display:flex; gap:8px; padding:12px 16px; border-bottom:1px solid #eceae4; background:#fff;">
            <button id="tab-login" class="tab">Iniciar sesión</button>
            <button id="tab-register" class="tab">Crear cuenta</button>
        </div>

        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:0;">
            <section style="padding:24px; border-right:1px solid #eceae4;">
                <h2 class="text-xl font-semibold mb-4">Inicia sesión</h2>
                @if(session('status'))
                    <div style="color:green;" class="mb-2">{{ session('status') }}</div>
                @endif
                @if($errors->login ?? false)
                    <div style="color:#b00020;" class="mb-2">
                        <ul>
                            @foreach(($errors->login->all() ?? []) as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="/login">
                    @csrf
                    <label class="text-sm">Email</label>
                    <input name="email" type="email" value="{{ old('email') }}" required class="w-full bg-gray-100 rounded px-3 py-2 mb-3">

                    <label class="text-sm">Contraseña</label>
                    <input name="password" type="password" required class="w-full bg-gray-100 rounded px-3 py-2 mb-3">

                    <label style="display:flex;align-items:center;gap:8px;" class="mb-3">
                        <input type="checkbox" name="remember"> Recuérdame
                    </label>

                    <button type="submit" class="w-full py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">Entrar</button>
                </form>
                <div class="mt-3">
                    <a href="/forgot-password" class="link">¿Olvidaste tu contraseña?</a>
                </div>
            </section>

            <section style="padding:24px;">
                <h2 class="text-xl font-semibold mb-4">Crear una cuenta</h2>
                @if($errors->register ?? false)
                    <div style="color:#b00020;" class="mb-2">
                        <ul>
                            @foreach(($errors->register->all() ?? []) as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="/register">
                    @csrf
                    <label class="text-sm">Nombre</label>
                    <input name="name" type="text" value="{{ old('name') }}" required class="w-full bg-gray-100 rounded px-3 py-2 mb-3">

                    <label class="text-sm">Email</label>
                    <input name="email" type="email" value="{{ old('email') }}" required class="w-full bg-gray-100 rounded px-3 py-2 mb-3">

                    <label class="text-sm">Contraseña</label>
                    <input name="password" type="password" required class="w-full bg-gray-100 rounded px-3 py-2 mb-3">

                    <label class="text-sm">Confirmar contraseña</label>
                    <input name="password_confirmation" type="password" required class="w-full bg-gray-100 rounded px-3 py-2 mb-3">

                    <label style="display:flex;align-items:flex-start;gap:8px;" class="mb-3">
                        <input type="checkbox" name="terms" value="1" required>
                        <span class="text-sm">Acepto los <a href="/terminos" class="link" target="_blank" rel="noopener">Términos y Condiciones</a> y la <a href="/privacidad" class="link" target="_blank" rel="noopener">Política de Privacidad</a>.</span>
                    </label>

                    <button type="submit" class="w-full py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">Crear cuenta</button>
                </form>
            </section>
        </div>
    </div>
</main>

<script>
    (function(){
        const tabLogin = document.getElementById('tab-login');
        const tabRegister = document.getElementById('tab-register');
        function setMode(mode){
            const isRegister = mode === 'register' || window.location.hash === '#register';
            tabLogin.classList.toggle('active', !isRegister);
            tabRegister.classList.toggle('active', isRegister);
        }
        tabLogin.addEventListener('click', function(){ history.replaceState(null, '', '#login'); setMode('login'); });
        tabRegister.addEventListener('click', function(){ history.replaceState(null, '', '#register'); setMode('register'); });
        setMode(window.location.hash === '#register' ? 'register' : 'login');
    })();
</script>
</body>
</html>


