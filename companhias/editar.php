<?php 
	include '../seguranca.php';

	$id = $_POST['id'];
	$nome = htmlentities($_POST['nome']);
	$tamanho = $_POST['tamanho'];

	$query = "UPDATE companhias SET nome = '$nome', tamanho_da_frota = '$tamanho' WHERE id = '$id'";

	if(mysql_query($query)){
		echo 'Companhia editado com sucesso!';
	}
	else {
		echo 'Erro na edição, tente novamente mais tarde.';
		echo '<script>alert("'.mysql_error().'")</script>';
	}
	
	
?>