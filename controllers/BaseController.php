<?php

namespace controllers;

class BaseController {
    
    public function render($view,$data=null)
    {
        if($data!==null)
        {
            extract($data);
        }
        
        $controller=get_called_class();
        //cuts 'Controller' and makes letters small
        $dir=strtolower(preg_replace('/^.*\\\\(.*)Controller$/', '$1', $controller));
        $path=dirname(__FILE__).'/../views/' . $dir . '/' . $view . '.php';
        if(file_exists($path))
        {
            include(dirname(__FILE__).'/../views/' . $dir . '/' . $view . '.php');
        }
        else
        {
            throw new \Exception("View '{$view}' was not found");
        }
    }
    
    public function redirect($route)
    {
        if ($route==='back')
        {
            header('Location:' . $_SERVER['HTTP_REFERER']);
        }
        else
        {
            header("Location: http://" . $_SERVER['HTTP_HOST'] . '?r=' . $route);
        }
                
    }
    
    public static function t($category,$message)
    {
        $lang=\components\Lang::getInstance();
        return $lang::t($category,$message);
    }
    
}

