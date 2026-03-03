# BlankSlate Child Theme - Desarrollo con LiveReload

Este tema incluye soporte para **LiveReload**, que recarga automáticamente la página del navegador cuando cambias archivos CSS, JS o PHP.

## Instalación de LiveReload

### Opción 1: Usando npm (Recomendado)

```bash
cd /home/rcarpioponce/proyectos/clientes/hdi/app/web/app/themes/blankslate-child
npm install
```

### Opción 2: Instalar globalmente

```bash
npm install -g livereload
```

## Uso

### Método 1: Con npm (si instalaste las dependencias locales)

```bash
npm run dev
# o
npm run livereload
```

### Método 2: Con el script bash

```bash
bash livereload.sh
```

### Método 3: Comando directo

```bash
livereload /home/rcarpioponce/proyectos/clientes/hdi/app/web/app/themes/blankslate-child -e "php,css,js,html" -p 35729
```

## Lo que sucede

1. LiveReload iniciará un servidor WebSocket en el puerto **35729**
2. El script `livereload.js` está cargado en el header (solo en ambiente de desarrollo)
3. Cuando cambies cualquier archivo `.php`, `.css`, `.js` o `.html` en el tema:
   - LiveReload detecta el cambio
   - Automáticamente recarga la página en tu navegador
   - Verás los cambios al instante

## Configuración de Ambiente

El script se carga automáticamente si tienes definida la constante `WP_ENV` en tu `wp-config.php`:

```php
define( 'WP_ENV', 'development' );
```

O si tienes la variable de entorno `WP_ENV`:

```bash
export WP_ENV=development
```

## Archivos del tema que monitorea

- `*.php` - Archivos PHP
- `*.css` - Hojas de estilo
- `*.js` - Scripts JavaScript
- `*.html` - Archivos HTML

## Desactivar LiveReload

Para desactivar temporalmente:
1. Comenta o elimina el campo `WP_ENV` de tu configuración
2. O detén el servidor con `Ctrl+C`

## Solución de problemas

Si no ves los cambios:

1. **Verifica que livereload está corriendo:**
   ```
   Debería ver: "LiveReload listening on port 35729"
   ```

2. **Recarga la página manualmente** (Ctrl+F5 o Cmd+Shift+R)

3. **Abre la consola del navegador** (F12) para ver si hay errores de conexión

4. **Verifica el puerto 35729:**
   ```bash
   lsof -i :35729
   ```

## Recursos

- [Documentación de LiveReload](http://livereload.com/)
- [npm livereload](https://www.npmjs.com/package/livereload)
