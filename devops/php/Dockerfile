FROM php:8.2-fpm

# 安装 pdo_mysql
RUN docker-php-ext-install pdo_mysql

# 安装 redis 扩展
RUN pecl install redis && docker-php-ext-enable redis