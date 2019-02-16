<?php 
$tax = DB::results("SELECT * FROM taxation");

?>


<!doctype html>
<html lang="pt-br">
    <head>
        <title> Sys Market  </title>
        <meta charset="utf-8">
        <meta name="author" content="Diogo Marostega de Oliveira   ">
        <meta name="description" content="Sistema para mercados">
        <meta name="keywords" content="mercado, sistema, vendas de produtos">
         <link  rel="stylesheet" type="text/css"  href="../view/css/personalite.css">       
        
    <!--    <script type="text/javascript">
            window.onload = function(){
                $.ajax({
                    type:'POST',
                    dataType:'json',
                    url:'json/getTaxation.php',
                    
                }).done(function(response){
                    alert("oi");
        
                }).fail(function(data){
                        alert("ERR: "+data.statusText);
                    }); /*   end done function ajax    */
            }
        </script>
        -->
        
      <!--  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        -->
        
            
  <!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>-->
  <!--  <script type="text/javascript">
        $(document).ready(function(){            
             $('.chk').on('click', 'checkbox', function() {
                 aler('3333');
                 
             });
        });
        
        </script>  -->       
            
        <script type="text/javascript">
            
                 
                 
            function edinput(chkelement){
//                alert("===> "+chkelement.value+" == > "+document.getElementById("percentual_tax_"+chkelement.value));
                var inputElement =  document.getElementById("percentual_tax_"+chkelement.value);
                if(chkelement.checked == true){
                    inputElement.removeAttribute("disabled"); 
                    inputElement.style.backgroundColor="white";
                    inputElement.style.borderColor="black";
                    inputElement.setAttribute("required","required");   
                    inputElement.focus();
                }else{
//                   element.value    
                    inputElement.value="";
                    inputElement.style.backgroundColor="#eee";
                    inputElement.style.borderColor="";

                   inputElement.setAttribute("disabled","disabled");
                   inputElement.removeAttribute("required");                                                        
                }
               
                
                
             
                /*
                    chkelement.id
                    chkelement.name
                    chkelement.className                
                    
                    chkelement.outerHTML
                    chkelement.innerHTML
                */
  /*              var input = document.createElement('input');
                    input.setAttribute("type","text");                   
                    input.setAttribute("class","chk chk-tax");
                    input.setAttribute("name","percenual_"+chkelement.id);

               chkelement.append("<input type='text' />"); */
//               chkelement.appendChild(input); 
//               chkelement.appendChild("<input type='text' name='percentual_"+chkelement.value+"' value=''>"); 
//               alert(   chkelement.className         ) ;
                
                
                
            }
        </script>
        <style>
          form{
                width: 90%;
                margin: auto;
                padding: 15px;
            }
            label,div,input:not(".chk"){
                display:block;
                width: 50%;
            }
        </style>
        
    </head>
    <body>
          <nav>
            <ul>
                <li class="drop-down">
                    <a href="#">Cadastros</a>
                    <ul>
                        <li>
                            <a href="/<?php echo DOMAIN;?>/product/cadastrar">Produtos</a>
                        </li>
                        <li>
                            <a href="/<?php echo DOMAIN;?>/typeproduct/cadastrar">Tipos de Produto</a>
                        </li>
                        <li>
                            <a href="/<?php echo DOMAIN;?>/taxation/cadastrar">Impostos</a>
                        </li>
                    </ul>
                </li>
           
                <li  class="drop-down">
                    <a href="#">Listagens</a>
                    <ul>
                        <li>
                            <a href="/<?php echo DOMAIN;?>/product/listar">Produtos</a>
                        </li>
                        <li>
                            <a href="/<?php echo DOMAIN;?>/typeproduct/listar">Tipos de Produto</a>
                        </li>
                        <li>
                            <a href="/<?php echo DOMAIN;?>/taxation/listar">Impostos</a>
                        </li>
                    </ul>                       
                </li>   
                <li  class="drop-down">
                        <a href="/<?php echo DOMAIN;?>/sell/">Vender</a>  
                        <ul>
                            <li>
                                <a href="/<?php echo DOMAIN;?>/sell/listar">Listagem</a>
                            </li>
                        </ul>
                    </li>                 
            </ul>
        </nav>            
        <main>
            <form action="save" method="POST">
                
                <div class="row">
                    <div class="col col-2">                    
                        <label for="id">Código</label>
                        <input type="text" id="id" name="id" value="" readonly>

                        <label for="name">Nome:</label>
                        <input type="text" id="name" name="name" value="" placeholder="Tipo de Produto" required>
                    </div>
                    
                    <div class="col col-2">
                        <label for="description">Descrição</label>
                        <input type="text" id="description" name="description" value="" placeholder="Descrição ">   
                    </div>
                    <div class="row">
                        <div class="col">
                           
<!--                            
                            <select multiple style="width: 100%; overflow:auto;">
                                <option>item 1</option>
                                <option>item 1</option>
                                <option>item 1</option>
                                <option>item 1</option>
                                <option>item 1</option>
                                <option>item 1</option>
                            </select>
                            
                            <select name="tax[]" multiple>
                                
                                <?php //foreach($tax as $k => $v){ ?>
                                <option value="" >
                                    <span> <?php// echo $v->name;?> </span>
                                    <input type="text" class="inputChk" id="percentual_tax_<?php// echo $v->id; ?>" name="percentual[<?php// echo $v->id; ?>]"  disabled />
                                </option>
                                <?php// } ?>                                    
                            </select>
                            -->
                            
                       
                            
                            <label for="taxation">Selecionar Impostos:</label>
                            <div id="taxation">
                                <?php $cont=0;
//                                echo "<div class='row'>";
//                                    echo "<div class='col col-2' >";
                                    foreach($tax as $k => $v){ 
                                        $cont++;

                                 /*   echo ($cont ==  4 ? "</div>" :"");                                        
                                    echo ($k % 4==0 ? "<div class='row'>" :"");
                                    echo ($cont ==  2 ? "</div>" :"");                                        
                                    echo ($k % 2==0 ? "<div class='col col-2'>" :"");*/
//                                              echo ($cont ==  4 ? "</div><div class='row'>" :""); 
//                                    echo ($cont ==  2 ? "</div><div class='col col-2'>" :""); 
                                   
                                        
                                    if($cont == 4){
                                        $cont=0;    
                                    }
                                ?>
                                <div class="taxItem">
                                    <label>                        
                                        <input type="checkbox" onclick="edinput(this)" class="chk chk-tax" name="tax[]" value="<?php echo $v->id;?>" >
                                        <span > <?php echo $v->name;?> </span>
                                        <input type="text" class="inputChk" id="percentual_tax_<?php echo $v->id; ?>" name="percentual[<?php echo $v->id; ?>]"  disabled />
                                    </label>  
                                </div>
                            <?php 
                          
                                
                                        
                                        
                                         $cont++;
//                                    echo ($k % 4==0 ? "</div>" :"");

                                } 
//                                echo "</div></div>";
                                
                            ?>                
                            </div>
                        </div>
                    </div>
                
                </div>
                
              
                
                

                
                <div class="buttons-box">
                    <button class="btn btn-save" type="submit" >Salvar</button>
    <!--                <button class="btn btn-reset" type="reset" >Limpar</button>-->
                    <button class="btn btn-cancel"  onclick="window.location.href='/<?php echo DOMAIN; ?>/typeproduct/listar'" type="button" >Cancelar</button>                
                </div>
            </form>            
        </main>
        <footer>
            <p>Copyright &copy; Diogo Marostega de Oliveira - 2019</p>
        </footer>
    </body>
</html>