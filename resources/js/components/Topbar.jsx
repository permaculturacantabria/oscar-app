import React from 'react';
import { Menu } from 'lucide-react';

const Topbar = ({ activeSection, toggleSidebar, sidebarCollapsed }) => {
    const getSectionTitle = (section) => {
        const titles = {
            dashboard: 'Dashboard',
            sessions: 'Mis Sesiones',
            listeners: 'Mis escuchas',
            catalogs: 'Catálogos',
            themes: 'Temas',
            'early-memories': 'Memorias Tempranas',
            'distressing-messages': 'Mensajes Angustiosos',
            directions: 'Direcciones',
            contradictions: 'Contradicciones',
            'listener-contradictions': 'Contradicciones del Escucha',
            'reality-bits': 'Pedacitos de Realidad',
            restimulations: 'Restimulaciones',
            'social-commitments': 'Compromisos Sociales',
            'next-steps': 'Próximos Pasos',
            'physical-session': 'Sesión Física',
            'frozen-needs': 'Necesidades Congeladas',
            calendar: 'Calendario',
            records: 'Registros',
            settings: 'Ajustes'
        };
        return titles[section] || 'Emociona';
    };

    return (
        <header className="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-6 py-4">
            <div className="flex items-center justify-between">
                <div className="flex items-center space-x-4">
                    <button
                        onClick={toggleSidebar}
                        className="p-2 rounded-lg text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"
                    >
                        <Menu size={20} />
                    </button>
                    <h1 className="text-xl font-semibold text-gray-900 dark:text-white">
                        {getSectionTitle(activeSection)}
                    </h1>
                </div>
                
                <div className="flex items-center space-x-4">
                    <div className="text-sm text-gray-500 dark:text-gray-400">
                        {new Date().toLocaleDateString('es-ES', {
                            weekday: 'long',
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        })}
                    </div>
                </div>
            </div>
        </header>
    );
};

export default Topbar;