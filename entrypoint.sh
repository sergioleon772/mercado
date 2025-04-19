#!/bin/sh

# Generar archivo .env si no existe
if [ ! -f .env ]; then
  echo "APP_NAME=\"$APP_NAME\"" >> .env
  echo "APP_ENV=$APP_ENV" >> .env
  echo "APP_KEY=$APP_KEY" >> .env
  echo "APP_DEBUG=$APP_DEBUG" >> .env
  echo "APP_URL=$APP_URL" >> .env
  echo "LOG_CHANNEL=stack" >> .env
  echo "DB_CONNECTION=$DB_CONNECTION" >> .env
  echo "DB_HOST=$DB_HOST" >> .env
  echo "DB_PORT=$DB_PORT" >> .env
  echo "DB_DATABASE=$DB_DATABASE" >> .env
  echo "DB_USERNAME=$DB_USERNAME" >> .env
  echo "DB_PASSWORD=$DB_PASSWORD" >> .env
fi

# Limpiar y cachear configuración
php artisan config:clear
php artisan config:cache

# Crear enlace simbólico a la carpeta de storage
php artisan storage:link || true

# Ejecutar migraciones (puedes quitarlo si no deseas hacerlo en producción)
php artisan migrate --force || true

# Iniciar servidor
exec php artisan serve --host=0.0.0.0 --port=8000
