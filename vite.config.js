import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app-simple.jsx'],
            refresh: true,
        }),
        react(),
        tailwindcss(),
    ],
    build: {
        // Use esbuild instead of terser to avoid CSP issues
        minify: 'esbuild',
        target: 'es2015',
        // Ensure no eval is used
        rollupOptions: {
            output: {
                manualChunks: undefined,
            }
        }
    },
    define: {
        // Avoid eval usage
        'process.env.NODE_ENV': JSON.stringify('production')
    }
});
