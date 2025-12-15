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
    <title>Gestão de Estágios</title>
</head>

<body>
    <div class="menu-box">
        <h2> Gestão de Estágios </h2>
        <form method = "post" action="registarEstagio.php">
            <input type=submit value="Adicionar Novo Estágio">
        </form>

        <?php
            $lista = $estagios->listarEstagios();
        ?>

    </div>
    <br>
    <a href="menu.html">voltar ao menu</a>
</body>
</html>