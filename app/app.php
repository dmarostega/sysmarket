<?php

class App{
	//private static $url;
	//private static $exploded;
	private static $controller;
	private static $action;

	private function __construct(){
	}
	
	private static function init(){
		//self::getURL();
		//self::getExploded();
	}
/*	public static function getURL(){
		self::$url = $_SERVER['REQUEST_URI'];
	}

	public static function getExploded(){
		self::$exploded = array_filter(explode("/",self::$url) );
		self::$controller = (isset(self::$exploded[2]) ? ucfirst(self::$exploded[2]) : 'Index') . 'Controller';
		self::$action = (isset(self::$exploded[3]) ? self::$exploded[3] : 'index');
	} 
 * /
 */

	public static function getController(){
		return self::$controller;
	}

	public static function getURL(){
		return str_replace("Controller", "",get_class(self::$controller))."/";
	}

	public static function run(){	

			// session_start();

			/*
			echo "<pre>";
			var_dump($_SESSION);
			echo "</pre>";*/
			// Verifica se existe os dados da sessão de login 
			/*if(!isset($_SESSION["id_usuario"]) || !isset($_SESSION["nome_usuario"])) 
			{ 
			// Usuário não logado! Redireciona para a página de login 
			header("Location: ".LOCAL_HOST."user/login"); 
			exit; 
			}*/
		/*self::init();
		Request::init();*/
		
		self::$controller = Request::Controller();
		self::$action = Request::Action();

        
        
        /*
		session_start();

		if(!isset($_SESSION["id_usuario"]) || !isset($_SESSION["nome_usuario"])) 
			{ 
				self::$controller='UserController';
				self::$action='login';
			}
		*/
        
//        echo json_encode($_GET)
//	var_dump($_GET['k']);
        
        		if(isset($_GET["k"]) && strpos($_GET["k"],	"css/") ) {
                    echo substr($_GET['k'], strpos($_GET['k'], "css/" ) );
                    include substr($_GET['k'], strpos($_GET['k'], "css/" ) ) ;
                }elseif(isset($_GET["k"]) && strpos($_GET["k"],	"json") ) {

				// echo "<h3>In App action</h3>";
				// var_dump($_GET['k']); 	
			
				include substr($_GET['k'], strpos($_GET['k'], "/json" ) ) ;
// exit;
			}else{
//                        echo ("<p>".CONTROLLERS.self::$controller.".php AND ".$_SERVER["REQUEST_URI"]."</p>");

						if(file_exists(CONTROLLERS.self::$controller.".php" )){
								
							require_once(CONTROLLERS."/".self::$controller . ".php");
							self::$controller  = new self::$controller;
					
							if(method_exists(self::$controller,self::$action)){
								$action = self::$action;
								self::$controller->$action(Request::Parameters()/*(!empty(self::$exploded[4]) ? self::$exploded[4] : null)*/ );
							}elseif(isset($_GET["k"]) && strpos($_GET["k"],	"json") ) {

								// echo "<h3>In App action</h3>";
								// var_dump($_GET['k']);
								// exit;
								include substr($_GET['k'], strpos($_GET['k'], "/json" ) ) ;
								//echo $_GET['k']." ==>> ".substr($_GET['k'], strpos($_GET['k'], "/json" ) ) ;
								//echo "<BR><BR>".json_encode(array('liga','depois'));
							}else{
								echo "<p>Não existe essa Action</p>";
							}			
						}else{ 
							echo "<p> Não existe arquivo controller....</p><h3>".CONTROLLERS.self::$controller.".php </h3>";
						}
			} //else 'k'
	}
}