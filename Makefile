stop:
	docker stop phpmyadmin_fileManager nginx_fileManager mysql_fileManager php_fileManager symfony_cli
	docker rm phpmyadmin_fileManager nginx_fileManager mysql_fileManager php_fileManager symfony_cli

dev:
	docker-compose up -d --build server symfony mysql phpmyadmin

install:
	docker-compose run --rm composer install