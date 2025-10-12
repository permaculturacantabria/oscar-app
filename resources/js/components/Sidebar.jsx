import React, { useState } from 'react';
import { motion, AnimatePresence } from 'framer-motion';
import {
    LayoutDashboard,
    NotebookPen,
    Users,
    FolderTree,
    Calendar,
    ListChecks,
    Settings,
    Plus,
    Moon,
    Sun,
    LogOut,
    Search,
    ChevronDown,
    ChevronRight
} from 'lucide-react';
import SidebarItem from './SidebarItem';

const Sidebar = ({ collapsed, activeSection, setActiveSection, darkMode, toggleDarkMode }) => {
    const [catalogsExpanded, setCatalogsExpanded] = useState(false);

    const menuItems = [
        { id: 'dashboard', label: 'Inicio', icon: LayoutDashboard },
        { id: 'sessions', label: 'Mis sesiones', icon: NotebookPen },
        { id: 'listeners', label: 'Mis escuchas', icon: Users },
        {
            id: 'catalogs',
            label: 'Catálogos',
            icon: FolderTree,
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
        { id: 'calendar', label: 'Calendario', icon: Calendar },
        { id: 'records', label: 'Registros', icon: ListChecks },
        { id: 'settings', label: 'Ajustes', icon: Settings }
    ];

    const sidebarVariants = {
        expanded: { width: '280px' },
        collapsed: { width: '80px' }
    };

    const handleCatalogClick = () => {
        if (!collapsed) {
            setCatalogsExpanded(!catalogsExpanded);
        } else {
            setActiveSection('catalogs');
        }
    };

    return (
        <motion.div
            className="bg-gray-900 dark:bg-gray-950 text-white flex flex-col border-r border-gray-800 dark:border-gray-700"
            variants={sidebarVariants}
            animate={collapsed ? 'collapsed' : 'expanded'}
            transition={{ duration: 0.3, ease: 'easeInOut' }}
        >
            {/* Logo/Header */}
            <div className="p-4 border-b border-gray-800 dark:border-gray-700">
                <div className="flex items-center space-x-3">
                    <div className="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center flex-shrink-0">
                        <NotebookPen size={20} />
                    </div>
                    <AnimatePresence>
                        {!collapsed && (
                            <motion.div
                                initial={{ opacity: 0, x: -10 }}
                                animate={{ opacity: 1, x: 0 }}
                                exit={{ opacity: 0, x: -10 }}
                                transition={{ duration: 0.2 }}
                                className="overflow-hidden"
                            >
                                <h1 className="text-lg font-semibold text-white">Emociona</h1>
                                <p className="text-xs text-gray-400">Diario de Sesiones</p>
                            </motion.div>
                        )}
                    </AnimatePresence>
                </div>
            </div>

            {/* Search Bar */}
            <AnimatePresence>
                {!collapsed && (
                    <motion.div
                        initial={{ opacity: 0, height: 0 }}
                        animate={{ opacity: 1, height: 'auto' }}
                        exit={{ opacity: 0, height: 0 }}
                        transition={{ duration: 0.2 }}
                        className="p-4"
                    >
                        <div className="relative">
                            <Search className="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" size={16} />
                            <input
                                type="text"
                                placeholder="Buscar..."
                                className="w-full bg-gray-800 dark:bg-gray-900 text-white placeholder-gray-400 rounded-lg pl-10 pr-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                            />
                        </div>
                    </motion.div>
                )}
            </AnimatePresence>

            {/* Navigation Menu */}
            <nav className="flex-1 px-4 py-2 space-y-1">
                {menuItems.map((item) => (
                    <div key={item.id}>
                        <SidebarItem
                            item={item}
                            collapsed={collapsed}
                            active={activeSection === item.id}
                            onClick={item.hasSubmenu ? handleCatalogClick : () => setActiveSection(item.id)}
                            hasSubmenu={item.hasSubmenu}
                            submenuExpanded={catalogsExpanded}
                        />
                        
                        {/* Submenu for Catalogs */}
                        {item.hasSubmenu && (
                            <AnimatePresence>
                                {catalogsExpanded && !collapsed && (
                                    <motion.div
                                        initial={{ opacity: 0, height: 0 }}
                                        animate={{ opacity: 1, height: 'auto' }}
                                        exit={{ opacity: 0, height: 0 }}
                                        transition={{ duration: 0.2 }}
                                        className="ml-4 mt-1 space-y-1"
                                    >
                                        {item.submenu.map((subItem) => (
                                            <button
                                                key={subItem.id}
                                                onClick={() => setActiveSection(subItem.id)}
                                                className={`w-full text-left px-3 py-2 rounded-lg text-sm transition-colors ${
                                                    activeSection === subItem.id
                                                        ? 'bg-blue-600 text-white'
                                                        : 'text-gray-300 hover:bg-gray-800 dark:hover:bg-gray-900 hover:text-white'
                                                }`}
                                            >
                                                {subItem.label}
                                            </button>
                                        ))}
                                    </motion.div>
                                )}
                            </AnimatePresence>
                        )}
                    </div>
                ))}
            </nav>

            {/* Bottom Actions */}
            <div className="p-4 border-t border-gray-800 dark:border-gray-700 space-y-2">
                {/* New Session Button */}
                <button className="w-full flex items-center justify-center space-x-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg py-2 px-3 transition-colors">
                    <Plus size={16} />
                    <AnimatePresence>
                        {!collapsed && (
                            <motion.span
                                initial={{ opacity: 0, x: -10 }}
                                animate={{ opacity: 1, x: 0 }}
                                exit={{ opacity: 0, x: -10 }}
                                transition={{ duration: 0.2 }}
                                className="text-sm font-medium"
                            >
                                Nueva sesión
                            </motion.span>
                        )}
                    </AnimatePresence>
                </button>

                {/* Dark Mode Toggle */}
                <button
                    onClick={toggleDarkMode}
                    className="w-full flex items-center justify-center space-x-2 text-gray-300 hover:text-white hover:bg-gray-800 dark:hover:bg-gray-900 rounded-lg py-2 px-3 transition-colors"
                >
                    {darkMode ? <Sun size={16} /> : <Moon size={16} />}
                    <AnimatePresence>
                        {!collapsed && (
                            <motion.span
                                initial={{ opacity: 0, x: -10 }}
                                animate={{ opacity: 1, x: 0 }}
                                exit={{ opacity: 0, x: -10 }}
                                transition={{ duration: 0.2 }}
                                className="text-sm"
                            >
                                {darkMode ? 'Modo claro' : 'Modo oscuro'}
                            </motion.span>
                        )}
                    </AnimatePresence>
                </button>

                {/* Logout Button */}
                <button className="w-full flex items-center justify-center space-x-2 text-gray-300 hover:text-white hover:bg-gray-800 dark:hover:bg-gray-900 rounded-lg py-2 px-3 transition-colors">
                    <LogOut size={16} />
                    <AnimatePresence>
                        {!collapsed && (
                            <motion.span
                                initial={{ opacity: 0, x: -10 }}
                                animate={{ opacity: 1, x: 0 }}
                                exit={{ opacity: 0, x: -10 }}
                                transition={{ duration: 0.2 }}
                                className="text-sm"
                            >
                                Salir
                            </motion.span>
                        )}
                    </AnimatePresence>
                </button>
            </div>
        </motion.div>
    );
};

export default Sidebar;