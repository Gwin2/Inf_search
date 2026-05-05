#!/bin/sh
set -e

echo "Waiting for MySQL..."
until php -r '$c=@mysqli_connect(getenv("DB_HOST") ?: "db", getenv("DB_USER") ?: "root", getenv("DB_PASS") ?: ""); if (!$c) exit(1); mysqli_close($c);' >/dev/null 2>&1; do
	sleep 2
done

echo "Preparing demo databases..."
php /var/www/html/setup-demo-db.php

exec "$@"
