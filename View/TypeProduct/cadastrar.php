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
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <!--  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        -->
        <script type="text/javascript">
            function edinput(chkelement){
//                alert("===> "+chkelement.value+" == > "+document.getElementById("percentual_tax_"+chkelement.value));
                document.getElementById("percentual_tax_"+chkelement.value).removeAttribute("disabled");
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
  
        
    </head>
    <body>
        <nav>
            <ul>
                <li>
                    <a href="index">Cadastros</a>
                    <ul>
                        <li>Produtos</li>
                        <li>Tipos de Produto</li>
                        <li>Impostos</li>
                    </ul>
                </li>
                <li>
                    <a href="vendas">Vender</a>
                </li>                
            </ul>
        </nav>        
        <main>
            <form action="save" method="POST">
                <label for="id">Código</label>
                <input type="text" id="id" name="id" value="code" readonly>
                
                <label for="name">Nome:</label>
                <input type="text" id="name" name="name" value="" placeholder="Nome do Produto">
                
                <label for="description">Descrição</label>
                <input type="text" id="description" name="description" value="" placeholder="Descrição do produto">   
                
                <label for="taxation">Selecionar Impostos</label>
                <div id="taxation">
                    <?php foreach($tax as $k => $v){ ?>
                    <label>                        
                        <input type="checkbox" onclick="edinput(this)" class="chk chk-tax" name="tax[]" value="<?php echo $v->id;?>" >
                        <span> <?php echo $v->name;?> </span>
                        <input type="text" class="inputChk" id="percentual_tax_<?php echo $v->id; ?>" name="percentual[<?php echo $v->id; ?>]"  disabled />
                    </label>                    
                    <?php } ?>                
                </div>

                
                <button type="submit" >Salvar</button>
                <button type="reset" >Limpar</button>
                <button type="button" class="btn btn-cancel">Cancelar</button>
            </form>            
        </main>
        <footer>
            <p>Copyright &copy; Diogo Marostega de Oliveira - 2019</p>
        </footer>
    </body>
</html>