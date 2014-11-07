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
    </head>
    <body>
        <!-- Home -->
        <div data-role="page" id="page1">
            <div data-theme="a" data-role="header">
	            <script>
		        function validateForm(form){
				    var reuniao = document.getElementsByName("reuniao");
				    var usuario = document.getElementsByName("usuario");
				    var senha = document.getElementsByName("senha");
				
					for (var i=0, len=usuario.length; i<len;i++){
				        if (usuario[i].value == "" || usuario[i].value == null){
					        alert("Usuário deve ser preenchido");
					    	return false;
				        }
				    }
				    
				    for (var i=0, len=senha.length; i<len;i++){
				        if (senha[i].value == "" || senha[i].value == null){
				        	alert("Senha deve ser preenchida");
					    	return false;
				        }
				    }
				
				    for (var i=0, len=reuniao.length; i<len;i++){
				        if (reuniao[i].checked){
						    form.action="participanteLoginValidate.php";
						    return true;
						}
					}
					alert("Uma reunião deve ser selecionada");
				    return false;
				}
				
		        </script>
	            <a id="home" data-role="button" data-transition="flow" data-transition="flow" data-theme="b" href="../index.php" class="ui-btn-right">
	              Home
	          	</a>
                <h3>
                    Conecte-se
                </h3>
            </div>
            <div data-role="content" style="padding: 15px">
            <form id="form" name="form" action="" method="POST" onsubmit="validateForm(this);">
                <div data-role="fieldcontain">
                    <fieldset data-role="controlgroup">
                        <label for="textinput1">
                            Nome:
                        </label>
                        <input name="usuario" id="textinput1" placeholder="Usuário" value="" type="text" />
                    </fieldset>
                </div>
                <div data-role="fieldcontain">
                    <fieldset data-role="controlgroup">
                        <label for="textinput1">
                            Senha:
                        </label>
                        <input name="senha" id="textinput1" placeholder="Senha" value="" type="password" />
                    </fieldset>
                </div>
                <div data-role="fieldcontain">
                <fieldset data-role="controlgroup" data-type="vertical" data-mini="true">
                    <label>
                        Reunião:
                    </label>
                    </br></br>
                    
                    <?
                    
                    	require_once '../dao/EntityManager.php';
                    	
                    	$em=new EntityManager();
                    	
                    	$reunioes=$em->findReunioesAtivas();
                    	
                    	if($reunioes != null){
                    		$count=0;
							for($i=0 ; $i<count($reunioes) ; $i++){
								$count++;
							    echo "<input name='reuniao' value='" . $reunioes[$i]->id . "' id='radio" . $reunioes[$i]->id . "' data-theme='c' type='radio'>
					                    <label for='radio" . $reunioes[$i]->id . "'>
					                        " . $reunioes[$i]->codigo . "
					                    </label>";
							}
						}
						else
							echo "Não há nenhuma reunião ativa no momento";
                    	
                    ?>
                    
                </fieldset>
            </div>
            <input type="submit" data-theme="b" value="Conectar" />
            <a id="backButton" data-role="button" href="participanteHome.php" data-icon="arrow-l" data-iconpos="left">
                    Início
            </a>
            </form>
        	</div>
            <div data-theme="a" data-role="footer" data-position="fixed">
                <h5>
                    G. Parmezani - UDESC
                </h5>
            </div>
        </div>
    </body>
</html>