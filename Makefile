stop:
	docker stop phpmyadmin_epsivent nginx_epsivent mysql_epsivent php_epsivent symfony_cli keycloak_epsivent
	docker rm phpmyadmin_epsivent nginx_epsivent mysql_epsivent php_epsivent symfony_cli keycloak_epsivent

dev:
	docker-compose up -d --build server symfony mysql phpmyadmin keycloak

install:
	docker-compose run --rm composer install