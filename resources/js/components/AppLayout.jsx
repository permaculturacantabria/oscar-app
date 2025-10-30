import React, { useState } from 'react';
import { motion } from 'framer-motion';
import Sidebar from './Sidebar';
import Topbar from './Topbar';
import Placeholder from './Placeholder';
import SessionForm from './SessionForm';

const AppLayout = () => {
    const [sidebarCollapsed, setSidebarCollapsed] = useState(false);
    const [activeSection, setActiveSection] = useState('dashboard');
    const [darkMode, setDarkMode] = useState(true);
    const [showSessionForm, setShowSessionForm] = useState(false);

    const toggleSidebar = () => {
        setSidebarCollapsed(!sidebarCollapsed);
    };

    const toggleDarkMode = () => {
        setDarkMode(!darkMode);
    };

    return (
        <div className={`min-h-screen flex ${darkMode ? 'dark' : ''}`}>
            <div className="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen flex w-full">
                {/* Sidebar */}
                <Sidebar
                    collapsed={sidebarCollapsed}
                    activeSection={activeSection}
                    setActiveSection={setActiveSection}
                    darkMode={darkMode}
                    toggleDarkMode={toggleDarkMode}
                    onNewSession={() => setShowSessionForm(true)}
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
                    <main className="flex-1 p-6">
                        <Placeholder activeSection={activeSection} />
                        {showSessionForm && (
                            <SessionForm
                                onClose={() => setShowSessionForm(false)}
                                onCreated={() => setShowSessionForm(false)}
                            />
                        )}
                    </main>
                </div>
            </div>
        </div>
    );
};

export default AppLayout;