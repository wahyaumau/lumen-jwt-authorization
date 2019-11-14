# Lumen jwt authentication and role based authorization
-   Lumen Version : 5.8.12

## Package added :
-   tymon/jwt-auth Version : dev-develop

## Use the project
-   Clone the repo : `https://github.com/wahyaumau/lumen-jwt-authorization.git`
-   Enter the project : `cd lumen-jwt-authorization`
-   Install composer dependency for current project : `composer install`
-   Copy file .env.example, and then paste it as .env, and then set your .env file
-   Generate Tymon JWT secret key, the secret will be found in .env file variable JWT_SECRET : `php artisan jwt:secret`
-   Migrate the database : `php artisan migrate`
-   Seed the database : `php artisan db:seed`
-   Check your database to see users, roles, and role_user table
-   Serve lumen project : `php -S localhost:8000 -t public`

## Authentication
-   AuthController is used for register and login user
-   UserController is used to demonstrate some action guarded with auth middleware (Need valid token to access)
-   To see user information by provided token, check UserController@profile
-   The configuration file for authentication is in config/auth.php, as for token is in config/jwt.php
-   To change token expiration time, change `'ttl' => env('JWT_TTL', MINUTES)` in config/jwt.php, the default is 60 minutes

## Register
![alt text](https://i.ibb.co/C2z8Twx/Screenshot-137.png)

## Login
![alt text](https://i.ibb.co/6YbsPhf/Screenshot-139.png)

## Access guarded route
![alt text](https://i.ibb.co/6YbsPhf/Screenshot-139.png)

## Reference for authentication
-   https://dev.to/ndiecodes/build-a-jwt-authenticated-api-with-lumen-2afm
-   https://github.com/wahyaumau/lumen-jwt-authentication

## Authorization
-   Authorization is based on role of user
-   Authorization is determined by provided token, and by the provided token, application will know the role of user
-   The database schema for authorization : User to Role -> Many to Many
-   The middleware for authorization is in app/Middleware/RoleMiddleware.php
-   The middleware registration for application is in app/bootstrap/app.php with this code : 
`$app->routeMiddleware([
    'auth' => App\Http\Middleware\Authenticate::class,
    'role' => App\Http\Middleware\RoleMiddleware::class,
]);`
-   Example of protecting some action by some role is in UserController@construct with this code :
`public function __construct(){
    $this->middleware('auth');
    $this->middleware('role:Administrator,Super Administrator', ['except' => ['logout']]);
}`
-	This mean that user need to be authenticated with valid provided token to access all of method in UserController
	After authentication guard, next is role guard, that only user with Administrator or Super Administrator role can access all of method in UserController except logout method, because you don't need to know certain role to log out, right?
 -	Instead of using 'except' keyword, you can also guard method by 'only' keyword, which implies that guard is 'only' for spesific method	 
-	You can also guard action in routes, instead of controller
