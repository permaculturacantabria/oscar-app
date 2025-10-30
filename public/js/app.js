// Aplicación JavaScript Estática - 100% libre de eval()
// Sin build tools, sin Vite, sin nada que pueda generar eval()

console.log('🚀 Iniciando aplicación JavaScript estática...');

// Estado global de la aplicación
const AppState = {
    sidebarCollapsed: false,
    activeSection: 'dashboard',
    darkMode: false
};

// Iconos SVG como strings
const Icons = {
    dashboard: '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>',
    bookOpen: '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>',
    users: '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
    folderTree: '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 20a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.9a2 2 0 0 1-1.69-.9L9.6 3.9A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2Z"/></svg>',
    calendar: '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>',
    settings: '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1 1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>',
    plus: '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>',
    moon: '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>',
    sun: '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>',
    logOut: '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16,17 21,12 16,7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>',
    search: '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>',
    chevronRight: '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9,18 15,12 9,6"/></svg>',
    fileText: '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14,2 14,8 20,8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10,9 9,9 8,9"/></svg>'
};

// Configuración de menú
const menuItems = [
    { id: 'dashboard', label: 'Inicio', icon: 'dashboard' },
    { id: 'sessions', label: 'Mis sesiones', icon: 'bookOpen' },
    { id: 'listeners', label: 'Mis escuchas', icon: 'users' },
    {
        id: 'catalogs',
        label: 'Catálogos',
        icon: 'folderTree',
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
    { id: 'calendar', label: 'Calendario', icon: 'calendar' },
    { id: 'settings', label: 'Ajustes', icon: 'settings' }
];

// Utilidades
function getSectionContent(section) {
    const contents = {
        'dashboard': {
            title: 'Dashboard',
            description: 'Bienvenido a Emociona - Diario de Sesiones',
            stats: [
                { label: 'Sesiones este mes', value: '12', color: '#3b82f6' },
                { label: 'Escuchas activas', value: '3', color: '#10b981' },
                { label: 'Progreso general', value: '85%', color: '#8b5cf6' }
            ]
        },
        'sessions': {
            title: 'Mis Sesiones',
            description: 'Gestiona tus sesiones de escucha',
            stats: [
                { label: 'Total sesiones', value: '47', color: '#3b82f6' },
                { label: 'Esta semana', value: '3', color: '#10b981' }
            ]
        }
    };
    
    return contents[section] || {
        title: section.charAt(0).toUpperCase() + section.slice(1).replace('-', ' '),
        description: 'Sección de ' + section.replace('-', ' '),
        stats: []
    };
}

// Funciones de renderizado
function renderApp() {
    const app = document.getElementById('app');
    if (!app) return;
    
    // Ocultar mensaje de carga
    const loadingDiv = app.querySelector('.loading');
    if (loadingDiv) {
        loadingDiv.style.display = 'none';
    }
    
    app.innerHTML = '<div class="min-h-screen flex bg-gray-50 text-gray-900"><div id="sidebar"></div><div class="flex-1 flex flex-col"><div id="topbar"></div><div id="content"></div></div></div>';
    
    renderSidebar();
    renderTopbar();
    renderContent();
}

function renderSidebar() {
    const sidebar = document.getElementById('sidebar');
    if (!sidebar) return;
    
    const sidebarClass = AppState.sidebarCollapsed ? 'w-20' : 'w-70';
    
    sidebar.innerHTML = '<div class="bg-gray-900 text-white flex flex-col border-r border-gray-800 transition-all duration-300 ' + sidebarClass + '"><div class="p-4 border-b border-gray-800"><div class="flex items-center space-x-3"><div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center flex-shrink-0">' + Icons.fileText + '</div>' + (!AppState.sidebarCollapsed ? '<div><h1 class="text-lg font-semibold text-white">Emociona</h1><p class="text-xs text-gray-400">Diario de Sesiones</p></div>' : '') + '</div></div>' + (!AppState.sidebarCollapsed ? '<div class="p-4"><div class="relative"><div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">' + Icons.search + '</div><input type="text" placeholder="Buscar..." class="w-full bg-gray-800 text-white placeholder-gray-400 rounded-lg pl-10 pr-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all"/></div></div>' : '') + '<nav class="flex-1 px-4 py-2 space-y-1" id="navigation-menu">' + renderMenuItems() + '</nav><div class="p-4 border-t border-gray-800 space-y-2"><button onclick="newSession()" class="w-full flex items-center justify-center space-x-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg py-2 px-3 transition-colors">' + Icons.plus + (!AppState.sidebarCollapsed ? '<span class="text-sm font-medium">Nueva sesión</span>' : '') + '</button><button onclick="toggleDarkMode()" class="w-full flex items-center justify-center space-x-2 text-gray-300 hover:text-white hover:bg-gray-800 rounded-lg py-2 px-3 transition-colors">' + (AppState.darkMode ? Icons.sun : Icons.moon) + (!AppState.sidebarCollapsed ? '<span class="text-sm">' + (AppState.darkMode ? 'Modo claro' : 'Modo oscuro') + '</span>' : '') + '</button><button onclick="logout()" class="w-full flex items-center justify-center space-x-2 text-gray-300 hover:text-white hover:bg-gray-800 rounded-lg py-2 px-3 transition-colors">' + Icons.logOut + (!AppState.sidebarCollapsed ? '<span class="text-sm">Salir</span>' : '') + '</button></div></div>';
}

function renderMenuItems() {
    return menuItems.map(function(item, index) {
        const isActive = AppState.activeSection === item.id;
        const activeClass = isActive ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white';
        
        return '<div><button onclick="handleMenuClick(\'' + item.id + '\', ' + (item.hasSubmenu || false) + ')" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 ' + activeClass + ' ' + (AppState.sidebarCollapsed ? 'justify-center' : '') + '">' + Icons[item.icon] + (!AppState.sidebarCollapsed ? '<span class="flex-1 text-left">' + item.label + '</span>' + (item.hasSubmenu ? '<div class="transition-transform duration-200" id="chevron-' + item.id + '">' + Icons.chevronRight + '</div>' : '') : '') + '</button>' + (item.hasSubmenu && !AppState.sidebarCollapsed ? '<div class="ml-4 mt-1 space-y-1" id="submenu-' + item.id + '" style="display: none;">' + item.submenu.map(function(subItem) { return '<button onclick="setActiveSection(\'' + subItem.id + '\')" class="w-full text-left px-3 py-2 rounded-lg text-sm transition-colors ' + (AppState.activeSection === subItem.id ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white') + '">' + subItem.label + '</button>'; }).join('') + '</div>' : '') + '</div>';
    }).join('');
}

function renderTopbar() {
    const topbar = document.getElementById('topbar');
    if (!topbar) return;
    
    const content = getSectionContent(AppState.activeSection);
    
    topbar.innerHTML = '<header class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between"><div class="flex items-center space-x-4"><button onclick="toggleSidebar()" class="p-2 rounded-lg hover:bg-gray-100 transition-colors"><div class="w-5 h-5 flex flex-col justify-center space-y-1"><div class="w-full h-0.5 bg-gray-600"></div><div class="w-full h-0.5 bg-gray-600"></div><div class="w-full h-0.5 bg-gray-600"></div></div></button><h1 class="text-2xl font-bold text-gray-900">' + content.title + '</h1></div><div class="text-sm text-gray-500">' + new Date().toLocaleDateString('es-ES', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' }) + '</div></header>';
}

function renderContent() {
    const content = document.getElementById('content');
    if (!content) return;
    
    const sectionContent = getSectionContent(AppState.activeSection);
    
    content.innerHTML = '<main class="flex-1 p-6"><div class="mb-8"><h2 class="text-3xl font-bold text-gray-900 mb-2">' + sectionContent.title + '</h2><p class="text-gray-600 text-lg">' + sectionContent.description + '</p></div>' + (sectionContent.stats.length > 0 ? '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">' + sectionContent.stats.map(function(stat) { return '<div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-shadow"><div class="flex items-center justify-between"><div><p class="text-sm text-gray-600 mb-1">' + stat.label + '</p><p class="text-2xl font-bold text-gray-900">' + stat.value + '</p></div><div class="w-12 h-12 rounded-lg flex items-center justify-center" style="background-color: ' + stat.color + '">' + Icons.dashboard + '</div></div></div>'; }).join('') + '</div>' : '') + '<div class="bg-white p-8 rounded-xl shadow-sm border border-gray-200 text-center"><div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">' + Icons.fileText + '</div><h3 class="text-xl font-semibold text-gray-900 mb-2">Contenido en desarrollo</h3><p class="text-gray-600 max-w-md mx-auto">Esta sección estará disponible próximamente. Aquí encontrarás todas las funcionalidades específicas para ' + sectionContent.title.toLowerCase() + '.</p></div></main>';
}

// Event handlers
function toggleSidebar() {
    AppState.sidebarCollapsed = !AppState.sidebarCollapsed;
    renderSidebar();
    console.log('Sidebar toggled:', AppState.sidebarCollapsed);
}

function toggleDarkMode() {
    AppState.darkMode = !AppState.darkMode;
    document.body.classList.toggle('dark', AppState.darkMode);
    renderSidebar();
    console.log('Dark mode toggled:', AppState.darkMode);
}

function setActiveSection(section) {
    AppState.activeSection = section;
    renderSidebar();
    renderTopbar();
    renderContent();
    console.log('Active section changed to:', section);
}

function handleMenuClick(itemId, hasSubmenu) {
    if (hasSubmenu && !AppState.sidebarCollapsed) {
        const submenu = document.getElementById('submenu-' + itemId);
        const chevron = document.getElementById('chevron-' + itemId);
        
        if (submenu) {
            const isVisible = submenu.style.display !== 'none';
            submenu.style.display = isVisible ? 'none' : 'block';
            
            if (chevron) {
                chevron.style.transform = isVisible ? 'rotate(0deg)' : 'rotate(90deg)';
            }
        }
    } else {
        setActiveSection(itemId);
    }
}

function getCsrfToken() {
    var meta = document.querySelector('meta[name="csrf-token"]');
    return meta ? meta.getAttribute('content') : '';
}

function newSession() {
    // Crear overlay
    var overlay = document.createElement('div');
    overlay.className = 'fixed inset-0';
    overlay.style.position = 'fixed';
    overlay.style.inset = '0';
    overlay.style.background = 'rgba(0,0,0,0.5)';
    overlay.style.display = 'flex';
    overlay.style.alignItems = 'center';
    overlay.style.justifyContent = 'center';
    overlay.style.zIndex = '9999';

    // Modal contenido
    var modal = document.createElement('div');
    modal.className = 'bg-white rounded-lg shadow-md';
    modal.style.width = '100%';
    modal.style.maxWidth = '600px';
    modal.style.background = '#ffffff';

    modal.innerHTML = '' +
        '<div class="border-b border-gray-200 px-4 py-3 flex items-center justify-between">' +
        '  <h2 class="text-lg font-semibold text-gray-900">Añadir sesión</h2>' +
        '  <button id="closeSessionModal" class="text-gray-500 hover:text-gray-900">✕</button>' +
        '</div>' +
        '<div class="p-4" id="sessionFormContainer">' +
        '  <div id="sessionError" class="text-red-600 text-sm mb-2" style="display:none;"></div>' +
        '  <form id="sessionForm" class="space-y-4">' +
        '    <div>' +
        '      <label class="block text-sm mb-1">Escucha (seleccionar)</label>' +
        '      <select id="listenerId" class="w-full bg-gray-100 rounded px-3 py-2"><option value="">— Ninguno —</option></select>' +
        '    </div>' +
        '    <div>' +
        '      <label class="block text-sm mb-1">O nombre de nuevo escucha</label>' +
        '      <input id="listenerName" type="text" class="w-full bg-gray-100 rounded px-3 py-2" placeholder="Nombre del escucha" />' +
        '    </div>' +
        '    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">' +
        '      <div>' +
        '        <label class="block text-sm mb-1">Día</label>' +
        '        <input id="dateField" type="date" class="w-full bg-gray-100 rounded px-3 py-2" required />' +
        '      </div>' +
        '      <div>' +
        '        <label class="block text-sm mb-1">Hora</label>' +
        '        <input id="timeField" type="time" class="w-full bg-gray-100 rounded px-3 py-2" required />' +
        '      </div>' +
        '    </div>' +
        '    <div>' +
        '      <label class="block text-sm mb-1">Estado</label>' +
        '      <select id="statusField" class="w-full bg-gray-100 rounded px-3 py-2">' +
        '        <option value="pendiente">Pendiente</option>' +
        '        <option value="realizada">Realizada</option>' +
        '      </select>' +
        '    </div>' +
        '    <div>' +
        '      <label class="block text-sm mb-1">Notas</label>' +
        '      <textarea id="notesField" rows="4" class="w-full bg-gray-100 rounded px-3 py-2" placeholder="Notas de la sesión..."></textarea>' +
        '    </div>' +
        '    <div class="flex justify-end gap-2 pt-2">' +
        '      <button type="button" id="cancelSessionBtn" class="px-4 py-2 rounded border border-gray-200">Cancelar</button>' +
        '      <button type="submit" id="saveSessionBtn" class="px-4 py-2 rounded bg-blue-600 hover:bg-blue-700 text-white">Guardar sesión</button>' +
        '    </div>' +
        '  </form>' +
        '</div>';

    overlay.appendChild(modal);
    document.body.appendChild(overlay);

    // Cerrar modal
    function closeModal() {
        if (overlay && overlay.parentNode) overlay.parentNode.removeChild(overlay);
    }
    document.getElementById('closeSessionModal').addEventListener('click', closeModal);
    document.getElementById('cancelSessionBtn').addEventListener('click', closeModal);

    // Deshabilitar nombre si se elige listener existente
    var listenerIdEl = document.getElementById('listenerId');
    var listenerNameEl = document.getElementById('listenerName');
    listenerIdEl.addEventListener('change', function() {
        listenerNameEl.disabled = !!listenerIdEl.value;
        if (listenerNameEl.disabled) listenerNameEl.value = '';
    });

    // Cargar listeners
    fetch('/api/listeners', { credentials: 'same-origin' })
        .then(function(r){ if(!r.ok) throw new Error('fail'); return r.json(); })
        .then(function(list){
            var select = document.getElementById('listenerId');
            list.forEach(function(l){
                var opt = document.createElement('option');
                opt.value = l.id;
                opt.textContent = l.name;
                select.appendChild(opt);
            });
        })
        .catch(function(){ /* silencioso */ });

    function combineDateTime(dateStr, timeStr) {
        if (!dateStr || !timeStr) return '';
        // dateStr from <input type="date"> is YYYY-MM-DD, timeStr is HH:mm
        return dateStr + ' ' + timeStr + ':00';
    }

    // Submit
    document.getElementById('sessionForm').addEventListener('submit', function(e){
        e.preventDefault();
        var errorBox = document.getElementById('sessionError');
        errorBox.style.display = 'none';

        var payload = {
            listener_id: listenerIdEl.value || null,
            listener_name: listenerIdEl.value ? null : (listenerNameEl.value || null),
            scheduled_at: combineDateTime(
                document.getElementById('dateField').value,
                document.getElementById('timeField').value
            ),
            status: document.getElementById('statusField').value,
            notes: document.getElementById('notesField').value || null,
            categories: null
        };

        var csrf = getCsrfToken();
        fetch('/api/sessions', {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf
            },
            body: JSON.stringify(payload)
        }).then(function(r){
            var ct = r.headers.get('content-type') || '';
            if (!r.ok) throw new Error('save-error');
            if (ct.indexOf('application/json') === -1) throw new Error('not-json');
            return r.json();
        }).then(function(){
            closeModal();
        }).catch(function(err){
            if (err && err.message === 'not-json') {
                errorBox.textContent = 'Sesión no guardada. ¿Has iniciado sesión?';
            } else {
                errorBox.textContent = 'No se pudo guardar la sesión.';
            }
            errorBox.style.display = 'block';
        });
    });
}

function logout() {
    if (!confirm('¿Estás seguro de que quieres salir?')) return;
    var csrf = getCsrfToken();
    fetch('/logout', {
        method: 'POST',
        credentials: 'same-origin',
        headers: { 'X-CSRF-TOKEN': csrf }
    }).then(function(){
        window.location.href = '/login';
    });
}

// Inicialización
document.addEventListener('DOMContentLoaded', function() {
    console.log('✅ DOM cargado, iniciando aplicación...');
    renderApp();
    console.log('✅ Aplicación JavaScript estática iniciada correctamente');
});

// Fallback si DOMContentLoaded ya pasó
if (document.readyState === 'loading') {
    // Ya está configurado el event listener arriba
} else {
    renderApp();
}