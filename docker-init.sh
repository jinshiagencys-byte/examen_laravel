#!/bin/bash
set -e

STORAGE_DIR="/var/www/html/storage"
CONFIG_DIR="/etc/inventory-booking-system/config"
KEY_DIR="/etc/ssl/private"
CA_DIR="/etc/ssl/certs"

mkdir -p "$STORAGE_DIR/framework/cache" "$STORAGE_DIR/framework/sessions" "$STORAGE_DIR/framework/views" "$STORAGE_DIR/logs" "$CONFIG_DIR"
chown -R www-data:www-data "$STORAGE_DIR" "$CONFIG_DIR"
find "$STORAGE_DIR" -type d -exec chmod 775 {} \;

cat > "$CONFIG_DIR/.env" <<EOF
APP_NAME="Examen Laravel"
APP_ENV=${APP_ENV:-local}
APP_KEY=${APP_KEY:-base64:QX5Wk0B0vZ2lP5w7d3h5Q1nM3YQF3sLkzZcFaPj7X7Q=}
APP_DEBUG=${APP_DEBUG:-true}
APP_URL=${APP_URL:-http://localhost}

LOG_CHANNEL=${LOG_CHANNEL:-stack}
LOG_LEVEL=${LOG_LEVEL:-debug}

DB_CONNECTION=mysql
DB_HOST=${DB_HOST:-mysql}
DB_PORT=${DB_PORT:-3306}
DB_DATABASE=${DB_DATABASE:-examen_laravel}
DB_USERNAME=${DB_USERNAME:-laravel}
DB_PASSWORD=${DB_PASSWORD:-laravel}

SESSION_DRIVER=file
SESSION_LIFETIME=120

CACHE_STORE=file
QUEUE_CONNECTION=sync

MAIL_MAILER=log
EOF

ln -sf "$CONFIG_DIR/.env" /var/www/html/.env
chown www-data:www-data "$CONFIG_DIR/.env"
chmod 664 "$CONFIG_DIR/.env"

service cron start

if [ ! -f "$KEY_DIR/ca.key" ]; then
    openssl genrsa -out "$KEY_DIR/ca.key" 4096
fi

if [ ! -f "$CA_DIR/ca.crt" ]; then
    openssl req -x509 -new -nodes -key "$KEY_DIR/ca.key" -sha256 -days 3650 -out "$CA_DIR/ca.crt" -subj "/C=US/ST=State/L=City/O=Company/CN=example.com CA"
fi

sed -i "s|SSLCertificateFile.*|SSLCertificateFile $CA_DIR/ca.crt|" /etc/apache2/sites-available/default-ssl.conf
sed -i "s|SSLCertificateKeyFile.*|SSLCertificateKeyFile $KEY_DIR/ca.key|" /etc/apache2/sites-available/default-ssl.conf

if [ ! -f "$CA_DIR/server.key" ] || [ ! -f "$CA_DIR/server.crt" ]; then
    openssl genrsa -out "$CA_DIR/server.key" 2048
    openssl req -new -key "$CA_DIR/server.key" -out "$CA_DIR/server.csr" -subj "/C=US/ST=State/L=City/O=Company/CN=example.com"
    openssl x509 -req -in "$CA_DIR/server.csr" -CA "$CA_DIR/ca.crt" -CAkey "$KEY_DIR/ca.key" -CAcreateserial -out "$CA_DIR/server.crt" -days 365 -sha256
fi

# Wait for MySQL to be ready.
for i in $(seq 1 60); do
    php /var/www/html/artisan db:monitor --database=mysql >/dev/null 2>&1 || php /var/www/html/artisan db:monitor --database=mysql >/dev/null 2>&1 || true
    if php -r "try { new PDO('mysql:host=' . getenv('DB_HOST') . ';port=' . getenv('DB_PORT') . ';dbname=' . getenv('DB_DATABASE') . ';charset=utf8mb4', getenv('DB_USERNAME'), getenv('DB_PASSWORD')); exit(0);} catch (Throwable $e) { exit(1);} " 2>/dev/null; then
        break
    fi
    sleep 2
done

php /var/www/html/artisan config:clear
php /var/www/html/artisan migrate:fresh --seed --force

exec "$@"
