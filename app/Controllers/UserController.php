<?php

namespace App\Controllers;
use Illuminate\Database\Capsule\Manager as Capsule;
use App\Models\User;

//validar cada um dos campos que estão a ser introduzidos (3 a 4 campus)
// se ocorrer algum erro enviar para os utilizadores
// encontrar uma package que valide

class UserController{
    protected $container;
    public function __construct($container)
    {
        $this->container = $container;
    }
    // index por convenção de laravel...
    public function index($request, $response, $args){
        //where (search)
        // limit

        // return 'users';
        // $results = Capsule::table('users')->get();
        $results = User::all();
        return $response->withJson($results, 200);
    }
    public function show($request, $response, $args){
        // $results = Capsule::table('users')->where('id', $args['id'])->get('name');
        $results = User::find($args['id']);
        return $response->withJson($results, 200);
    }
    public function create($request, $response, $args){
        $data = $request->getParsedBody();
        $newUser = User::firstOrCreate($data);
        return $response->withJson($newUser,200);
    }
    public function update($request, $response, $args){
        //ir buscar ao body do pedido a info do novo utilizador
        $user = User::find($args['id']);
        $user->name = 'boB Construtor';
        $user->save();
        return $response->withJson($user, 200);
    }
    public function destroy($request, $response, $args){
        $result = (bool)User::destroy($args['id']);
        return $result->withJson($result, $result ? 200 : 400);
    }
}
