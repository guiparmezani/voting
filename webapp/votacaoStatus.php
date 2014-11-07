<?
	session_start();
?>  
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>
        Voting
        </title>
        <link rel="stylesheet" href="https://ajax.aspnetcdn.com/ajax/jquery.mobile/1.1.1/jquery.mobile-1.1.1.min.css" />
        <link rel="stylesheet" href="css/my.css" />
        <style type='text/css'>
	        html { background-color: #333; }
	        @media only screen and (min-width: 600px){
	            .ui-page {
	                width: 500px !important;
	                margin: 0 auto !important;
	                position: relative !important;
	                border-right: 5px #000 outset !important;
               		border-left: 5px #000 outset !important;
	            }
	            .ui-footer {
	                width: 500px !important;
	                margin: 0 auto !important;
	                
	            }
	        }
		</style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js">
        </script>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery.mobile/1.1.1/jquery.mobile-1.1.1.min.js">
        </script>
        <script src="js/my.js">
        </script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
    </head>
    <body>
  <!-- votacaoStatus -->
  <div data-role="page" id="page5">
      <div data-theme="a" data-role="header">
		<script> 
		     var auto_refresh = setInterval(
		     function interval(){
		     	window.location.reload();
		     }, 5000);
		     
		     function stopInterval(){
		     	clearInterval(auto_refresh);
		     }
		     
		     function change(){
		     	if(document.getElementById("checkbox3").checked){
	        		auto_refresh = setInterval(
					     function interval(){
					     	window.location.reload();
					     }, 5000);
	        	}
	        	else{
	        		stopInterval();
	        	}
		     }
	     </script>
	     
	     <!--
	     <script> 
		     var auto_refresh = setInterval(
		     function interval(){
		     	$('#graph').fadeOut('slow').load('votacaoStatus.php?votacao='+ document.getElementById('votacaoId').value +' #graph').fadeIn("slow");
		     }, 2000);
		     
		     function stopInterval(){
		     	clearInterval(auto_refresh);
		     }
		     
		     function change(){
		     	if(document.getElementById("checkbox3").checked){
	        		auto_refresh = setInterval(
					     function interval(){
					     	$('#graph').fadeOut('slow').load('votacaoStatus.php?votacao='+ document.getElementById('votacaoId').value +' #graph').fadeIn("slow");
					     }, 4000);
	        	}
	        	else{
	        		stopInterval();
	        	}
		     }
	     </script>
	      -->
	     
          <a id="home" data-role="button" data-transition="flow" data-theme="b" href="../index.php" class="ui-btn-right">
              Home
          </a>
          <h3>
              Status
          </h3>
      </div>
      <div data-role="content">
      <?php
     	require_once '../dao/EntityManager.php';
     	require_once '../model/OpcaoModel.php';
     	require_once '../model/VotacaoModel.php';
     	require_once '../util/alphaID.php';
		
		$em = new EntityManager();
		 
 		if(isset($_GET['opcao'])){
	 		$validate = true;
	 
	 		$idOpcao=$_GET['opcao'];
			$opcao = $em->findOpcaoById($idOpcao);
			
		    $participanteAtual = $em->findParticipanteById($_SESSION['id']);
		    $encryptedId = alphaID($participanteAtual->id, false, 3);
		    
		    $votos = $em->executeQuery("SELECT * FROM PARTICIPANTE_VOTACAO WHERE ID_PARTICIPANTE = '" . $encryptedId . "' AND ID_VOTACAO = " . $opcao->idVotacao);
		    
		    if($votos->num_rows != 0){
		    	$validate = false;
		    }
		    
		    if($validate){
			    $em->insereVoto($participanteAtual->id, $opcao);
		    }
 		}
 		
 		else{
 			$idVotacao = $_GET['votacao'];
 			$votacao = $em->findVotacaoById($idVotacao);
 			
 			echo "<p style='text-align: center;' data-mce-style='text-align: center;'>
			                  <span style='font-size: small;' data-mce-style='font-size: small;'>
			                      Resultados da Votação
			                  </span>
			              </p>";
 		}
	    
	    function getReuniao(){
	    	$em = new EntityManager();
	    	$reuniao = $em->findReuniaoByIdOpcao($_GET['opcao']);
	    	
	    	return $reuniao->id;
	    }
     ?>
          <div>
              <?
              	if(isset($_GET['opcao'])){
	              	if($validate){
	              		echo "<p style='text-align: center;' data-mce-style='text-align: center;'>
				                  <span style='font-size: small;' data-mce-style='font-size: small;'>
				                      Seu voto foi computado com sucesso
				                  </span>
				              </p>";
	              	}
	              	
	              	else{
	              		echo "<p style='text-align: center;' data-mce-style='text-align: center;'>
				                  <span style='font-size: small;' data-mce-style='font-size: small;'>
				                      Você já participou dessa votação, portanto seu voto não foi computado.
				                  </span>
				              </p>";
	              	}
	              	
	          		echo "<p style='text-align: center;' data-mce-style='text-align: center;'>
			                  <span style='font-size: small;' data-mce-style='font-size: small;'>
			                      Opção escolhida:
			                  </span>
			              </p>
			              <p style='text-align: center;' data-mce-style='text-align: center;'>
			                  <strong>
			                     " . $opcao->descricao . "
			                  </strong>
			              </p>";
              	}
              ?>
              
          </div>
          <div align="center">
			<?php
				require_once 'graph.php';
				
				if(isset($_GET['opcao'])){
					$opcoes=$em->executeQuery("SELECT * FROM OPCAO WHERE ID_VOTACAO = " . $opcao->idVotacao);
				}
				else{
					$opcoes=$em->executeQuery("SELECT * FROM OPCAO WHERE ID_VOTACAO = " . $idVotacao);
				}
					
				$count=0;
				if($opcoes != FALSE){
					while($opcao = mysqli_fetch_array($opcoes)){
						$values[$count] = $opcao['NUM_VOTOS'];
					    $count++;
					}
				}
				
				generateGraph($values);
			?>
			<img id="graph" src="graph/file.jpg" />
			<br/>
			<div data-role='fieldcontain'>
	            <fieldset data-role='controlgroup' data-type='vertical' data-mini='true'>
	                <input id='checkbox3' name='atualizaVotos' type='checkbox' checked='true' value='1' onClick='change();'>
	                <label for='checkbox3'>
	                    Atualizar resultados automaticamente
	                </label>
	            </fieldset>
	        </div>
          </div>
          <?
          	if(isset($_GET['opcao'])){
          		echo "<a data-role='button' onClick='stopInterval();' data-transition='fade' data-theme='b' href='reuniao.php?reuniao=" . getReuniao() . "' >
			          		Concluir
			          </a>";
          	}
          	else{
          		echo "<a data-role='button' onClick='stopInterval();' data-transition='fade' data-theme='b' data-rel='back'>
			          		OK
			          </a>";
          	}

			// logica para atualizar o grafico de status
	     	if(isset($_GET['votacao'])){
	     		echo "<input type='hidden' id='votacaoId' value='". $_GET['votacao'] ."'>";
	     	}
	     	else{
	     		$idOpcao=$_GET['opcao'];
				$opcao = $em->findOpcaoById($idOpcao);
				echo "<input type='hidden' id='votacaoId' value='". $opcao->idVotacao ."'>";
	     	}
	     ?>
      </div>
      <div data-theme="a" data-role="footer" data-position="fixed">
          <h3>
              G. Parmezani
          </h3>
      </div>
  </div>
</body>
</html>
