<?php 
	include '../seguranca.php';

	$id_companhia = $_POST['id_companhia'];
	$destino = htmlentities($_POST['destino']);

	$query = "INSERT INTO destinos (id_companhia, destino) VALUES ('$id_companhia', '$destino')";	

	if(mysql_query($query)){
		echo 'Destino cadastrado com sucesso!';
	}
	else {
		echo 'Erro no cadastro, tente novamente mais tarde.';
		echo '<script>alert("'.mysql_error().'")</script>';
	}
	
	
?>