.PHONY: migrate
migrate:
	php artisan migrate

.PHONY: migrate-fresh
migrate-fresh:
	php artisan migrate:fresh --seed

.PHONY: run
run:
	composer run dev

.PHONY: createfilamentuser
createfilamentuser:
	php artisan make:filament-user

.PHONY: reset-run
reset-run: migrate run;

.PHONY: showroutes
showroutes:
    php artisan route:list
