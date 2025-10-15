<?php
// Script de verificación de assets
echo "=== VERIFICACIÓN DE ASSETS ===\n\n";

// Verificar archivos
$manifest = public_path('build/manifest.json');
$cssFile = public_path('build/assets/app-BQQfwzOi.css');
$jsFile = public_path('build/assets/app-DRzP95OV.js');

echo "1. Verificando archivos:\n";
echo "   Manifest: " . (file_exists($manifest) ? "✓ EXISTE" : "✗ NO EXISTE") . "\n";
echo "   CSS: " . (file_exists($cssFile) ? "✓ EXISTE" : "✗ NO EXISTE") . "\n";
echo "   JS: " . (file_exists($jsFile) ? "✓ EXISTE" : "✗ NO EXISTE") . "\n\n";

// Verificar contenido del manifest
if (file_exists($manifest)) {
    echo "2. Contenido del manifest:\n";
    echo file_get_contents($manifest) . "\n\n";
}

// Verificar configuración de Laravel
echo "3. Configuración de Laravel:\n";
echo "   APP_ENV: " . env('APP_ENV') . "\n";
echo "   APP_DEBUG: " . (env('APP_DEBUG') ? 'true' : 'false') . "\n";
echo "   APP_URL: " . env('APP_URL') . "\n\n";

// Verificar función Vite
echo "4. Verificando función @vite:\n";
try {
    $viteManifest = app(\Illuminate\Foundation\Vite::class);
    echo "   Vite helper: ✓ DISPONIBLE\n";
} catch (Exception $e) {
    echo "   Vite helper: ✗ ERROR - " . $e->getMessage() . "\n";
}

echo "\n=== FIN DE VERIFICACIÓN ===\n";