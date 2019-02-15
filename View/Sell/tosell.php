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
        
        
            $("#searchProduct").keyup(function(){ 
                
                var data =  {searchProduct: $("#searchProduct").val()};
                
                $.post( "http://localhost/market/json/getProduct.php",
                        data,                                                 
                        'json'
                  )
                .done(function(response){
                    var resData = JSON.parse(response);
                    $("#tableSearch tbody").empty();
                    $.each(resData, function( index, value ) {
                       $("#tableSearch tbody").append("<tr>"+
                                                        "<td>"+value.id+"</td>"+
                                                        "<td><span>"+value.name+"</span></td>"+
                                                        "<td><input type='text' >"+
                                                             "<button type='button'><span>Inserir</span></button>"+
                                                        "</td>"+
                                                      "</tr>");  
                    });                     
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
            }); /*  end keydown*/
      
            $('#tableSearch').on('click', 'button', function() {
                var idProduct = $(this).parent().prev().prev().text();
          /**/  var quantity =  $(this).prev().val();
                var name =  $(this).parent().prev().children().text();
                
                
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
                                                    "<td>"+name+"</td>"+
                                                    "<td><input class='quantity' type='text' name='quantity["+idProduct+"]'   value='"+quantity+"' ></td>"+
                                                    "<td>"+value.totalproductvalue+"</td>"+
                                                    "<td>"+value.totaltax+"</td>"+
                                                    "<td class='quantityTax'>"+value.quantitytax+"</td>"+
                                                    "<td class='totalitem'>"+value.totalitem+"</td>"+
                                                    "<td><button type='button' > X </button></td>"+
                                                "</tr>"
                                               );
                        });                     
                    })
                    .fail(function(errdata){
                        alert('Falha na cominicação!');
                    })    
                    .always(function() { 
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
                            total = parseFloat(total)+parseFloat($(this).find('td').eq(6).text());
                            quantityTax = parseFloat(quantityTax)+parseFloat($(this).find('td').eq(5).text());
//                            alert(total);
                            $("#quantityTax").text(quantityTax.toString());
                            $("#fulltotal").text(total.toString());
                        }); /*end tablesell find tr*/
                        
    //                    alert('complete');
                    });//end always; //End post
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
                
                $("#searchProduct").val('');
                $(this).parent().parent().remove();
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
                <li>
                    <a href="#">Cadastros</a>
                    <ul>
                        <li><a href="/<?php echo DOMAIN;?>/product/cadastrar">Produtos</a></li>
                        <li><a href="/<?php echo DOMAIN;?>/typeproduct/cadastrar">Tipos de Produto</a></li>
                        <li><a href="/<?php echo DOMAIN;?>/taxation/cadastrar">Impostos</a></li>
                    </ul>
                </li>
                <li>
                    <a href="/<?php echo DOMAIN;?>/sell/">Vender</a>
                </li>                
            </ul>
        </nav>        
        <main>
            <form action="save" method="POST">
                <div class="row">
                    <div class="col-2">
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
                                </tr>
                            </thead>
                            <tfoot>  
<!--                                <tr></tr>-->
                                <tr>  <td colspan="5">&nbsp;</td>
                                    <td  ><span id="tquantityTax"></span></td>
                                    <td><span id="fulltotal"></span></td>
                                </tr>
                            </tfoot>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-2">                
                        <label>Digite Codigo ou Nome do Produto</label>
                        <input type="text" id="searchProduct" >
                         <table id="tableSearch" class="table table-clear" border="1">
                            <caption>Selecionar Produto</caption>
                            <thead>
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