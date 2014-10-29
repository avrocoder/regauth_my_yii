<?php

namespace components;

class Config {
    
    private static $config=[
        'salt'=>'My secret salt',
        'defaultLanguage'=>'en',
        'indexPage'=>'site/index',
    ];
    
    public static function get($param)
    {
        return self::$config[$param];
    }
}
