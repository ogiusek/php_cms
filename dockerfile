FROM php:8.2-cli

WORKDIR /

COPY . .

EXPOSE 80

RUN docker-php-ext-install mysqli

CMD ["php", "-S", "0.0.0.0:80"]