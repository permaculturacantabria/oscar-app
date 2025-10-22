# Configuración de EasyPanel para Laravel

## Problema Actual
Error: `net::ERR_NAME_NOT_RESOLVED` al cargar archivos CSS y JS estáticos.

## Causa
El servidor web no está apuntando correctamente al directorio `public` de Laravel.

## Solución: Configurar EasyPanel Correctamente

### Paso 1: Verificar Document Root

En EasyPanel, ve a la configuración de tu aplicación y verifica:

1. **Busca la sección "General" o "Settings"**
2. **Encuentra el campo "Start Command" o "Web Root"**
3. **Asegúrate de que esté configurado correctamente**

Para Laravel, el Document Root debe apuntar a la carpeta `public`.

### Paso 2: Configuración Recomendada para EasyPanel

**Si EasyPanel usa Docker/Dockerfile:**

En tu configuración, asegúrate de que el servidor web (nginx o apache) esté configurado para servir desde `/app/public`.

**Configuración Nginx para EasyPanel:**
```nginx
server {
    listen 80;
    server_name _;
    root /app/public;
    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~* \.(css|js|jpg|jpeg|png|gif|ico|svg)$ {
        expires 1y;
        add_header Cache-Control "public, immutable";
    }
}
```

### Paso 3: Variables de Entorno (Ya configuradas)

✅ Estas ya están configuradas correctamente:
- `APP_URL=https://diariosesionesapp-diarioapp.txuo5.easypanel.host`
- `ASSET_URL=https://diariosesionesapp-diarioapp.txuo5.easypanel.host`
- `APP_ENV=production`
- `APP_DEBUG=false`

### Paso 4: Verificar que los archivos existen

Ejecuta este comando en el terminal de EasyPanel para verificar:

```bash
ls -la /app/public/css/
ls -la /app/public/js/
```

Deberías ver:
- `app.css` en `/app/public/css/`
- `app.js` en `/app/public/js/`

### Paso 5: Permisos de archivos

Asegúrate de que los permisos sean correctos:

```bash
chmod -R 755 /app/public
chown -R www-data:www-data /app/public
```

### Paso 6: Reiniciar servicios

Después de cualquier cambio de configuración:

```bash
# Si usas nginx
nginx -s reload

# O reinicia toda la aplicación en EasyPanel
```

## Verificación

Después de aplicar la configuración, abre la consola del navegador y verifica:

1. Las URLs de los assets deben ser:
   - `https://diariosesionesapp-diarioapp.txuo5.easypanel.host/css/app.css`
   - `https://diariosesionesapp-diarioapp.txuo5.easypanel.host/js/app.js`

2. Ambos archivos deben cargar con código HTTP 200

## Si el problema persiste

Si después de esto sigue sin funcionar, es posible que necesites:

1. **Verificar los logs del servidor web** en EasyPanel
2. **Contactar al soporte de EasyPanel** para verificar la configuración del servidor web
3. **Considerar usar los assets compilados por Vite** en lugar de los estáticos

### Opción alternativa: Usar Vite Assets

Si prefieres usar los assets compilados por Vite (que ya están en `public/build/assets/`), podemos actualizar el template para usar la directiva `@vite` de Laravel.

