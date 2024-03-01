#Multi-staged build
FROM composer:2.7.1 as deps
WORKDIR /app
#Installer les dépendances (dossier vendor/) du projet PHP (gestionnaire de paquet Composer)
RUN --mount=type=bind,source=$PWD/composer.json,target=composer.json \
    --mount=type=bind,source=$PWD/composer.lock,target=composer.lock \
    --mount=type=cache,target=/tmp/cache \
    composer install --no-dev --no-interaction

FROM php:8.2-apache as final
RUN docker-php-ext-install pdo pdo_mysql
#Preparer un fichier php.ini (pas abordé dans cette démo pour simplifier)
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
COPY --from=deps app/vendor/ /var/www/html/vendor
COPY ./src /var/www/html
#Utilisation de l'user d'apache (www-data) pour lancer le processus
USER www-data