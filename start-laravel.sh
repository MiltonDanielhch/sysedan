cat > start-laravel.sh <<'EOF'
#!/bin/bash
# 1) Permisos correctos
chown -R www-data:www-data /app/storage /app/bootstrap/cache
chmod -R ug+rw /app/storage /app/bootstrap/cache

# 2) Migraciones (si no se han corrido)
cd /app
php artisan migrate --force || true

# 3) Delegar al arranque original
exec "$@"
EOF
chmod +x start-laravel.sh
