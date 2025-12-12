<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>SIEstagios - Registar Notas</title>
    </head>
    <body background=#ffffff>
        <p><h3>Adicionar Notas aos Estágios</h3></p>
        <br>
        <form action = "" method = post>
            Nota da Empresa: <input type = "text" name = "nota_emp"><br>
            Nota da Escola: <input type = "text" name = "nota_esc"><br>
            Nota do Relatório: <input type = "text" name = nota_rel><br>
            Nota da Procura: <input type = "text" name = nota_proc><br> 
            <br>
            <input type = "submit" name = "botao">
        </form>

        <?php
        if(isset($_POST['botao'])) { //apenas se for submetido
            require('bd_estagios.php');

            //atribuimos os valores às variáveis
            $nota_emp = $_POST['nota_emp'];
            $nota_esc = $_POST['nota_esc'];
            $nota_rel = $_POST['nota_rel'];
            $nota_proc = $_POST['nota_proc'];

            $estagios = new Estagio;
            $estagios->Estagio();
            $estagios->atribuirNota($nota_emp, $nota_esc, $nota_rel, $nota_proc);
            $estagios->fecharBDEstagios();
        }
        ?>
        <br>
        <a href="menu.html">voltar ao menu</a>
    </body>
</html>