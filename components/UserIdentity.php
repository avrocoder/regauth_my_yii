<?php
namespace components;

class UserIdentity {
    
    public function login($login, $password)
    {
        $mysqli = \components\DB::connect(); 
        $select=$mysqli->prepare("SELECT `password` FROM `user` WHERE `login`=  ?");
        $select->bind_param('s', $login);
        $result=$select->execute();
        $select->store_result();
        if($result===false)
        {
            throw new \Exception('Error database query');
        }
        elseif($select->num_rows>0)
        {
            $select->bind_result($colPassword);
            while($select->fetch())
            {
                $hashdb=$colPassword;
            }
            $select->close();
            $result=$hashdb==$this->hash($password, \components\Config::get('salt'));
            if ($result===true)
            {
                self::setUserLogin($login);
            }
            return $result;
        }
        else
        {   
            return false;
        }
    }
    
    public static function hash($password,$salt)
    {
        return md5($salt . $password . $salt);
    }
    
    public static function getUserLogin()
    {
        if(isset($_SESSION['user_login']))
            return $_SESSION['user_login'];
        else
            return null;
    }
    
    public static function setUserLogin($login)
    {
        $_SESSION['user_login']=$login;
        return true;
    }
    
    public static function logout()
    {
        unset($_SESSION['user_login']);
        return true;
    }
}
