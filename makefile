build_up:
	@docker-compose up -d --build
	@make composer && make add_hosts && make permissions

migrate:
	@docker-compose exec fpm php yii migrate --interactive=0

test:
	@docker-compose exec fpm vendor/bin/codecept run common/tests/functional/FeedbackCest

add_hosts:
	@docker-compose exec fpm /bin/sh -c 'echo "172.33.238.22 back.dev.local\n172.33.238.22 front.dev.local" >> /etc/hosts'

composer:
	@docker-compose exec fpm composer install

permissions:
	@docker exec fpm chmod -R 777 backend/runtime backend/web
	@docker exec fpm chmod -R 777 frontend/runtime frontend/web
	@docker exec fpm chmod -R 777 common/tests/_output
