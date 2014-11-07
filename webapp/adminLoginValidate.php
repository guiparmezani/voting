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
        <div data-role="page" id="page1">
            <div data-theme="a" data-role="header">
            <script>
				 $(document).ready(function myFunction(){
				 	if(document.getElementById('validate').value == 'true'){
						setTimeout(function(){window.location.href="adminHome.php";},1500);
				 	}
				 	else{
				 		setTimeout(function(){window.history.back();},1500);
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
            	
            	$em = new EntityManager();
            	
            	$result=$em->executeQuery("SELECT * FROM ADMINISTRADOR WHERE USUARIO LIKE '" . $usuario . "' AND SENHA LIKE '" . $senha . "'");
            	if($result != FALSE){
            		if($result->num_rows == 0){
            			echo "<div data-role='content' align='center'>
				                <h5>
				                    Usuario ou senha incorreto(s)
				                </h5>  
		                		<h5> Você será redirecionado para a página anterior... </h5>" .
		                				"<input type='hidden' id='validate' value='false'>
				              </div>";
            		}
            		else{
            			echo "<div data-role='content' align='center'>
				                <h5>
				                    Login realizado com sucesso
				                </h5>  
		                		<h5> Você será redirecionado para a próxima página... </h5>" .
		                				"<input type='hidden' id='validate' value='true'>
				              </div>";
            		}
				}
				else{
					echo "" .
							"<div data-role='content' align='center'>
				                <h5>
				                    Erro tecnico, favor entrar em contato com o administrador do sistema.
				                </h5>" .
				                "<a data-role='button' data-theme='b' href='adminLogin.php'>
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
    </body>
</html>
