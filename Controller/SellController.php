<?php

require_once APP."Controller.php";


function sum($a, $b) {
//    echo "<p>{$a} + {$b} = ".($a+$b)."</p>";
    return floatval($a + $b);
}



class SellController extends Controller{     
  
    public function index(){
        parent::View('tosell',parent::model());
    }
    
    public function toSell(){
        parent::View('tosell',parent::model());
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
     
        header("Location: /".DOMAIN."/sell/tosell"); 
    }
    
    public function listar(){        
       $strSell = " SELECT
                        s.id as id,
                        sum(tpt.percentual) as totalitemtax,
                        s.date,
                        (p.unitvalue * sp.quantity)+((p.unitvalue * sp.quantity)*(sum(tpt.percentual)/100)) as totalItems
                        FROM sell as s
						left join sell_product as sp ON (sp.idsell = s.id )
                        inner JOIN product as p ON (sp.idproduct = p.id )                      
                        right join typeproduct as tp ON (tp.id = p.idtypeproduct)
                        left join typeproduct_taxation as tpt ON (tpt.idtypeproduct = tp.id)
                        left join taxation as t ON (t.id = tpt.idtaxation)
                        WHERE s.id IS NOT NULL
						GROUP BY s.id,p.id,sp.quantity--,tpt.percentual
						ORDER BY s.id; ";

        $sell=0;
        $data = null;
        
        foreach(parent::model()->findGeneric($strSell) as $sellObj ){
            
            if($sell   !=  $sellObj->id){
                $sell=$sellObj->id;
                $data[$sell] = $sellObj;
                $data[$sell]->total=0;
                $data[$sell]->totaltax=0;
            }
        
            $data[$sell]->totaltax = sum($data[$sell]->totaltax,$sellObj->totalitemtax);            
            $data[$sell]->total = sum($data[$sell]->total,$sellObj->totalitems);            
        }
        parent::View('listar',$data);
    }
    
    public function editar($id){        
        parent::View('editar',parent::model()->find($id['id']));
    }
    
    public function delete($id){
        parent::model()->delete($id['id']);
        parent::View('tosell',parent::model());
    }
}