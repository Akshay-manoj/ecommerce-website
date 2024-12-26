## Ecommerce website backend


This repository is an ecommerce website backend with few endpoints and database schema done in laravel.

## Installation

1. Run ```composer install```
2. Opern terminal and run ```cp .env.example .env``` to copy the .env variables. Once done update the variables as needed.
3. Generate jwt secret ```php artisan jwt:secret```
4. Run database migrations ```php artisan migrate```
5. Run seeder file ``` php artisan db:seed ```
6. Run localserver ```php artisan serve --port=8080```. Here the application will be available at ```http://localhost:8080```