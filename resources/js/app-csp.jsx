import './bootstrap';
import React from 'react';
import { createRoot } from 'react-dom/client';

// CSP-Compliant React Application
// No Framer Motion, no Lucide React, no eval() dependencies

// Custom Icons Component (replaces Lucide React)
const Icons = {
    Dashboard: () => (
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
            <rect x="3" y="3" width="7" height="7"/>
            <rect x="14" y="3" width="7" height="7"/>
            <rect x="14" y="14" width="7" height="7"/>
            <rect x="3" y="14" width="7" height="7"/>
        </svg>
    ),
    BookOpen: () => (
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
            <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
            <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
        </svg>
    ),
    Users: () => (
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
            <circle cx="9" cy="7" r="4"/>
            <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
        </svg>
    ),
    FolderTree: () => (
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
            <path d="M20 20a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.9a2 2 0 0 1-1.69-.9L9.6 3.9A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2Z"/>
        </svg>
    ),
    Calendar: () => (
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
            <line x1="16" y1="2" x2="16" y2="6"/>
            <line x1="8" y1="2" x2="8" y2="6"/>
            <line x1="3" y1="10" x2="21" y2="10"/>
        </svg>
    ),
    Settings: () => (
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
            <circle cx="12" cy="12" r="3"/>
            <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1 1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/>
        </svg>
    ),
    Plus: () => (
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
            <line x1="12" y1="5" x2="12" y2="19"/>
            <line x1="5" y1="12" x2="19" y2="12"/>
        </svg>
    ),
    Moon: () => (
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
        </svg>
    ),
    Sun: () => (
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
            <circle cx="12" cy="12" r="5"/>
            <line x1="12" y1="1" x2="12" y2="3"/>
            <line x1="12" y1="21" x2="12" y2="23"/>
            <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/>
            <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/>
            <line x1="1" y1="12" x2="3" y2="12"/>
            <line x1="21" y1="12" x2="23" y2="12"/>
            <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/>
            <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
        </svg>
    ),
    LogOut: () => (
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
            <polyline points="16,17 21,12 16,7"/>
            <line x1="21" y1="12" x2="9" y2="12"/>
        </svg>
    ),
    Search: () => (
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
            <circle cx="11" cy="11" r="8"/>
            <path d="M21 21l-4.35-4.35"/>
        </svg>
    ),
    ChevronDown: () => (
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
            <polyline points="6,9 12,15 18,9"/>
        </svg>
    ),
    ChevronRight: () => (
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
            <polyline points="9,18 15,12 9,6"/>
        </svg>
    ),
    FileText: () => (
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
            <polyline points="14,2 14,8 20,8"/>
            <line x1="16" y1="13" x2="8" y2="13"/>
            <line x1="16" y1="17" x2="8" y2="17"/>
            <polyline points="10,9 9,9 8,9"/>
        </svg>
    )
};

// Custom Animation Hook (replaces Framer Motion)
const useAnimation = (initialState = false) => {
    const [isVisible, setIsVisible] = React.useState(initialState);
    const [animationClass, setAnimationClass] = React.useState('');

    const trigger = (animation = 'animate-fade-in') => {
        setAnimationClass(animation);
        setIsVisible(true);
    };

    const hide = (animation = 'animate-fade-out') => {
        setAnimationClass(animation);
        setTimeout(() => setIsVisible(false), 300);
    };

    return { isVisible, animationClass, trigger, hide };
};

// Sidebar Item Component
const SidebarItem = ({ item, collapsed, active, onClick, hasSubmenu, submenuExpanded }) => {
    const IconComponent = Icons[item.icon] || Icons.FileText;
    
    return (
        <button
            onClick={onClick}
            className={`
                w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium
                transition-all duration-200 sidebar-item
                ${active 
                    ? 'bg-blue-600 text-white sidebar-item active' 
                    : 'text-gray-300 hover:bg-gray-800 hover:text-white'
                }
                ${collapsed ? 'justify-center' : ''}
            `}
        >
            <IconComponent />
            {!collapsed && (
                <>
                    <span className="flex-1 text-left">{item.label}</span>
                    {hasSubmenu && (
                        <div className="transition-transform duration-200" style={{
                            transform: submenuExpanded ? 'rotate(90deg)' : 'rotate(0deg)'
                        }}>
                            <Icons.ChevronRight />
                        </div>
                    )}
                </>
            )}
        </button>
    );
};

// Main Sidebar Component
const Sidebar = ({ collapsed, activeSection, setActiveSection, darkMode, toggleDarkMode }) => {
    const [catalogsExpanded, setCatalogsExpanded] = React.useState(false);

    const menuItems = [
        { id: 'dashboard', label: 'Inicio', icon: 'Dashboard' },
        { id: 'sessions', label: 'Mis sesiones', icon: 'BookOpen' },
        { id: 'listeners', label: 'Mis escuchas', icon: 'Users' },
        {
            id: 'catalogs',
            label: 'Catálogos',
            icon: 'FolderTree',
            hasSubmenu: true,
            submenu: [
                { id: 'themes', label: 'Temas' },
                { id: 'early-memories', label: 'Memorias tempranas' },
                { id: 'distressing-messages', label: 'Mensajes angustiosos' },
                { id: 'directions', label: 'Direcciones' },
                { id: 'contradictions', label: 'Contradicciones' },
                { id: 'listener-contradictions', label: 'Contradicciones del escucha' },
                { id: 'reality-bits', label: 'Pedacitos de realidad' },
                { id: 'restimulations', label: 'Restimulaciones' },
                { id: 'social-commitments', label: 'Compromisos sociales' },
                { id: 'next-steps', label: 'Próximos pasos' },
                { id: 'physical-session', label: 'Sesión física' },
                { id: 'frozen-needs', label: 'Necesidades congeladas' }
            ]
        },
        { id: 'calendar', label: 'Calendario', icon: 'Calendar' },
        { id: 'settings', label: 'Ajustes', icon: 'Settings' }
    ];

    const handleCatalogClick = () => {
        if (!collapsed) {
            setCatalogsExpanded(!catalogsExpanded);
        } else {
            setActiveSection('catalogs');
        }
    };

    return (
        <div className={`
            bg-gray-900 text-white flex flex-col border-r border-gray-800
            transition-width duration-300 ease-in-out
            ${collapsed ? 'sidebar-collapsed' : 'sidebar-expanded'}
        `}>
            {/* Logo/Header */}
            <div className="p-4 border-b border-gray-800">
                <div className="flex items-center space-x-3">
                    <div className="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center flex-shrink-0">
                        <Icons.FileText />
                    </div>
                    {!collapsed && (
                        <div className="animate-fade-in">
                            <h1 className="text-lg font-semibold text-white">Emociona</h1>
                            <p className="text-xs text-gray-400">Diario de Sesiones</p>
                        </div>
                    )}
                </div>
            </div>

            {/* Search Bar */}
            {!collapsed && (
                <div className="p-4 animate-slide-in-down">
                    <div className="relative">
                        <div className="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                            <Icons.Search />
                        </div>
                        <input
                            type="text"
                            placeholder="Buscar..."
                            className="w-full bg-gray-800 text-white placeholder-gray-400 rounded-lg pl-10 pr-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all"
                        />
                    </div>
                </div>
            )}

            {/* Navigation Menu */}
            <nav className="flex-1 px-4 py-2 space-y-1">
                {menuItems.map((item, index) => (
                    <div key={item.id} className={`stagger-item`} style={{ animationDelay: `${index * 0.1}s` }}>
                        <SidebarItem
                            item={item}
                            collapsed={collapsed}
                            active={activeSection === item.id}
                            onClick={item.hasSubmenu ? handleCatalogClick : () => setActiveSection(item.id)}
                            hasSubmenu={item.hasSubmenu}
                            submenuExpanded={catalogsExpanded}
                        />
                        
                        {/* Submenu for Catalogs */}
                        {item.hasSubmenu && catalogsExpanded && !collapsed && (
                            <div className="ml-4 mt-1 space-y-1 animate-slide-in-down">
                                {item.submenu.map((subItem) => (
                                    <button
                                        key={subItem.id}
                                        onClick={() => setActiveSection(subItem.id)}
                                        className={`w-full text-left px-3 py-2 rounded-lg text-sm transition-colors ${
                                            activeSection === subItem.id
                                                ? 'bg-blue-600 text-white'
                                                : 'text-gray-300 hover:bg-gray-800 hover:text-white'
                                        }`}
                                    >
                                        {subItem.label}
                                    </button>
                                ))}
                            </div>
                        )}
                    </div>
                ))}
            </nav>

            {/* Bottom Actions */}
            <div className="p-4 border-t border-gray-800 space-y-2">
                {/* New Session Button */}
                <button className="w-full flex items-center justify-center space-x-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg py-2 px-3 transition-colors button-press hover-lift">
                    <Icons.Plus />
                    {!collapsed && (
                        <span className="text-sm font-medium animate-fade-in">
                            Nueva sesión
                        </span>
                    )}
                </button>

                {/* Dark Mode Toggle */}
                <button
                    onClick={toggleDarkMode}
                    className="w-full flex items-center justify-center space-x-2 text-gray-300 hover:text-white hover:bg-gray-800 rounded-lg py-2 px-3 transition-colors button-press"
                >
                    {darkMode ? <Icons.Sun /> : <Icons.Moon />}
                    {!collapsed && (
                        <span className="text-sm animate-fade-in">
                            {darkMode ? 'Modo claro' : 'Modo oscuro'}
                        </span>
                    )}
                </button>

                {/* Logout Button */}
                <button className="w-full flex items-center justify-center space-x-2 text-gray-300 hover:text-white hover:bg-gray-800 rounded-lg py-2 px-3 transition-colors button-press">
                    <Icons.LogOut />
                    {!collapsed && (
                        <span className="text-sm animate-fade-in">
                            Salir
                        </span>
                    )}
                </button>
            </div>
        </div>
    );
};

// Topbar Component
const Topbar = ({ activeSection, toggleSidebar, sidebarCollapsed }) => {
    const getSectionTitle = () => {
        const titles = {
            'dashboard': 'Dashboard',
            'sessions': 'Mis Sesiones',
            'listeners': 'Mis Escuchas',
            'catalogs': 'Catálogos',
            'calendar': 'Calendario',
            'settings': 'Configuración',
            'themes': 'Temas',
            'early-memories': 'Memorias Tempranas',
            'distressing-messages': 'Mensajes Angustiosos',
            'directions': 'Direcciones',
            'contradictions': 'Contradicciones',
            'listener-contradictions': 'Contradicciones del Escucha',
            'reality-bits': 'Pedacitos de Realidad',
            'restimulations': 'Restimulaciones',
            'social-commitments': 'Compromisos Sociales',
            'next-steps': 'Próximos Pasos',
            'physical-session': 'Sesión Física',
            'frozen-needs': 'Necesidades Congeladas'
        };
        return titles[activeSection] || 'Emociona';
    };

    return (
        <header className="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between animate-slide-in-down">
            <div className="flex items-center space-x-4">
                <button
                    onClick={toggleSidebar}
                    className="p-2 rounded-lg hover:bg-gray-100 transition-colors button-press"
                >
                    <div className="w-5 h-5 flex flex-col justify-center space-y-1">
                        <div className="w-full h-0.5 bg-gray-600 transition-all"></div>
                        <div className="w-full h-0.5 bg-gray-600 transition-all"></div>
                        <div className="w-full h-0.5 bg-gray-600 transition-all"></div>
                    </div>
                </button>
                <h1 className="text-2xl font-bold text-gray-900 animate-fade-in">
                    {getSectionTitle()}
                </h1>
            </div>
            <div className="text-sm text-gray-500 animate-fade-in">
                {new Date().toLocaleDateString('es-ES', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                })}
            </div>
        </header>
    );
};

// Content Component
const Content = ({ activeSection }) => {
    const getContent = () => {
        switch (activeSection) {
            case 'dashboard':
                return {
                    title: 'Dashboard',
                    description: 'Bienvenido a Emociona - Diario de Sesiones',
                    stats: [
                        { label: 'Sesiones este mes', value: '12', color: 'bg-blue-500' },
                        { label: 'Escuchas activas', value: '3', color: 'bg-green-500' },
                        { label: 'Progreso general', value: '85%', color: 'bg-purple-500' }
                    ]
                };
            case 'sessions':
                return {
                    title: 'Mis Sesiones',
                    description: 'Gestiona tus sesiones de escucha',
                    stats: [
                        { label: 'Total sesiones', value: '47', color: 'bg-blue-500' },
                        { label: 'Esta semana', value: '3', color: 'bg-green-500' }
                    ]
                };
            default:
                return {
                    title: activeSection.charAt(0).toUpperCase() + activeSection.slice(1).replace('-', ' '),
                    description: `Sección de ${activeSection.replace('-', ' ')}`,
                    stats: []
                };
        }
    };

    const content = getContent();

    return (
        <main className="flex-1 p-6 animate-fade-in">
            <div className="mb-8">
                <h2 className="text-3xl font-bold text-gray-900 mb-2 animate-slide-in-up">
                    {content.title}
                </h2>
                <p className="text-gray-600 text-lg animate-slide-in-up" style={{ animationDelay: '0.1s' }}>
                    {content.description}
                </p>
            </div>

            {/* Stats Cards */}
            {content.stats.length > 0 && (
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    {content.stats.map((stat, index) => (
                        <div
                            key={index}
                            className="bg-white p-6 rounded-xl shadow-sm border border-gray-200 card-hover stagger-item"
                            style={{ animationDelay: `${index * 0.1}s` }}
                        >
                            <div className="flex items-center justify-between">
                                <div>
                                    <p className="text-sm text-gray-600 mb-1">
                                        {stat.label}
                                    </p>
                                    <p className="text-2xl font-bold text-gray-900">
                                        {stat.value}
                                    </p>
                                </div>
                                <div className={`w-12 h-12 ${stat.color} rounded-lg flex items-center justify-center`}>
                                    <Icons.Dashboard />
                                </div>
                            </div>
                        </div>
                    ))}
                </div>
            )}

            {/* Main Content Area */}
            <div className="bg-white p-8 rounded-xl shadow-sm border border-gray-200 text-center animate-scale-in">
                <div className="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <Icons.FileText />
                </div>
                <h3 className="text-xl font-semibold text-gray-900 mb-2">
                    Contenido en desarrollo
                </h3>
                <p className="text-gray-600 max-w-md mx-auto">
                    Esta sección estará disponible próximamente. Aquí encontrarás todas las funcionalidades específicas para {content.title.toLowerCase()}.
                </p>
            </div>
        </main>
    );
};

// Main App Component
const CSPCompliantApp = () => {
    const [sidebarCollapsed, setSidebarCollapsed] = React.useState(false);
    const [activeSection, setActiveSection] = React.useState('dashboard');
    const [darkMode, setDarkMode] = React.useState(false);

    const toggleSidebar = () => {
        setSidebarCollapsed(!sidebarCollapsed);
    };

    const toggleDarkMode = () => {
        setDarkMode(!darkMode);
    };

    return (
        <div className={`min-h-screen flex ${darkMode ? 'dark' : ''} dark-mode-transition`}>
            <div className="bg-gray-50 text-gray-900 min-h-screen flex w-full">
                {/* Sidebar */}
                <Sidebar
                    collapsed={sidebarCollapsed}
                    activeSection={activeSection}
                    setActiveSection={setActiveSection}
                    darkMode={darkMode}
                    toggleDarkMode={toggleDarkMode}
                />

                {/* Main Content Area */}
                <div className="flex-1 flex flex-col">
                    {/* Topbar */}
                    <Topbar
                        activeSection={activeSection}
                        toggleSidebar={toggleSidebar}
                        sidebarCollapsed={sidebarCollapsed}
                    />

                    {/* Main Content */}
                    <Content activeSection={activeSection} />
                </div>
            </div>
        </div>
    );
};

// Mount the application
console.log('🚀 Iniciando aplicación React CSP-compliant...');

const container = document.getElementById('app');
if (container) {
    console.log('✅ Contenedor #app encontrado');
    try {
        const root = createRoot(container);
        root.render(<CSPCompliantApp />);
        console.log('✅ React CSP-compliant montado exitosamente');
        
        // Hide loading message
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