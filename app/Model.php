<?php
require_once BASE;

abstract class Model{
    
    public function __construct(){
        if(!isset($this->table)){
            $this->table = strtolower(str_replace("Model","",get_class($this)));
        }        
        //        echo "<p>in Model: ".$this->table."</p>";

        return $this->table;
    }
    
	abstract public function insert();
	abstract public function update($id);    
	abstract public function delete($id);    
    
    public function findAll(){                  
        return DB::results("SELECT * FROM ".$this->table);        
    }
    
    public function find($id){
        return DB::result("SELECT * FROM ".$this->table." WHERE id = ".intval($id).";");       
    }
    
    public function findFull($cols="*",$where="",$limit=""){
        $strSql="SELECT {$cols} FROM ".$this->table." ".$where." ".$limit;   
        return DB::results($strSql);
    }
    
    public function findGeneric($str){
        return DB::results($str);
    }
    
    public function getLastInsertId(){
        DB::getLastInsertId();
    }
}