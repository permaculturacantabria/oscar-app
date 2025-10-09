<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Diario de Sesiones') }}</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
        
        <!-- Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        
        <!-- Styles -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                * { margin: 0; padding: 0; box-sizing: border-box; }
                body { font-family: 'Inter', sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
                .hero { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; min-height: 100vh; display: flex; align-items: center; }
                .hero-content { text-align: center; }
                .hero h1 { font-size: 3.5rem; font-weight: 700; margin-bottom: 1rem; }
                .hero p { font-size: 1.25rem; margin-bottom: 2rem; opacity: 0.9; }
                .btn { display: inline-block; padding: 12px 30px; border-radius: 8px; text-decoration: none; font-weight: 600; transition: all 0.3s; }
                .btn-primary { background: #fff; color: #667eea; }
                .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 10px 25px rgba(0,0,0,0.2); }
                .features { padding: 80px 0; background: #f8fafc; }
                .features-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; margin-top: 50px; }
                .feature-card { background: white; padding: 30px; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); text-align: center; transition: transform 0.3s; }
                .feature-card:hover { transform: translateY(-5px); }
                .feature-icon { font-size: 3rem; color: #667eea; margin-bottom: 20px; }
                .stats { padding: 80px 0; background: #1a202c; color: white; }
                .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 30px; text-align: center; }
                .stat-number { font-size: 3rem; font-weight: 700; color: #667eea; }
                .navbar { position: fixed; top: 0; width: 100%; background: rgba(255,255,255,0.95); backdrop-filter: blur(10px); z-index: 1000; padding: 15px 0; }
                .nav-content { display: flex; justify-content: space-between; align-items: center; }
                .logo { font-size: 1.5rem; font-weight: 700; color: #667eea; }
                .nav-links { display: flex; gap: 30px; }
                .nav-links a { text-decoration: none; color: #333; font-weight: 500; transition: color 0.3s; }
                .nav-links a:hover { color: #667eea; }
                @media (max-width: 768px) {
                    .hero h1 { font-size: 2.5rem; }
                    .features-grid { grid-template-columns: 1fr; }
                    .nav-links { display: none; }
                }
            </style>
        @endif
    </head>
    <body>
        <!-- Navigation -->
        <nav class="navbar">
            <div class="container">
                <div class="nav-content">
                    <div class="logo">
                        <i class="fas fa-brain"></i> Diario de Sesiones
                    </div>
                    <div class="nav-links">
                        <a href="#inicio">Inicio</a>
                        <a href="#funciones">Funciones</a>
                        <a href="#estadisticas">Estadísticas</a>
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn btn-primary">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}">Iniciar Sesión</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-primary">Registrarse</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section id="inicio" class="hero">
            <div class="container">
                <div class="hero-content">
                    <h1>Diario de Sesiones Terapéuticas</h1>
                    <p>Gestiona y organiza tus sesiones de escucha con una plataforma moderna y eficiente</p>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-primary">
                                <i class="fas fa-tachometer-alt"></i> Ir al Dashboard
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="btn btn-primary">
                                <i class="fas fa-rocket"></i> Comenzar Ahora
                            </a>
                        @endif
                    @endif
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="funciones" class="features">
            <div class="container">
                <div style="text-align: center; margin-bottom: 50px;">
                    <h2 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 20px;">Funcionalidades Principales</h2>
                    <p style="font-size: 1.2rem; color: #666;">Todo lo que necesitas para gestionar tus sesiones terapéuticas</p>
                </div>
                
                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 style="font-size: 1.5rem; margin-bottom: 15px;">Gestión de Usuarios</h3>
                        <p>Sistema completo de autenticación y gestión de perfiles para terapeutas y pacientes.</p>
                    </div>
                    
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-ear-listen"></i>
                        </div>
                        <h3 style="font-size: 1.5rem; margin-bottom: 15px;">Registro de Escuchas</h3>
                        <p>Documenta y organiza todas las sesiones de escucha con propietarios y realizadores.</p>
                    </div>
                    
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                        <h3 style="font-size: 1.5rem; margin-bottom: 15px;">Sesiones Detalladas</h3>
                        <p>Registra sesiones con múltiples catálogos: temas, memorias, mensajes y más.</p>
                    </div>
                    
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-route"></i>
                        </div>
                        <h3 style="font-size: 1.5rem; margin-bottom: 15px;">Proceso de 10 Pasos</h3>
                        <p>Metodología estructurada con procesos de 10 pasos asociados a cada escucha.</p>
                    </div>
                    
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-tags"></i>
                        </div>
                        <h3 style="font-size: 1.5rem; margin-bottom: 15px;">Catálogos Organizados</h3>
                        <p>Sistema de clasificación con temas, memorias tempranas, contradicciones y más.</p>
                    </div>
                    
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3 style="font-size: 1.5rem; margin-bottom: 15px;">Dashboard Analítico</h3>
                        <p>Visualiza estadísticas y resúmenes de todas tus sesiones y procesos.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section id="estadisticas" class="stats">
            <div class="container">
                <div style="text-align: center; margin-bottom: 50px;">
                    <h2 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 20px;">API Completa</h2>
                    <p style="font-size: 1.2rem; opacity: 0.9;">Endpoints disponibles para integración</p>
                </div>
                
                <div class="stats-grid">
                    <div>
                        <div class="stat-number">15+</div>
                        <p>Endpoints API</p>
                    </div>
                    <div>
                        <div class="stat-number">12</div>
                        <p>Modelos de Datos</p>
                    </div>
                    <div>
                        <div class="stat-number">100%</div>
                        <p>Autenticado</p>
                    </div>
                    <div>
                        <div class="stat-number">REST</div>
                        <p>API Standard</p>
                    </div>
                </div>
                
                <div style="margin-top: 50px; text-align: center;">
                    <h3 style="font-size: 1.8rem; margin-bottom: 30px;">Endpoints Principales</h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; text-align: left;">
                        <div style="background: rgba(255,255,255,0.1); padding: 20px; border-radius: 8px;">
                            <code style="color: #4ade80;">POST /api/v1/register</code>
                            <p style="margin-top: 5px; opacity: 0.8;">Registro de usuarios</p>
                        </div>
                        <div style="background: rgba(255,255,255,0.1); padding: 20px; border-radius: 8px;">
                            <code style="color: #60a5fa;">GET /api/v1/dashboard</code>
                            <p style="margin-top: 5px; opacity: 0.8;">Resumen del usuario</p>
                        </div>
                        <div style="background: rgba(255,255,255,0.1); padding: 20px; border-radius: 8px;">
                            <code style="color: #f59e0b;">GET /api/v1/escuchas</code>
                            <p style="margin-top: 5px; opacity: 0.8;">Lista de escuchas</p>
                        </div>
                        <div style="background: rgba(255,255,255,0.1); padding: 20px; border-radius: 8px;">
                            <code style="color: #ec4899;">GET /api/v1/sesiones</code>
                            <p style="margin-top: 5px; opacity: 0.8;">Lista de sesiones</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer style="background: #f8fafc; padding: 40px 0; text-align: center; border-top: 1px solid #e2e8f0;">
            <div class="container">
                <div style="margin-bottom: 20px;">
                    <div class="logo" style="margin-bottom: 10px;">
                        <i class="fas fa-brain"></i> Diario de Sesiones
                    </div>
                    <p style="color: #666;">Plataforma profesional para la gestión de sesiones terapéuticas</p>
                </div>
                <div style="display: flex; justify-content: center; gap: 30px; margin-bottom: 20px;">
                    <a href="#" style="color: #667eea; font-size: 1.5rem;"><i class="fab fa-twitter"></i></a>
                    <a href="#" style="color: #667eea; font-size: 1.5rem;"><i class="fab fa-linkedin"></i></a>
                    <a href="#" style="color: #667eea; font-size: 1.5rem;"><i class="fab fa-github"></i></a>
                </div>
                <p style="color: #999; font-size: 0.9rem;">&copy; {{ date('Y') }} Diario de Sesiones. Todos los derechos reservados.</p>
            </div>
        </footer>

        <!-- Smooth Scrolling Script -->
        <script>
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Navbar scroll effect
            window.addEventListener('scroll', function() {
                const navbar = document.querySelector('.navbar');
                if (window.scrollY > 50) {
                    navbar.style.background = 'rgba(255,255,255,0.98)';
                    navbar.style.boxShadow = '0 2px 20px rgba(0,0,0,0.1)';
                } else {
                    navbar.style.background = 'rgba(255,255,255,0.95)';
                    navbar.style.boxShadow = 'none';
                }
            });
        </script>
    </body>
</html>
