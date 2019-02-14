<!doctype html>
<html lang="pt-br">
    <head>
        <title> Sys Market  </title>
        <meta charset="utf-8">
        <meta name="author" content="Diogo Marostega de Oliveira   ">
        <meta name="description" content="Sistema para mercados">
        <meta name="keywords" content="mercado, sistema, vendas de produtos">
    </head>
    <style>
        *{
            padding:0;
            margin:0;
        }
        
        .row{
            width: 100%;
            
        }
        
        .col-2{
            width: 50%;
            border: 1px solid black;
            float: left;
            box-sizing: border-box;
        }
        
    </style>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
        
            $("#searcProduct").keydown(function(){                
//                alert($("#searcProduct").val());
                $.ajax({
                    type:'post',
                    dataType:'json',
                    url:'json/getProduct.php',
                    data:{searchProduct: $("#searcProduct").val()}                                    
                })  /* end ajax*/
                .done(function(){ 
                    alert("oi");
                })/* end done*/
                .fail(function(failData){
                    alert("Err[JSON] : "+failData[0]);
                })/*  end fail    */
                .always(function() { 
                
                });/*end always*/
            }); /*  end keydown*/
        }); /*  end ready */
    </script>

    <body>
        <nav>
            <ul>
                <li>
                    <a href="#">Cadastros</a>
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
                <div class="row">
                    <div class="col-2">
                        <table class="table table-clear">
                            <caption>Caixa</caption>
                            <thead>
                                <tr>
                                    <td>Code</td>
                                    <td>Produto</td>
                                    <td>Quantidade</td>
                                    <td>Total</td>
                                </tr>
                            </thead>
                            <tfoot></tfoot>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-2">                
                        <label>Digite Codigo ou Nome do Produto</label>
                        <input type="text" id="searcProduct" >
                        <button type="button">Procurar</button>
                        
                         <table class="table table-clear">
                            <caption>Selecionar Produto</caption>
                            <thead>
                                <tr>
                                    <td>Code</td>
                                    <td>Produto</td>
                                    <td>Quantidade</td>
                                    <td>Total</td>
                                </tr>
                            </thead>
                            <tfoot></tfoot>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
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