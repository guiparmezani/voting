<div data-role="page" id="page13">
    <div data-theme="a" data-role="header">
	    <script type="text/javascript">
	        function excluir(){
	        	var array = document.getElementsByName("participante");
				var valida = false;
				for(var i=0 ; i<array.length ; i++){
					if(document.getElementById(array[i].id).checked){
						valida = true; 
						break;
					}
				}
				if(valida){
					var x;
					var r=confirm("Tem certeza que deseja remover o Participante?");
					if (r==true){
						form.action="participanteFormRemove.php";
					}
					else{
						return false;
					}
				}
				else{
					alert("Um Participante deve ser selecionado.");
					return false;
				}
			}
			function novo(){
				var array = document.getElementsByName("participante");
				for(var i=0 ; i<array.length ; i++){
					document.getElementById(array[i].id).value="";
				}
				form.action="participanteForm.php";
			}
			function editar(){
				var array = document.getElementsByName("participante");
				var valida = false;
				for(var i=0 ; i<array.length ; i++){
					if(document.getElementById(array[i].id).checked){
						valida = true; 
						break;
					}
				}
				if(valida){
					form.action="participanteForm.php";
				}
				else{
					alert("Um Participante deve ser selecionado.");
					return false;
				}
			}
		</script>
        <a data-role="button" data-transition="flow" data-theme="b" href="../index.php" class="ui-btn-right">
            Home
        </a>
        <h3>
            Participantes
        </h3>
    </div>
    <div data-role="content">
        <div>
            <p style="text-align: center;">
                <span style="font-size: small;">
                    Selecione um Participante:
                </span>
            </p>
        </div>
        <form id="form" action="">
            <div data-role="fieldcontain">
                <fieldset data-role="controlgroup" data-type="vertical">
                	<?
                    	require_once '../dao/EntityManager.php';
                    	
                    	$em=new EntityManager();
                    	$participantes=$em->findAllParticipante();
                    	
                    	if($participantes != null){
                    		$count=0;
							foreach($participantes as $p){
								$count++;
							    echo "<input name='participante' value='" . $p->id . "' id='radio" . $p->id . "' data-theme='c' type='radio'>
					                    <label for='radio" . $p->id . "'>
					                        " . $p->usuario . "
					                    </label>";
							}
						}
						else
							echo "Erro ao carregar os participantes";
                    	
                    ?>
                </fieldset>
            </div>
            <div class="ui-grid-b">
                <div class="ui-block-a">
                    <input type="submit" onclick="novo();" data-theme="b" value="Novo">
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