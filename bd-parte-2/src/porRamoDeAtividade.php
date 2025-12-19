<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>SIEstagios - Listar Empresas</title>
        <link rel ="stylesheet" href="style.css">
    </head>
    <body>
        <div class = "box content-box">
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

            $estagios = new Estagio;
            $estagios->Estagio();
            if(isset($_GET['ramo_atividade']) && $_GET['ramo_atividade'] != '')
                $estagios -> listarEmpresasPorRamo($_GET['ramo_atividade']);
            else 
                $estagios->listarEmpresas();

            $estagios->fecharBDEstagios();
            ?>

            <br>
            <a href="index.html">voltar ao menu</a>
        </div>
    </body>
</html>