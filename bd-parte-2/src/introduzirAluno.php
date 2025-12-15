<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>SIEstágios - Introduzir novo Aluno</title>
    </head>

    <body bgcolor="#fcbce6ff">
        <p><h3>Introduzir novo Aluno:</h3></p>
        <form method="post" action="introduzir.php">
            <label for="utilizador_id">ID do utilizador do Aluno:</label><br/>
            <input type="text" name="utilizador_id" size="8" maxlength="8" required>
            <br>
            <label for="turma_id">ID da Turma:</label><br/>
            <textarea name="turma_id" cols="50" rows="3" required></textarea>
            <br>
                <input type="submit" name="Submit" value="Introduzir">
                <input type="reset" name="Submit2" value="Limpar">
        </p>
        </form>
        <p>&nbsp; </p>
    </body>
</html>
