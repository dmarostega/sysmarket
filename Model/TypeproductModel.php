<?php

require_once APP."Model.php";
//require_once ""

class TypeproductModel extends Model{
    
    public $tax = array();
    public $percentual = array();

    public function insert(){ 
//        var_dump($this->table);
        $strInsert = "INSERT INTO ".$this->table." (name,description) VALUES (:name,:description)";
        DB::insert($strInsert,array($this->name,$this->description));

        $strInsert = "INSERT INTO typeproduct_taxation (idtypeproduct, idtaxation, percentual) VALUES (:idtypeproduct,:idtaxation,:percentual)";

        foreach($this->tax as $k => $idTax){
              DB::insert($strInsert,array(DB::getLastInsertId(),$idTax,$this->percentual[$idTax]));
        }      
    }
   
    public function update($id){
        $strUpdate = "UPDATE ".$this->table." SET name = :name,description = :description, updated_at = :updated WHERE id = :id; ";
       
        DB::update($strUpdate,array(
                        $this->name,
                        $this->description,                        
                        date("Y-m-d"),
                        $id
                    )); 
    }
    
    public function delete($id){
        $strUpdate = "DELETE FROM ".$this->table." WHERE id = :id; ";        
        DB::execution($strUpdate,array($id));
    }  
    
    public function findForEdit(){
        
    }
}