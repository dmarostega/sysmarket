<!doctype html>
<html lang="pt-br">
    <head>
        <title> Sys Market  </title>
        <meta charset="utf-8">
        <meta name="author" content="Diogo Marostega de Oliveira   ">
        <meta name="description" content="Sistema para mercados">
        <meta name="keywords" content="mercado, sistema, vendas de produtos">
    </head>
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
                <label for="id">Código</label>
                <input type="text" id="id" name="id" value="code" readonly>
                
                <label for="name">Nome:</label>
                <input type="text" id="name" name="name" value="" placeholder="Nome do Produto">
                
                <label for="description">Descrição</label>
                <input type="text" id="description" name="description" value="" placeholder="Descrição do produto">
                
                <label for="unitvalue">Valor Unitário</label>
                <input type="text" id="unitvalue" name="unitvalue" value="" placeholder="Valor">
                
                <label for="quantity">Quantidade</label>
                <input type="text" id="quantity" name="quantity" value="" placeholder="Quantidade estoque">
                
                <label for="typeproduct">Categoria</label>
                <select id="typeproduct" name="idtypeproduct">                    
                    <option value="0">Selecione</option>
                    <?php foreach(DB::results("SELECT * FROM public.typeproduct ORDER BY id ASC ") as $v){ ?>
                     <option value="<?php echo $v->id; ?>"><?php echo $v->name; ?></option>                    
                    <?php } ?>
                </select>                                
                
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