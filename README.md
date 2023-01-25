# Installation

1. Run Docker Desktop

2. Terminal in app folder `./vendor/bin/sail up`

    Once the application's Docker containers have been started, you can access the application in your web browser at: http://localhost.

3. Configure A Shell Alias `alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'`

4. `sail composer install`

5. `sail npm install`

6. `sail php artisan db:seed`

# Testing

    sail php artisan test
