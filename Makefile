stop:
	docker stop phpmyadmin_fileManager nginx_fileManager mysql_fileManager php_fileManager symfony_cli
	docker rm phpmyadmin_fileManager nginx_fileManager mysql_fileManager php_fileManager symfony_cli

dev:
	docker-compose up -d --build server symfony mysql phpmyadmin

build:
	docker-compose up -d php
	sleep 30s
	docker exec -it php_fileManager php bin/console doctrine:migrations:migrate
	docker stop mysql_fileManager php_fileManager
	docker rm mysql_fileManager php_fileManager

install:
	docker-compose run --rm composer install