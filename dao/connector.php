<!DOCTYPE html>
<html>
    <body>

		<?php
			function connect(){
				$xml = simplexml_load_file("../dao/mysql-ds.xml") or die("Erro ao conectar com o MySQL");
				
				$host = $xml->host;
				$user = $xml->user;
				$password = $xml->password;
				$schema = $xml->schema;
				
				return mysqli_connect($host, $user, $password, $schema);
				
			}
		?>

	</body>
</html>