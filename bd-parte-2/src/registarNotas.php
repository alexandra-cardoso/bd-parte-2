<?php 
    require('bd_estagios.php');
    $estagios = new Estagio;
    $estagios->Estagio();

    $aluno_cod = "";
    $emp_cod = "";
    $est_cod = "";
    if(isset($_POST['aluno_cod'])) { //a primeira vez que entra na página
        $aluno_cod = $_POST['aluno_cod'];
        $est_cod = $_POST['est_cod'];
        $emp_cod = $_POST['emp_cod'];
    }
    if(isset($_POST['botao'])) { //se for clicado para submeter as notas, é isso que fazemos
        $aluno_cod = $_POST['aluno_cod'];
        $emp_cod = $_POST['emp_cod'];
        $est_cod = $_POST['est_cod'];
        //atribuimos os valores às variáveis
        $nota_emp = $_POST['nota_emp'];
        $nota_esc = $_POST['nota_esc'];
        $nota_rel = $_POST['nota_rel'];
        $nota_proc = $_POST['nota_proc'];
        //esta função grava as notas na bd e calcula a nota final por lá também
        $estagios->atribuirNota($nota_emp, $nota_esc, $nota_rel, $nota_proc);
        $estagios->fecharBDEstagios();
    }
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>SIEstagios - Registar Notas</title>
    </head>
    <body background=#ffffff>
        <p><h3>Adicionar Notas aos Estágios</h3></p>
        <br>
        <p><b>Aluno:</b> <?php echo $aluno_cod;?> | <b>Empresa:</b><?php echo $emp_cod;?> | <b>Estabelecimento:</b> <?php echo $est_cod;?></p>
        <form action = "" method = post>
            <input type = hidden name = aluno_cod value = <?php echo $aluno_cod;?>>
            <input type = hidden name = emp_cod value = <?php echo $emp_cod;?>>
            <input type = hidden name = est_cod value = <?php echo $est_cod;?>>
            Nota da Empresa: <input type = "text" name = "nota_emp"><br>
            Nota da Escola: <input type = "text" name = "nota_esc"><br>
            Nota do Relatório: <input type = "text" name = nota_rel><br>
            Nota da Procura: <input type = "text" name = nota_proc><br> 
            <br>
            <input type = "submit" name = "botao" value = "Guardar Notas">
        </form>

        <br>
        <a href="formador.php">voltar ao menu</a>
    </body>
</html>