<?php

require_once APP."Model.php";
//require_once ""

class SellModel extends Model{
    
    public $products = array();

    public function insert(){ 

        $strInsert = "INSERT INTO ".$this->table." (name,description) VALUES (:name,:description)";
        DB::insert($strInsert,array($this->name,$this->description));

        $strInsert = "INSERT INTO sell_product (idtypeproduct, idtaxation, percentual) VALUES (:idtypeproduct,:idtaxation,:percentual)";
        
        foreach($this->$products as $k => $idProduct){
              DB::insert($strInsert,array(DB::getLastInsertId(),$idProduct,$this->percentual[$idTax]));
        }      
    }
    
    public function update($id){        
    }
    
        


    
}