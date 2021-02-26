<?php

$app->group('/users', function () use ($app){
    $app->get('', 'UserController:index');
    $app->get('/{id}', 'UserController:show');
    $app->post('', 'UserController:create');
    $app->put('/{id}', 'UserController:update');
    $app->delete('/{id}', 'UserController:destroy');
});

$app->group('/articles', function () use ($app){
    $app->get('', 'UserController:index');
    $app->post('', function ($request, $response, array $args){
        return "create users";
    });
});