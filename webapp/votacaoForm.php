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
        <style>
            /* App custom styles */
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js">
        </script>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery.mobile/1.1.1/jquery.mobile-1.1.1.min.js">
        </script>
        <script src="js/my.js">
        </script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
    </head>
    <body>
        <!-- cadastrarVotacao -->
  <div data-role="page" id="page6">
      <div data-theme="a" data-role="header">
	      <script type="text/javascript">
		    
		        $(document).ready(function() {
		            $('#btnAdd').click(function() {
		                var num     = $('.clonedInput').length; // how many "duplicatable" input fields we currently have
		                var newNum  = new Number(num + 1);      // the numeric ID of the new input field being added
		                
		                $('#checkbox3').attr('disabled','disabled');
		 
		                // create the new element via clone(), and manipulate it's ID using newNum value
		                var newElem = $('#input' + num).clone().attr('id', 'input' + newNum);
		 
		                // manipulate the name/id values of the input inside the new element
		                newElem.children(':first').attr('id', 'name' + newNum).attr('name', 'name' + newNum);
		 
		                // insert the new element after the last "duplicatable" input field
		                $('#input' + num).after(newElem);
		 
		                // enable the "remove" button
		                $('#btnDel').attr('disabled','');
		 
		                // business rule: you can only add 5 names
		                if (newNum == 5)
		                    $('#btnAdd').attr('disabled','disabled');
		                $('#hidden').attr('value',newNum);
		            });
		 
		            $('#btnDel').click(function() {
		                var num = $('.clonedInput').length; // how many "duplicatable" input fields we currently have
		                $('#input' + num).remove();     // remove the last element
		 
		                // enable the "add" button
		                $('#btnAdd').attr('disabled','');
		 
		                // if only one element remains, disable the "remove" button
		                if (num-1 == 1)
		                    $('#btnDel').attr('disabled','disabled');
		            });
		 
		            $('#btnDel').attr('disabled','disabled');
		        });
		        
		        function change(){
		        	if(document.getElementById("checkbox3").checked){
		        		document.getElementById("btnAdd").disabled = false;
		        	}
		        	else{
		        		document.getElementById("btnAdd").disabled = true;
		        	}
		        }
		        
		    </script>
		    
		    <?php
		    	require_once '../model/VotacaoModel.php';
		    	require_once '../dao/EntityManager.php';
		    
		    	$votacao = new VotacaoModel();
		    	$em = new EntityManager();
		    	
		    	if(isset($_GET['votacao']) && $_GET['votacao'] != ""){
		    		$votacao = $em->findVotacaoById($_GET['votacao']);
		    	}
		    	
		    ?>
		    
     	  <a id="home" data-role="button" data-transition="flow" data-theme="b" href="../index.php" class="ui-btn-right">
	          Home
	      </a>
          <h3>
              Votação
          </h3>
      </div>
      <div data-role="content">
      <?
      if(isset($_GET['votacao']) && $_GET['votacao'] != ""){
      	echo "
	      <div>
	            <table border='1' align='center' style='' data-mce-style=''>
	                <tbody>
	                    <tr>
	                        <td style='text-align: center;' data-mce-style='text-align: center;'>
	                            <span style='color: rgb(255, 0, 0); font-size: small;' data-mce-style='color: #ff0000; font-size: small;'>
	                                ATENÇÃO: Por padrão, ao editar uma votação, os votos da mesma são apagados.
	                                Defina se os votos serão apagados através &nbsp;da opção '
	                                <strong>
	                                    Apagar votos
	                                </strong>
	                                ' deste formulário.
	                            </span>
	                        </td>
	                    </tr>
	                </tbody>
	            </table>
	        </div>
	        ";
      }
	  ?>
          <form id="form" action="votacaoFormSubmit.php" method="GET" data-transition="fade">
              <div data-role="fieldcontain" id="titulo">
                  <label for="titulo">
                      Título
                  </label>
                  <input name="titulo" id="titulo" placeholder="Digite o título" value="<?echo $votacao->titulo;?>" type="text">
              </div>
              <div data-role="fieldcontain">
                  <label for="textarea1">
                      Pergunta:
                  </label>
                  <textarea name="pergunta" id="textarea1" placeholder="Digite a pergunta"><?echo $votacao->pergunta;?></textarea>
              </div>
              <div data-role="fieldcontain">
                    <?
	                    if(!isset($_GET['sugestao'])){
	                    	echo "<fieldset data-role='controlgroup' data-type='vertical' data-mini='true'>
					                <label>
					                    Reunião:
					                </label>
					                </br></br>";
	                    	$reunioes=$em->findAllReuniao();
	                    	
	                    	if($reunioes != null){
	                    		$count=0;
								foreach($reunioes as $r){
									$count++;
									if($r->id != $votacao->idReuniao){
									    echo "<input id='radio" . $r->id . "' name='reuniao' value='" . $r->id . "' data-theme='c' type='radio'>
							                    <label for='radio" . $r->id . "'>
							                        " . $r->codigo . "
							                    </label>";
									}
									else{
										echo "<input id='radio" . $r->id . "' name='reuniao' value='" . $r->id . "' data-theme='c' type='radio' checked>
							                    <label for='radio" . $r->id . "'>
							                        " . $r->codigo . "
							                    </label>";
									}
								}
								echo "</fieldset>";
							}
							else
								echo "Não há reuniões cadastradas";
	                    }
	                    else{
	                    	echo "<input name='reuniao' value='" . $_GET['reuniao'] . "' type='hidden'>";
	                    }
                    ?>
                    
            </div>
            <?
            	if(isset($_GET['votacao']) && $_GET['votacao'] != ""){
      				echo "<div data-role='fieldcontain'>
				            <fieldset data-role='controlgroup' data-type='vertical' data-mini='true'>
				                <input id='checkbox3' name='apagarVotos' type='checkbox' checked='true' value='1' onClick='change();'>
				                <label for='checkbox3'>
				                    Apagar Votos
				                </label>
				            </fieldset>
				        </div>";
            	}
            	else echo "<input type='hidden' name='apagarVotos' value='0'";
            ?>
              <h4>
                  Opções
              </h4>
              
              <?
              if(isset($_GET['votacao']) && $_GET['votacao'] != ""){
              	  $count=1;
	              $opcoes = $em->findOpcaoByIdVotacao($votacao->id);
	              
	              for($i=0 ; $i<count($opcoes) ; $i++){
	              	$descricao[$count] = $opcoes[$i]->descricao;
	              	$count++;
	              }
	              
	              	for($i=1 ; $i<$count ; $i++){
	              		echo "<div id='input".$i."' data-role='fieldcontain' class='clonedInput' >
				                  Opção <input type='text' name='name".$i."' id='name".$i."' value='".$descricao[$i]."' />
						   	  </div>";
	              	}
              }
              else{
              	$count=2;
              	echo "<div id='input1' data-role='fieldcontain' class='clonedInput' >
		                  Opção <input type='text' name='name1' id='name1' value='' />
				   	  </div>";
              }
              ?>
              
		      <input type="button" data-mini="true" data-inline="true" data-theme="a" data-icon="plus" data-iconpos="left" id="btnAdd" value="Add" />
		      <input type="button" data-mini="true" data-inline="true" data-theme="a" data-icon="minus" data-iconpos="left" id="btnDel" value="Del" />
              
		   	  <input type="hidden" id="hidden" name="hidden" value="<?echo ($count -1);?>"/>
		   	  <input type="hidden" id="hiddenId" name="hiddenId" value="<? echo $votacao->id; ?>"/>
		   	  
		   	  <?
		   	  	if(isset($_GET['sugestao'])){
		   	  		echo "<input type='hidden' id='sugestao' name='sugestao' value='1'/>";
		   	  	}
		   	  	else{
		   	  		echo "<input type='hidden' id='sugestao' name='sugestao' value='0'/>";
		   	  	}
		   	  ?>
		   	  
              <input type="submit" data-theme="b" value="Salvar">
          </form>
          <?
          	if(isset($_GET['sugestao'])){
          		echo "<a data-role='button' data-transition='fade' data-rel='back' data-icon='arrow-l' data-iconpos='left'>
			              Votações
			          </a>";
          	}
          	else{
          		echo "<a data-role='button' data-transition='fade' href='votacaoGrid.php' data-icon='arrow-l' data-iconpos='left'>
			              Votações
			          </a>";
          	}
          ?>
      </div>
      <div data-theme="a" data-role="footer" data-position="fixed">
          <h3>
              G. Parmezani
          </h3>
      </div>
  </div>
    </body>
</html>