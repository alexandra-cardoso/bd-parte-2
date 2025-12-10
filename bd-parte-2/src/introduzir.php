<html>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <head>
        <title>BD Loja - Introduzir</title>
    </head>
    <body background=#ffffff>
        <?php
        require('bdloja.php');

        $produtos = new ProdutosLoja;
        $produtos->ProdutosLoja();
        $produtos->novoProduto($_POST["codigo"], $_POST["designacao"], $_POST["preco"]);
        $produtos->fecharBDProdutos();
        ?>
        <br>
        <a href="menu.html">voltar ao menu</a>
    </body>
</html>