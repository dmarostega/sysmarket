<?php

require "../app/define.php";
require BASE;
//$_POST['searchProduct'] = "1";
    
$resSearch=array();
$strSearch="";
if(isset($_POST['searchProduct']) ){
    
    $strSearch=$_POST['searchProduct'];
    
    $resSearch = DB::results("SELECT * FROM product WHERE id = {$strSearch} OR name LIKE '%{ $strSearch}%'");
}else{    
    $resSearch = array('Err'=>'Acesso negado');
}

echo json_encode($resSearch);