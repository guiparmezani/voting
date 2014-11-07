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
	          		Votação
	          	</h3>
		    </div>
		    <div data-role="content">
		        <div>
		           <?php
	          	
	          		require_once '../dao/EntityManager.php';
	          		
	          		$em = new EntityManager();
	          		$result = $em->removeVotacao($_GET['votacao']);
	          		
	          		if($result == TRUE){
	          			echo "<p style='text-align: center;'>
					            Votação Excluída com sucesso.
					        </p>";
	          		}
	          		else{
	          			echo "<p style='text-align: center;'>
					            Houve um erro ao tentar excluir a votação.
					        </p>";
	          		}
	          	
	          	?>
		        <a data-role="button" href="votacaoGrid.php" data-icon="arrow-l" data-iconpos="left">
		            Votações
		        </a>
		        <a data-role="button" data-theme="b" href="adminHome.php">
		            Início
		        </a>
		    </div>
		    <div data-theme="a" data-role="footer" data-position="fixed">
		        <h3>
		            G. Parmezani
		        </h3>
		    </div>
		    <div data-theme="a" data-role="footer" data-position="fixed">
                <h5>
                    G. Parmezani - UDESC
                </h5>
            </div>
		</div>
    </body>
</html>
