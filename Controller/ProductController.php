<?php
require_once (APP.'Controller.php');

class ProductController extends Controller{
    
    public function index(){
        $data = parent::model()->findAll();
        parent::View('index',$data );
    }
    
    public function cadastrar(){
        parent::View('cadastrar',parent::model());
    }
    
    public function save($id="-1"){
        foreach($_POST as $k => $v){
            parent::model()->$k = $v;
        }
        
        if($id!="-1"){
            parent::model()->insert();
        }else{
            parent::model()->update($id);
        }
        
        header("Location: /".DOMAIN."/index"); 
    }
}