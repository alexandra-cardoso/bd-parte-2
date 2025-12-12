<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>SIEstágios- Listar Empresas</title></head>
    <body background=#ffffff>
        <p><h3>Listagem de empresas</h3></p>
        <?php
        require('bd_estagios.php');

        $produtos = new Estagio;
        $produtos->Estagio();
        $produtos->listarEmpresas();
        $produtos->fecharBDEstagios();
        ?>
        <br>
        <form action = porRamoDeAtividade.php>
            <input type=submit value="Listar Empresas por Ramo">
        </form>
        <form action=porLocalidade.php>
            <input type=submit value="Listar Empresas por Localidade">
        </form>

        <a href="menu.html">voltar ao menu</a>
    </body>
</html>