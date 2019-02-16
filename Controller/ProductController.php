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
      /*var_dump(*///$id = intval($id['id'])/*)*/;
        
        //$id=$id['id'];
//        exit;
    //    var
//           var_dump("CONTROLLER",$id);exit;

        foreach($_POST as $k => $v){
            parent::model()->$k = $v;
        }
        if($id==NULL){
            parent::model()->insert();
        }else{
            parent::model()->update(intval($id["id"]));
        }        
        header("Location: /".DOMAIN."/Product/listar"); 
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