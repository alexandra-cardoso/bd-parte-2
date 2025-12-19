<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>SIEstagios - Listar Empresas</title></head>
    <body background=#ffffff>
        <p><h3>Listagem de empresas por Ramo de Atividade</h3></p>

        <br>
        <form action = "" method = "get"> 
            Ramo de Atividade:
            <input type = "text" id = "ramo_atividade" name = "ramo_atividade">
            <input type = "submit" value = "Pesquisar">
        </form>
        <br>

        <?php
        require('bd_estagios.php');

        $produtos = new Estagio;
        $produtos->Estagio();
        //$produtos->listarProdutos();
        if(isset($_GET['ramo_atividade']) && $_GET['ramo_atividade'] != '')
            $produtos -> listarEmpresasPorRamo($_GET['ramo_atividade']);
        else 
            $produtos->listarEmpresas();

        $produtos->fecharBDEstagios();
        ?>

        <br>
        <a href="index.html">voltar ao menu</a>
    </body>
</html>