import './bootstrap';
import React from 'react';
import { createRoot } from 'react-dom/client';

// Componente simple sin dependencias externas que puedan usar eval
const SimpleApp = () => {
    const [activeSection, setActiveSection] = React.useState('dashboard');
    const [sidebarCollapsed, setSidebarCollapsed] = React.useState(false);

    const menuItems = [
        { id: 'dashboard', label: 'Dashboard', emoji: '📊' },
        { id: 'sessions', label: 'Mis Sesiones', emoji: '📝' },
        { id: 'listeners', label: 'Mis Escuchas', emoji: '👥' },
        { id: 'catalogs', label: 'Catálogos', emoji: '📚' },
        { id: 'calendar', label: 'Calendario', emoji: '📅' },
        { id: 'settings', label: 'Configuración', emoji: '⚙️' }
    ];

    const getSectionContent = () => {
        switch (activeSection) {
            case 'dashboard':
                return {
                    title: 'Dashboard',
                    description: 'Bienvenido a Emociona - Diario de Sesiones',
                    stats: [
                        { label: 'Sesiones este mes', value: '12', color: '#3b82f6' },
                        { label: 'Escuchas activas', value: '3', color: '#10b981' },
                        { label: 'Progreso general', value: '85%', color: '#8b5cf6' }
                    ]
                };
            case 'sessions':
                return {
                    title: 'Mis Sesiones',
                    description: 'Gestiona tus sesiones de escucha',
                    stats: [
                        { label: 'Total sesiones', value: '47', color: '#3b82f6' },
                        { label: 'Esta semana', value: '3', color: '#10b981' }
                    ]
                };
            default:
                return {
                    title: activeSection.charAt(0).toUpperCase() + activeSection.slice(1),
                    description: `Sección de ${activeSection}`,
                    stats: []
                };
        }
    };

    const content = getSectionContent();

    return (
        <div style={{ 
            minHeight: '100vh', 
            display: 'flex', 
            fontFamily: 'Inter, system-ui, sans-serif',
            backgroundColor: '#f8fafc'
        }}>
            {/* Sidebar */}
            <div style={{
                width: sidebarCollapsed ? '80px' : '280px',
                backgroundColor: '#1f2937',
                color: 'white',
                transition: 'width 0.3s ease',
                display: 'flex',
                flexDirection: 'column'
            }}>
                {/* Header */}
                <div style={{ 
                    padding: '1rem', 
                    borderBottom: '1px solid #374151',
                    display: 'flex',
                    alignItems: 'center',
                    gap: '0.75rem'
                }}>
                    <div style={{
                        width: '32px',
                        height: '32px',
                        backgroundColor: '#3b82f6',
                        borderRadius: '8px',
                        display: 'flex',
                        alignItems: 'center',
                        justifyContent: 'center',
                        fontSize: '16px'
                    }}>
                        📝
                    </div>
                    {!sidebarCollapsed && (
                        <div>
                            <h1 style={{ fontSize: '18px', fontWeight: '600', margin: 0 }}>Emociona</h1>
                            <p style={{ fontSize: '12px', color: '#9ca3af', margin: 0 }}>Diario de Sesiones</p>
                        </div>
                    )}
                </div>

                {/* Menu */}
                <nav style={{ flex: 1, padding: '1rem 0.5rem' }}>
                    {menuItems.map((item) => (
                        <button
                            key={item.id}
                            onClick={() => setActiveSection(item.id)}
                            style={{
                                width: '100%',
                                display: 'flex',
                                alignItems: 'center',
                                gap: '0.75rem',
                                padding: '0.75rem',
                                marginBottom: '0.25rem',
                                backgroundColor: activeSection === item.id ? '#3b82f6' : 'transparent',
                                color: 'white',
                                border: 'none',
                                borderRadius: '8px',
                                cursor: 'pointer',
                                fontSize: '14px',
                                transition: 'background-color 0.2s'
                            }}
                            onMouseEnter={(e) => {
                                if (activeSection !== item.id) {
                                    e.target.style.backgroundColor = '#374151';
                                }
                            }}
                            onMouseLeave={(e) => {
                                if (activeSection !== item.id) {
                                    e.target.style.backgroundColor = 'transparent';
                                }
                            }}
                        >
                            <span style={{ fontSize: '16px' }}>{item.emoji}</span>
                            {!sidebarCollapsed && <span>{item.label}</span>}
                        </button>
                    ))}
                </nav>

                {/* Toggle Button */}
                <div style={{ padding: '1rem', borderTop: '1px solid #374151' }}>
                    <button
                        onClick={() => setSidebarCollapsed(!sidebarCollapsed)}
                        style={{
                            width: '100%',
                            padding: '0.75rem',
                            backgroundColor: '#374151',
                            color: 'white',
                            border: 'none',
                            borderRadius: '8px',
                            cursor: 'pointer',
                            fontSize: '14px'
                        }}
                    >
                        {sidebarCollapsed ? '→' : '←'}
                    </button>
                </div>
            </div>

            {/* Main Content */}
            <div style={{ flex: 1, display: 'flex', flexDirection: 'column' }}>
                {/* Topbar */}
                <header style={{
                    backgroundColor: 'white',
                    borderBottom: '1px solid #e5e7eb',
                    padding: '1rem 1.5rem',
                    display: 'flex',
                    alignItems: 'center',
                    justifyContent: 'space-between'
                }}>
                    <h1 style={{ 
                        fontSize: '24px', 
                        fontWeight: '600', 
                        color: '#1f2937',
                        margin: 0 
                    }}>
                        {content.title}
                    </h1>
                    <div style={{ fontSize: '14px', color: '#6b7280' }}>
                        {new Date().toLocaleDateString('es-ES', {
                            weekday: 'long',
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        })}
                    </div>
                </header>

                {/* Content */}
                <main style={{ flex: 1, padding: '1.5rem' }}>
                    <div style={{ marginBottom: '2rem' }}>
                        <h2 style={{ 
                            fontSize: '28px', 
                            fontWeight: '700', 
                            color: '#1f2937',
                            marginBottom: '0.5rem'
                        }}>
                            {content.title}
                        </h2>
                        <p style={{ color: '#6b7280', fontSize: '16px' }}>
                            {content.description}
                        </p>
                    </div>

                    {/* Stats Cards */}
                    {content.stats.length > 0 && (
                        <div style={{
                            display: 'grid',
                            gridTemplateColumns: 'repeat(auto-fit, minmax(250px, 1fr))',
                            gap: '1.5rem',
                            marginBottom: '2rem'
                        }}>
                            {content.stats.map((stat, index) => (
                                <div
                                    key={index}
                                    style={{
                                        backgroundColor: 'white',
                                        padding: '1.5rem',
                                        borderRadius: '12px',
                                        boxShadow: '0 1px 3px rgba(0, 0, 0, 0.1)',
                                        border: '1px solid #e5e7eb'
                                    }}
                                >
                                    <div style={{
                                        display: 'flex',
                                        alignItems: 'center',
                                        justifyContent: 'space-between'
                                    }}>
                                        <div>
                                            <p style={{
                                                fontSize: '14px',
                                                color: '#6b7280',
                                                margin: '0 0 0.25rem 0'
                                            }}>
                                                {stat.label}
                                            </p>
                                            <p style={{
                                                fontSize: '24px',
                                                fontWeight: '700',
                                                color: '#1f2937',
                                                margin: 0
                                            }}>
                                                {stat.value}
                                            </p>
                                        </div>
                                        <div style={{
                                            width: '48px',
                                            height: '48px',
                                            backgroundColor: stat.color,
                                            borderRadius: '8px',
                                            display: 'flex',
                                            alignItems: 'center',
                                            justifyContent: 'center',
                                            fontSize: '20px'
                                        }}>
                                            📊
                                        </div>
                                    </div>
                                </div>
                            ))}
                        </div>
                    )}

                    {/* Main Content Area */}
                    <div style={{
                        backgroundColor: 'white',
                        padding: '2rem',
                        borderRadius: '12px',
                        boxShadow: '0 1px 3px rgba(0, 0, 0, 0.1)',
                        border: '1px solid #e5e7eb',
                        textAlign: 'center'
                    }}>
                        <div style={{
                            width: '64px',
                            height: '64px',
                            backgroundColor: '#f3f4f6',
                            borderRadius: '50%',
                            display: 'flex',
                            alignItems: 'center',
                            justifyContent: 'center',
                            margin: '0 auto 1rem auto',
                            fontSize: '24px'
                        }}>
                            📄
                        </div>
                        <h3 style={{
                            fontSize: '18px',
                            fontWeight: '600',
                            color: '#1f2937',
                            marginBottom: '0.5rem'
                        }}>
                            Contenido en desarrollo
                        </h3>
                        <p style={{
                            color: '#6b7280',
                            maxWidth: '400px',
                            margin: '0 auto'
                        }}>
                            Esta sección estará disponible próximamente. Aquí encontrarás todas las funcionalidades específicas para {content.title.toLowerCase()}.
                        </p>
                    </div>
                </main>
            </div>
        </div>
    );
};

// Montar la aplicación
console.log('🚀 Iniciando aplicación React simple...');

const container = document.getElementById('app');
if (container) {
    console.log('✅ Contenedor #app encontrado');
    try {
        const root = createRoot(container);
        root.render(<SimpleApp />);
        console.log('✅ React montado exitosamente');
        
        // Ocultar el mensaje de carga
        const loadingDiv = container.querySelector('.loading');
        if (loadingDiv) {
            loadingDiv.style.display = 'none';
        }
    } catch (error) {
        console.error('❌ Error al montar React:', error);
    }
} else {
    console.error('❌ No se encontró el contenedor #app');
}