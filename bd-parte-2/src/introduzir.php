<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>SIEstagios - Introduzir Aluno</title>
        <link rel ="stylesheet" href="style.css">
    </head>
    <body>
        <div class = "box menu-box">
            <?php
            require('bd_estagios.php');

            $estagios = new Estagio;
            $estagios->Estagio();
            $estagios->registarAluno($_POST["utilizador_id"], $_POST["turma_id"]);
            $estagios->fecharBDEstagios();
            ?>
            <br>
            <a href="index.html">voltar ao menu</a>
        </div>
    </body>
</html>