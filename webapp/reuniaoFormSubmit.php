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
		        <!-- cadastrarReuniaoSubmit -->
		<div data-role="page" id="page7">
		    <div data-theme="a" data-role="header">
		    	<a id="home" data-role="button" data-transition="flow" data-theme="b" href="../index.php" class="ui-btn-right">
	             	Home
	          	</a>
		        <h3>
		            Reunião
		        </h3>
		    </div>
		    <div data-role="content">
		    <?
		    
		    	require_once '../dao/EntityManager.php';
         		require_once '../model/ReuniaoModel.php';
         		
				$reuniao=new ReuniaoModel();
				
				$reuniao->id = $_GET['hiddenId'];
				$reuniao->codigo = $_GET["codigo"];
				$reuniao->ativa = $_GET['ativa'];
				
				$em = new EntityManager();
				$validate = $em->insertOrUpdateReuniao($reuniao);
				
				if($validate == null){
					echo "<h3 align='center'>Código informado já está cadastrado, favor informar outro.</h3></br>";
				}
				
		    ?>
		        <div>
		            <p style="text-align: center;">
		                    Código
		            </p>
		            <h3 id="textinput4" align="center"><?php echo $_GET["codigo"]; ?></h3></br>
		        </div>
		        <div>
		            <p style="text-align: center;">
		                    Ativa
		            </p>
		            <h3 id="textinput4" align="center"><?php if($_GET["ativa"] == 1) echo "Sim"; else echo "Não";?></h3></br>
		        </div>
		        <a data-role="button" href="reuniaoGrid.php" data-icon="arrow-l" data-iconpos="left">
		            Reuniões
		        </a>
		        <a data-role="button" data-theme="b" href="votacaoForm.php">
		            Cadastrar uma Votação
		        </a>
		    </div>
		    <div data-theme="a" data-role="footer" data-position="fixed">
		        <h3>
		            G. Parmezani - UDESC
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
