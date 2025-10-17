import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app-csp.jsx'],
            refresh: true,
        }),
        react({
            // Simple React configuration without Babel plugins
            jsxRuntime: 'automatic'
        }),
        tailwindcss(),
    ],
    build: {
        // Strict CSP-compliant build configuration
        minify: 'esbuild',
        target: 'es2020',
        sourcemap: false, // Disable source maps to avoid eval()
        rollupOptions: {
            output: {
                // Ensure deterministic chunk names
                manualChunks: undefined,
                // Avoid dynamic imports that might use eval()
                format: 'es',
                entryFileNames: 'assets/[name]-[hash].js',
                chunkFileNames: 'assets/[name]-[hash].js',
                assetFileNames: 'assets/[name]-[hash].[ext]'
            },
            // Disable code splitting to avoid dynamic imports
            external: [],
        },
        // Additional CSP-compliant settings
        cssCodeSplit: true,
        reportCompressedSize: false,
        chunkSizeWarningLimit: 1000,
    },
    define: {
        // Static replacements to avoid eval()
        'process.env.NODE_ENV': JSON.stringify(process.env.NODE_ENV || 'production'),
        '__DEV__': false,
        '__PROD__': true,
        'global': 'globalThis',
    },
    esbuild: {
        // Strict esbuild settings for CSP compliance
        legalComments: 'none',
        minifyIdentifiers: true,
        minifySyntax: true,
        minifyWhitespace: true,
        treeShaking: true,
        // Disable features that might use eval()
        keepNames: false,
        drop: process.env.NODE_ENV === 'production' ? ['console', 'debugger'] : [],
    },
    server: {
        // Development server settings
        hmr: {
            // Disable HMR overlay that might use eval()
            overlay: false
        }
    },
    optimizeDeps: {
        // Pre-bundle dependencies to avoid runtime eval()
        include: ['react', 'react-dom'],
        exclude: ['framer-motion', 'lucide-react'], // Exclude eval-dependent libraries
        esbuildOptions: {
            target: 'es2020',
            supported: {
                // Disable features that might require eval()
                'dynamic-import': false,
                'import-meta': false,
            }
        }
    }
});
