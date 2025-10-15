import './bootstrap';
import React from 'react';
import { createRoot } from 'react-dom/client';

// Componente de prueba simple
const TestApp = () => {
    return (
        <div style={{ padding: '20px', fontFamily: 'Arial, sans-serif' }}>
            <h1 style={{ color: '#2563eb' }}>✅ React está funcionando!</h1>
            <p>Si ves este mensaje, React se ha montado correctamente.</p>
            <div style={{ 
                background: '#f3f4f6', 
                padding: '15px', 
                borderRadius: '8px',
                marginTop: '20px'
            }}>
                <h2>Información del sistema:</h2>
                <ul>
                    <li>React: {React.version}</li>
                    <li>Fecha: {new Date().toLocaleString()}</li>
                    <li>URL: {window.location.href}</li>
                </ul>
            </div>
        </div>
    );
};

// Intentar montar la aplicación
console.log('🚀 Iniciando aplicación React...');

const container = document.getElementById('app');
if (container) {
    console.log('✅ Contenedor #app encontrado');
    try {
        const root = createRoot(container);
        root.render(<TestApp />);
        console.log('✅ React montado exitosamente');
    } catch (error) {
        console.error('❌ Error al montar React:', error);
    }
} else {
    console.error('❌ No se encontró el contenedor #app');
}