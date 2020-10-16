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
$VERSION = getenv('APP_VERSION', 'api/v1');
$router->group(['prefix'=>$VERSION], function ($router){
    $router->get('actor', 'Actor\ActorController@all');
    $router->post('actor', 'Actor\ActorController@create');
});

$router->get('/', function () use($VERSION){
    return response()->json([
        'version' => $VERSION
    ]);
});

