DOCKER_HOST                          ?= localhost
UNAME_S 							 := $(shell uname -s)

USERID=$(shell id -u)
GROUPID=$(shell id -g)

## Define variable depending on OS used
ifeq ($(UNAME_S),Darwin)
	ifneq (,$(wildcard /var/run/docker.sock))
	  DOCKER_HOST = docker.for.mac.localhost
	endif
else ifneq ($(UNAME_S),Linux)
    $(warning Your OS "$(UNAME_S)" is not supported and could not work as expecetd!)
endif

.PHONY: *

help: ## Shows all available commands with their description

	$(info Available Commands:)
	@cat $(MAKEFILE_LIST) | grep -e "^[a-zA-Z_\-]*: *.*## *" | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

build: ## Builds the base image for our php

	docker-compose build --build-arg DOCKER_HOST_ADDR=${DOCKER_HOST}
	docker-compose run --rm -u $(USERID):$(GROUPID) php sh -lc 'composer install'

destroy: ## Stops and deletes all containers and volumes

	docker-compose down -v

upgrade: ## Upgrades the docker images

	docker-compose build --build-arg DOCKER_HOST_ADDR=${DOCKER_HOST} --pull
	docker-compose pull

test: ## Simply runs the tests assuming the test environment was previously setup via ``make it-run-test

	docker-compose run --rm -u $(USERID):$(GROUPID) -T php sh -lc './vendor/bin/phpunit'

fix-cs: ## Runs the code style fixer

	docker-compose run --rm -u $(USERID):$(GROUPID) php-cs-fixer php-cs-fixer -v fix --allow-risky yes

check-cs: ## Dry-run the code style fixer and provide diff if available

	docker-compose run --rm -u $(USERID):$(GROUPID) php-cs-fixer php-cs-fixer fix --dry-run --diff --allow-risky yes

cli: ## Launch php cli commands. Usage: make cli c='fixtures/testtest_fixtures.php'

	docker-compose run --rm -u $(USERID):$(GROUPID) php sh

analyse-code:

	docker-compose run --rm -u $(USERID):$(GROUPID) phpstan analyse -c phpstan.neon  -l max src test

phpstan.update-baseline: ## Update the baseline of phpstan

	-docker-compose run --rm -u $(USERID):$(GROUPID) -T phpstan analyse -c phpstan.neon -l max --error-format baselineNeon src tests >phpstan-baseline.neon

composer: ## Allow to use the composer command. Usage: make composer c='require symfony/assets'

	docker-compose run --rm -u $(USERID):$(GROUPID) php sh -lc 'composer $(c)'

composer-install: ## Allows to manually launch the composer install command in case you did some manual changes

	docker-compose run --rm -u $(USERID):$(GROUPID) php sh -lc 'composer install'

composer-require: ## Allows to require new composer vendors. Usage: make composer-require p=symfony/assets

	docker-compose run --rm -u $(USERID):$(GROUPID) php sh -lc 'composer require $(p)'

composer-update: ## Allows to update 1 or all composer vendors. Usage: make compage-update p=symfony/assets (when leaving p empty, it will update all packages)

	docker-compose run --rm -u $(USERID):$(GROUPID) php sh -lc 'composer update $(p)'

ps:	## List all containers

	docker-compose ps

pstorm:	## Configures phpstorm phpunit debugging configuration

	$(eval MYSQL_PORT := $(shell docker-compose port mysql 3306))
	$(eval RABBITMQ_PORT := $(shell docker-compose port rabbitmq 5672))
	@etc/dev/make/pstorm.sh $(DOCKER_HOST) $(MYSQL_PORT) $(RABBITMQ_PORT)

logs: ## Shows the logs of a container. Use 's' variable to filter on a specific container.

	docker-compose logs -f $(s)