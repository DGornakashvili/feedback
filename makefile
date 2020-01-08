up:
	@docker-compose up -d
	@docker-compose run fpm composer install

build_up:
	@docker-compose up -d --build
	@docker-compose run fpm composer install

migrate:
	@docker-compose run fpm php yii migrate --interactive=0

add_hosts:
	@sudo chmod 777 /etc/hosts
	@echo '0.0.0.0         back.dev.local' >> /etc/hosts
	@echo '0.0.0.0         front.dev.local' >> /etc/hosts
	@sudo chmod 755 /etc/hosts

test:
	@gnome-terminal -- ${PWD}/docker/fpm/app/chromedriver --url-base=/wd/hub
	@cd /var/www/docker/fpm/app/common && \
	../vendor/bin/codecept run acceptance FeedbackCest
