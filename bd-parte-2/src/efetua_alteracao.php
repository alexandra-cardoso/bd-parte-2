<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>BD Loja - Alterar</title>
    </head>
    <body bgcolor="#f9d3e9ff">

        <?php
        require('bd_estagios.php');
        $estagio = new Estagio;
        $estagio->Estagio();
        $estagio->alterarProduto($_POST["codigo"], $_POST["designacao"], $_POST["preco"]);
        $estagio->fecharBDEstagios();
        ?>
        <br>
        <p>Alteração efetuada com sucesso!</p>
        <br>
        <br>
        <a href="listar.php">voltar</a> | <a href="menu.html">voltar ao menu</a>

    </body>
</html>
