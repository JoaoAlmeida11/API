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

// $app->get('/users', function ($request, $response, array $args) {
//     // returns users
//     return $response->withJson([
//         "users" => [
//             "id" => 1,
//             "name" => "Jonh Doe"
//         ]
//         ], 200);
// });

// $app->get('/users/{id}/friends', function ($request, $response, array $args) {
//     // returns users
//     return "user {$args['id']} friends";
// });

// $app->get('/users/{id}', function ($request, $response, array $args) {
//     // returns users
//     return "user" . $args['id'];
// });

// $app->post('/users', function ($request, $response, array $args) {
//     return "publish new user";
// });

// $app->put('/users/{id}', function ($request, $response, array $args) {
//     return "update user";
// });

// $app->delete('/users/{id}', function ($request, $response, array $args) {
//     return "delete user";
// });