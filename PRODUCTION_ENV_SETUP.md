# Configuración del archivo .env en Producción

## Problema
Laravel está generando URLs HTTP en lugar de HTTPS para los assets, causando errores de "Mixed Content" en el navegador.

## Solución: Actualizar archivo .env en EasyPanel

Necesitas actualizar el archivo `.env` en tu servidor de EasyPanel con las siguientes configuraciones:

```env
# URL base de la aplicación (debe ser HTTPS)
APP_URL=https://diariosesionesapp-diarioapp.txuo5.easypanel.host

# URL para assets (debe ser HTTPS)
ASSET_URL=https://diariosesionesapp-diarioapp.txuo5.easypanel.host

# Asegurar que el entorno sea producción
APP_ENV=production

# Debug debe estar deshabilitado en producción
APP_DEBUG=false
```

## Pasos para aplicar en EasyPanel:

1. **Acceder al panel de EasyPanel**
2. **Ir a la sección de Variables de Entorno** (Environment Variables)
3. **Actualizar o agregar las siguientes variables:**
   - `APP_URL` = `https://diariosesionesapp-diarioapp.txuo5.easypanel.host`
   - `ASSET_URL` = `https://diariosesionesapp-diarioapp.txuo5.easypanel.host`
   - `APP_ENV` = `production`
   - `APP_DEBUG` = `false`

4. **Reiniciar la aplicación** después de hacer los cambios

## Verificación

Después de aplicar estos cambios:
- Los assets CSS y JS se cargarán correctamente sobre HTTPS
- No habrá más errores de "Mixed Content" en la consola del navegador
- La aplicación React se iniciará correctamente

## Nota Importante

El cambio en `AppServiceProvider.php` ya está implementado y forzará HTTPS automáticamente cuando `APP_ENV=production`.
