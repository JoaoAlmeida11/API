<?php
use Illuminate\Database\Capsule\Manager as Capsule;

require __DIR__ . '/../vendor/autoload.php';

$app = new \Slim\App( [
    'settings' => [
        'determineRouteBeforeAppMiddleware' => true,
        'displayErrorDetails' => true,
        'addContentLengthHeader' => false,
        'db' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database'=> 'articlesapp',
            'username' => 'root',
            'password' => '',
            // 'charset' => 'utf8',
            // 'collation' => 'utf8mb4_general_ci'
        ]
    ]
]);

$container = $app->getContainer();

$capsule = new Capsule;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
// mais à frente
$capsule->bootEloquent();

$container['UserController'] = function ($container) {
    return new \App\Controllers\UserController($container);
};
// $container['validator'] = function($container){
//     return new App\Validation\Validator;
// };


require __DIR__ . '/../app/route.php';
