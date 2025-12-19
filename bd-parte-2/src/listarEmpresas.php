<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>SIEstágios- Listar Empresas</title></head>
        <link rel ="stylesheet" href="style.css">
    <body>
        <div class = "box content-box">
            <p><h3>Listagem de empresas</h3></p>
            <?php
            require('bd_estagios.php');

            $estagios = new Estagio;
            $estagios->Estagio();
            $estagios->listarEmpresasComDisponibilidade(); //para o aluno, aparecem as empresas que têm disponibilidade
            $estagios->fecharBDEstagios();
            ?>
            <br>
            <form action = porRamoDeAtividade.php>
                <input type=submit value="Listar Empresas por Ramo">
            </form>
            <form action=porLocalidade.php>
                <input type=submit value="Listar Empresas por Localidade">
            </form>

            <a href="index.html">voltar ao menu</a>
        </div>
    </body>
</html>