<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>SIEstágios - Página do Formador!</title>
    </head>

    <body>
        <h2> BEM-VINDO! </h2>
        <?php
            require('bd_estagios.php');
            $estagios = new Estagio;
            $estagios->Estagio();
            $estagios->listarEstagiosFormador();
        ?>
        <br>
        <a href="index.html">voltar ao menu</a>
    </body>
</html>