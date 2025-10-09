<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard - {{ config('app.name', 'Diario de Sesiones') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f8fafc; color: #333; }
        
        /* Sidebar */
        .sidebar { position: fixed; left: 0; top: 0; width: 280px; height: 100vh; background: #1a202c; color: white; z-index: 1000; transition: transform 0.3s; }
        .sidebar-header { padding: 20px; border-bottom: 1px solid #2d3748; }
        .sidebar-logo { font-size: 1.5rem; font-weight: 700; color: #667eea; }
        .sidebar-nav { padding: 20px 0; }
        .nav-item { display: block; padding: 12px 20px; color: #cbd5e0; text-decoration: none; transition: all 0.3s; }
        .nav-item:hover, .nav-item.active { background: #2d3748; color: white; }
        .nav-item i { width: 20px; margin-right: 10px; }
        
        /* Main Content */
        .main-content { margin-left: 280px; min-height: 100vh; }
        .topbar { background: white; padding: 15px 30px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); display: flex; justify-content: space-between; align-items: center; }
        .topbar-title { font-size: 1.5rem; font-weight: 600; }
        .user-menu { display: flex; align-items: center; gap: 15px; }
        .user-avatar { width: 40px; height: 40px; border-radius: 50%; background: #667eea; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; }
        
        /* Dashboard Content */
        .dashboard-content { padding: 30px; }
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px; }
        .stat-card { background: white; padding: 25px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .stat-header { display: flex; justify-content: between; align-items: center; margin-bottom: 15px; }
        .stat-icon { width: 50px; height: 50px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: white; }
        .stat-number { font-size: 2rem; font-weight: 700; margin-bottom: 5px; }
        .stat-label { color: #666; font-size: 0.9rem; }
        
        /* Charts and Tables */
        .chart-container { background: white; padding: 25px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 30px; }
        .chart-title { font-size: 1.3rem; font-weight: 600; margin-bottom: 20px; }
        
        .table-container { background: white; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); overflow: hidden; }
        .table { width: 100%; }
        .table th { background: #f8fafc; padding: 15px; text-align: left; font-weight: 600; color: #4a5568; }
        .table td { padding: 15px; border-top: 1px solid #e2e8f0; }
        .table tr:hover { background: #f8fafc; }
        
        /* Buttons */
        .btn { display: inline-block; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 500; transition: all 0.3s; border: none; cursor: pointer; }
        .btn-primary { background: #667eea; color: white; }
        .btn-primary:hover { background: #5a67d8; transform: translateY(-1px); }
        .btn-success { background: #48bb78; color: white; }
        .btn-warning { background: #ed8936; color: white; }
        .btn-danger { background: #f56565; color: white; }
        .btn-sm { padding: 6px 12px; font-size: 0.875rem; }
        
        /* Status badges */
        .badge { padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; }
        .badge-success { background: #c6f6d5; color: #22543d; }
        .badge-warning { background: #faf089; color: #744210; }
        .badge-danger { background: #fed7d7; color: #742a2a; }
        .badge-info { background: #bee3f8; color: #2a4365; }
        
        /* Responsive */
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main-content { margin-left: 0; }
            .stats-grid { grid-template-columns: 1fr; }
            .dashboard-content { padding: 20px; }
        }
        
        /* Quick Actions */
        .quick-actions { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-bottom: 30px; }
        .quick-action { background: white; padding: 20px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); text-align: center; text-decoration: none; color: #333; transition: transform 0.3s; }
        .quick-action:hover { transform: translateY(-2px); }
        .quick-action i { font-size: 2rem; color: #667eea; margin-bottom: 10px; }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <i class="fas fa-brain"></i> Diario de Sesiones
            </div>
        </div>
        <nav class="sidebar-nav">
            <a href="#" class="nav-item active">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-ear-listen"></i> Escuchas
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-clipboard-list"></i> Sesiones
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-route"></i> Procesos
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-tags"></i> Catálogos
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-chart-bar"></i> Reportes
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-cog"></i> Configuración
            </a>
            <a href="#" class="nav-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Bar -->
        <div class="topbar">
            <div class="topbar-left">
                <button class="btn" id="sidebar-toggle" style="background: none; color: #666;">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="topbar-title">Dashboard</h1>
            </div>
            <div class="user-menu">
                <span>Bienvenido, {{ Auth::user()->name ?? 'Usuario' }}</span>
                <div class="user-avatar">
                    {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                </div>
            </div>
        </div>

        <!-- Dashboard Content -->
        <div class="dashboard-content">
            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-number">24</div>
                            <div class="stat-label">Total Escuchas</div>
                        </div>
                        <div class="stat-icon" style="background: #667eea;">
                            <i class="fas fa-ear-listen"></i>
                        </div>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-number">156</div>
                            <div class="stat-label">Sesiones Realizadas</div>
                        </div>
                        <div class="stat-icon" style="background: #48bb78;">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-number">12</div>
                            <div class="stat-label">Procesos Activos</div>
                        </div>
                        <div class="stat-icon" style="background: #ed8936;">
                            <i class="fas fa-route"></i>
                        </div>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-number">8</div>
                            <div class="stat-label">Sesiones Pendientes</div>
                        </div>
                        <div class="stat-icon" style="background: #f56565;">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="quick-actions">
                <a href="#" class="quick-action">
                    <i class="fas fa-plus"></i>
                    <h3>Nueva Escucha</h3>
                    <p>Registrar nueva escucha</p>
                </a>
                <a href="#" class="quick-action">
                    <i class="fas fa-calendar-plus"></i>
                    <h3>Nueva Sesión</h3>
                    <p>Programar sesión</p>
                </a>
                <a href="#" class="quick-action">
                    <i class="fas fa-route"></i>
                    <h3>Nuevo Proceso</h3>
                    <p>Iniciar proceso de 10 pasos</p>
                </a>
                <a href="#" class="quick-action">
                    <i class="fas fa-chart-line"></i>
                    <h3>Ver Reportes</h3>
                    <p>Análisis y estadísticas</p>
                </a>
            </div>

            <!-- Recent Sessions -->
            <div class="chart-container">
                <h2 class="chart-title">Sesiones Recientes</h2>
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Escucha</th>
                                <th>Tipo</th>
                                <th>Estado</th>
                                <th>Duración</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ date('d/m/Y') }}</td>
                                <td>María González</td>
                                <td>Proceso 10 pasos</td>
                                <td><span class="badge badge-success">Realizada</span></td>
                                <td>90 min</td>
                                <td>
                                    <button class="btn btn-primary btn-sm">Ver</button>
                                    <button class="btn btn-warning btn-sm">Editar</button>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ date('d/m/Y', strtotime('-1 day')) }}</td>
                                <td>Juan Pérez</td>
                                <td>Libre</td>
                                <td><span class="badge badge-warning">Pendiente</span></td>
                                <td>60 min</td>
                                <td>
                                    <button class="btn btn-primary btn-sm">Ver</button>
                                    <button class="btn btn-warning btn-sm">Editar</button>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ date('d/m/Y', strtotime('-2 days')) }}</td>
                                <td>Ana Martínez</td>
                                <td>Proceso 10 pasos</td>
                                <td><span class="badge badge-success">Realizada</span></td>
                                <td>75 min</td>
                                <td>
                                    <button class="btn btn-primary btn-sm">Ver</button>
                                    <button class="btn btn-warning btn-sm">Editar</button>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ date('d/m/Y', strtotime('-3 days')) }}</td>
                                <td>Carlos López</td>
                                <td>Libre</td>
                                <td><span class="badge badge-info">En progreso</span></td>
                                <td>45 min</td>
                                <td>
                                    <button class="btn btn-primary btn-sm">Ver</button>
                                    <button class="btn btn-warning btn-sm">Editar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Progress Chart -->
            <div class="chart-container">
                <h2 class="chart-title">Progreso Mensual</h2>
                <div style="height: 300px; display: flex; align-items: center; justify-content: center; background: #f8fafc; border-radius: 8px;">
                    <div style="text-align: center; color: #666;">
                        <i class="fas fa-chart-bar" style="font-size: 3rem; margin-bottom: 15px;"></i>
                        <p>Gráfico de progreso mensual</p>
                        <p style="font-size: 0.9rem;">Aquí se mostraría un gráfico con las estadísticas mensuales</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <script>
        // Sidebar toggle
        document.getElementById('sidebar-toggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('open');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(e) {
            const sidebar = document.getElementById('sidebar');
            const toggle = document.getElementById('sidebar-toggle');
            
            if (window.innerWidth <= 768 && !sidebar.contains(e.target) && !toggle.contains(e.target)) {
                sidebar.classList.remove('open');
            }
        });

        // Smooth animations for cards
        document.querySelectorAll('.stat-card, .quick-action').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
                this.style.boxShadow = '0 4px 20px rgba(0,0,0,0.15)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = '0 2px 10px rgba(0,0,0,0.1)';
            });
        });
    </script>
</body>
</html>