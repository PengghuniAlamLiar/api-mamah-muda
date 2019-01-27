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
    $router->get('gizi', 'GiziController@index');
    $router->post('gizi/detail', ['middleware' => ['valid_article_param'], 'uses' => 'GiziController@detail']);
    $router->get('penyakit', 'PenyakitController@index');
    $router->post('penyakit/detail', ['middleware' => ['valid_article_param'], 'uses' => 'PenyakitController@detail']);
});