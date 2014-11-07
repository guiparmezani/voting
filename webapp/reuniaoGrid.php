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
		<!-- reuniaoGrid -->
		<div data-role="page" id="page12">
		    <div data-theme="a" data-role="header">
		    <script type="text/javascript">
			        function excluir(){
			        	var array = document.getElementsByName("reuniao");
						var valida = false;
						for(var i=0 ; i<array.length ; i++){
							if(document.getElementById(array[i].id).checked){
								valida = true; 
								break;
							}
						}
						if(valida){
							var x;
							var r=confirm("Tem certeza que deseja remover a reunião (todas as votações relacionadas serão excluídas)?");
							if (r==true){
								form.action="reuniaoFormRemove.php";
							}
							else{
								return false;
							}
						}
						else{
							alert("Uma Reunião deve ser selecionada.");
							return false;
						}
					}
					function nova(){
						var array = document.getElementsByName("reuniao");
						for(var i=0 ; i<array.length ; i++){
							document.getElementById(array[i].id).value="";
						}
						form.action="reuniaoForm.php";
					}
					function editar(){
						var array = document.getElementsByName("reuniao");
						var valida = false;
						for(var i=0 ; i<array.length ; i++){
							if(document.getElementById(array[i].id).checked){
								valida = true; 
								break;
							}
						}
						if(valida){
							form.action="reuniaoForm.php";
						}
						else{
							alert("Uma Reunião deve ser selecionada.");
							return false;
						}
					}
				</script>
		        <h3>
		            Reuniões
		        </h3>
		        <a id="home" data-role="button" data-transition="flow" data-theme="b" href="../index.php" class="ui-btn-right">
	             	Home
	          	</a>
		    </div>
		    <div data-role="content">
		        <div>
		            <p style="text-align: center;">
		                <span style="font-size: small;">
		                    Selecione uma das reuniões
		                </span>
		            </p>
		        </div>
		        <form id="form" action="">
		            <div id="radio" data-role="fieldcontain">
		                <fieldset data-role="controlgroup" data-type="vertical">
		                <?
		                    	require_once '../dao/EntityManager.php';
		                    	
		                    	$em=new EntityManager();
		                    	$reunioes=$em->findAllReuniao();
		                    	
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
									echo "Erro ao carregar as reuniões";
		                    	
		                    ?>
		                </fieldset>
		            </div>
		            <div class="ui-grid-b">
		                <div class="ui-block-a">
		                    <input type="submit" onclick="nova();" data-theme="b" value="Nova">
		                </div>
		                <div class="ui-block-b">
		                    <input type="submit" onclick="editar();" data-theme="e" value="Editar">
		                </div>
		                <div class="ui-block-c">
		                    <input type="submit" onclick="excluir();" data-theme="a" value="Excluir">
		                </div>
		            </div>
		        </form>
		        <a data-role="button" href="adminHome.php" data-icon="arrow-l" data-iconpos="left">
		            Início
		        </a>
		    </div>
		    <div data-theme="a" data-role="footer" data-position="fixed">
		        <h3>
		            G. Parmezani - UDESC
		        </h3>
		    </div>
		</div>
	</body>
</html>