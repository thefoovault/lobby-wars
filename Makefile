all: help

##     _                     ____  _        _      _
##    / \   _ __  _ __      / ___|| | _____| | ___| |_ ___  _ __
##   / _ \ | '_ \| '_ \ ____\___ \| |/ / _ \ |/ _ \ __/ _ \| '_ \
##  / ___ \| |_) | |_) |_____|__) |   <  __/ |  __/ || (_) | | | |
## /_/   \_\ .__/| .__/     |____/|_|\_\___|_|\___|\__\___/|_| |_|
##         |_|   |_|
.PHONY: help status build composer-install build-container start stop shell test

current-dir := $(dir $(abspath $(lastword $(MAKEFILE_LIST))))

help: Makefile
	@sed -n 's/^##//p' $<

## status:	Show containers status
status:
	@docker-compose ps

## build:		Start container and install packages
build: build-container start hooks composer-install

## install:	Install packages
composer-install:
	@docker-compose exec app composer install

##build-container 	Rebuild a container
build-container:
	@docker-compose up --build --force-recreate --no-deps -d

## start:		Start container
start:
	@docker-compose up -d

## stop:		Stop containers
stop:
	@docker-compose stop

## down:		Stop containers and remove stopped containers and any network created
down:
	@docker-comopse down

## destroy:	Stop containers and remove its volumes (all information inside volumes will be lost)
destroy:
	@docker-compose down -v

## shell:		Interactive shell inside docker
shell:
	@docker-compose exec app sh

## hooks:		Add git hooks
hooks:
	rm -rf .git/hooks
	ln -s ../docs/git/hooks-docker .git/hooks

## test:		Run all tests inside docker
test:
	@docker-compose exec app make run-tests

## run-tests:	Run all tests
run-tests:
	./vendor/bin/phpunit --exclude-group='disabled' --log-junit build/test_results/phpunit/junit.xml test