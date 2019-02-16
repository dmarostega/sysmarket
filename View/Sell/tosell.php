<!doctype html>
<html lang="pt-br">
    <head>
        <title> Sys Market  </title>
        <meta charset="utf-8">
        <meta name="author" content="Diogo Marostega de Oliveira   ">
        <meta name="description" content="Sistema para mercados">
        <meta name="keywords" content="mercado, sistema, vendas de produtos">
        <link  rel="stylesheet" type="text/css"  href="../view/css/personalite.css?version=12">
<!--        <link  rel="stylesheet" type="text/css"  href="http://localhost/market/view/css/personalite.css">-->
    </head>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>
    <script type="text/javascript">
        $(document).ready(function(){

             /*  end form submit event*/
            $(".btn-save").click(function(event){               
                if(!$("#tableSell").find('tbody > tr').length > 0){
                     event.preventDefault();
                     alert("Caixa Vazio!!");
                }
                
            });/*end btn-save funtion*/
            
            /*  limpa tudo  */
            $(".btn-cancel").click( function() {
                $("#inputSearch").empty();
                $("#resSearch").empty();
                $("#tableSell tbody").empty();             
                $("#tableSell tfoot").empty();             
                
            });/*end btn-cancel event*/
        
            $("#inputSearch").keyup(function(){ 
                
                if($("#inputSearch").val()!=""){
                    var data =  {searchProduct: $("#inputSearch").val()};

                    $.post( "http://localhost/market/json/getProduct.php",
                            data,                                                 
                            'json'
                      )
                    .done(function(response){
                        var resData = JSON.parse(response);
                        
                        if(parseInt(resData.length)>0){
                            $(".error").text('');
                            $("#resSearch").empty();
                            $.each(resData, function( index, value ) {
                               $("#resSearch").append("<div class='row row-search'>"+
                                                            "<div><p> "+value.id+"</p></div>"+
                                                            "<div ><p> "+value.name+"</p></div>"+
                                                            "<div>"+
                                                                "<input type='number' min='0' >"+
                                                                 "<button type='button' class='btn-insert-product'>"+
                                                                 "<span>Ins.</span></button>"+
                                                             "</div>"+
                                                        "</div>");  
                            }); 
                        }else{
                            $(".error").text("Nenhum produto encontrado!!");
                        }              
                    })
                    .fail(function(errdata){
                        alert('erro denovo');
                    })    
                    .always(function() { 
    //                    alert('complete');
                    });//end always; //End post

                }   /*  end if function empty*/
            }); /*  end keydown*/
      
            $('#resSearch').on('click', 'button', function() {
                var idProduct = $(this).parent().prev().prev().text().trim();
          /**/  var quantity =  $(this).prev().val();
                var name =  $(this).parent().prev().children().text();
                
                var hasElement = document.querySelector("#prod"+idProduct);
                if(hasElement!=null){
                    hasElement.remove();
                }
                
                if(childs != idProduct &&  quantity > 0){

                    var childs = $("#tableSell tbody tr#prod"+idProduct+"").children(":first-child").text();               
                    var data = {productID: idProduct, quantity: quantity };                
                    $.post( "http://localhost/market/json/getCalcSell.php",
                            data,                                                 
                            'json'
                      )
                    .done(function(response){
                        var resData = JSON.parse(response);
                        $("#tableSearch tbody").empty();
                        $.each(resData, function( index, value ) {
                            
                                $("#tableSell tbody").append("<tr id='prod"+idProduct+"'>" +
                                                    "<td>"+idProduct+"<input type='hidden' name='products[]' value='"+idProduct+"' ></td>"+
                                                    "<td>"+name.toUpperCase()+"</td>"+
                                                    "<td>"+quantity+"<input class='quantity' type='hidden' name='quantity["+idProduct+"]'   value='"+quantity+"' ></td>"+
                                                    "<td>"+parseFloat(value.totalproductvalue).toFixed(2)+"</td>"+                       
                                                    "<td class='quantityTax'>"+value.quantitytax+"</td>"+
                                                    "<td>"+parseFloat(value.totaltax).toFixed(2)+"% </td>"+
                                                    "<td class='totalitem'>"+parseFloat(value.totalitem).toFixed(2)+"</td>"+
                                                    "<td><button class='removeItem' type='button' >x</button></td>"+
                                                "</tr>"
                                               );
                        });   
                         $( "#inputSearch" ).focus();
                    })
                    .fail(function(errdata){
                        alert('Falha na comunicação!');
                    })    
                    .always(function() { 
                        $("#inputSearch").val("");                              
                        
                        var total=0;
                        var quantityTax=0;
                        var fullTotalTax=0;

                        $("#tableSell").find('tbody > tr').each(function(indice){
                            quantityTax = parseInt(quantityTax)   +   parseInt( $(this).find('td').eq(4).text() );
                            fullTotalTax = parseFloat(fullTotalTax)+parseFloat($(this).find('td').eq(5).text());
                            total = parseFloat(total)   +   parseFloat($(this).find('td').eq(6).text());                            
                    }); /*end tablesell find tr*/
                        
                            $("#fullTotalTax").text(fullTotalTax.toFixed(2).toString()+"%");
                            $("#tquantityTax").text(quantityTax.toString());
                            $("#fulltotal").text("R$ "+total.toFixed(2).toString());
                    });//end always; //End post
                     $("#searchProduct").val('');
                    $(this).parent().parent().remove();
                }

   
                
               
            }); /*  end table seach onclick*/
            $('#tableSell').on('click', 'button', function() {
                if( confirm(    'Remover o item ' + $(this).parent().prev().prev().text()   )==true ){
                   $(this).parent().parent().remove();
                        var total=0;
                        var quantityTax=0;
                        var fullTotalTax=0;
                    
                        $("#tableSell").find('tbody > tr').each(function(indice){
                            quantityTax = parseInt(quantityTax)   +   parseInt( $(this).find('td').eq(4).text() );
                            fullTotalTax = parseFloat(fullTotalTax)+parseFloat($(this).find('td').eq(5).text());
                            total = parseFloat(total)   +   parseFloat($(this).find('td').eq(6).text());         
                            
                            $("#quantityTax").text(quantityTax.toString()+"%");
                            $("#fullTotalTax").text(fullTotalTax.toString()+"%");
                            $("#fulltotal").text("R$ "+total.toString());
                        }); /*end tablesell find tr*/
                }
            }); /*  end tableSell onclick   */
            
        }); /*  end ready */
    </script>

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
                    <div class="col col-2-3">
                        <table id="tableSell" class="table table-clear"  border="1">
                            <caption>Caixa</caption>
                            <thead>
                                <tr>
                                    <td>Code</td>
                                    <td>Produto</td>
                                    <td>Quantidade</td>
                                    <td>Subtotal</td>
                                    <td>Qtd. Taxas</td>
                                    <td>Taxas</td>                                   
                                    <td>Total</td>
                                    <td>&nbsp;</td><!-- excluir -->
                                </tr>
                            </thead>
                            <tfoot>  
                                <tr>  
                                    <td colspan="4">&nbsp;</td>
                                    <td><span id="tquantityTax"></span></td>
                                    <td><span id="fullTotalTax" ></span></td>
                                    <td><span id="fulltotal"></span></td>
                                </tr>
                            </tfoot>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    <div class="col col-1-3"> 
                        
                        <div class="search">
                            <label>Adicionar Produtos: </label>
                            <input id="inputSearch" type="text" autocomplete="off" placeholder="Digite código ou nome do produto">
                            <span class="error"></span>
                        </div>
                        
                        <div id="resSearch">
                        
                        </div>
                   
                    </div>
                </div>
                
                <div class="buttons-box">
                    <button class="btn btn-save" type="submit" >Salvar</button>
                    <button class="btn btn-cancel"  type="button" >Cancelar</button>                
                </div>
            </form>            
        </main>
        <footer>
            <p>Copyright &copy; Diogo Marostega de Oliveira - 2019</p>
        </footer>
    </body>  
</html>