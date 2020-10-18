<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$VERSION = getenv('APP_VERSION', 'api/v1');

$router->group(['prefix' => $VERSION], function ($router) {

    $router->group(['middleware' => 'user'], function ($router) {
        $router->group(['prefix' => 'product'], function ($router) {
            $router->post('/', 'Product\ProductController@create');
            $router->put('/', 'Product\ProductController@update');
            $router->delete('/{id}', 'Product\ProductController@delete');
        });
    });

    $router->group(['middleware' => 'client'], function ($router) {
        $router->group(['prefix' => 'product'], function ($router) {
            $router->get('/', 'Product\ProductController@get');
        });

        $router->group(['prefix' => 'purchase'], function ($router) {
            $router->get('/', 'Purchase\PurchaseController@get');
            $router->post('/', 'Purchase\PurchaseController@create');
        });
    });

});

$router->get('/', function () use ($VERSION) {
    return response()->json([
        'version' => $VERSION
    ]);
});

