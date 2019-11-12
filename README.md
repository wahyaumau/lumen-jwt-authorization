# Lumen jwt authentication
-   `Lumen Version : 5.8.12`

## Package added :
-   `tymon/jwt-auth Version: dev-develop`

## Use the project
-   `Clone the repo : git clone https://github.com/wahyaumau/lumen-jwt-authentication.git`
-   `Enter the project : cd lumen-jwt-authentication`
-   `Install composer dependency for current project : composer install`
-   `Copy file .env.example, and then paste it as .env, and then set your .env file`
-   `Generate Tymon JWT secret key, the secret will be found in .env file variable JWT_SECRET : php artisan jwt:secret`
-   `Migrate database : php artisan migrate`
-   `Serve lumen project : php -S localhost:8000 -t public`

## Hint
-   `AuthController is used for register and login user `
-   `UserController is used to demonstrate some action guarded with auth middleware (Need valid token to access) `
-   `To see user information by provided token, check UserController@profile`
-   `The configuration file for authentication is in config/auth.php, as for token is in config/jwt.php`
-   `To change token expiration time, change 'ttl' => env('JWT_TTL', MINUTES) in config/jwt.php`


