<?php

namespace App\Controllers;
use Illuminate\Database\Capsule\Manager as Capsule;
use App\Models\User;
use Respect\Validation\Validator as v;
use App\Validation\Validator;


//validar cada um dos campos que estão a ser introduzidos (3 a 4 campus)
// se ocorrer algum erro enviar para os utilizadores
// encontrar uma package que valide

class UserController{
    protected $container;
    public function __construct($container){
        $this->container = $container;
    }
    // index por convenção de laravel...
    public function index($request, $response, $args){
        //where (search)
        // $results = Capsule::table('users')->get();
        $results = User::all()->take(10);
        return $response->withJson($results, 200);
    }
    public function show($request, $response, $args){
        // $results = Capsule::table('users')->where('id', $args['id'])->get('name');

        $results = User::find($args['id']);
        return $response->withJson($results, 200);
    }
    public function create($request, $response, $args){

        $validation = new Validator();

        $validation->validate($request, [
            'email' => v::noWhiteSpace()->notEmpty(),
            'name' =>  v::noWhiteSpace()->notEmpty(),
            'password' =>  v::noWhiteSpace()->notEmpty()
        ]);

        if($validation->failed() === true){
            return $response->withJson($validation->errors(), 400);
        }

        $data = $request->getParsedBody();
        $newUser = User::firstOrCreate($data);
        return $response->withJson($newUser,200);
    }
    public function update($request, $response, $args){
        //ir buscar ao body do pedido a info do novo utilizador
        $user = User::find($args['id']);
        $data = $request->getParsedBody();
        $user->name = $data['name'];
        $user->save();
        return $response->withJson($user, 200);
    }
    public function destroy($request, $response, $args){
        // funciona mas com erro
        $result = (bool)User::destroy($args['id']);
        return $response->withJson([
            "message" => result ? "Utilizador apagado" : "Utilizador não existe"
        ], $result ? 200 : 400);
    }
    
}
