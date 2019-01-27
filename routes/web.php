<?php

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group([
    'prefix' => 'auth'
], function ($router) {

    $router->post('login', 'AuthController@login');
    $router->post('logout', 'AuthController@logout');
    $router->post('refresh', 'AuthController@refresh');
    $router->post('me', 'AuthController@me');
});

$router->group([
    'prefix' => 'artikel'
], function ($router) {
    $router->get('gizi', 'ArticleController@gizi');
    $router->get('penyakit', 'ArticleController@penyakit');
});