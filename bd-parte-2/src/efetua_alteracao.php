<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>BD Loja - Alterar</title>
    </head>
    <body bgcolor="#FFFFFF">

        <?php
        require('bdloja.php');
        $produtos = new ProdutosLoja;
        $produtos->ProdutosLoja();
        $produtos->alterarProduto($_POST["codigo"], $_POST["designacao"], $_POST["preco"]);
        $produtos->fecharBDProdutos();
        ?>
        <br>
        <p>Alteração efetuada com sucesso!</p>
        <br>
        <br>
        <a href="listar.php">voltar</a> | <a href="menu.html">voltar ao menu</a>

    </body>
</html>
