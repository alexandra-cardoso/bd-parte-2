<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>SIEstagios - Listar Empresas</title>~
        <link rel ="stylesheet" href="style.css">
    </head>

    <body>
        <div class = "box content-box">
            <p><h3>Listagem de empresas por Localidade</h3></p>

            <br>
            <form action = "" method = "get"> Localidade:
                <input type = "text" id = "localidade" name = "localidade">
                <input type = "submit" value = "Pesquisar">
            </form>
            <br>

            <?php
            require('bd_estagios.php');

            $estagios = new Estagio;
            $estagios->Estagio();
            if(isset($_GET['localidade']) && $_GET['localidade'] != '')
                $estagios -> listarEmpresasPorLocalidade($_GET['localidade']);
            else 
                $estagios->listarEmpresasComDisponibilidade();

            $estagios->fecharBDEstagios();
            ?>

            <br>
            <a href="index.html">voltar ao menu</a>
        </div>
    </body>
</html>