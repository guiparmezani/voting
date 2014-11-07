<?php
	require_once '../model/ParticipanteModel.php';
	require_once '../dao/EntityManager.php';
	
	class Session{
		
		function getUsuarioAtual(){
			
			if($_SESSION['validacao'] == 1){
				
				$em = new EntityManager();
				$participante =  $em->findParticipanteById($_SESSION['id']);
				
				return $participante;
			}
			else{
				return false;
			}
		}
		
	}
?>