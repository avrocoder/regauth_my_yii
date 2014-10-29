<?php

namespace components;

class DB {
    
    public static function connect()
    {
        $mysqli=new \mysqli('localhost', 'root', '12345678', 'tz1');
        if (mysqli_connect_errno()) 
        { 
            throw new Exception("Connection error. Error code: " . mysqli_connect_error()); 
        }
        
        return $mysqli;
    }
            
}
