<?
    	session_start();
    ?>
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
        <style>
            /* App custom styles */
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js">
        </script>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery.mobile/1.1.1/jquery.mobile-1.1.1.min.js">
        </script>
        <script src="js/my.js">
        </script>
    </head>
    <body>
        <!-- Home -->
        <div data-role="page" id="page1">
            <div data-theme="a" data-role="header">
	            <a id="home" data-role="button" data-transition="flow" data-transition="flow" data-theme="b" href="../index.php" class="ui-btn-right">
	              Home
	          	</a>
	          	<?
	          	
	          		require_once '../dao/EntityManager.php';
	             
             		$em = new EntityManager();
					$votacoes = $em->findVotacaoByIdReuniaoWithoutSugestao($_GET["reuniao"]);
					$reuniao = $em->findReuniaoById($_GET['reuniao']);
					
					echo "<h3>
		                    Reunião " . $reuniao->codigo . "
		                  </h3>";
	          	
	          	?>
                
            </div>
            <div data-role="content" style="padding: 15px">
                    <?php
                    
						if($votacoes != null){
							 echo "<ul data-role='listview' data-divider-theme='b' data-inset='true'>
					                    <li data-role='list-divider' role='heading'>
					                        Votações Ativas
					                    </li>";
							for($i=0 ; $i<count($votacoes) ; $i++){
							    echo "<li data-theme='c''><a href='votacao.php?id=". $votacoes[$i]->id ."'>". $votacoes[$i]->titulo ."</a></li>";
							}
							echo "</ul>";
						}
						else{
							if($votacoes === null){
								echo "<div align='center'><h5>Não existem votações cadastradas para esta reunião.</h5></div>";
							}
						}
						
                    ?>
                    <form id="form" name="form" action="votacaoForm.php" method="GET" data-transition="fade">
		                <input type='hidden' name='sugestao' value='1' />
		                <input type='hidden' name='reuniao' value='<?echo $reuniao->id;?>' />
		                <input type="submit" data-theme='e' value="Sugerir Votação" />
                	</form>
                <a data-role="button"  data-transition="fade" data-theme="c" href="participanteLogin.php" data-icon="arrow-l" data-iconpos="left">
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