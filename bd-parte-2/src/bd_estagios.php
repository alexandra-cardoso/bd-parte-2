<?php
/**Esta classe gere as operações realizadas sobre uma base de dados de uma
Loja virtual.*/

class Estagios {
  /**Variável da classe que permite guardar a ligação à base de dados.*/
  var $conn;

  /**Função para ligar à BD da Loja
   @return Um valor indicando qual o resultado da ligação à base de dados.*/
   function ligarBD() {
      $this->conn = mysqli_connect("mariadb", "root", "maria", "SIEstagios");
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


/**Esta classe implementa a gestão de produtos na base de dados dos Estagios. Permite
efectuar toda uma série de operações sobre a tabela de produtos, nomeadamente
operações de introdução, remoção, consulta e alteração de estagios.*/

class Estagio extends Estagios {
 /**Esta variável da classe é responsável pelas operações directas na Base de dados.*/
	var $db_estagios;
 
	function Estagio() {
		$this->db_estagios = new Estagios;
		$this->db_estagios->ligarBD(); 
	}
 
	function novoEstagio($empresa_id, $estabelecimento_id, $aluno_id, $formador_id) {
		$sql = "INSERT INTO estagio (estabelecimento_empresa_id, estabalecimento_id, aluno_id, formador_id) VALUES ($empresa_id, $estabelecimento_id, $aluno_id, $formador_id)";
		$this->db_estagios->executarSQL($sql);
	}
 
	function apagarEstagio($estabelecimento_empresa_id, $estabelecimento_id, $aluno_id) {
		$sql = "DELETE FROM estagio WHERE estabelecimento_empresa_id = $estabelecimento_empresa_id AND estabelecimento_id = $estabelecimento_id AND aluno = $aluno_id";
		$this->db_estagios->executarSQL($sql);
	}

	function registarAluno($utilizador, $turma) {
		$sql = "INSERT INTO aluno (turma_id, utilizador_id) VALUES ($turma, $utilizador)";
		$this->db_estagios->executarSQL($sql);
	}

	function listarEstagios() {
		echo "<table border=1 cellpadding=5 cellspacing=5>\n";
		$result_set = $this->db_estagios->executarSQL("SELECT * FROM estagio");
		$tuplos = $this->db_estagios->numeroTuplos("estagio");
		for($registo=0; $registo<$tuplos; $registo++) {
			echo "<tr>\n";
			$row = mysqli_fetch_assoc($result_set);
			$this->escreveEstagio($row["firma"], $row["tipo_organizacao"], $row["localidade"], $row["telefone"], $row["website"]);
			echo "</tr>\n";    }
		echo "</table>\n";
	}

	function listarEmpresasComDisponibilidade() {
		echo "<table border=1 cellpadding=5 cellspacing=5>\n";
		$result_set = $this->db_estagios->executarSQL("SELECT e.firma, d.num_estagios 
		FROM empresa e
		INNER JOIN disponibilidade d ON e.empresa_id = d.empresa_id");
		$tuplos = mysqli_num_rows($result_set); #só vão aparecer as linhas do resultado do sql
		for($registo=0; $registo<$tuplos; $registo++) {
			echo "<tr>\n";
			$row = mysqli_fetch_assoc($result_set);
			$this->escreveEmpresa($row["firma"], $row["num_estagios"]);
			echo "</tr>\n";    }
		echo "</table>\n";
	}

	function listarEmpresas() { //escreve as empresas sem contar com a disponibilidade
		echo "<table border=1 cellpadding=5 cellspacing=5>\n";
		$result_set = $this->db_estagios->executarSQL("SELECT * FROM empresa");
		$tuplos = $this->db_estagios->numeroTuplos("empresa");
		for($registo=0; $registo<$tuplos; $registo++) {
			echo "<tr>\n";
			$row = mysqli_fetch_assoc($result_set);
			$this->escreveEmpresa($row["firma"], $row["tipo_organizacao"], $row["localidade"], $row["telefone"], $row["website"]);
			echo "</tr>\n";    }
		echo "</table>\n";
	}

	function listarEmpresasPorRamo($ramo_atividade) { // o query seleciona apenas as empresas daquele ramo de atividade 
		echo "<table border=1 cellpadding=5 cellspacing=5>\n";
		$result_set = $this->db_estagios->executarSQL("SELECT * FROM ramo_atividade ra 
		inner join trabalha t on t.ramo_atividade_id = ra.ramo_atividade_id
		inner join empresa e on e.empresa_id = t.empresa_id
		WHERE ra.descricao like '%$ramo_atividade%'");
		$tuplos = mysqli_num_rows($result_set);

		for($registo=0; $registo<$tuplos; $registo++) {
			echo "<tr>\n";
			$row = mysqli_fetch_assoc($result_set);
			$this->escreveEmpresa($row["firma"], $row["tipo_organizacao"], $row["localidade"], $row["telefone"], $row["website"]);
			echo "</tr>\n";    }
		echo "</table>\n";
	}

	function listarEmpresasPorLocalidade($localidade) {
		echo "<table border=1 cellpadding=5 cellspacing=5>\n";
		$result_set = $this->db_estagios->executarSQL("SELECT * FROM empresa WHERE localidade like '%$localidade%'");
		$tuplos = mysqli_num_rows($result_set);

		for($registo=0; $registo<$tuplos; $registo++) {
			echo "<tr>\n";
			$row = mysqli_fetch_assoc($result_set);
			$this->escreveEmpresa($row["firma"], $row["tipo_organizacao"], $row["localidade"], $row["telefone"], $row["website"]);
			echo "</tr>\n";    }
		echo "</table>\n";
	}

	function escreveEmpresa($firma, $tipo, $localidade, $telefone, $website) {
		printf("<td>$firma</td><td>$tipo</td><td>$localidade</td><td>$telefone</td><td>$website</td>\n");
	}
	
	function escreveEstagio($nome_estab, $morada_estab, $localidade_estab, $nome_resp, $cargo_resp, $telefone_resp, $email_resp, $nome_emp, $ramo_emp, $morada_emp, $local_emp, $telefone_emp) {
		printf("<td>$nome_estab</td><td>$morada_estab</td><td>$localidade_estab</td><td>$nome_resp</td><td>$cargo_resp</td><td>$telefone_resp</td><td>$email_resp</td><td>$nome_emp</td><td>$ramo_emp</td><td>$morada_emp</td><td>$local_emp</td><td>$telefone_emp</td>");
		$this->escreveTransportes();
	}

	function escreveTransportes() {

	}

	function escreveEmpresaComDisponibilidade($firma, $num_estagios) {
		printf("<td>$firma</td><td>$num_estagios</td><form action=\"apagar.php\" method=post><td><input type=hidden name=firma value=$firma><input type=submit value=Apagar></td></form><form action=\"alterar.php\" method=post><td><input type=hidden name=firma value=$firma><input type=submit value=Alterar></td></form>\n");
	}

  function atribuirNota($nota_emp, $nota_esc, $nota_rel, $nota_proc) {
	$nota_final = ($nota_emp + $nota_esc + $nota_rel + $nota_proc)/4; //calcula a média
	$sql = "INSERT INTO estagio (nota_empresa, nota_escola, nota_relatorio, nota_procura, nota_final) VALUES ($nota_emp, $nota_esc, $nota_proc, $nota_final)";
	$this->db_estagios->executarSQL($sql);
  }
  
  /**Corta a ligação à base de dados*/
  function fecharBDEstagios() {
    $this->db_estagios->fecharBD();
  }
}
?>
