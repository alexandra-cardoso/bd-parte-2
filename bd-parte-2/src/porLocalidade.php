<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>SIEstagios - Listar Empresas</title></head>
    <body background=#ffffff>
        <p><h3>Listagem de empresas por Localidade</h3></p>

        <br>
        <form action = "" method = "get"> 
            Localidade:
            <input type = "text" id = "localidade" name = "localidade">
            <input type = "submit" value = "Pesquisar">
        </form>
        <br>

        <?php
        require('bd_estagios.php');

        $produtos = new Estagio;
        $produtos->Estagio();
        //$produtos->listarProdutos();
        if(isset($_GET['localidade']) && $_GET['localidade'] != '')
            $produtos -> listarEmpresasPorLocalidade($_GET['localidade']);
        else 
            $produtos->listarEmpresas();

        $produtos->fecharBDEstagios();
        ?>

        <br>
        <a href="index.html">voltar ao menu</a>
    </body>
</html>