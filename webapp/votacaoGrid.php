<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Voting</title>
        <link rel="stylesheet" href="https://ajax.aspnetcdn.com/ajax/jquery.mobile/1.1.1/jquery.mobile-1.1.1.min.css" />
        <link rel="stylesheet" href="css/my.css" />
        <script src="js/my.js">
        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js">
        </script>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery.mobile/1.1.1/jquery.mobile-1.1.1.min.js">
        </script>
	</head>
	<body>
		<!-- votaçãoGrid -->
		<div data-role="page" id="page11">
		    <div data-theme="a" data-role="header">
			    <script type="text/javascript">
			        function excluir(){
			        	var array = document.getElementsByName("votacao");
						var valida = false;
						for(var i=0 ; i<array.length ; i++){
							if(document.getElementById(array[i].id).checked){
								valida = true; 
								break;
							}
						}
						if(valida){
							var x;
							var r=confirm("Tem certeza que deseja remover a votação?");
							if (r==true){
								form.action="votacaoFormRemove.php";
							}
							else{
								return false;
							}
						}
						else{
							alert("Uma Votação deve ser selecionada.");
							return false;
						}
			        	
					}
					function resultados(){
						var array = document.getElementsByName("votacao");
						var valida = false;
						for(var i=0 ; i<array.length ; i++){
							if(document.getElementById(array[i].id).checked){
								valida = true; 
								break;
							}
						}
						if(valida){
							form.action="votacaoStatus.php";
						}
						else{
							alert("Uma Votação deve ser selecionada.");
							return false;
						}
					}
					function nova(){
						var array = document.getElementsByName("votacao");
						for(var i=0 ; i<array.length ; i++){
							document.getElementById(array[i].id).value="";
						}
						form.action="votacaoForm.php";
					}
					function editar(){
						var array = document.getElementsByName("votacao");
						var valida = false;
						for(var i=0 ; i<array.length ; i++){
							if(document.getElementById(array[i].id).checked){
								valida = true; 
								break;
							}
						}
						if(valida){
							form.action="votacaoForm.php";
						}
						else{
							alert("Uma Votação deve ser selecionada");
						}
					}
				</script>
		        <h3>
		            Votações
		        </h3>
		        <a id="home" data-role="button" data-transition="flow" data-theme="b" href="../index.php" class="ui-btn-right">
	             	Home
	          	</a>
		    </div>
		    <div data-role="content">
		        <div>
		            <p style="text-align: center;">
		                <span style="font-size: small;">
		                    Selecione uma das votações
		                </span>
		            </p>
		        </div>
		        <form id="form" name="form" action="" method="GET" data-transition="fade">
		            <div id="radios" data-role="fieldcontain">
		                <fieldset data-role="controlgroup" data-type="vertical">
		                    <?
                    
		                    	require_once '../dao/EntityManager.php';
		                    	
		                    	$em=new EntityManager();
		                    	
		                    	if(isset($_GET['sugestao'])){
		                    		$votacoes=$em->findAllVotacaoSugestao();
		                    	}
		                    	else{
		                    		$votacoes=$em->findAllVotacao();
		                    	}
		                    	
		                    	if($votacoes != null){
		                    		$count=0;
									foreach($votacoes as $v){
										$count++;
									    echo "<input name='votacao' value='" . $v->id . "' id='radio" . $v->id . "' data-theme='c' type='radio'>
							                    <label for='radio" . $v->id . "'>
							                        " . $v->titulo . "
							                    </label>";
									}
									echo "</fieldset>
		            					</div>";
								}
								else if(isset($_GET['sugestao'])){
									echo "</fieldset>
		            						</div><p style='text-align: center;'>
							                <span style='font-size: small;'>
							                    Não há Sugestões cadastradas.
							                </span>
							            </p>";
								}
								else
									echo "</fieldset>
		            						</div><p style='text-align: center;'>
							                <span style='font-size: small;'>
							                    Não há Votações cadastradas.
							                </span>
							            </p>";
		                    	
		                    ?>
		            
		            <?
		            	if(isset($_GET['sugestao'])){
		            		echo "<div class='ui-grid-a'><div class='ui-block-a'>
				                    <input onclick='editar();' type='submit' data-theme='e' value='Avaliar'>
				                </div><div class='ui-block-b'>
					                    <input onclick='excluir();' type='submit' data-theme='a' value='Excluir'>
					                </div></div>";
		            	}
		            	else{
		            		echo "<div class='ui-grid-b'><div class='ui-block-a'>
					                    <input onclick='nova();' type='submit' data-theme='b' value='Nova'>
					                </div>
					                <div class='ui-block-b'>
					                    <input onclick='editar();' type='submit' data-theme='e'  value='Editar'>
					                </div>
					                <div class='ui-block-c'>
					                    <input onclick='excluir();' type='submit' data-theme='a' value='Excluir'>
					                </div></div>
						            <input type='submit' data-theme='b' data-icon='check' data-iconpos='top'
				            			value='Resultados' data-mini='true' onclick='resultados();'>";
		            	}
		            ?>
		            
		        </form>
		        <a data-role="button" data-transition="fade" href="adminHome.php" data-icon="arrow-l" data-iconpos="left">
		            Início
		        </a>
		    </div>
		    <div data-theme="a" data-position="fixed" data-role="footer" >
		        <h3>
		            G. Parmezani - UDESC
		        </h3>
		    </div>
		</div>
	</body>
</html>