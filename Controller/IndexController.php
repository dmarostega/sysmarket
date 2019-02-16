<?php

require_once (APP.'Controller.php');

class IndexController extends Controller{
    
     public function index(){
            header("Location: /".DOMAIN."/sell/tosell"); 
    }
}
