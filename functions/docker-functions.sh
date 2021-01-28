#!/bin/bash

docker:ash() {
	docker-compose -f docker-compose-${ENV}.yaml exec helpdesk_app ash -l
}

docker:up() {
	docker-compose -f docker-compose-${ENV}.yaml up -d
}

docker:down() {
	docker-compose -f docker-compose-${ENV}.yaml stop
}
