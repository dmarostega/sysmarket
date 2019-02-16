<?php

/*  DATABASE    */
define("DB_HOST","localhost");
define("DB_NAME","marketDB");
define('DB_USER',"postgres");
define("DB_PASSWORD","hd3Pnx");

define('BASE',dirname(__FILE__)."/Database.php");

/*  MVC */
define("MODELS",dirname(__FILE__)."/../Model/");
define("CONTROLLERS",dirname(__FILE__)."/../Controller/");
define("VIEWS",dirname(__FILE__)."/../View/");

/*  Library's   */
define("LIB","lib/");
define("APP","app/");

define("DOMAIN","market");

define('LOCAL_HOST','http://localhost/'.DOMAIN.'');
//define('LOCAL_HOST','http://'.$_SERVER['HTTP_HOST'].'/'.DOMAIN.'/');
define('LAYOUT',LOCAL_HOST.'');
