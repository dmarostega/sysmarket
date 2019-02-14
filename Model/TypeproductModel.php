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
        
//        echo "<p>".$strInsert."</p>";

        foreach($this->tax as $k => $idTax){
              DB::insert($strInsert,array(DB::getLastInsertId(),$idTax,$this->percentual[$idTax]));
        }      
    }
    
    public function update($id){        
    }
    
        


    
}