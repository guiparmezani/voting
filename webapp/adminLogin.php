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
        <style type='text/css'>
	        html { background-color: #333; }
	        @media only screen and (min-width: 600px){
	            .ui-page {
	                width: 500px !important;
	                margin: 0 auto !important;
	                position: relative !important;
	                border-right: 5px #000 outset !important;
               		border-left: 5px #000 outset !important;
	            }
	            .ui-footer {
	                width: 500px !important;
	                margin: 0 auto !important;
	                
	            }
	        }
		</style>
        <script src="https://s3.amazonaws.com/codiqa-cdn/jquery-1.7.2.min.js">
        </script>
        <script src="https://s3.amazonaws.com/codiqa-cdn/mobile/1.2.0/jquery.mobile-1.2.0.min.js">
        </script>
        <script src="js/my.js">
        </script>
    </head>
    <body>
        <!-- adminLogin -->
		<div data-role="page" id="page8">
		    <div data-theme="a" data-role="header">
		    <script>
		        function validateForm(form){
				    var usuario = document.getElementsByName("usuario");
				    var senha = document.getElementsByName("senha");
				
					for (var i=0, len=usuario.length; i<len;i++){
				        if (usuario[i].value == "" || usuario[i].value == null){
					        alert("Usuário deve ser preenchido");
					    	return false;
				        }
				    }
				    
				    for (var i=0, len=senha.length; i<len;i++){
				        if (senha[i].value == "" || senha[i].value == null){
				        	alert("Senha deve ser preenchida");
					    	return false;
				        }
				    }
				
				    form.action="adminLoginValidate.php";
					return true;
				}
				
		        </script>
		    	<a id="home" data-role="button" data-transition="flow" data-theme="b" href="../index.php" class="ui-btn-right">
	              Home
	          	</a>
		        <h3>
		            Login
		        </h3>
		    </div>
		    <div data-role="content">
		        <form id="form" action="" method="POST" onSubmit="validateForm(this);" data-transition="fade">
		            <div data-role="fieldcontain">
		                <label for="textinput2">
		                    Usuário
		                </label>
		                <input name="usuario" id="textinput2" placeholder="" value="" type="text">
		            </div>
		            <div data-role="fieldcontain">
		                <label for="textinput3">
		                    Senha
		                </label>
		                <input name="senha" id="textinput3" placeholder="" value="" type="password">
		            </div>
		            <input type="submit" data-theme="b" value="Logar">
		        </form>
		        <a data-role="button" data-transition="flip" href="../index.php" data-icon="arrow-l" data-iconpos="left">
		              Voltar
		          </a>
		    </div>
		    <div data-theme="a" data-role="footer" data-position="fixed">
                <h5>
                    G. Parmezani - UDESC
                </h5>
            </div>
		</div>
    </body>
</html>
