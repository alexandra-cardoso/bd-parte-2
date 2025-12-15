<html>
<head>
    <meta charset="UTF-8">
    <title>SIEstágios - Alterar Estágio</title>
</head>

<?php
    require('bd_estagios.php');
    $estagios = new Estagio;
    $estagios->Estagio();

    if (isset($_POST['atualizar'])) { //se submeter o pedido para atualizar
        $aluno_id = $_POST['aluno_cod'];
        $old_emp = $_POST['old_emp'];
        $old_est = $_POST['old_est'];
        
        $novo_emp = $_POST['nome_emp'];
        $novo_est = $_POST['nome_estab'];
        $nova_data = $_POST['data_inicio'];

        $estagios->atualizarEstagio($aluno_id, $old_emp, $old_est, $novo_emp, $novo_est, $nova_data);
    }
    $aluno_id = $_POST['aluno_cod'];
    $emp_atual = $_POST['emp_cod'];
    $est_atual = $_POST['est_cod'];
    $data_atual = $_POST['data_ini'];
?>

<body style="background-color: #f6c0e9ff;"> 
    <h2>Alterar um Estágio</h2>
    
    <form action="" method="post">
        <input type = hidden name = old_aluno value = <?php echo $aluno_id;?>>
        <input type = hidden name = old_emp value = <?php echo $emp_atual;?>>
        <input type = hidden name = old_est value = <?php echo $est_atual;?>>

        <label>Aluno ID:</label>
        <?php echo $aluno_id; ?>
        <br><br>

        <label>Empresa:</label><br>
        <input type=text name=nome_emp value=<?php echo $emp_atual; ?>>
        <br/><br/>

        <label>Estabelecimento:</label><br>
        <input type=text name=nome_estab value=<?php echo $est_atual; ?>>
        <br/><br/>

        <label>Data de Início:</label><br>
        <input type=date name=data_inicio value=<?php echo $data_atual; ?>>
        <br/><br/>
        <?php $estagios->fecharBDEstagios();?>

        <input type="submit" name="atualizar" value="Alterar">
        <input type="reset" name="limpar" value="Limpar">
        
        <a href="gestao.php"><input type="button" value=Cancelar></a>
    </form>

</body>
</html>