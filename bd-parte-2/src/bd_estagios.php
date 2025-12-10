<?php
/**Esta classe gere as operações realizadas sobre uma base de dados de uma
Loja virtual.*/

class Estagios {
  /**Variável da classe que permite guardar a ligação à base de dados.*/
  var $conn;

  /**Função para ligar à BD da Loja
   @return Um valor indicando qual o resultado da ligação à base de dados.*/
   function ligarBD() {
      #$this->conn = mysqli_connect("localhost", "root", "", "yloja");
      $this->conn = mysqli_connect("mariadb", "root", "maria", "yloja");
	  if(!$this->conn){
		return -1;
	  }
	}
 
 /**Executa um determinado comando SQL, retornando o seu resultado.  
 @param sql_command Comando SQL a ser executado pela função
 @return O resultado do comando SQL.*/
  function executarSQL($sql_command) {
    $resultado = mysqli_query( $this->conn, $sql_command);
    return $resultado;
 }
 
 /**Devolve o número de registos de uma determinada tabela numa base de dados
 @param tabela O nome da tabela onde se deseja verificar o numero de registos.
 @return O numero de registos da tabela.*/
 function numeroTuplos($tabela) {
    $tuplos=0;
	  $rs=$this->executarSQL("SELECT * FROM $tabela");
	  return mysqli_num_rows($rs);  
 }
 
 /**Fecha a ligação à base de dados*/
 function fecharBD() {
	mysqli_close($this->conn);
 }

}


/**Esta classe implementa a gestão de produtos na base de dados da Loja. Permite
efectuar toda uma série de operações sobre a tabela de produtos, nomeadamente
operações de introdução, remoção, consulta e alteração de produtos.*/

class Estagio extends Estagios {
 /**Esta variável da classe é responsável pelas operações directas na Base de dados.*/
 var $db_estagio;
 /**Inicializa os produtos da loja, e as variáveis da classe.*/
 
 function AlunosEstagio() {
    $this->db_estagio = new Estagios;
	$this->db_estagio->ligarBD(); 
 }
 
 /**Permite a introdução de um novo produto na base de dados.
 @param codigo O codigo do novo produto a introduzir.
 @param designação A designação do novo produto a introduzir.
 @param preco O preço do novo produto a introduzir.*/
 
 function novoEstagio($estabelecimento_empresa_id, $estabelecimento_id, $aluno_id, $formador_id) {
    $sql = "INSERT INTO estagio VALUES ($estabelecimento_empresa_id, $estabelecimento_id, $aluno_id)";
    $this->db_estagio->executarSQL($sql);
 }
 
 /**Apaga um determinado produto da base de dados.
 @param codigo O codigo do produto a apagar.*/
 function apagarEstagio($estabelecimento_empresa_id, $estabelecimento_id, $aluno_id) {
 $sql = "DELETE FROM estagio WHERE estabelecimento_empresa_id = $estabelecimento_empresa_id AND estabelecimento_id = $estabelecimento_id AND aluno = $aluno_id";
 $this->db_estagio->executarSQL($sql);
 }

/**Altera um determinado produto na base de dados
  @param codigo O codigo do produto a ser alterado
  @param designacao A nova designacao do produto
  @param preco O novo preço do produto.*/
  
  function alterarEstagio($codigo, $designacao, $preco) {
  $sql = "UPDATE produto SET designacao = '$designacao', preco = $preco WHERE codigo = $codigo ";
  $this->db_estagio->executarSQL($sql);
  }

  /**Lista todos os produtos da base de dados*/
  function listarProdutos() {
  echo "<table border=1 cellpadding=0 cellspacing=0>\n";
  $result_set = $this->db_estagio->executarSQL("SELECT * FROM produto");
  $tuplos = $this->db_estagio->numeroTuplos("produto");
  for($registo=0; $registo<$tuplos; $registo++) {
  echo "<tr>\n";
  $row = mysqli_fetch_assoc($result_set);
  $this->escreveProduto($row["codigo"], $row["designacao"], $row["preco"]);
  echo "</tr>\n";    }
  echo "</table>\n";
  }
  
  /**Escreve os detalhes de um determinado produto
  @param codigo O codigo do produto
  @param designacao A designacao do produto
  @param preco O preço do produto*/
  function escreveProduto($codigo, $designacao, $preco) {
  printf("<td>$codigo</td><td>$designacao</td><td>$preco</td><form action=\"apagar.php\" method=post><td><input type=hidden name=codigo value=$codigo><input type=submit value=Apagar></td></form><form action=\"alterar.php\" method=post><td><input type=hidden name=codigo value=$codigo><input type=submit value=Alterar></td></form>\n");
  }

  /**Devolve o campo designacao de um determinado produto
  @param codigo O codigo do produto
  @return A designacao de um determinado produto*/
  function devolveDesignacao($codigo) {
  $sql="SELECT designacao FROM produto WHERE codigo=$codigo";
  $result_set = $this->db_estagio->executarSQL($sql);
  $row = mysqli_fetch_assoc($result_set);
  return $row["designacao"];
  }

  /**Devolve o campo preco de um determinado produto
  @param codigo O codigo do produto
  @return O preco de um determinado produto*/
  function devolvePreco($codigo) {
      $sql="SELECT preco FROM produto WHERE codigo=$codigo";
	  $result_set = $this->db_estagio->executarSQL($sql);
	  $row = mysqli_fetch_assoc($result_set);
	  return $row["preco"];
  }
  
  /**Corta a ligação à base de dados*/
  function fecharBDProdutos() {
    $this->db_estagio->fecharBD();
  }
}
?>
