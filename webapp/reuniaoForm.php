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
		<!-- cadastrarReuniao -->
		<div data-role="page" id="page10">
		    <div data-theme="a" data-role="header">
		    <?php
		    	require_once '../model/ReuniaoModel.php';
		    	require_once '../dao/EntityManager.php';
		    
		    	$reuniao = new ReuniaoModel();
		    	$em = new EntityManager();
		    	
		    	if(isset($_GET['reuniao']) && $_GET['reuniao'] != ""){
		    		$reuniao = $em->findReuniaoById($_GET['reuniao']);
		    	}
		    	
		    ?>
		        <a id="home" data-role="button" data-transition="flow" data-theme="b" href="../index.php" class="ui-btn-right">
		            Home
		        </a>
		        <h3>
		            Reunião
		        </h3>
		    </div>
		    <div data-role="content">
		        <form action="reuniaoFormSubmit.php" method="GET">
		            <div data-role="fieldcontain">
		                <label for="textinput6">
		                    Código
		                </label>
		                <input id="codigo" name="codigo" class="codigo" id="textinput6" placeholder="Apenas números" value="<?echo $reuniao->codigo;?>" type="number">
		            </div>
		            <div data-role="fieldcontain">
		                <label for="ativa">
		                    Ativa
		                </label>
		                <select name="ativa" id="ativa" data-theme="" data-role="slider">
		                	<?
		                		if($reuniao->ativa == 1){
		                			echo "<option value='0'>
						                        Não
						                    </option>
						                    <option value='1' selected='selected'>
						                        Sim
						                    </option>";
		                		}
		                		else{
		                			echo "<option value='0'>
						                        Não
						                    </option>
						                    <option value='1'>
						                        Sim
						                    </option>";
		                		}
		                	?>
		                </select>
		            </div>
			   	  	<input type="hidden" id="hiddenId" name="hiddenId" value="<? echo $reuniao->id; ?>"/>
		            <input type="submit" data-theme="b" value="Salvar">
		        </form>
		        <a data-role="button" href="reuniaoGrid.php" data-icon="arrow-l" data-iconpos="left">
		              Reuniões
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
