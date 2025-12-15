<html>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <head><title>BD Loja - Introduzir</title>
        </head>
    <body background=#ffffff>
        <?php
        require('bd_estagios.php');

        $estagios = new Estagio;
        $estagios->Estagio();
        $estagios->registarAluno($_POST["utilizador_id"], $_POST["turma_id"]);
        $estagios->fecharBDEstagios();
        ?>
        <br>
        <a href="menu.html">voltar ao menu</a>
    </body>
</html>