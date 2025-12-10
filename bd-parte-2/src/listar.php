<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>BD Loja - Listar</title>
    </head>
    <body background=#ffffff>
        <p><h3>Listagem de produtos</h3></p>
        <?php
        require('bdloja.php');

        $produtos = new ProdutosLoja;
        $produtos->ProdutosLoja();
        $produtos->listarProdutos();
        $produtos->fecharBDProdutos();
        ?>
        <br>
        <a href="menu.html">voltar ao menu</a>
    </body>
</html>