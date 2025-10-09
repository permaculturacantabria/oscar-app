<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Registro - {{ config('app.name', 'Diario de Sesiones') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f5f0 0%, #e8e8e3 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 0;
        }
        
        .auth-container {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 450px;
            margin: 20px;
        }
        
        .auth-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .auth-logo {
            font-size: 2rem;
            font-weight: 700;
            color: #ff6b1a;
            margin-bottom: 10px;
        }
        
        .auth-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
        }
        
        .auth-subtitle {
            color: #666;
            font-size: 0.9rem;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #333;
        }
        
        .form-input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s;
            background: white;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #ff6b1a;
            background: white;
            box-shadow: 0 0 0 3px rgba(255, 107, 26, 0.1);
        }
        
        .form-input.is-invalid {
            border-color: #f56565;
        }
        
        .invalid-feedback {
            color: #f56565;
            font-size: 0.875rem;
            margin-top: 5px;
        }
        
        .btn {
            width: 100%;
            padding: 12px;
            background: #ff6b1a;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .btn:hover {
            background: #e55a15;
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(255, 107, 26, 0.3);
        }
        
        .auth-links {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }
        
        .auth-links a {
            color: #ff6b1a;
            text-decoration: none;
            font-weight: 500;
        }
        
        .auth-links a:hover {
            text-decoration: underline;
        }
        
        .back-home {
            position: absolute;
            top: 20px;
            left: 20px;
            color: #666;
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
        }
        
        .back-home:hover {
            transform: translateX(-5px);
        }
        
        .password-requirements {
            background: #f5f5f0;
            border: 1px solid #e8e8e3;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            font-size: 0.875rem;
        }
        
        .password-requirements h4 {
            color: #ff6b1a;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }
        
        .password-requirements ul {
            list-style: none;
            color: #666;
        }
        
        .password-requirements li {
            margin-bottom: 4px;
        }
        
        .password-requirements li:before {
            content: "✓ ";
            color: #10b981;
            font-weight: bold;
        }
        
        @media (max-width: 480px) {
            .auth-container {
                padding: 30px 20px;
                margin: 10px;
            }
            
            .back-home {
                position: relative;
                top: auto;
                left: auto;
                margin-bottom: 20px;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <a href="{{ url('/') }}" class="back-home">
        <i class="fas fa-arrow-left"></i>
        Volver al inicio
    </a>

    <div class="auth-container">
        <div class="auth-header">
            <div class="auth-logo">
                <i class="fas fa-brain"></i> Diario de Sesiones
            </div>
            <h1 class="auth-title">Crear Cuenta</h1>
            <p class="auth-subtitle">Únete a nuestra plataforma profesional</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label for="name" class="form-label">Nombre Completo</label>
                <input id="name" type="text" class="form-input @error('name') is-invalid @enderror" 
                       name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                       placeholder="Tu nombre completo">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input id="email" type="email" class="form-input @error('email') is-invalid @enderror" 
                       name="email" value="{{ old('email') }}" required autocomplete="email"
                       placeholder="tu@email.com">
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="password-requirements">
                <h4>Requisitos de la contraseña:</h4>
                <ul>
                    <li>Mínimo 8 caracteres</li>
                    <li>Al menos una letra mayúscula</li>
                    <li>Al menos una letra minúscula</li>
                    <li>Al menos un número</li>
                </ul>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Contraseña</label>
                <input id="password" type="password" class="form-input @error('password') is-invalid @enderror" 
                       name="password" required autocomplete="new-password"
                       placeholder="Crea una contraseña segura">
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password-confirm" class="form-label">Confirmar Contraseña</label>
                <input id="password-confirm" type="password" class="form-input" 
                       name="password_confirmation" required autocomplete="new-password"
                       placeholder="Confirma tu contraseña">
            </div>

            <button type="submit" class="btn">
                <i class="fas fa-user-plus"></i> Crear Cuenta
            </button>

            <div class="auth-links">
                ¿Ya tienes cuenta? 
                <a href="{{ route('login') }}">Inicia sesión aquí</a>
            </div>
        </form>
    </div>

    <script>
        // Password strength indicator
        const passwordInput = document.getElementById('password');
        const confirmInput = document.getElementById('password-confirm');
        
        function validatePassword() {
            const password = passwordInput.value;
            const requirements = document.querySelectorAll('.password-requirements li');
            
            // Check length
            if (password.length >= 8) {
                requirements[0].style.color = '#10b981';
            } else {
                requirements[0].style.color = '#ef4444';
            }
            
            // Check uppercase
            if (/[A-Z]/.test(password)) {
                requirements[1].style.color = '#10b981';
            } else {
                requirements[1].style.color = '#ef4444';
            }
            
            // Check lowercase
            if (/[a-z]/.test(password)) {
                requirements[2].style.color = '#10b981';
            } else {
                requirements[2].style.color = '#ef4444';
            }
            
            // Check number
            if (/\d/.test(password)) {
                requirements[3].style.color = '#10b981';
            } else {
                requirements[3].style.color = '#ef4444';
            }
        }
        
        function validateConfirmPassword() {
            const password = passwordInput.value;
            const confirm = confirmInput.value;
            
            if (confirm && password !== confirm) {
                confirmInput.style.borderColor = '#ef4444';
            } else if (confirm) {
                confirmInput.style.borderColor = '#10b981';
            } else {
                confirmInput.style.borderColor = '#e2e8f0';
            }
        }
        
        passwordInput.addEventListener('input', validatePassword);
        confirmInput.addEventListener('input', validateConfirmPassword);
    </script>
</body>
</html>