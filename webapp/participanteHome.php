<!DOCTYPE html> 
<html> 
	<head> 
	<title>Voting</title> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.1/jquery.mobile-1.1.1.min.css" />
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
	<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.1.1/jquery.mobile-1.1.1.min.js"></script>
</head> 
<body> 

<div data-role="page">

	<div data-role="header">
		<a id="home" data-role="button" data-transition="flow" data-transition="flow" data-theme="b" href="../index.php" class="ui-btn-right">
            Home
        </a>
		<h1>Início</h1>
	</div><!-- /header -->

	<div data-role="content" align="center">
			<a data-role="button" data-theme="a" href="participanteForm.php">Cadastre-se</a>
			<a data-role="button" data-theme="a" href="participanteLogin.php">Conecte-se</a>
	</div>
	<div data-role="content" align="center">
        <a data-role="button"  data-transition="flip" href="../index.php" data-icon="arrow-l" data-iconpos="left">
        	Voltar
        </a>
    </div>
	<div data-theme="a" data-role="footer" data-position="fixed">
        <h5>
            G. Parmezani - UDESC
        </h5>
	</div>

</div><!-- /page -->

</body>
</html>