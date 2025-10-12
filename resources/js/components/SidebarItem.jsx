import React from 'react';
import { motion, AnimatePresence } from 'framer-motion';
import { ChevronDown, ChevronRight } from 'lucide-react';

const SidebarItem = ({ item, collapsed, active, onClick, hasSubmenu, submenuExpanded }) => {
    const Icon = item.icon;

    return (
        <button
            onClick={onClick}
            className={`w-full flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors group ${
                active
                    ? 'bg-blue-600 text-white'
                    : 'text-gray-300 hover:bg-gray-800 dark:hover:bg-gray-900 hover:text-white'
            }`}
        >
            <Icon size={20} className="flex-shrink-0" />
            
            <AnimatePresence>
                {!collapsed && (
                    <motion.div
                        initial={{ opacity: 0, x: -10 }}
                        animate={{ opacity: 1, x: 0 }}
                        exit={{ opacity: 0, x: -10 }}
                        transition={{ duration: 0.2 }}
                        className="flex-1 flex items-center justify-between"
                    >
                        <span className="text-sm font-medium">{item.label}</span>
                        {hasSubmenu && (
                            <motion.div
                                animate={{ rotate: submenuExpanded ? 180 : 0 }}
                                transition={{ duration: 0.2 }}
                            >
                                <ChevronDown size={16} />
                            </motion.div>
                        )}
                    </motion.div>
                )}
            </AnimatePresence>
        </button>
    );
};

export default SidebarItem;