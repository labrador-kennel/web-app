#!/usr/bin/env just --justfile

_default:
    just --list --unsorted

# Build the containers to be able to run the app
build: _build-container composer

# Bring down the application, remove vendor directory, and any generated code or cache
clean: down _clean-composer

_build-container:
    docker compose build

# Install composer dependencies on the container and populate vendor on host
composer: _clean-composer
    docker buildx build . --target=composer-output --file=docker/php/Dockerfile --output=.

# Update composer dependencies on the container and populate vendor on host
composer-update: _clean-composer
    docker buildx build . --target=composer-output-updated --file=docker/php/Dockerfile --output=.

_clean-composer:
    rm -rf vendor

# Bring up the application
up:
    docker compose up app --force-recreate --remove-orphans --detach

# Bring down the application
down:
    docker compose down --remove-orphans

# Reload the application server, loading any code changes
reload timeout='0':
    docker compose restart app --no-deps --timeout {{timeout}}

# See the logs for the given docker compose service
logs compose_service='app':
    docker compose logs {{compose_service}}

# Follow the logs for the given docker compose service
logs-follow compose_service='app':
    docker compose logs {{compose_service}} --follow
