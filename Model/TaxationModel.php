<?php

require_once APP."Model.php";

class TaxationModel extends Model{
    
    public function insert(){
        $strInsert = "INSERT INTO ".$this->table. "  (name,description) VALUES (:name,:description)";

        DB::insert($strInsert,array($this->name,$this->description));
    }
    
    public function update($id){
        
    }
}