<?php

class DB{
	private static $instance;
	
	public static function getInstance(){
		if(!isset(self::$instance)){
			try{
                $strCon="pgsql:host=".DB_HOST."; dbname=".DB_NAME.";   user=".DB_USER." password=".DB_PASSWORD."; port=5433";
                
				self::$instance = new PDO($strCon);
//				self::$instance = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);

                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);				
			}catch(PDOException $e){
				echo "Erro de Conexão: " . $e->getMessage();
			}			
		}
		
		return self::$instance;
	}
	    
	public static function prepare($sqlquery){
		return self::getInstance()->prepare($sqlquery);
	}


	public static function execution($sqlQuery,$bindparams=array()){
			$stmt = self::prepare($sqlQuery);
			$stmt->execute($bindparams);
	}
    
	public static function insert($sqlquery,$bindparams=array()){
        $stmt = self::prepare($sqlquery);
		$stmt->execute($bindparams);		
	}
    
    public static function update($sqlquery,$bindparams=array()){
         $stmt = self::prepare($sqlquery);
		$stmt->execute($bindparams);		
	}
    
	public static function results($sqlquery){
		$stmt = self::prepare($sqlquery);
		$stmt->execute();
		return $stmt->fetchAll();
	}	

	public static function result($sqlquery){
		$stmt = self::prepare($sqlquery);
		$stmt->execute();
		return $stmt->fetch();
	}

	public static function getLastInsertId(){
		return self::getInstance()->lastInsertId();
	}
}
