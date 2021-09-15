stop:
	docker stop phpmyadmin_gui nginx_server mysql_db php-8.0.9 symfony_cli
	docker rm phpmyadmin_gui nginx_server mysql_db php-8.0.9 symfony_cli
dev:
	docker-compose up -d --build server symfony mysql phpmyadmin
controller:
	docker exec -it symfony_cli php ./bin/console make:controller

entity:
	docker exec -it symfony_cli php ./bin/console make:entity

install:
	docker-compose run --rm composer install