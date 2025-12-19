<?php
/**Esta classe gere as operações realizadas sobre uma base de dados da gestão de Estágios virtual.*/

class Estagios {
  /**Variável da classe que permite guardar a ligação à base de dados.*/
  var $conn;

  /**Função para ligar à BD dos Estagios
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
 
	function novoEstagio($empresa_id, $estabelecimento_id, $data_inicio, $aluno_id, $formador_id) {
		$sql = "INSERT INTO estagio (estabelecimento_empresa_id, estabelecimento_id, aluno_id, formador_id, data_inicio) VALUES ($empresa_id, $estabelecimento_id, $aluno_id, $formador_id, $data_inicio)";
		$this->db_estagios->executarSQL($sql);
	}

	function alterarEstagio($aluno_id, $old_emp, $old_est, $novo_est, $nova_emp, $nova_data) {
		$sql = "UPDATE estagio SET estabelecimento_id = $novo_est, estabelecimento_empresa_id = $nova_emp, data_inicio = '$nova_data' 
		WHERE aluno_id = $aluno_cod AND estabelecimento_empresa_id = $old_emp AND estabelecimento_id = $old_est";
		$this->db_estagios->executarSQL($sql);
	}
 
	function apagarEstagio($estabelecimento_empresa_id, $estabelecimento_id, $aluno_id) {
		$sql = "DELETE FROM estagio WHERE estabelecimento_empresa_id = $estabelecimento_empresa_id AND estabelecimento_id = $estabelecimento_id AND aluno_id = $aluno_id";
		$this->db_estagios->executarSQL($sql);
	}

	function registarAluno($utilizador, $turma) {
		$sql = "INSERT INTO aluno (turma_id, utilizador_id) VALUES ($turma, $utilizador)";
		$this->db_estagios->executarSQL($sql);
	}

	function listarEstagios() { //esta função vai servir para a página do administrador então fizemos joins com as empresas e estabelecimentos apenas para lhes mostrar o nome e não o id
		echo "<table border=1 cellpadding=5 cellspacing=5>\n";
		$result_set = $this->db_estagios->executarSQL("SELECT o.*, empresa.firma AS nome_emp, est.nome_comercial as nome_est
		FROM estagio o
		left join empresa on o.estabelecimento_empresa_id = empresa.empresa_id
		left join estabelecimento est on o.estabelecimento_id = est.estabelecimento_id");
		$tuplos = $this->db_estagios->numeroTuplos("estagio");
		for($registo=0; $registo<$tuplos; $registo++) {
			echo "<tr>\n";
			$row = mysqli_fetch_assoc($result_set);
			$this->escreveEstagio($row['nome_emp'], $row['nome_est'], $row['data_inicio'], $row['aluno_id'], $row['formador_id'], $row['nota_final']); //imprime se tambem a nota final para saber mais tarde se podemos alterar ou não
			echo "</tr>\n";    }
		echo "</table>\n";
	}

	function listarEstagiosDaEmpresa($id) { //os left joins neste query servem para ligar os dados todos das tabelas. fç chamada pelo aluno
		echo "<table border = 1 cellpadding = 5 cellspacing=5>\n";
		$sql = "SELECT est.nome_comercial, est.morada, est.localidade as loc_est, resp.nome as nome_resp, resp.cargo, resp.telemovel as tel_resp, resp.email as email_resp, emp.firma, emp.morada_sede, emp.localidade as loc_emp, emp.telefone, ra.descricao as nome_ramo, GROUP_CONCAT(Distinct tr.meio_transporte separator ', ') as lista_transportes
		FROM estagio o
		inner join estabelecimento est on o.estabelecimento_id = est.estabelecimento_id
		inner join empresa emp on est.empresa_id = emp.empresa_id
		
		left join responsavel resp on resp.responsavel_id = est.responsavel_id
		
		left join trabalha t on emp.empresa_id = t.empresa_id
		left join ramo_atividade ra on t.ramo_atividade_id = ra.ramo_atividade_id
		
		left join servido s on est.estabelecimento_id = s.estabelecimento_id
		left join transporte tr on s.transporte_id = tr.transporte_id
		
		where emp.empresa_id = $id
		group by est.estabelecimento_id";
		
		$result_set = $this->db_estagios->executarSQL($sql);
		if($result_set) {
			$tuplos = mysqli_num_rows($result_set);
			for($registo = 0; $registo < $tuplos; $registo++) {
				echo "<tr>\n";
				$row = mysqli_fetch_assoc($result_set);
				$this->escreveEstagioDaEmpresa($row['nome_comercial'], $row['morada'], $row['loc_est'], $row['nome_resp'], $row['cargo'], $row['tel_resp'], $row['email_resp'], $row['firma'], $row['nome_ramo'], $row['morada_sede'], $row['loc_emp'], $row['telefone'], $row['lista_transportes']);
				echo"</tr>\n";
			}
			echo "</table>\n";
		}
	}

	function listarEstagiosFormador() { //este também é diferente porque mostra as notas. vamos mostrar as chaves primárias e as notas apenas
		echo "<table border=1 cellpadding=5 cellspacing=5>\n";
		$result_set = $this->db_estagios->executarSQL("SELECT * FROM estagio");
		$tuplos = $this->db_estagios->numeroTuplos("estagio");
		for($registo=0; $registo<$tuplos; $registo++) {
			echo "<tr>\n";
			$row = mysqli_fetch_assoc($result_set);
			$this->escreveEstagioFormador($row['aluno_id'], $row['estabelecimento_empresa_id'], $row['estabelecimento_id'], $row['nota_empresa'], $row['nota_escola'], $row['nota_relatorio'], $row['nota_procura'], $row['nota_final']);
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
			$this->escreveEmpresa($row["empresa_id"], $row["firma"], $row["tipo_organizacao"], $row["localidade"], $row["telefone"], $row["website"]);
			echo "</tr>\n";    }
		echo "</table>\n";
	}

	function listarEmpresasComDisponibilidade() {
		echo "<table border=1 cellpadding=5 cellspacing=5>\n";
		$ano_atual = date("Y");
		$result_set = $this->db_estagios->executarSQL("SELECT e.*
		FROM empresa e
		INNER JOIN disponibilidade d ON e.empresa_id = d.empresa_id
		Where d.ano = $ano_atual And d.num_estagios > 0");
		$tuplos = mysqli_num_rows($result_set); #só vão aparecer as linhas do resultado do sql
		for($registo=0; $registo<$tuplos; $registo++) {
			echo "<tr>\n";
			$row = mysqli_fetch_assoc($result_set);
			$this->escreveEmpresa($row["empresa_id"], $row["firma"], $row["tipo_organizacao"], $row["localidade"], $row["telefone"], $row["website"]); //imprime as informações pedidas, das empresas que têm disponibilidade
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
			$this->escreveEmpresa($row["empresa_id"], $row["firma"], $row["tipo_organizacao"], $row["localidade"], $row["telefone"], $row["website"]);
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
			$this->escreveEmpresa($row["empresa_id"], $row["firma"], $row["tipo_organizacao"], $row["localidade"], $row["telefone"], $row["website"]);
			echo "</tr>\n";    }
		echo "</table>\n";
	}

	function escreveEmpresa($emp_id, $firma, $tipo, $localidade, $telefone, $website) { //criámos um link no nome da empresa que liga depois à pagina que lista os estágios daquela empresa. o id da empresa não é escrito mas é usado para verificar na próxima página os estágios associados a ela
		printf("<td><a href='estagiosNaEmpresa.php?empresa_id=$emp_id'>$firma</td><td>$tipo</td><td>$localidade</td><td>$telefone</td><td>$website</td>\n");
	}
	
	function escreveEstagio($id_est, $id_emp, $data_inicio, $aluno_id, $formador_id, $nota_final) { //este é chamado para o admin apenas. mostra os botões que permitem alterar e apagar estágios. cada estágio mostra as informações que o enunciado diz que é possível o admin alterar
		printf("<td>Estabelecimento: $id_est</td><td>Empresa: $id_emp</td><td>Data de Início: $data_inicio</td><td>Aluno: $aluno_id</td><td> Formador: $formador_id</td>");
		if($nota_final == NULL || $nota_final == 0) { //apenas os estágios não terminados podem ser alterados/apagados
			printf("<td><form action='' method=post><input type=hidden name=emp_cod value=$id_emp><input type=hidden name=est_cod value=$id_est><input type=hidden name=aluno_cod value=$aluno_id><input type=submit name=apagar value=Apagar></td></form><td><form action=\"forms_estagio.php\" method=post><input type=hidden name=aluno_cod value=$aluno_id><input type=hidden name=emp_cod value=$id_emp><input type=hidden name=est_cod value=$id_est><input type=hidden name = data_ini value =$data_inicio><input type=submit value=Alterar></td></form>\n"); //para atualizar recebo a data de inicio alem das chaves primarias
		}
	}

	function escreveEstagioDaEmpresa($nome_estab, $morada_estab, $localidade_estab, $nome_resp, $cargo_resp, $telefone_resp, $email_resp, $nome_emp, $ramo_emp, $morada_emp, $local_emp, $telefone_emp, $transportes) { //chamado para o aluno, que vê o estagio muito detalhado
		printf("<td>Estabelecimento: $nome_estab</td><td>$morada_estab</td><td>$localidade_estab</td><td>Responsável: $nome_resp</td><td>$cargo_resp</td><td>$telefone_resp</td><td>$email_resp</td><td>Empresa: $nome_emp</td><td>$ramo_emp</td><td>$morada_emp</td><td>$local_emp</td><td>$telefone_emp</td><td>Transportes: $transportes</td>\n");
	}

	function escreveEstagioFormador($aluno, $empresa, $estabelecimento, $n_empresa, $n_escola, $n_relatorio, $n_procura, $n_final) { //chamado para o formador, que vê as notas e chaves primárias
		printf("<td>ID do Aluno: $aluno</td><td>ID da Empresa: $empresa</td><td>ID do Estabelecimento: $estabelecimento</td><td>Nota da Empresa: $n_empresa</td><td>Nota da Escola: $n_escola</td><td>Nota do Relatório: $n_relatorio</td><td>Nota da Procura: $n_procura</td><td>Nota Final: $n_final</td><td><form action='registarNotas.php' method=post><input type=hidden name=emp_cod value=$empresa><input type=hidden name=est_cod value=$estabelecimento><input type=hidden name=aluno_cod value=$aluno><input type=submit value=Lançar Notas></td></form>\n");
	}

	function escreveEmpresaComDisponibilidade($firma, $num_estagios) {
		printf("<td>$firma</td><td>$num_estagios</td>\n");
	}

	function atribuirNota($nota_emp, $nota_esc, $nota_rel, $nota_proc, $aluno_cod, $est_cod, $emp_cod) {
		$nota_final = ($nota_emp + $nota_esc + $nota_rel + $nota_proc)/4; //calcula a média
		$data = date("Y-m-d"); //vai colocar, alem das notas, a data_final
		$sql = "UPDATE estagio SET nota_empresa = $nota_emp, nota_escola = $nota_esc, nota_relatorio = $nota_rel, nota_procura = $nota_proc, nota_final = $nota_final, data_fim = '$data'
		WHERE aluno_id = $aluno_cod AND estabelecimento_empresa_id = $emp_cod AND estabelecimento_id = $est_cod";
		$this->db_estagios->executarSQL($sql);
	}
  
	/**Corta a ligação à base de dados*/
	function fecharBDEstagios() {
		$this->db_estagios->fecharBD();
	}
}
?>
