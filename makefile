build_up:
	@docker-compose up -d --build
	@make composer && make add_hosts && make permissions

migrate:
	@docker-compose run fpm php yii migrate --interactive=0

test:
	@make init_chrome && make init_php
	@gnome-terminal -- ${PWD}/docker/fpm/app/chromedriver --url-base=/wd/hub
	@cd ${PWD}/docker/fpm/app/common && \
	../vendor/bin/codecept run acceptance FeedbackCest

composer:
	@docker-compose run fpm composer install

add_hosts:
	@sudo chmod 777 /etc/hosts
	@echo '0.0.0.0         back.dev.local' >> /etc/hosts
	@echo '0.0.0.0         front.dev.local' >> /etc/hosts
	@sudo chmod 755 /etc/hosts

permissions:
	@cd ${PWD}/docker/fpm/app/backend && sudo chmod -R 777 runtime web
	@cd ${PWD}/docker/fpm/app/frontend && sudo chmod -R 777 runtime web
	@cd ${PWD}/docker/fpm/app/common/tests && sudo chmod -R 777 _output

init_chrome:
	@wget -q -O - https://dl-ssl.google.com/linux/linux_signing_key.pub | sudo apt-key add -
	@sudo sh -c 'echo "deb [arch=amd64] http://dl.google.com/linux/chrome/deb/ stable main" >> /etc/apt/sources.list.d/google-chrome.list'
	@sudo apt update && sudo apt install google-chrome-stable -y

init_php:
	@sudo apt install -y php-cli php-curl php-dom php-mbstring php-pgsql
