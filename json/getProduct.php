<?php
    
$resSearch=array();
$strSearch="";

if( isset($_POST['searchProduct']) && !empty($_POST['searchProduct'])    ){
    require_once "../app/define.php";
    require_once "../app/Database.php";
    
    $strSearch=(is_numeric($_POST['searchProduct'])  ? 
                    "id = {$_POST['searchProduct']} "
                :
                     " name LIKE '%{$_POST['searchProduct']}%' "
                );
    
    $resSearch = DB::results("SELECT * FROM product WHERE {$strSearch}; ");
}else{    
    $resSearch = array('Err'=>'Acesso negado');
}

echo json_encode($resSearch);