<!doctype html>
<html lang="pt-br">
    <head>
        <title> Sys Market  </title>
        <meta charset="utf-8">
        <meta name="author" content="Diogo Marostega de Oliveira   ">
        <meta name="description" content="Sistema para mercados">
        <meta name="keywords" content="mercado, sistema, vendas de produtos">
        <link  rel="stylesheet" type="text/css"  href="/view/css/personalite.css">
        <style>
            main{
                width: 90%;
                margin:auto;
            }
            form{
                width: 90%;
                margin: auto;
                padding: 15px;
            }
            
            label,div,input,select{
                display:block;
                width: 50%;
                margin: auto;
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
                        <input type="text" id="name" name="name" value="" placeholder="Nome do Produto" required>
                    </div>
                    <div class="col col-2">
                        <label for="description">Descrição</label>
                        <input type="text" id="description" name="description" value="" placeholder="Descrição do produto">

                        <label for="unitvalue">Valor Unitário</label>
                        <input type="text" id="unitvalue" name="unitvalue" value="" placeholder="Valor" required>
                        
                         <label for="quantity">Quantidade</label>
                        <input type="text" id="quantity" name="quantity" value="" placeholder="Quantidade estoque" required>
                    </div>
                </div>

                      
                <div class="row">
                    <div class="col col-2">
                        <label for="typeproduct">Categoria</label>
                        <select id="typeproduct" name="idtypeproduct" required>                    
                            <option value="0">Selecione</option>
                            <?php foreach(DB::results("SELECT * FROM public.typeproduct ORDER BY id ASC ") as $v){ ?>
                             <option value="<?php echo $v->id; ?>"><?php echo $v->name; ?></option>                    
                            <?php } ?>
                        </select>                                
                    </div>
                </div>
                
                <div class="buttons-box">
                    <button class="btn btn-save" type="submit" >Salvar</button>
                    <button class="btn btn-cancel" onclick="window.location.href='/<?php echo DOMAIN; ?>/product/listar'" type="button" >Cancelar</button>                
                </div>
            </form>            
        </main>
        <footer>
            <p>Copyright &copy; Diogo Marostega de Oliveira - 2019</p>
        </footer>
    </body>
</html>