<?php

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
    $router->get('artists', 'ArtistController@all');
    $router->post('artists', 'ArtistController@create');
    $router->get('artists/{id}', 'ArtistController@show');
    $router->put('artists/{id}', 'ArtistController@update');
    $router->delete('artists/{id}', 'ArtistController@delete');

    $router->get('tours', 'TourController@all');
    $router->post('tours', 'TourController@create');
    $router->get('tours/{id}', 'TourController@show');
    $router->put('tours/{id}', 'TourController@update');
    $router->delete('tours/{id}', 'TourController@delete');
});
