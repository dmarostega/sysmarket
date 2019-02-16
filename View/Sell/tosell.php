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
        
            /*            
            <div class="search">
                            <label>Digite sua busca: </label>
                            <input id="inputSearch" type="text" >
                        </div>
                        <div id="serachRes">            
            */
            
//            $("form").submit(function(){});
                
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
//            $("#searchProduct").keyup(function(){ 
//                alert('sisi');
                
                if($("#inputSearch").val()!=""){
                    var data =  {searchProduct: $("#inputSearch").val()};
    //                var data =  {searchProduct: $("#searchProduct").val()};

                    $.post( "http://localhost/market/json/getProduct.php",
                            data,                                                 
                            'json'
                      )
                    .done(function(response){
                        var resData = JSON.parse(response);
                        
                        
//                        alert("Redata: "+resData.length);


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


                     /*   $("#tableSearch tbody").empty();
                        $.each(resData, function( index, value ) {
                           $("#tableSearch tbody").append("<tr>"+
                                                            "<td>"+value.id+"</td>"+
                                                            "<td><span>"+value.name+"</span></td>"+
                                                            "<td><input type='text' >"+
                                                                 "<button type='button'><span>Inserir</span></button>"+
                                                            "</td>"+
                                                          "</tr>");  
                        });   */                  
                    })
                    .fail(function(errdata){
                        alert('erro denovo');
                    })    
                    .always(function() { 
    //                    alert('complete');
                    });//end always; //End post

                
                
//                alert($("#searcProduct").val());
            /*   $.ajax({
                    type:'post',
                    dataType:'json',
                    url:'json/getProduct.php',
                    data:{searchProduct: $("#searcProduct").val()}                                    
                })  // end ajax
                .done(function(){ 
                    alert("oi");
                })// end done
                .fail(function(failData){
                    $.each( failData, function( key, val ) {
                    alert( "<li id='" + key + "'>" + val.length + "</li>" );
                  });
                })//  end fail    
                .always(function() { 
                
                });//end always
                */ 
                }   /*  end if function empty*/
            }); /*  end keydown*/
      
            $('#resSearch').on('click', 'button', function() {
                var idProduct = $(this).parent().prev().prev().text().trim();
          /**/  var quantity =  $(this).prev().val();
                var name =  $(this).parent().prev().children().text();
                
                var hasElement = document.querySelector("#prod"+idProduct);
//                alert("RES: ["+idProduct+"]"+el);
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
                            
//                            alert(typeof parseFloat(value.totalproductvalue) );
                            
                            
                                $("#tableSell tbody").append("<tr id='prod"+idProduct+"'>" +
                                                    "<td>"+idProduct+"<input type='hidden' name='products[]' value='"+idProduct+"' ></td>"+
                                                    "<td>"+name.toUpperCase()+"</td>"+
                                                    "<td>"+quantity+"<input class='quantity' type='hidden' name='quantity["+idProduct+"]'   value='"+quantity+"' ></td>"+
                                                    "<td>"+parseFloat(value.totalproductvalue).toFixed(2)+"</td>"+
                                                    "<td>"+parseFloat(value.totaltax).toFixed(2)+"</td>"+
                                                    "<td class='quantityTax'>"+value.quantitytax+"</td>"+
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

                         ///*alert(*/$("#tableSell tbody:last-child").children().children(":last-child").prev().css('background','red');
                       // alert($("#tableSell tbody:last-child").children().children(":last-child").prev().lenght());
                  /*
                  
                  function ocultar() {
  var table = $('table.grid');
  var i = 0;
  table.find('tbody > tr').each(function() {
    if ($(this).find('td').eq(4).text() == '') {
      $(this).hide();
    } else {     
        $(this).find('td').eq(0).text(++i);
    }
  });
}*/      
                        
                        var total=0;
                        var quantityTax=0;
                        $("#tableSell").find('tbody > tr').each(function(indice){
                           // alert(indice+" --> "+$(this).find('td').eq(6).text());
                            total = parseFloat(total)   +   parseFloat($(this).find('td').eq(6).text());
                            quantityTax = parseFloat(quantityTax)   +   parseFloat($(this).find('td').eq(5).text());
                            
                            $("#quantityTax").text(quantityTax.toFixed(2).toString());
                            $("#fulltotal").text(total.toFixed(2).toString());
                        }); /*end tablesell find tr*/
                        
    //                    alert('complete');
                    });//end always; //End post
                     $("#searchProduct").val('');
                    $(this).parent().parent().remove();
                }

                
                
                
//                alert('Child: '+childs+' --> '+idProduct);
//                if(childs != idProduct &&  quantity > 0){
               /* $("#tableSell tbody").append("<tr id='prod"+idProduct+"'>" +
                                                "<td>"+idProduct+"<input type='hidden' name='products[]' value='"+idProduct+"' ></td>"+
                                                "<td>"+name+"</td>"+
                                                "<td><input class='quantity' type='text' name='quantity["+idProduct+"]'   value='"+quantity+"' ></td>"+
                                                "<td><button type='button' > X </button></td>"+
                                            "</tr>"
                                           );*/
//                }
                
               
            }); /*  end table seach onclick*/
            $('#tableSell').on('click', 'button', function() {
                if( confirm(    'Remover o item ' + $(this).parent().prev().prev().text()   )==true ){
                   $(this).parent().parent().remove();
                    var total=0;
                        var quantityTax=0;
                        $("#tableSell").find('tbody > tr').each(function(indice){
                            total = parseFloat(total)+parseFloat($(this).find('td').eq(6).text());
                            quantityTax = parseFloat(quantityTax)+parseFloat($(this).find('td').eq(5).text());
                            $("#quantityTax").text(quantityTax.toString());
                            $("#fulltotal").text(total.toString());
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
                    <a href="/<?php echo DOMAIN;?>/sell/">Vender</a>                   
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
                                    <td>Taxas</td>
                                    <td>Qtd. Taxas</td>
                                    <td>Total</td>
                                    <td>&nbsp;</td>
                                </tr>
                            </thead>
                            <tfoot>  
                                <tr>  
                                    <td colspan="5">&nbsp;</td>
                                    <td  ><span id="tquantityTax"></span></td>
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
                      <!--   <table id="tableSearch" class="table table-clear" border="1">
                            <caption>Selecionar Produto</caption>
                            <thead>
                                <div class="search">
                                    <label>Digite Codigo ou Nome do Produto</label>
                                    <input type="text" id="searchProduct" placeholder="Digite Codigo ou Nome do Produto" >
                                </div>
                                <tr>
                                    <td>Code</td>
                                    <td>Produto</td>
                                    <td>Quantidade</td>
                                    <td>Total</td>
                                </tr>
                            </thead>
                            <tfoot>
                              
                            </tfoot>
                            <tbody>

                            </tbody>
                        </table>-->
                    </div>
                </div>
                
                <div class="buttons-box">
                    <button class="btn btn-save" type="submit" >Salvar</button>
    <!--                <button class="btn btn-reset" type="reset" >Limpar</button>-->
                    <button class="btn btn-cancel"  type="button" >Cancelar</button>                
                </div>
            </form>            
        </main>
        <footer>
            <p>Copyright &copy; Diogo Marostega de Oliveira - 2019</p>
        </footer>
    </body>  
</html>