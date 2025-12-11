<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>BD Loja - Listar</title>
    </head>
    <body background=#ffffff>
        <p><h3>Listagem de Estágios</h3></p>
        <?php
        require('bd_estagios.php');

        $estagios = new Estagio;
        $estagios->Estagio();
        $produtos->listarEstagios();
        $produtos->fecharBDEstagios();
        ?>
        <br>
        <a href="menu.html">voltar ao menu</a>
    </body>
</html>