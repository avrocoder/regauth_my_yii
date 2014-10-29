<?php
namespace models;

class Login extends Model {
    
    public $login='';
    public $password='';
    public $message='';

    public function __construct($scenario = null) {
        parent::__construct($scenario);
    }
    
    protected function rules()
    {
        return [
            'required'=>['login','password'],
        ];
    }
    
    public function login()
    {
        $user= new \components\UserIdentity;
        $result=$user->login($this->login, $this->password);
        if($result===false)
            $this->message='Incorrect login or password';
        return $result;
    }
   
}
