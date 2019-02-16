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
        <script type="text/javascript">                 
            function edinput(chkelement){
                var inputElement =  document.getElementById("percentual_tax_"+chkelement.value);
                if(chkelement.checked == true){
                    inputElement.removeAttribute("disabled"); 
                    inputElement.style.backgroundColor="white";
                    inputElement.style.borderColor="black";
                    inputElement.setAttribute("required","required");   
                    inputElement.focus();
                }else{
                    inputElement.value="";
                    inputElement.style.backgroundColor="#eee";
                    inputElement.style.borderColor="";
                    inputElement.setAttribute("disabled","disabled");
                    inputElement.removeAttribute("required");                                                        
                }
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
            <form action="save?id=<?php echo $data->id; ?>" method="POST">
                
                <div class="row">
                    <div class="col col-2">                    
                        <label for="id">Código</label>
                        <input type="text" id="id"  value="<?php echo $data->id;?>" readonly>

                        <label for="name">Nome:</label>
                        <input type="text" id="name" name="name" value="<?php echo $data->name;?>" placeholder="Tipo de Produto" required>
                    </div>
                    
                    <div class="col col-2">
                        <label for="description">Descrição</label>
                        <input type="text" id="description" name="description" value="<?php echo $data->description;?>" placeholder="Descrição ">   
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="taxation">Selecionar Impostos:</label>
                            <div id="taxation">
                                <?php $cont=0;
                                    foreach($tax as $k => $v){ 
                                ?>
                                <div class="taxItem">
                                    <label>                        
                                        <input type="checkbox" onclick="edinput(this)" class="chk chk-tax" name="tax[]" 
                                               value="<?php echo $v->id;?>" >
                                        <span > <?php echo $v->name;?> </span>
                                        <input type="text" class="inputChk" id="percentual_tax_<?php echo $v->id; ?>" 
                                               name="percentual[<?php echo $v->id; ?>]"  disabled />
                                    </label>  
                                </div>
                            <?php  }    ?>                
                            </div>
                        </div>
                    </div>                
                </div>
                <div class="buttons-box">
                    <button class="btn btn-save" type="submit" >Salvar</button>
    <!--                <button class="btn btn-reset" type="reset" >Limpar</button>-->
                    <button class="btn btn-cancel" onclick="window.location.href='/<?php echo DOMAIN; ?>/typeproduct/listar'" type="button" >Cancelar</button>                
                </div>
            </form>            
        </main>
        <footer>
            <p>Copyright &copy; Diogo Marostega de Oliveira - 2019</p>
        </footer>
    </body>
</html>