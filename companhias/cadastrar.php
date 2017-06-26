<?php 
	include '../seguranca.php';

	$nome = htmlentities($_POST['nome']);
	$tamanho = $_POST['tamanho'];

	$query = "INSERT INTO companhias (nome, tamanho_da_frota) VALUES ('$nome', '$tamanho')";	

	if(mysql_query($query)){
		echo 'Companhia cadastrado com sucesso!';
	}
	else {
		echo 'Erro no cadastro, tente novamente mais tarde.';
		echo '<script>alert("'.mysql_error().'")</script>';
	}
	
	
?>