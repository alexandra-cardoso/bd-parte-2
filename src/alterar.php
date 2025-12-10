<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>BD Loja - Alterar</title>
  </head>

  <?php
  require('bdloja.php');
  $produtos = new ProdutosLoja;
  $produtos->ProdutosLoja();
  ?>
  
  <body bgcolor="#FFFFFF">
    <p><h3>Alterar um produto:</h3></p>
    <form method="post" action="efetua_alteracao.php">
      <label for="codigo">Código:<?php echo $_POST["codigo"]; ?></label>
      <input type=hidden name="codigo" value=<?php echo $_POST["codigo"]; ?>>
      <br/><br/>
      <label for="designacao">Designação:</label><br/>
      <textarea name="designacao" cols="50" rows="3"><?php echo $produtos->devolveDesignacao($_POST["codigo"]); ?></textarea>
      <br/><br/>
      <label for="preco">Preço:</label><br/>
      <input type="text" name="preco" size="20" maxlength="20" value="<?php echo $produtos->devolvePreco($_POST["codigo"]); ?>">
      <br/>
      <br/>
      <?php $produtos->fecharBDProdutos(); ?>
      <input type="submit" name="Submit" value="Alterar">
      <input type="reset" name="Submit2" value="Limpar">
    </form>
  </body>
</html>