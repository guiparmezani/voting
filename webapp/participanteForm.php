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
        <!-- User-generated css -->
        <style>
        </style>
        <!-- User-generated js -->
    </head>
    <body>
        <!-- Home -->
        <div data-role="page" id="page1">
            <div data-theme="a" data-role="header">
	            <script>
		            function validateForm(form){
		            	
		            	var name = document.forms["form"]["nome"].value;
		            	var password = document.forms["form"]["senha"].value;
		            	var instituition = document.forms["form"]["instituicao"].value;
		            	
						if ((name == "" || name == null) || (password == "" || password == null) || (instituition == "" || instituition == null)){
							  alert("Todos os campos são obrigatórios");
							  form.action = "";
						}
						else{
							form.action = "participanteFormSubmit.php";
						}
					}
		        </script>
		        
		        <?php
			    	require_once '../model/ParticipanteModel.php';
			    	require_once '../dao/EntityManager.php';
			    
			    	$participante = new ParticipanteModel();
			    	$em = new EntityManager();
			    	
			    	if(isset($_GET['participante']) && $_GET['participante'] != ""){
			    		$participante = $em->findParticipanteById($_GET['participante']);
			    	}
			    ?>
	            <a id="home" data-role="button" data-transition="flow" data-theme="b" href="../index.php" class="ui-btn-right">
	              Home
	          	</a>
                <h2>
                    Participante
                </h2>
            </div>
            <div data-role="content">
                <form id="form" name="form" action="" method="get" onsubmit="validateForm(this);">
                    <div data-role="fieldcontain" id="name">
                        <label for="name">
                            Nome
                        </label>
                        <input name="nome" id="name" placeholder="Usuario" value="<?echo $participante->usuario;?>" type="text" />
                    </div>
                    <div data-role="fieldcontain" id="senha">
                        <label for="senha">
                            Senha
                        </label>
                        <input name="senha" id="senha" placeholder="Senha" value="<?echo $participante->senha;?>" type="password" />
                    </div>
                    <div data-role="fieldcontain" id="instituition">
                        <label for="instituition">
                            Empresa/Universidade
                        </label>
                        <input name="instituicao" id="instituition" placeholder="Empresa" value="<?echo $participante->instituicao;?>" type="text" />
                    </div>
 		   	  	    <input type="hidden" id="hiddenId" name="hiddenId" value="<? echo $participante->id; ?>"/>
                    <input type="submit" data-theme="b" value="Salvar" />
                    <a id="backButton" data-role="button" data-rel="back" data-icon="arrow-l" data-iconpos="left">
                        Voltar
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
