<?php
use Illuminate\Support\Facades\Artisan as Artisan;

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
 */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {

    $router->get('/', function () use ($router) {
        return $router->app->version();
    });
    $router->get('auth/current', ['uses' => 'AuthController@getCurrent']);
    $router->post('auth/register', ['uses' => 'AuthController@register']);
    $router->post('auth/login', ['uses' => 'AuthController@login']);
    $router->post('auth/current', ['uses' => 'AuthController@getCurrent']);
    $router->post('auth/logout', ['uses' => 'AuthController@logout']);

    // ...
});

$router->get('artisan/migrate', function () {
    Artisan::call('migrate');
    return "successfully migrated";
});
