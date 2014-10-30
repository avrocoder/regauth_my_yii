<?php session_start();
ini_set('display_errors',1);
error_reporting (E_ALL);
set_exception_handler("exception_handler");

    if (isset($_GET['r']))
    {
        $route=$_GET['r'];
    }
    else
    {
        $route='user/registration';
    }

$route=str_replace('/','\\',$route);
preg_match('/(.*)\\\\(.*)/', $route, $matches);
$class='controllers\\' . ucfirst(strtolower($matches[1])).'Controller';
$method='action' . $matches[2];

if(class_exists($class) && method_exists($class, $method))
{
    $controller=new $class;
    call_user_func([$controller, $method]);
}
else 
{
    throw new Exception('The route is invalid');
}



function __autoload($class) {
  $class = str_replace('\\', '/', $class) . '.php';
  if (file_exists($class))
  {
      require_once($class);
  }
}

function exception_handler($exception) {
  echo $exception->getMessage();
}