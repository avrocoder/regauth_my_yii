<?php
namespace models;

class User extends Model {
    
    public $login='';
    public $password='';
    public $surname='';
    public $name='';
    public $patronymic='';
    public $birthday='';
    public $location='';
    public $maritalStatus='';
    public $education='';
    public $experience='';
    public $phone='';
    public $email='';
    public $moreInformation='';
    public $photo='';
    
    protected function rules()
    {
        return [
            'required'=>['login','password','name','surname', 'patronymic','birthday','location',
                         'maritalStatus','education','experience','phone','email'
            ],
            'email'=>['email'],
            'date'=>['birthday'],
            'number'=>['experience'],
            'login'=>['login'],
            'minLength'=>['password','params'=>[6]],
            'exist'=>['login','email', 'params'=>['user']],
            'file'=>['photo', 'params'=>['maxsize'=>1048576,'extensions'=>'gif|jpg|png']],
        ];
    }
    public function __construct($scenario = null) {
        parent::__construct($scenario);
    }
    
    protected function labels()
    {
        return [
            'maritalStatus'=>'Marital status',
        ];
    }
    
    public function getModelFromDb($login)
    {
        $mysqli = \components\DB::connect(); 
        $login=$mysqli->real_escape_string($login);
        $result=$mysqli->query("SELECT * FROM `user` WHERE `login`= '{$login}'");
        if($result===false)
        {
            throw new \Exception('Error database query');
        }
        elseif($result->num_rows>0)
        {
            $class_vars = get_class_vars(get_class($this));
            while($record=$result->fetch_object())
            {
                foreach ($class_vars as $name => $value) {
                   if(isset($record->$name))
                        $this->$name=$record->$name;
                }
            }
            $result->close();
            
            return true;
        }
        else
        {   
            return false;
        }
    }
}
