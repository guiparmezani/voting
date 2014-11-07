<?
	session_start();
?>

<div data-role="page" id="page1">
    <div data-theme="a" data-role="header">
    <script>
		 $(document).ready(function myFunction(){
		 	if(document.getElementById('validate').value == 'false'){
				setTimeout(function(){window.history.back();},1500);
		 	}
		 	else{
		 		setTimeout(function(){window.location.href="reuniao.php?reuniao=" + document.getElementById('validate').value;},1500);
		 	}
		});
	</script>
        <h3>
            Login
        </h3>
    </div>
    
    <?
    	require_once '../dao/EntityManager.php';
    	
    	$usuario=$_POST['usuario'];
    	$senha=$_POST['senha'];
    	$reuniao=$_POST['reuniao'];
    	$id=null;
    	
    	$em = new EntityManager();
    	
    	$result=$em->executeQuery("SELECT * FROM PARTICIPANTE WHERE USUARIO LIKE '" . $usuario . "' AND SENHA LIKE '" . $senha . "'");
    	if($result != FALSE){
    		if($result->num_rows == 0){
    			echo "<div data-role='content' align='center'>
		                <h5>
		                    Usuário ou senha incorreto(s)
		                </h5>  
                		<h5> Você será redirecionado para a página anterior... </h5>" .
		                				"<input type='hidden' id='validate' value='false'>
		              </div>";
    		}
    		else{
    			
    			while($row = mysqli_fetch_array($result)){
    				$id = $row['ID'];
    			}
    			
    			ob_start();
    			
    			$validacao = "1";
    			
    			$_SESSION['usuario'] = $usuario;
				$_SESSION['validacao'] = $validacao;
				$_SESSION['id'] = $id;
    			
    			echo "<div data-role='content' align='center'>
		                <h5>
		                    Login realizado com sucesso
		                </h5>  " .
		                		"<h5> Você será redirecionado para a próxima página... </h5>" .
		                				"<input type='hidden' id='validate' value='".$reuniao."'>
		              </div>";
    		}
		}
		else{
			echo "" .
					"<div data-role='content' align='center'>
		                <h5>
		                    Erro tecnico, favor entrar em contato com o administrador do sistema.
		                </h5>" .
		                "<a data-role='button' data-theme='b' href='participanteHome.php'>
		                    OK
		                </a> " .
	                "</div>";
		}
    ?>
    <div data-theme="a" data-role="footer" data-position="fixed">
        <h5>
            G. Parmezani - UDESC
        </h5>
    </div>
</div>
