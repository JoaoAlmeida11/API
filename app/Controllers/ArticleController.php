<?php

namespace App\Controllers;
use Illuminate\Database\Capsule\Manager as Capsule;
use App\Models\User;
use Respect\Validation\Validator as v;


class ArticleController{
    protected $container;
    public function __construct($container){
        $this->container = $container;
    }
    // index por convenção de laravel...
    public function index($request, $response, $args){
        $results = Article::all()->take(10);
        return $response->withJson($results, 200);
    }
    public function show($request, $response, $args){
        $results = Article::find($args['id']);
        return $response->withJson($results, 200);
    }
    public function create($request, $response, $args){
        
        // $emailValidator = v::email();
        // $nameValidator = v::alpha()->noWhitespace()->length(1, 50);
        // $passwordValidator = v::noWhitespace()->length(8, 50);
        

        // var_dump($usernameValidator->validate('alganet'));
        // die();

        // $validation = $this->validator->validate($request, [
        //     'email' => v::noWhiteSpace()->notEmpty(),
        //     'name' =>  v::noWhiteSpace()->notEmpty(),
        //     'password' =>  v::noWhiteSpace()->notEmpty()
        // ]);

        $data = $request->getParsedBody();
        $newUser = Article::firstOrCreate($data);
        return $response->withJson($newUser,200);
    }
    public function update($request, $response, $args){
        //ir buscar ao body do pedido a info do novo utilizador
        $user = Article::find($args['id']);
        $data = $request->getParsedBody();
        $user->name = $data['name'];
        $user->save();
        return $response->withJson($user, 200);
    }
    public function destroy($request, $response, $args){
        // funciona mas com erro
        $result = (bool)Article::destroy($args['id']);
        return $result->withJson($result, $result ? 200 : 400);
    }
}

