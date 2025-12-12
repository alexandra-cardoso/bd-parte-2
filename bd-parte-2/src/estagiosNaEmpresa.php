<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>SIEstagios - Estagios na Empresa</title> </head>
    <body>
        <?php
        require('bd_estagios.php');

        if(isset($_GET['empresa_id'])) {
            $id = $_GET['empresa_id'];

            $estagios = new Estagio;
            $estagios->Estagio();
            $estagios->listarEstagiosDaEmpresa($id);
            $estagios->fecharBDEstagios();
        }

        ?>
    </body>
</html>