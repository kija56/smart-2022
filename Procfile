
web: vendor/bin/heroku-php-apache2 public/
scheduler: while true; do php artisan schedule:run; sleep 60; done


supervisor: supervisord -c supervisor.conf -n

##release: npm run prod && php artisan migrate --force  && php artisan optimize
release: php artisan migrate --force &&  php artisan optimize
