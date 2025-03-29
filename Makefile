down:	
	echo "Stopping and removing existing containers..."
	docker-compose down -v
up:
	echo "Building and starting containers..."
	docker-compose up -d --build
build:
	echo "Stopping and removing existing containers..."
	docker-compose down -v
	echo "Building and starting containers..."
	docker-compose up -d --build
keygen:
	echo "Generating application key and JWT secret..."
	docker exec laravel_app php artisan key:generate
	docker exec laravel_app php artisan jwt:secret
migration:
	echo "Running migrations and seeding the database..."
	docker exec laravel_app php artisan migrate
	docker exec laravel_app php artisan migrate:fresh --seed
storage:
	echo "Setting up storage link..."
	docker exec laravel_app php artisan storage:link
