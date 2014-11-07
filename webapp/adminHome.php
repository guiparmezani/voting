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
        <script src="js/my.js">
        </script>
        <script src="https://s3.amazonaws.com/codiqa-cdn/jquery-1.7.2.min.js">
        </script>
        <script src="https://s3.amazonaws.com/codiqa-cdn/mobile/1.2.0/jquery.mobile-1.2.0.min.js">
        </script>
    </head>
    <body>
        <!-- Home -->
        <div data-role="page" id="page1">
            <div data-theme="a" data-role="header">
	            <a id="home" data-role="button" data-transition="flow"  data-theme="b" href="../index.php" class="ui-btn-right">
	              Home
	          	</a>
                <h3>
                    Administrador
                </h3>
            </div>
            <div data-role="content" align="center">
                <h5>
                    Selecione uma das opções abaixo para visualizar e editar registros:
                </h5>
                <a data-role="button" data-transition="fade" data-theme="a" href="votacaoGrid.php">
                    Votações
                </a>
                <a data-role="button" data-transition="fade" data-theme="a" href="reuniaoGrid.php">
                    Reuniões
                </a>
                <a data-role="button" data-transition="fade" data-theme="a" href="participanteGrid.php">
                    Participantes
                </a>
            
	            <form action="votacaoGrid.php" method="GET">
		            <div>
		                <p style="text-align: center;">
		                    <span style="font-size: small;">
		                        Selecione a opção abaixo para administrar as sugestões de votações feitas
		                        por participantes:
		                    </span>
		                </p>
		                <input type="hidden" id="sugestao" name="sugestao" value="1"/>
		            </div>
		            <input type="submit" data-theme="e" value="Sugestões">
	            </form>
            </div>
            <div data-role="content" align="center">
	            <a data-role="button"  data-transition="fade" data-theme="c" href="../index.php" data-icon="arrow-l" data-iconpos="left">
	            	Voltar
	            </a>
            </div>
            <div data-theme="a" data-role="footer" data-position="fixed">
                <h5>
                    G. Parmezani - UDESC
                </h5>
            </div>
        </div>
    </body>
</html>
