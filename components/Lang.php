<?php

namespace components;

class Lang {
    
    private static $_object=null;
    private $_language=null;
    private $_messages=[];
    
    
    private function __construct() 
    {
    }
    
    public static function getInstance()
    {
        if (self::$_object === null)
        {
            self::$_object=new Lang();
        }
        
        self::$_object->afterInstance();
        return self::$_object;
    }
    
    private function afterInstance()
    {
        if(!isset($_SESSION['lang']))   
        {
            $lang=\components\Config::get('defaultLanguage');
            $_SESSION['lang']=$lang;
            self::$_object->_language=$lang;
        }
        else
        {
            self::$_object->_language=$_SESSION['lang'];
        }
    }
    
    public function setLanguage($lang)
    {
        $_SESSION['lang']=$lang;
        self::$_object->_language=$lang;
    }

    public static function t($category,$message)
    {
        if (!isset(self::$_object->_messages[$category]))
        {
            $messages=self::$_object->getMessagesFromFile($category);
            self::$_object->_messages[$category]=eval($messages);
        }
        
        return self::$_object->getMessage($category,$message);
    }
    
    private function getMessagesFromFile($category)
    {
        $filename=dirname(__FILE__) . "/../messages/" . self::$_object->_language . '/' . $category . '.php';
        if(file_exists($filename))
        {
            $messages=file_get_contents($filename);
            return $messages;
        }
        else
        {
            throw new \Exception('File not found: ' . $filename);
        }
    }
    
    private function getMessage($category,$message)
    {
        if (isset($this->_messages[$category][$message]))
        {
            return $this->_messages[$category][$message];
        }
        else
        {
            return $message;
        }
    }
    
    public static function getLanguage()
    {
        return self::$_object->_language;
    }

        private function __clone() 
    {
    }
}
