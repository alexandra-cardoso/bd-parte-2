<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>SIEstágios - Apagar Estágio</title>
    </head>
    <body background=#ffffff>
        <p><h3>Apagar estágio </h3></p>

        <?php
        require('bd_estagios.php');
        $estagios = new Estagio;
        $estagios->Estagio();
        $estagios->apagarEstagio($_POST["emp_cod"], $_POST["est_cod"], $_POST["aluno_cod"]);
        $estagios->fecharBDEstagios();
        ?>
        
        <br>
        Estágio removido com sucesso!
        <br><br>
        <a href="listar.php">voltar</a> | <a href="menu.html">voltar ao menu</a>
    </body>
</html>
