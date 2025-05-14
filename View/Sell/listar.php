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
            <?php ?>
            <table class="table">
                <thead></thead>
                <tfoot>     
                </tfoot>
                <tbody>
                   <?php 
                        $totalValorDeVendas=0;
                        $totalTaxaDeVendas=0;
                    
                        foreach($data as $k => $seller){ ?>
                        <tr id="edit_<?php echo $seller->id?>">                       
                            <td><?php echo $seller->id?></td>
                            <td><?php echo $seller->date?></td>
                            <td><?php echo $seller->totaltax?>%</td>
                            <td>R$ <?php echo  number_format($seller->total, 2, ',', '.'); ?></td>
                            <td>
                                <a type="button" class="btn btn-cancel" href="delete?id=<?php echo $seller->id; ?>"  ><span>Excluir</span></a>                                
                            </td>
                        </tr>
                    <?php   
                                $totalValorDeVendas+=$seller->total;
                                $totalTaxaDeVendas=$seller->totaltax;
                            }                    
                    ?>   
                </tbody>
            </table>
            <div class="row">
                <div class="col col-2-3">
                </div>
                <div class="col col-1-3 ">
                        <span>Total: <?php echo number_format($totalValorDeVendas, 2, ',', '.'); ?></span>
                </div>
                
            </div>
        </main>
        <footer>
            <p>Copyright &copy; Diogo Marostega de Oliveira - 2019</p>
        </footer>
    </body>
</html>