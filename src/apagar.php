<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>BD Loja - Apagar</title>
    </head>
    <body background=#ffffff>
        <p><h3>Apagar produtos </h3></p>

        <?php
        require('bdloja.php');
        $produtos = new ProdutosLoja;
        $produtos->ProdutosLoja();
        $produtos->apagarProduto($_POST["codigo"]);
        $produtos->fecharBDProdutos();
        ?>
        
        <br>
        Produto removido com sucesso!
        <br><br>
        <a href="listar.php">voltar</a> | <a href="menu.html">voltar ao menu</a>
    </body>
</html>
