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
         $strUpdate = "UPDATE ".$this->table." SET name = :name,description = :description,unitvalue = :unitvalue, quantity = :quantity, idtypeproduct = :idtypeproduct, updated_at = :updated WHERE id = :id; ";
       
//        var_dump($id);exit;
        DB::update($strUpdate,array(
                        $this->name,
                        $this->description,
                        $this->unitvalue,
                        $this->quantity,
                        $this->idtypeproduct,
                        date("Y-m-d"),
                        $id
                    ));
    }
    
    public function delete($id){
        $strUpdate = "DELETE FROM ".$this->table." WHERE id = :id; ";        
        DB::execution($strUpdate,array($id));
    }
}