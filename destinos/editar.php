<?php 
	include '../seguranca.php';

	$id = $_POST['id'];
	$id_companhia = $_POST['id_companhia'];
	$destino = htmlentities($_POST['destino']);

	$query = "UPDATE destinos SET id_companhia = '$id_companhia', destino = '$destino' WHERE id = '$id'";

	if(mysql_query($query)){
		echo 'Destino editado com sucesso!';
	}
	else {
		echo 'Erro na edição, tente novamente mais tarde.';
		echo '<script>alert("'.mysql_error().'")</script>';
	}
	
	
?>