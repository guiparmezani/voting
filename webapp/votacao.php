<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <title>Voting</title>
  <link rel="stylesheet" href="https://s3.amazonaws.com/codiqa-cdn/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
  <link rel="stylesheet" href="css/my.css" />
  <script src="https://s3.amazonaws.com/codiqa-cdn/jquery-1.7.2.min.js"></script>
  <script src="https://s3.amazonaws.com/codiqa-cdn/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
  <script src="js/my.js"></script>
  <script type="text/javascript">
		
  </script>
</head>
<body>
  <!-- votacao -->
  <div data-role="page" id="page4">
      <div data-theme="a" data-role="header">
      	  <script>
		        function validateForm(form){
				    var elements = document.getElementsByName("opcao");
				
				    for (var i=0, len=elements.length; i<len;i++){
				        if (elements[i].checked){
				        	form.action="votacaoStatus.php";
				        	return true;
				        }
				    }
				    alert("Uma opção deve ser selecionada");
				    return false;
				}
				
		        </script>
      	  <a id="home" data-role="button" data-transition="flow" data-theme="b" href="../index.php" class="ui-btn-right">
              Home
          </a>
          <?
          	require_once '../dao/EntityManager.php';
                  	  	
            $em=new EntityManager();
            
            $votacao = $em->findVotacaoById($_GET['id']);
          ?>
          <h3 id="titulo">
              <?php
              	echo $votacao->titulo;
              ?>
          </h3>
      </div>
      <div data-role="content">
          <h2 id="pergunta">
              <?php
              	echo $votacao->pergunta;
              ?>
          </h2>
          <form name="form" action="" onsubmit="validateForm(this);" method="get">
              <div id="opcoes" data-role="fieldcontain">
                  <fieldset data-role="controlgroup" data-type="vertical">
                  	<label>
                    	Opções:
                    </label>
                    </br></br>
                  	  <?php
                  	  		
						$opcoes = $em->findOpcaoByIdVotacao($_GET['id']);
						
						if($opcoes != null){
							for($i=0 ; $i<count($opcoes) ; $i++){
							    echo "<input id='".$opcoes[$i]->id."' name='opcao' value='".$opcoes[$i]->id."' type='radio'>
				                      <label for='".$opcoes[$i]->id."'>
				                          ".$opcoes[$i]->descricao."
				                      </label>";
							}
						}
                  	  		
                  	  ?>
                  
                  </fieldset>
              </div>
              <div class="ui-grid-a">
                <div class="ui-block-a">
                    <input type="submit" data-theme="b" data-icon="check" data-iconpos="left"
                    value="Votar">
                </div>
                <div class="ui-block-b">
                    <a data-role="button" data-theme="e" href='votacaoStatus.php?votacao=<?echo $_GET['id'];?>'>
                        Resultados
                    </a>
                </div>
            </div>
          </form>
          <a id="voltar" data-role="button" data-rel="back" data-icon="arrow-l"
          data-iconpos="left">
              Voltar
          </a>
      </div>
      <div data-theme="a" data-role="footer" data-position="fixed">
          <h3 id="footer">
              G. Parmezani - UDESC
          </h3>
      </div>
  </div>

  
</body>
</html>
