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
 

 
	function novoEstagio($empresa_id, $estabelecimento_id, $aluno_id, $formador_id) {
		$sql = "INSERT INTO estagio (estabelecimento_empresa_id, estabalecimento_id, aluno_id, formador_id) VALUES ($empresa_id, $estabelecimento_id, $aluno_id, $formador_id)";
		$this->db_estagio->executarSQL($sql);
	}
 
	function apagarEstagio($estabelecimento_empresa_id, $estabelecimento_id, $aluno_id) {
		$sql = "DELETE FROM estagio WHERE estabelecimento_empresa_id = $estabelecimento_empresa_id AND estabelecimento_id = $estabelecimento_id AND aluno = $aluno_id";
		$this->db_estagio->executarSQL($sql);
	}

	function registarAluno($utilizador, $turma) {
		$sql = "INSERT INTO aluno (turma_id, utilizador_id) VALUES ($turma, $utilizador)"
		$this->db_estagio->executarSQL($sql);
	}
	function listarEstagios() {
    echo "<table border=1 cellpadding=0 cellspacing=0>\n";
    $result_set = $this->db_loja->executarSQL("SELECT * FROM estagio");
    $tuplos = $this->db_loja->numeroTuplos("estagio");
    for($registo=0; $registo<$tuplos; $registo++) {
      echo "<tr>\n";
      $row = mysqli_fetch_assoc($result_set);
      $this->escreveProduto($row["codigo"], $row["designacao"], $row["preco"]);
      echo "</tr>\n";    }
    echo "</table>\n";
  }

	/**Lista todos os produtos da base de dados*/
	function listarEmpresas() {
		echo "<table border=1 cellpadding=0 cellspacing=0>\n";
		$result_set = $this->db_estagio->executarSQL("SELECT e.firma, d.num_estagios 
		FROM empresa e
		INNER JOIN disponibilidade d ON e.empresa_id = d.empresa_id");
		$tuplos = mysqli_num_rows($result_set); #só vão aparecer as linhas do resultado do sql
		for($registo=0; $registo<$tuplos; $registo++) {
			echo "<tr>\n";
			$row = mysqli_fetch_assoc($result_set);
			$this->escreveProduto($row["firma"], $row["num_estagios"]); #posso fazer isto?
			echo "</tr>\n";    }
		echo "</table>\n";
	}

	function escreveEmpresa($firma, $num_estagios) {
		printf("<td>$firma</td><td>$num_estagios</td><form action=\"apagar.php\" method=post><td><input type=hidden name=firma value=$firma><input type=submit value=Apagar></td></form><form action=\"alterar.php\" method=post><td><input type=hidden name=firma value=$firma><input type=submit value=Alterar></td></form>\n");
	}

  function atribuirNota($nota_emp, $nota_esc, $nota_rel, $nota_proc, $nota_final) {
	$sql = "INSERT INTO estagio (nota_empresa, nota_escola, nota_relatorio, nota_procura, nota_final) VALUES ($nota_emp, $nota_esc, $nota_proc, $nota_final)";
	$this->db_estagio->executarSQL($sql)

  }
  
  /**Corta a ligação à base de dados*/
  function fecharBDEstagios() {
    $this->db_estagio->fecharBD();
  }
}
?>
