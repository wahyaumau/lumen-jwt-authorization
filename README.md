# Lumen jwt authentication
-   Lumen Version : 5.8.12

## Package added :
-   tymon/jwt-auth Version : dev-develop

## Use the project
-   Clone the repo : `git clone https://github.com/wahyaumau/lumen-jwt-authentication.git`
-   Enter the project : `cd lumen-jwt-authentication`
-   Install composer dependency for current project : `composer install`
-   Copy file .env.example, and then paste it as .env, and then set your .env file
-   Generate APP key : `php artisan key:generate`
-   Generate Tymon JWT secret key, the secret will be found in .env file variable JWT_SECRET : `php artisan jwt:secret`
-   Migrate the database : `php artisan migrate`
-   Serve lumen project : `php -S localhost:8000 -t public`

## Hint
-   AuthController is used for register and login user
-   UserController is used to demonstrate some action guarded with auth middleware (Need valid token to access)
-   To see user information by provided token, check UserController@profile
-   The configuration file for authentication is in config/auth.php, as for token is in config/jwt.php
-   To change token expiration time, change `'ttl' => env('JWT_TTL', MINUTES)` in config/jwt.php, the default is 60 minutes

## Register
![alt text](https://res.cloudinary.com/practicaldev/image/fetch/s--bDSm0Stf--/c_limit%2Cf_auto%2Cfl_progressive%2Cq_auto%2Cw_880/https://res.cloudinary.com/iamndie/image/upload/v1566663229/Screen_Shot_2019-08-24_at_4.34.01_PM_vnm7zv.png)

## Login
![alt text](https://res.cloudinary.com/practicaldev/image/fetch/s--rNSeRinR--/c_limit%2Cf_auto%2Cfl_progressive%2Cq_auto%2Cw_880/https://res.cloudinary.com/iamndie/image/upload/v1566672721/Screen_Shot_2019-08-24_at_7.51.18_PM_srhwrs.png)

## Access guarded route
![alt text](https://res.cloudinary.com/practicaldev/image/fetch/s--Y5N256_j--/c_limit%2Cf_auto%2Cfl_progressive%2Cq_auto%2Cw_880/https://res.cloudinary.com/iamndie/image/upload/v1566677009/Screen_Shot_2019-08-24_at_8.54.39_PM_vqr7bx.png)

## Reference
https://dev.to/ndiecodes/build-a-jwt-authenticated-api-with-lumen-2afm

