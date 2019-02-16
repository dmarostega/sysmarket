<?php
    
$resSearch=array();
$strSearch="";
/*    
$_POST['productID'] =18;
$_POST['quantity'] =10;*/
    
if( isset($_POST['productID']) && !empty($_POST['productID'])  &&
    isset($_POST['quantity']) && !empty($_POST['quantity'])
  ){
    require_once "../app/define.php";
    require_once "../app/Database.php";
    
    $where= " WHERE ". (is_numeric($_POST['productID'])  ? 
                    "p.id = {$_POST['productID']} "
                :
                     ""
                );
    $strSql = "SELECT 
                    p.name productName,
                    p.unitvalue productValue,
                    p.unitvalue * {$_POST['quantity']} as totalProductValue,
                    tpt.percentual as percentualItem,
                    tpt.percentual * {$_POST['quantity']} as totalTax,
                    p.unitvalue * {$_POST['quantity']} + tpt.percentual * {$_POST['quantity']} as totalItem
                FROM product as p
                        right join typeproduct as tp ON (tp.id = p.idtypeproduct)
                        left join typeproduct_taxation as tpt ON (tpt.idtypeproduct = tp.id)
                        left join taxation as t ON (t.id = tpt.idtaxation)
                 {$where}
                        ;";
    
    /*
        productID
        typeproductID -> 
        taxation    
    */
    
    $aux= DB::results($strSql);

    $resSearch[0]["productname"] = $aux[0]->productname;
    $resSearch[0]["productvalue"] = $aux[0]->productvalue;
    $resSearch[0]["totalproductvalue"] = $aux[0]->totalproductvalue;
//    $resSearch["percentualItem"][$k] = $aux[0]->percentualitem;
    $resSearch[0]["totaltax"] = 0;
    $resSearch[0]["totalitem"] = 0;
    $resSearch[0]["quantitytax"] = 0;
    
    
    
    foreach($aux as $k => $v){
        $resSearch[0]["percentualitem"][$k] = $v->percentualitem;
        $resSearch[0]["totaltax"] += $v->totaltax;   
         $resSearch[0]["quantitytax"]++;
    }
      $resSearch[0]["totalitem"]   += $resSearch[0]["totalproductvalue"]  + ($resSearch[0]["totalproductvalue"] * ($resSearch[0]["totaltax"])/100);
    
    
//    $resSearch["totaltax"] = $aux[0]->totaltax;
//    $resSearch[0] = $aux[0]->totalitem;
}else{    
    $resSearch = array('Err'=>'Acesso negado');
}
echo json_encode($resSearch);