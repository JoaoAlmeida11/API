<?php

namespace App\Validation;

use Respect\Validation\Validator as Respect;
use Respect\Validation\Exceptions\NestedValidationException;

class Validator{
    protected $errors = [];

    public function validate($request, array $rules){


        // $validation->validate($request, [
        //     'email' => v::noWhiteSpace()->notEmpty(),
        //     'name' =>  v::noWhiteSpace()->notEmpty(),
        //     'password' =>  v::noWhiteSpace()->notEmpty()
        // ]);

        foreach ($rules as $field => $rule) {
            try{
                $rule->setName($field)->assert($request->getParam($field));
            } catch (NestedValidationException $e){
                $this->errors[$field] = $e->getMessages();
            }
        }
        return $this->errors;
    }
       
     public function failed(){
            return !empty($this->errors);
        }
      public function errors(){
          return $this->errors;
     }
    
}