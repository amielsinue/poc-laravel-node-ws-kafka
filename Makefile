# Help (auto-generado)
.PHONY: help
help:  ## Show this help message
	@awk 'BEGIN {FS = ":.*?## "}; /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

# Docker base
DOCKER_COMPOSE := docker-compose

# Servicios
LARAVEL_SERVICE := laravel
NODE_SERVICE := node-consumer

# Comandos básicos
.PHONY: up
up:  ## Start containers in background
	@$(DOCKER_COMPOSE) up -d --build

.PHONY: down
down:  ## Stop and remove containers
	@$(DOCKER_COMPOSE) down

.PHONY: restart
restart:  ## Restart all services
	@$(DOCKER_COMPOSE) restart

.PHONY: rebuild
rebuild:  ## Rebuild containers from scratch
	@$(DOCKER_COMPOSE) down -v
	@$(DOCKER_COMPOSE) up -d --build

.PHONY: ps
ps:  ## Show container status
	@$(DOCKER_COMPOSE) ps

# Logs
.PHONY: logs
logs:  ## Show all logs
	@$(DOCKER_COMPOSE) logs -f

.PHONY: logs-laravel
logs-laravel:  ## Show logs for Laravel
	@$(DOCKER_COMPOSE) logs -f $(LARAVEL_SERVICE)

.PHONY: logs-node
logs-node:  ## Show logs for Node.js consumer
	@$(DOCKER_COMPOSE) logs -f $(NODE_SERVICE)

# Shell access
.PHONY: ssh-laravel
ssh-laravel:  ## Shell into Laravel container
	@$(DOCKER_COMPOSE) exec $(LARAVEL_SERVICE) bash

.PHONY: ssh-node
ssh-node:  ## Shell into Node.js consumer
	@$(DOCKER_COMPOSE) exec $(NODE_SERVICE) sh
