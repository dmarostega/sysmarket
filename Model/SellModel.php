<?php

require_once APP."Model.php";

class SellModel extends Model{
    
    public $products = array();
    public $quantity = array();

    public function insert(){ 
        
        $strInsert = "INSERT INTO ".$this->table." (date) VALUES(:date)";
        DB::insert( $strInsert,array(date("Y-m-d")  ));

        $strInsert = "INSERT INTO sell_product (idsell, idproduct, quantity) VALUES (:idsell,:idproduct,:quantity)";
        foreach($this->products as $k => $idProduct){
            DB::insert($strInsert,array(DB::getLastInsertId(),$idProduct,$this->quantity[$idProduct]));
        }      
    }
    
   
    public function update($id){
    }
    
    public function delete($id){
        $strUpdate = "DELETE FROM ".$this->table." WHERE id = :id; ";        
        DB::execution($strUpdate,array($id));
    }
}
