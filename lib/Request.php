<?php

class Request {
    
    private static $controller;
    private static $action;
    private static $parameters;
    private static $url;
    
    public static function __constructor(){
        echo "<h4>Construct do request</h4>";
    }
    
    private static function init(){
        self::$url = $_SERVER["REQUEST_URI"];
        
        $blown=explode("/",self::$url);
        
        array_shift($blown); //Remove espaço em branco
        array_shift($blown); //remove dominio
        
        self::$controller=ucfirst(array_shift($blown));        
        self::$controller= (self::$controller == "" ? "Index" : self::$controller)."Controller";
        
        self::$action= array_shift($blown);
        self::$action= (self::$action == "" ? "index" : self::$action);
        
        if(strpos(self::$action,"?") ){
            $actionBlown=explode("?",self::$action);
            self::$action=array_shift($actionBlown);                  
            self::$parameters = explode("&",array_shift($actionBlown));
        }
            //self::$action = self::$action."Model";
        /*
        /venda?ola=111&dois=34
        */
    }
    
    public static function Controller(){
        self::init();
        return (self::$controller != NULL ? self::$controller : NULL );
    }    
    
    public static function Action(){
        return self::$action;
    }
    
    public static function Parameters(){
        return self::$parameters;
    }
    
}