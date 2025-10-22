# Configuración EasyPanel con Buildpacks para Laravel

## Tu Configuración Actual
- ✅ Buildpacks (Heroku-style)
- ✅ GitHub conectado a EasyPanel
- ✅ Laravel con archivos estáticos en `public/css/app.css` y `public/js/app.js`

## Problema Identificado
El servidor web no está sirviendo correctamente los archivos estáticos desde la carpeta `public`.

## Solución para Buildpacks

### Paso 1: Crear archivo `Procfile` (si no existe)

Verifica que tengas un archivo `Procfile` en la raíz de tu proyecto:

```procfile
web: vendor/bin/heroku-php-nginx -C nginx.conf public/
```

### Paso 2: Crear archivo `nginx.conf`

Crea un archivo `nginx.conf` en la raíz de tu proyecto:

```nginx
location / {
    # try to serve file directly, fallback to index.php
    try_files $uri $uri/ /index.php?$query_string;
}

location ~ \.php$ {
    fastcgi_pass unix:/tmp/php-fpm.sock;
    fastcgi_index index.php;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    include fastcgi_params;
}

# Cache static assets
location ~* \.(css|js|jpg|jpeg|png|gif|ico|svg)$ {
    expires 1y;
    add_header Cache-Control "public, immutable";
    try_files $uri =404;
}
```

### Paso 3: Configurar variables de entorno en EasyPanel

En el panel de EasyPanel, ve a **Environment Variables** y configura:

```env
APP_URL=https://diariosesionesapp-diarioapp.txuo5.easypanel.host
ASSET_URL=https://diariosesionesapp-diarioapp.txuo5.easypanel.host
APP_ENV=production
APP_DEBUG=false
```

### Paso 4: Verificar configuración de Buildpack

En EasyPanel, asegúrate de que:

1. **Buildpack**: Esté configurado como `heroku/php` o `heroku/php:latest`
2. **Start Command**: Debe estar vacío (el Procfile maneja esto)
3. **Web Root**: Debe estar vacío o configurado como `/app/public`

### Paso 5: Verificar archivos necesarios

Asegúrate de que estos archivos existan en tu repositorio:

```
tu-proyecto/
├── Procfile
├── nginx.conf
├── composer.json
├── composer.lock
├── public/
│   ├── css/app.css
│   ├── js/app.js
│   └── index.php
└── app/
    └── Providers/
        └── AppServiceProvider.php
```

## Comandos para verificar en EasyPanel

Accede al terminal de tu aplicación en EasyPanel y ejecuta:

```bash
# Verificar que los archivos existen
ls -la public/css/app.css
ls -la public/js/app.js

# Verificar configuración de nginx
cat nginx.conf

# Verificar Procfile
cat Procfile

# Verificar variables de entorno
env | grep APP_
```

## Si el problema persiste

### Opción A: Usar assets compilados por Vite

Si prefieres usar los assets compilados (que ya están en `public/build/assets/`), podemos cambiar el template para usar Vite:

```php
<!-- En resources/views/app.blade.php -->
@vite(['resources/css/app.css', 'resources/js/app-vanilla.js'])
```

### Opción B: Verificar logs de buildpack

En EasyPanel, revisa los logs de construcción (build logs) para ver si hay errores durante el despliegue.

### Opción C: Configuración alternativa de Procfile

Si la configuración de nginx no funciona, prueba con:

```procfile
web: vendor/bin/heroku-php-apache2 public/
```

## Verificación Final

Después de aplicar estos cambios:

1. **Haz commit y push** a tu repositorio GitHub
2. **EasyPanel se reconstruirá automáticamente**
3. **Verifica en el navegador** que los assets se cargan correctamente:
   - `https://diariosesionesapp-diarioapp.txuo5.easypanel.host/css/app.css`
   - `https://diariosesionesapp-diarioapp.txuo5.easypanel.host/js/app.js`

## Nota Importante

Con buildpacks, EasyPanel maneja automáticamente:
- ✅ Instalación de PHP
- ✅ Instalación de dependencias (composer install)
- ✅ Configuración del servidor web
- ✅ Variables de entorno

Solo necesitas asegurarte de que el `Procfile` y `nginx.conf` estén configurados correctamente.
