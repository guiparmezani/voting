<?
	require_once 'connector.php';
	require_once '../model/ParticipanteModel.php';
	require_once '../model/VotacaoModel.php';
	require_once '../model/ReuniaoModel.php';
	require_once '../model/OpcaoModel.php';
	require_once '../util/alphaID.php';
	
	class EntityManager{
		var $con;

		// Executa consulta qualquer no banco
		function executeQuery($query){
		
			$con=connect();
			
			if (mysqli_connect_errno($con)){
			  echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			
			$result = mysqli_query($con, $query);
			mysqli_close($con);
			
			return $result;
		}
		
		
		/**
		 * Métodos de Inserção de dados
		 * @author Guilherme Parmezani 
		 */
		function insertOrUpdateParticipante($participante){
			$con=connect();
			
			if (mysqli_connect_errno($con)){
			  echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			if($participante->id == null || strcmp($participante->id, "") == 0){
				$result = mysqli_query($con, "INSERT INTO PARTICIPANTE (USUARIO, SENHA, INSTITUICAO) VALUES ('" . $participante->usuario . "', '" . $participante->senha . "', '" . $participante->instituicao . "')");
			}
			else{
				$result = mysqli_query($con, "UPDATE PARTICIPANTE SET USUARIO = '" . $participante->usuario . "', SENHA = '" . $participante->senha . "', INSTITUICAO = '" . $participante->instituicao . "' WHERE ID = " . $participante->id);
			}
			mysqli_close($con);
			
			return $result;
		}
		
		function insertOrUpdateVotacao($votacao){
			$con=connect();
			
			if (mysqli_connect_errno($con)){
			  echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			
			if($votacao->id == null || strcmp($votacao->id, "") == 0){
				$result = mysqli_query($con, "INSERT INTO VOTACAO (TITULO, ID_REUNIAO, PERGUNTA, SUGESTAO) VALUES ('" . $votacao->titulo . "', '" . $votacao->idReuniao . "', '" . $votacao->pergunta . "', '" . $votacao->sugestao . "')");
			}
			else{
				$result = mysqli_query($con, "UPDATE VOTACAO SET TITULO = '" . $votacao->titulo . "', ID_REUNIAO = " . $votacao->idReuniao . ", PERGUNTA = '" . $votacao->pergunta . "', SUGESTAO = '" . $votacao->sugestao . "' WHERE ID = " . $votacao->id);
			}
			mysqli_close($con);
			
			return $result;
		}
		
		function insertOrUpdateOpcao($opcao){
			$con=connect();
			
			if (mysqli_connect_errno($con)){
			  echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			if($opcao->id == null || strcmp($opcao->id, "") == 0){
				$result = mysqli_query($con, "INSERT INTO OPCAO (ID_VOTACAO, DESCRICAO) VALUES ('" . $opcao->idVotacao . "', '" . $opcao->descricao . "')");
			}
			else{
				$result = mysqli_query($con, "UPDATE OPCAO SET DESCRICAO = '" . $opcao->descricao . "', ID_VOTACAO = " . $opcao->idVotacao . ", NUM_VOTOS = '" . $opcao->numVotos . "' WHERE ID = " . $opcao->id);
			}
			mysqli_close($con);
			
			return $result;
		}
		
		function insereVoto($participanteId, $opcao){
			$con=connect();
			
			if (mysqli_connect_errno($con)){
			  echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			
			mysqli_query($con, "UPDATE OPCAO SET NUM_VOTOS = (NUM_VOTOS + 1) WHERE ID = " . $opcao->id);
			mysqli_query($con, "INSERT INTO PARTICIPANTE_VOTACAO (ID_PARTICIPANTE, ID_VOTACAO) VALUES ('" . alphaID($participanteId, false, 3) . "', " . $opcao->idVotacao . ")");
			mysqli_close($con);
			
		}
		
		function insertOrUpdateReuniao($reuniao){
			$con=connect();
			
			if (mysqli_connect_errno($con)){
			  echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			
			//testa se o código já está cadastrado
			$reunioes = $this->findAllReuniao();
			foreach($reunioes as $r){
				if(strcmp($reuniao->codigo, $r->codigo) == 0 && $reuniao->id == null){
					return null;
				}
			}
			
			if($reuniao->id == null || strcmp($reuniao->id, "") == 0){
				$result = mysqli_query($con, "INSERT INTO REUNIAO (CODIGO, ATIVA) VALUES ('" . $reuniao->codigo . "', " . $reuniao->ativa . ")");
			}
			else{
				$result = mysqli_query($con, "UPDATE REUNIAO SET CODIGO = '" . $reuniao->codigo . "', ATIVA = " . $reuniao->ativa . " WHERE ID = " . $reuniao->id);
			}
			
			mysqli_close($con);
			
			return $result;
		}
		
		/**
		 * Métodos de Consulta de dados
		 * @author Guilherme Parmezani 
		 */
		function findVotacaoByIdReuniao($idReuniao){
			$con=connect();
			$count = 0;
			
			if (mysqli_connect_errno($con)){
			  echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			
			$result = mysqli_query($con, "SELECT * FROM VOTACAO WHERE ID_REUNIAO = " . $idReuniao);
			mysqli_close($con);
			
			while($row = mysqli_fetch_array($result)){
				$votacao = new VotacaoModel();
				
				$votacao->id = $row['ID'];
				$votacao->titulo = $row['TITULO'];
				$votacao->idReuniao = $row['ID_REUNIAO'];
				$votacao->pergunta = $row['PERGUNTA'];
				$votacao->sugestao = $row['SUGESTAO'];
				
				$votacoes[$count] = $votacao;
				$count++;
			}
			if($result->num_rows > 0){
				return $votacoes;
			}
			else{
				return null;
			}
		}
		
		function findVotacaoByIdReuniaoWithoutSugestao($idReuniao){
			$con=connect();
			$count = 0;
			
			if (mysqli_connect_errno($con)){
			  echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			
			$result = mysqli_query($con, "SELECT * FROM VOTACAO WHERE ID_REUNIAO = " . $idReuniao ." AND SUGESTAO = 0");
			mysqli_close($con);
			
			while($row = mysqli_fetch_array($result)){
				$votacao = new VotacaoModel();
				
				$votacao->id = $row['ID'];
				$votacao->titulo = $row['TITULO'];
				$votacao->idReuniao = $row['ID_REUNIAO'];
				$votacao->pergunta = $row['PERGUNTA'];
				$votacao->sugestao = $row['SUGESTAO'];
				
				$votacoes[$count] = $votacao;
				$count++;
			}
			if($result->num_rows > 0){
				return $votacoes;
			}
			else{
				return null;
			}
		}
		
		function findVotacaoLastInserted(){
			$con=connect();
			
			if (mysqli_connect_errno($con)){
			  echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			
			$result = mysqli_query($con, "SELECT * FROM VOTACAO ORDER BY ID DESC LIMIT 1");
			mysqli_close($con);
			
			while($row = mysqli_fetch_array($result)){
				$votacao = new VotacaoModel();
				
				$votacao->id = $row['ID'];
				$votacao->titulo = $row['TITULO'];
				$votacao->idReuniao = $row['ID_REUNIAO'];
				$votacao->pergunta = $row['PERGUNTA'];
				$votacao->sugestao = $row['SUGESTAO'];
				
				return $votacao;
			}
			
			return null;
		}
		
		function findVotacaoById($id){
			$con=connect();
			
			if (mysqli_connect_errno($con)){
			  echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			
			$result = mysqli_query($con, "SELECT * FROM VOTACAO WHERE ID = " . $id);
			mysqli_close($con);
			
			while($row = mysqli_fetch_array($result)){
				$votacao = new VotacaoModel();
				
				$votacao->id = $row['ID'];
				$votacao->titulo = $row['TITULO'];
				$votacao->idReuniao = $row['ID_REUNIAO'];
				$votacao->pergunta = $row['PERGUNTA'];
				$votacao->sugestao = $row['SUGESTAO'];
				
				return $votacao;
			}
			
			return null;
		}
		
		function findParticipanteById($id){
			$con=connect();
			
			if (mysqli_connect_errno($con)){
			  echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			
			$result = mysqli_query($con, "SELECT * FROM PARTICIPANTE WHERE ID = " . $id);
			mysqli_close($con);
			
			while($row = mysqli_fetch_array($result)){
				$participante = new ParticipanteModel();
				
				$participante->id = $row['ID'];
				$participante->usuario = $row['USUARIO'];
				$participante->senha = $row['SENHA'];
				$participante->instituicao = $row['INSTITUICAO'];
				
				return $participante;
			}
			
			return null;
		}
		
		function findOpcaoByIdVotacao($idVotacao){
			$con=connect();
			$count = 0;
			
			if (mysqli_connect_errno($con)){
			  echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			
			$result = mysqli_query($con, "SELECT * FROM OPCAO WHERE ID_VOTACAO = " . $idVotacao);
			mysqli_close($con);
			
			while($row = mysqli_fetch_array($result)){
				$opcao = new OpcaoModel();
				
				$opcao->id = $row['ID'];
				$opcao->descricao = $row['DESCRICAO'];
				$opcao->idVotacao = $row['ID_VOTACAO'];
				$opcao->numVotos = $row['NUM_VOTOS'];
				
				$opcoes[$count] = $opcao;
				$count++;  
			}
			
			if($result->num_rows > 0){
				return $opcoes;
			}
			else{
				return null;
			}
			
		}
		
		function findOpcaoById($idOpcao){
			$con=connect();
			
			if (mysqli_connect_errno($con)){
			  echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			
			$result = mysqli_query($con, "SELECT * FROM OPCAO WHERE ID = " . $idOpcao);
			mysqli_close($con);
			
			while($row = mysqli_fetch_array($result)){
				$opcao = new OpcaoModel();
				
				$opcao->id = $row['ID'];
				$opcao->descricao = $row['DESCRICAO'];
				$opcao->idVotacao = $row['ID_VOTACAO'];
				$opcao->numVotos = $row['NUM_VOTOS'];
				
				return $opcao;
			}
			
			return null;
		}
		
		function findReuniaoByIdOpcao($idOpcao){
			$con=connect();
			
			if (mysqli_connect_errno($con)){
			  echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			
			$result = mysqli_query($con, "SELECT DISTINCT r.ID, r.CODIGO, r.ATIVA FROM REUNIAO r INNER JOIN VOTACAO v ON r.ID=v.ID_REUNIAO INNER JOIN OPCAO o ON o.ID_VOTACAO=v.ID WHERE o.ID = " . $idOpcao);
			mysqli_close($con);
			
			while($row = mysqli_fetch_array($result)){
				$reuniao = new ReuniaoModel();
				
				$reuniao->id = $row['ID'];
				$reuniao->codigo = $row['CODIGO'];
				$reuniao->ativa = $row['ATIVA'];
				
				return $reuniao;
			}
			
			return null;
		
		}
		
		function findReuniaoById($id){
			$con=connect();
			
			if (mysqli_connect_errno($con)){
			  echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			
			$result = mysqli_query($con, "SELECT * FROM REUNIAO WHERE ID = " . $id);
			mysqli_close($con);
			
			while($row = mysqli_fetch_array($result)){
				$reuniao = new ReuniaoModel();
				
				$reuniao->id = $row['ID'];
				$reuniao->codigo = $row['CODIGO'];
				$reuniao->ativa = $row['ATIVA'];
				
				return $reuniao;
			}
			
			return null;
		
		}
		
		function findAllReuniao(){
			$con=connect();
			$count = 0;
			
			if (mysqli_connect_errno($con)){
			  echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			
			$result = mysqli_query($con, "SELECT * FROM REUNIAO");
			mysqli_close($con);
			
			while($row = mysqli_fetch_array($result)){
				
				$reuniao = new ReuniaoModel();
				$reuniao->id = $row['ID'];
				$reuniao->codigo = $row['CODIGO'];
				$reuniao->ativa = $row['ATIVA'];
				
				$reunioes[$count] = $reuniao;
				$count++;
			}
			
			if($result->num_rows > 0){
				return $reunioes;	
			}
			else{
				return null;
			}
		
		}
		
		function findReunioesAtivas(){
			$con=connect();
			$count = 0;
			
			if (mysqli_connect_errno($con)){
			  echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			
			$result = mysqli_query($con, "SELECT * FROM REUNIAO WHERE ATIVA = 1");
			mysqli_close($con);
			
			while($row = mysqli_fetch_array($result)){
				
				$reuniao = new ReuniaoModel();
				$reuniao->id = $row['ID'];
				$reuniao->codigo = $row['CODIGO'];
				$reuniao->ativa = $row['ATIVA'];
				
				$reunioes[$count] = $reuniao;
				$count++;
			}
			
			if($result->num_rows > 0){
				return $reunioes;	
			}
			else{
				return null;
			}
		
		}
		
		function findAllVotacao(){
			$con=connect();
			$count=0;
			
			if (mysqli_connect_errno($con)){
			  echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			
			$result = mysqli_query($con, "SELECT * FROM VOTACAO WHERE SUGESTAO = 0");
			mysqli_close($con);
			
			while($row = mysqli_fetch_array($result)){
				$votacao = new VotacaoModel();
				
				$votacao->id = $row['ID'];
				$votacao->idReuniao = $row['ID_REUNIAO'];
				$votacao->titulo = $row['TITULO'];
				$votacao->pergunta = $row['PERGUNTA'];
				$votacao->sugestao = $row['SUGESTAO'];
				
				$votacoes[$count] = $votacao;
				$count++;
			}
			
			if($result->num_rows > 0){
				return $votacoes;	
			}
			else{
				return null;
			}
		
		}
		
		function findAllVotacaoSugestao(){
			$con=connect();
			$count=0;
			
			if (mysqli_connect_errno($con)){
			  echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			
			$result = mysqli_query($con, "SELECT * FROM VOTACAO WHERE SUGESTAO = 1");
			mysqli_close($con);
			
			while($row = mysqli_fetch_array($result)){
				$votacao = new VotacaoModel();
				
				$votacao->id = $row['ID'];
				$votacao->idReuniao = $row['ID_REUNIAO'];
				$votacao->titulo = $row['TITULO'];
				$votacao->pergunta = $row['PERGUNTA'];
				$votacao->sugestao = $row['SUGESTAO'];
				
				$votacoes[$count] = $votacao;
				$count++;
			}
			
			if($result->num_rows > 0){
				return $votacoes;	
			}
			else{
				return null;
			}
		
		}
		
		function findAllParticipante(){
			$con=connect();
			$count=0;
			
			if (mysqli_connect_errno($con)){
			  echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			
			$result = mysqli_query($con, "SELECT * FROM PARTICIPANTE");
			mysqli_close($con);
			
			while($row = mysqli_fetch_array($result)){
				$participante = new ParticipanteModel();
				
				$participante->id = $row['ID'];
				$participante->usuario = $row['USUARIO'];
				$participante->senha = $row['SENHA'];
				$participante->instituicao = $row['INSTITUICAO'];
				
				$participantes[$count] = $participante;
				$count++;
			}
			
			if($result->num_rows > 0){
				return $participantes;
			}
			
			return null;
		
		}
		
		/**
		 * Métodos de Remoção de dados
		 * @author Guilherme Parmezani 
		 */
		 function removeVotacao($id){
		 	$con=connect();
			
			if (mysqli_connect_errno($con)){
			  echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			
			try{
				mysqli_query($con, "DELETE FROM OPCAO WHERE ID_VOTACAO = " .$id);
				mysqli_query($con, "DELETE FROM VOTACAO WHERE ID = " .$id);
				mysqli_close($con);
			}catch(Exception $e){
				echo "Houve um erro ao tentar remover a votação: " . $e->getMessage();
				return FALSE;
			}
			return TRUE;
		 }
		 
		 /**
		 * Métodos de Remoção de reunião pelo ID
		 * @author Guilherme Parmezani 
		 * @param int $id
		 */
		 function removeReuniao($id){
		 	$con=connect();
			
			if (mysqli_connect_errno($con)){
			  echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			
			try{
				
				$votacoes = $this->findVotacaoByIdReuniao($id); 
				$len = count($votacoes);
				
				for($i=0 ; $i<$len ; $i++){
					$this->removeVotacao($votacoes[$i]->id);
				}
				
				mysqli_query($con, "DELETE FROM REUNIAO WHERE ID = " .$id);
				mysqli_close($con);
			}catch(Exception $e){
				echo "Houve um erro ao tentar remover a reunião: " . $e->getMessage();
				return FALSE;
			}
			return TRUE;
		 }
		 
		 function removeParticipante($id){
		 	$con=connect();
			
			if (mysqli_connect_errno($con)){
			  echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			
			try{
				mysqli_query($con, "DELETE FROM PARTICIPANTE WHERE ID = " .$id);
				mysqli_close($con);
			}catch(Exception $e){
				echo "Houve um erro ao tentar remover o participante: " . $e->getMessage();
				return FALSE;
			}
			return TRUE;
		 }
		 
		 function removeOpcoesByIdVotacao($id){
		 	$con=connect();
			
			if (mysqli_connect_errno($con)){
			  echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			
			try{
				mysqli_query($con, "DELETE FROM OPCAO WHERE ID_VOTACAO = " .$id);
				mysqli_close($con);
			}catch(Exception $e){
				echo "Houve um erro ao tentar remover as opções: " . $e->getMessage();
				return FALSE;
			}
			return TRUE;
		 }
	}
?>