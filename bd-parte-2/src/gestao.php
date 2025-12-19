<?php //isto trata quando é apagado um estágio
    require('bd_estagios.php');
    $estagios = new Estagio;
    $estagios->Estagio();

    if(isset($_POST['apagar'])) {
        $estagios->apagarEstagio($_POST['emp_cod'],$_POST['est_cod'], $_POST['aluno_cod']);
    }
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>SIEstágios - Gestão de Estágios</title>
        <link rel ="stylesheet" href="style.css">
    </head>

    <body>
        <div class = "box content-box">
            <h2> Gestão de Estágios </h2>
            <form method = "post" action="registarEstagio.php">
                <input type=submit value="Adicionar Novo Estágio">
            </form>

            <?php
                $lista = $estagios->listarEstagios();
            ?>
            <br>
            <a href="index.html">voltar ao menu</a>
        </div>
    </body>
</html>