FROM nginx:latest

WORKDIR /etc/nginx/conf.d

COPY ../nginx/nginx.conf .

RUN mv nginx.conf default.conf

RUN addgroup -g 1000 symfony && adduser -G symfony -g symfony -s /bin/sh -D symfony

WORKDIR /var/www/html

COPY . .