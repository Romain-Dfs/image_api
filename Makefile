stop:
	docker stop phpmyadmin_epsivent nginx_epsivent mysql_epsivent php_epsivent symfony_cli_epsivent
	docker rm phpmyadmin_epsivent nginx_epsivent mysql_epsivent php_epsivent symfony_cli_epsivent

dev:
	docker-compose up -d --build server symfony mysql phpmyadmin

install:
	docker-compose run --rm composer install