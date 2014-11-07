<!-- reuniaoFormRemove -->
<div data-role="page" id="page7">
    <div data-theme="a" data-role="header">
    	<a id="home" data-role="button" data-transition="flow" data-theme="b" href="../index.php" class="ui-btn-right">
         	Home
      	</a>
      	<h3>
      		Participante
      	</h3>
    </div>
    <div data-role="content">
        <div>
           <?php
      	
      		require_once '../dao/EntityManager.php';
      		
      		$em = new EntityManager();
      		$result = $em->removeParticipante($_GET['participante']);
      		
      		if($result == TRUE){
      			echo "<p style='text-align: center;'>
			            Participante excluído com sucesso.
			        </p>";
      		}
      		else{
      			echo "<p style='text-align: center;'>
			            Houve um erro ao tentar excluir o participante.
			        </p>";
      		}
      	
      	?>
        <a data-role="button" href="participanteGrid.php" data-icon="arrow-l" data-iconpos="left">
            Participantes
        </a>
        <a data-role="button" data-theme="b" href="adminHome.php">
            Início
        </a>
    </div>
    <div data-theme="a" data-role="footer" data-position="fixed">
        <h5>
            G. Parmezani - UDESC
        </h5>
    </div>
</div>
