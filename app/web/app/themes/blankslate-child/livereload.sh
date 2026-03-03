#!/bin/bash

# Script para ejecutar livereload y monitorear cambios en el tema blankslate-child
# Instala primero: npm install -g livereload

THEME_DIR="/home/rcarpioponce/proyectos/clientes/hdi/app/web/app/themes/blankslate-child"

echo "=================================================="
echo "🔄 LiveReload para BlankSlate Child Theme"
echo "=================================================="
echo ""
echo "Monitorando cambios en:"
echo "  - $THEME_DIR"
echo ""
echo "Puerto: 35729"
echo "Abre tu navegador o recarga la página para conectarte"
echo ""
echo "Presiona Ctrl+C para detener"
echo "=================================================="
echo ""

# Verificar si livereload está instalado
if ! command -v livereload &> /dev/null; then
    echo "⚠️  livereload no está instalado."
    echo "Instálalo con: npm install -g livereload"
    exit 1
fi

# Ejecutar livereload
livereload "$THEME_DIR" -e "php,css,js,html" -p 35729
