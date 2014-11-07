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
        <!-- Home -->
        <div data-role="page" id="page1">
            <div data-theme="a" data-role="header">
	            <a id="home" data-role="button" data-transition="flow" data-theme="b" href="../index.php" class="ui-btn-right">
	              Home
	          	</a>
                <h2>
                    Participante
                </h2>
            </div>
            <div data-role="content">
                <div data-role="fieldcontain">
                    <p align="center">
                        Nome
                    </p>
                    <h3 id="textinput4" align="center"><?php echo $_GET["nome"]; ?></h3></br>
                </div>
                <div data-role="fieldcontain">
                    <p align="center">
                        Senha
                    </p>
                    <h3 id="textinput5" align="center"> <?php echo $_GET["senha"]; ?></h3></br>
                </div>
                <div data-role="fieldcontain">
                    <p align="center">
                        Instituicao
                    </p>
                    <h3 id="textinput6" align="center"> <?php echo $_GET["instituicao"]; ?></h3></br>
                </div>
                <div>
                	<a id="backButton" data-role="button" data-rel="back" data-icon="arrow-l" data-iconpos="left">
                        Voltar
                    </a>
                    <a id="conectar" data-theme="b" data-role="button" href="participanteLogin.php">
                        Conecte-se
                    </a>
                </div>
            </div>
            
             <?php
             		
             		require_once '../dao/EntityManager.php';
             		require_once '../model/ParticipanteModel.php';
             		
					$participante=new ParticipanteModel();
					
					$participante->id = $_GET['hiddenId'];
					$participante->usuario = $_GET["nome"];
					$participante->senha = $_GET["senha"];
					$participante->instituicao = $_GET["instituicao"];
					
					$em = new EntityManager();
					$em->insertOrUpdateParticipante($participante);
					
				?>
            <div data-theme="a" data-role="footer" data-position="fixed">
                <h5>
                    G. Parmezani - UDESC
                </h5>
            </div>
        </div>
    </body>
</html>
