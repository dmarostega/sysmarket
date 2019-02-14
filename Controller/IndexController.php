<?php

require_once (APP.'Controller.php');

class IndexController extends Controller{
    
     public function index(){
        echo "<h3>".get_class($this)."</h3>";
    }
}
