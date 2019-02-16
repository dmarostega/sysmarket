<?php

require_once APP."Controller.php";

class TypeproductController extends Controller{    
 
    public function cadastrar(){        
        parent::View('cadastrar',parent::model());
    }
    
    public function index(){
        parent::View('index',parent::model());
    }
    
    public function save($id="-1"){    
        foreach($_POST as $k => $v){
            parent::model()->$k = $v;
        }
        if($id==NULL){
            parent::model()->insert();
        }else{
            parent::model()->update(intval($id["id"]));
        }    
        
        header("Location: /".DOMAIN."/Typeproduct"); 
    }
       
    public function listar(){
        parent::View('listar',parent::model()->findAll());
    }
    
    public function editar($id){        
        
        parent::View('editar',parent::model()->find($id['id']));
    }
    
    public function delete($id){
        parent::model()->delete($id['id']);
        parent::View('listar',parent::model()->findAll());
    }
}