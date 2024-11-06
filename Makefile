.PHONY: update-schema load-dummy-data all  

up:
	docker compose up -d db
	@echo "Waiting for 10 second..."
	sleep 10
	@echo "Done waiting!"
	docker compose up -d nginx fpm


uninstall:
	docker compose down
	docker volume rm intas_test_db


update-schema:
	docker compose exec fpm sh -c "cd /var/www/html/public && php bin/doctrine orm:schema-tool:update --force"

load-dummy-data:  
	docker exec -i db mysql intas_company -u root -proot < dummy_data.sql  

install: up update-schema load-dummy-data

reinstall: uninstall install
