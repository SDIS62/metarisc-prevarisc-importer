FROM php:8.2-apache

# Installation de Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install pdo pdo_mysql
# Copie des fichiers de votre projet dans le conteneur
COPY . /var/www/html

# Définition du répertoire de travail dans le conteneur
WORKDIR /var/www/html

# Copie du fichier composer.jso    n et le fichier composer.lock dans le conteneur
COPY composer.json composer.lock ./

RUN composer clear-cache

# Installation des dépendances PHP requises à l'aide de Composer
RUN composer install --no-scripts --no-autoloader

COPY . .

# Exécution de la commande Composer pour générer l'autoloader et exécuter les scripts post-installation
RUN composer dump-autoload --optimize

EXPOSE 80

# Insert application
COPY boot.sh boot.sh
CMD ["bash", "/var/www/html/boot.sh"]
