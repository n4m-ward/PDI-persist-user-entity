start:
	php -S localhost:1234 -t public

test:
	./vendor/bin/phpunit tests/

validate-stan:
	./vendor/bin/phpstan analyse -l 6 src tests

validate-phpcs:
	./vendor/bin/php-cs-fixer fix src -v --dry-run

test-behat:
	./vendor/bin/behat