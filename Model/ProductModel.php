<?php

require_once APP."Model.php";

//require_once BASE;

class ProductModel extends Model{

    public function insert(){

        $strInsert = "INSERT INTO ".$this->table." (name,description,unitvalue, quantity, idtypeproduct) VALUES (:name,:description,:unitvalue, :quantity, :idtypeproduct); ";
        
        DB::insert($strInsert,array(
            $this->name,
            $this->description,
            $this->unitvalue,
            $this->quantity,
            $this->idtypeproduct
        ));
        
    }
    
    public function update($id){
        
    }
}