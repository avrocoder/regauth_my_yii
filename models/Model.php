<?php
namespace models;

class Model {
    
    // validation errors[name_attr=>[err_msg1,err_msg2,...,err_msgN]]
    private $_errors=[];
    // validation rules[func=>[attr1,attr2,...,attrN]]
    protected $_rules=[];
    //current scenario, for example 'registration','login' etc.
    protected $_scenario='';
    
    public function __construct($scenario=null) 
    {
        if($scenario!==null)
            $this->_scenario=$scenario;
        
        $this->_rules=$this->rules();
    }
    
    protected function rules()
    {
        return [];
    }
    
    protected function labels()
    {
        return [];
    }
    
    private function getLabel($attribute)
    {
        return array_key_exists($attribute, $this->labels()) ? $this->labels()[$attribute] : $attribute;
    }


    public function hasErrors($attribute=null)
    {
        if($attribute===null)
            return $this->_errors!==array();
        else
            return isset($this->_errors[$attribute]);
    }
    
    public function getErrors($attribute=null)
    {
        if($attribute===null)
        {
            return $this->_errors;
        }
        else
        {
            return isset($this->_errors[$attribute]) ? $this->_errors[$attribute] : array();
        }
    }
    
    public function setAttributes($values)
    {
        foreach($values as $key=>$value)
        {
            if(isset($this->$key))
            {
                $this->$key=$value;
            }
        }
    }
    
    public function validate()
    {
        foreach ($this->_rules as $method=>$attributes) 
        {
            foreach($attributes as $attribute)
            {
                //if found params ($attribute==[params=>[value]])
                if (is_array($attribute)) continue;
                
                if (array_key_exists('params',$attributes))
                    $params=[$attribute,$this->$attribute,$attributes['params']];
                else
                    $params=[$attribute,$this->$attribute];
                        
                if (call_user_func_array([$this, $method . 'Validation'],$params)===false)
                {
                    throw new \Exception('Does not exist method ' . $method . 'Validation');
                }
            }
        }
        
        return !$this->hasErrors();
    }
    
    public function getError($attribute)
    {
        $errors=$this->getErrors($attribute);
        $message='';
        foreach ($errors as $value) 
        {
            $message.=\controllers\BaseController::t('error', $value) . '. ';
        }
        return $message;
    }
    
    private function addError($attribute, $message)
    {
        $this->_errors[$attribute][]= \controllers\BaseController::t('error',$message);
    }

    private function requiredValidation($attribute, $value)
    {
        $message="Field '{$this->getLabel($attribute)}' is empty";
        if (empty($this->$attribute))
        {
            $this->addError($attribute, $message);
        }
    }
    
    private function emailValidation($attribute, $value)
    {
        $message="Field '{$this->getLabel($attribute)}' is not e-mail";
        if (!preg_match('/^[-0-9a-z_\.]+@[-0-9a-z^\.]+\.[a-z]{2,4}$/i', $value))
        {
            $this->addError($attribute, $message);
        }
    }
    
    private function dateValidation($attribute, $value)
    {
        $message="Field '{$this->getLabel($attribute)}' is not date";
        if (!preg_match('/(0[1-9]|[12][0-9]|3[01])[- \\/\\\\.](0[1-9]|1[012])[- \\/\\\\.](19|20)\d\d/', $value))
        {
            $this->addError($attribute, $message);
        }
    }
    
    public function numberValidation($attribute, $value)
    {
        $message="Field '{$this->getLabel($attribute)}' is not numbler";
        if(!is_numeric($value))
        {
            $this->addError($attribute, $message);
        }
    }
    
    public function loginValidation($attribute, $value)
    {
        $message="Field '{$this->getLabel($attribute)}' contains forbidden characters";
        if(!preg_match('/^[a-zA-Z][a-zA-Z0-9-_\.]*$/', $value))
        {
            $this->addError($attribute, $message);
        }
    }
    
    public function minLengthValidation($attribute, $value, array $params)
    {
        $length=$params[0];
        $message="Field length '{$this->getLabel($attribute)}' must be at least " . $length . " symblols";
        if (strlen($value) < $length)
        {
            $this->addError($attribute, $message);
        }
    }
    
    public function existValidation($attribute, $value, array $params)
    {
        $message="Such '{$attribute}' already exist";
        $table=$params[0];
        $mysqli=\components\DB::connect();
        $select=$mysqli->query("SELECT `id` FROM `{$table}` WHERE `{$attribute}`='$value'");
        if($select===false)
        {
            throw new \Exception('Query error to the database');
        }
        if ($select->num_rows>0)
            $this->addError($attribute, $message);
    }
    
    public function fileValidation($attribute, $value, array $params)
    {
        if(empty($this->_scenario))
            throw new \Exception ("Unknown scenario for file validation");
        
//        if(isset($_FILES[$this->_scenario]['name'][$attribute]))
//        {
            //var_dump($_FILES[$this->_scenario]['name'][$attribute]);
//            $this->$attribute['name']=$_FILES[$this->_scenario]['name'][$attribute];
//            $this->$attribute['tmp_name']=$_FILES[$this->_scenario]['tmp_name'][$attribute];
//            $this->$attribute['size']=$_FILES[$this->_scenario]['size'][$attribute];
//        }
        if(isset($_FILES[$this->_scenario]['name'][$attribute]))
        {
            if(isset($params['maxsize']))
            {
                $maxsize=$params['maxsize'];
                $message="File size '{$attribute}' is more than " . $maxsize / 1048576 ." MB";
                if($_FILES[$this->_scenario]['size'][$attribute]>$params['maxsize'])
                    $this->addError($attribute, $message);
            }
        
            if(isset($params['extensions']))
            {
                $extensions=$params['extensions'];
                $message="Invalid file extension for file '{$attribute}'";
                
                $filename=$_FILES[$this->_scenario]['name'][$attribute];
                $preg=preg_match("/\.(?:{$extensions})$/i", $filename, $matches);
                if($preg===false)
                {
                    throw new \Exception ("Error in the extension lists");
                }
                if(!$preg)
                {
                    $this->addError($attribute, $message);
                }
            }  
        }
        
    }    
    
}
