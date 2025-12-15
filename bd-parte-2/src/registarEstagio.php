<?php
    require('bd_estagios.php');

    $estagios = new Estagio;
    $estagios->Estagio();
    if(isset($_POST['salvar'])) {
        $id_estab = $_POST['estab_id'];
        $id_emp = $_POST['emp_id'];
        $data_inicio = $_POST['data_inicio'];
        $aluno_id = $_POST['aluno_id'];
        $formador_id = $_POST['formador_id'];

        $estagios->novoEstagio($id_estab, $id_emp, $data_inicio, $aluno_id, $formador_id);
    }
?>
<html>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <head><title>SIEstágios - Introduzir Estágio</title>
    </head>

    <body background=#fcbce6ff>
        <p><h3>Registar novo estágio:</h3></p>
        <form action = "registarEstagio.php" method=post>
            ID do Estabelecimento: <input type=text name = estab_id><br>
            ID da Empresa: <input type=text name = emp_id><br>
            Data de Início do Estágio: <input type=text name = data_inicio><br>
            ID do Aluno: <input type=text name = aluno_id><br>
            ID do Formador: <input type=text name = formador_id><br>
            <input type=submit name = salvar value = "Guardar Estágio">
        </form>
        <br>
        <a href="gestao.php">voltar ao menu</a>
    </body>
</html>