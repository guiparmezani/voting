<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black" />
        <title>
        Voting
        </title>
        <link rel="stylesheet" href="https://s3.amazonaws.com/codiqa-cdn/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
        <link rel="stylesheet" href="css/my.css" />
        <script src="https://s3.amazonaws.com/codiqa-cdn/jquery-1.7.2.min.js">
        </script>
        <script src="https://s3.amazonaws.com/codiqa-cdn/mobile/1.2.0/jquery.mobile-1.2.0.min.js">
        </script>
        <script src="js/my.js">
        </script>
    </head>
    <body>
		<!-- cadastrarVotacaoSubmit -->
		<div data-role="page" id="page7">
		    <div data-theme="a" data-role="header">
		    	<a id="home" data-role="button" data-transition="flow" data-theme="b" href="../index.php" class="ui-btn-right">
	             	Home
	          	</a>
		        <h3>
		            Cadastro Realizado
		        </h3>
		    </div>
		    <div data-role="content">
		        <div>
		            <h3 id="textinput4" align="center">
		                    Título
		            </h3>
		            <p style="text-align: center;"><?php echo $_GET["titulo"]; ?></p></br>
		        </div>
		        <div>
		            <h3 id="textinput4" align="center">
		                    Pergunta
		            </h3>
		            <p style="text-align: center;"><?php echo $_GET["pergunta"]; ?></p></br>
		        </div>
		        <div>
		            <h3 id="textinput4" align="center">
		                    Opções
		            </h3>
		            </div>
		            <?
		            	for($count = 1 ; $count<=$_GET['hidden'] ; $count++){
		            		echo "<p style='text-align: center;'>" . $count . ") " . $_GET['name' . $count]  . "</p>";
		            	}
		            	
		            	if($_GET["sugestao"] == 1){
		            		echo "<a data-role='button' href='reuniao.php?reuniao=". $_GET["reuniao"] ."' data-icon='arrow-l' data-iconpos='left'>
						            Votações
						        </a>";
		            	}
		            	else{
		            		echo "<a data-role='button' href='votacaoGrid.php' data-icon='arrow-l' data-iconpos='left'>
						            Votações
						        </a><a data-role='button' data-theme='b' href='adminHome.php'>
						            Início
						        </a>";
		            	}
		            ?>
		            
		    </div>
		    <div data-theme="a" data-role="footer" data-position="fixed">
		        <h3>
		            G. Parmezani
		        </h3>
		    </div>
		    
		    <?
		    
		    	require_once '../dao/EntityManager.php';
         		require_once '../model/VotacaoModel.php';
         		require_once '../model/OpcaoModel.php';
         		
				$votacao=new VotacaoModel();
				
				$votacao->id = $_GET["hiddenId"];
				$votacao->pergunta = $_GET["pergunta"];
				$votacao->titulo = $_GET["titulo"];
				$votacao->idReuniao= $_GET["reuniao"];
				$votacao->sugestao= $_GET["sugestao"];
				
				if($votacao->sugestao == 1){
					$votacao->titulo = $votacao->titulo . " (Sugerida por Participante)";
				}
				$em = new EntityManager();
				$em->insertOrUpdateVotacao($votacao);
				
				$votacao = $em->findVotacaoLastInserted();
				$opcoes = $em->findOpcaoByIdVotacao($votacao->id);
				
				if(isset($_GET['apagarVotos']) || $_GET['hidden'] > sizeof($opcoes)){
					$em->removeOpcoesByIdVotacao($votacao->id);
				
					for($count = 1 ; $count<=$_GET['hidden'] ; $count++){
						$opcao=new OpcaoModel();
						$opcao->idVotacao = $votacao->id;
						$opcao->descricao = $_GET['name' . $count];
						
						$em->insertOrUpdateOpcao($opcao);
					}
				}
				else{
					$count = 1;
					
					foreach($opcoes as $op){
						$op->descricao = $_GET['name' . $count];
						$em->insertOrUpdateOpcao($op);
						$count++;
					}
				}
		    ?>
		    <div data-theme="a" data-role="footer" data-position="fixed">
                <h5>
                    G. Parmezani - UDESC
                </h5>
            </div>
		</div>
    </body>
</html>
