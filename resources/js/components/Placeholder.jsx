import React from 'react';
import { motion } from 'framer-motion';
import {
    BarChart3,
    Calendar,
    Users,
    FileText,
    Clock,
    TrendingUp,
    Heart,
    Brain,
    MessageSquare,
    Target,
    Lightbulb,
    Activity
} from 'lucide-react';

const Placeholder = ({ activeSection }) => {
    const getPlaceholderContent = () => {
        switch (activeSection) {
            case 'dashboard':
                return {
                    title: 'Dashboard - Vista General',
                    description: 'Resumen de tu actividad y progreso en Emociona',
                    cards: [
                        { icon: Calendar, title: 'Sesiones este mes', value: '12', color: 'bg-blue-500' },
                        { icon: Users, title: 'Escuchas activas', value: '3', color: 'bg-green-500' },
                        { icon: TrendingUp, title: 'Progreso general', value: '85%', color: 'bg-purple-500' },
                        { icon: Heart, title: 'Bienestar emocional', value: 'Bueno', color: 'bg-pink-500' }
                    ]
                };
            case 'sessions':
                return {
                    title: 'Mis Sesiones',
                    description: 'Historial y gestión de tus sesiones de escucha',
                    cards: [
                        { icon: Clock, title: 'Última sesión', value: 'Hace 2 días', color: 'bg-orange-500' },
                        { icon: BarChart3, title: 'Total sesiones', value: '47', color: 'bg-blue-500' },
                        { icon: Activity, title: 'Promedio semanal', value: '3.2', color: 'bg-green-500' }
                    ]
                };
            case 'listeners':
                return {
                    title: 'Mis Escuchas',
                    description: 'Personas que te acompañan en tu proceso de crecimiento',
                    cards: [
                        { icon: Users, title: 'Escuchas disponibles', value: '5', color: 'bg-indigo-500' },
                        { icon: MessageSquare, title: 'Conversaciones activas', value: '2', color: 'bg-cyan-500' },
                        { icon: Heart, title: 'Valoración promedio', value: '4.8/5', color: 'bg-pink-500' }
                    ]
                };
            case 'catalogs':
            case 'themes':
            case 'early-memories':
            case 'distressing-messages':
            case 'directions':
            case 'contradictions':
            case 'listener-contradictions':
            case 'reality-bits':
            case 'restimulations':
            case 'social-commitments':
            case 'next-steps':
            case 'physical-session':
            case 'frozen-needs':
                return {
                    title: 'Catálogos',
                    description: 'Recursos y herramientas para tu proceso de autoconocimiento',
                    cards: [
                        { icon: Brain, title: 'Temas explorados', value: '23', color: 'bg-purple-500' },
                        { icon: Lightbulb, title: 'Insights generados', value: '15', color: 'bg-yellow-500' },
                        { icon: Target, title: 'Objetivos alcanzados', value: '8', color: 'bg-green-500' }
                    ]
                };
            case 'calendar':
                return {
                    title: 'Calendario',
                    description: 'Programa y gestiona tus sesiones y actividades',
                    cards: [
                        { icon: Calendar, title: 'Próxima sesión', value: 'Mañana 10:00', color: 'bg-blue-500' },
                        { icon: Clock, title: 'Sesiones pendientes', value: '3', color: 'bg-orange-500' },
                        { icon: Users, title: 'Reuniones grupales', value: '1', color: 'bg-green-500' }
                    ]
                };
            case 'records':
                return {
                    title: 'Registros',
                    description: 'Historial detallado de tu progreso y actividades',
                    cards: [
                        { icon: FileText, title: 'Entradas totales', value: '156', color: 'bg-slate-500' },
                        { icon: BarChart3, title: 'Análisis completados', value: '34', color: 'bg-blue-500' },
                        { icon: TrendingUp, title: 'Tendencia positiva', value: '92%', color: 'bg-green-500' }
                    ]
                };
            case 'settings':
                return {
                    title: 'Ajustes',
                    description: 'Personaliza tu experiencia en Emociona',
                    cards: [
                        { icon: Users, title: 'Perfil', value: 'Completo', color: 'bg-indigo-500' },
                        { icon: MessageSquare, title: 'Notificaciones', value: 'Activas', color: 'bg-cyan-500' },
                        { icon: Heart, title: 'Privacidad', value: 'Configurada', color: 'bg-pink-500' }
                    ]
                };
            default:
                return {
                    title: 'Bienvenido a Emociona',
                    description: 'Tu espacio personal para el crecimiento emocional',
                    cards: [
                        { icon: Heart, title: 'Bienestar', value: 'Prioridad', color: 'bg-pink-500' },
                        { icon: Brain, title: 'Autoconocimiento', value: 'En progreso', color: 'bg-purple-500' },
                        { icon: Users, title: 'Comunidad', value: 'Conectada', color: 'bg-green-500' }
                    ]
                };
        }
    };

    const content = getPlaceholderContent();

    return (
        <motion.div
            key={activeSection}
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.3 }}
            className="space-y-6"
        >
            {/* Header */}
            <div className="mb-8">
                <h2 className="text-2xl font-bold text-gray-900 dark:text-white mb-2">
                    {content.title}
                </h2>
                <p className="text-gray-600 dark:text-gray-400">
                    {content.description}
                </p>
            </div>

            {/* Stats Cards */}
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {content.cards.map((card, index) => {
                    const Icon = card.icon;
                    return (
                        <motion.div
                            key={index}
                            initial={{ opacity: 0, y: 20 }}
                            animate={{ opacity: 1, y: 0 }}
                            transition={{ duration: 0.3, delay: index * 0.1 }}
                            className="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow"
                        >
                            <div className="flex items-center justify-between">
                                <div>
                                    <p className="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">
                                        {card.title}
                                    </p>
                                    <p className="text-2xl font-bold text-gray-900 dark:text-white">
                                        {card.value}
                                    </p>
                                </div>
                                <div className={`p-3 rounded-lg ${card.color}`}>
                                    <Icon className="w-6 h-6 text-white" />
                                </div>
                            </div>
                        </motion.div>
                    );
                })}
            </div>

            {/* Content Area */}
            <div className="bg-white dark:bg-gray-800 rounded-xl p-8 shadow-sm border border-gray-200 dark:border-gray-700">
                <div className="text-center py-12">
                    <div className="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                        <FileText className="w-8 h-8 text-gray-400" />
                    </div>
                    <h3 className="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                        Contenido en desarrollo
                    </h3>
                    <p className="text-gray-600 dark:text-gray-400 max-w-md mx-auto">
                        Esta sección estará disponible próximamente. Aquí encontrarás todas las funcionalidades específicas para {content.title.toLowerCase()}.
                    </p>
                </div>
            </div>
        </motion.div>
    );
};

export default Placeholder;