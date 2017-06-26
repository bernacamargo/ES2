<?php 
	include '../seguranca.php';

	$id = $_POST['id'];
	$nome = htmlentities($_POST['nome']);
	$email = htmlentities($_POST['email']);
	$contato = htmlentities($_POST['contato']);

	$query = "UPDATE motorista SET nome = '$nome', email = '$email', contato = '$contato' WHERE id = '$id'";

	if(mysql_query($query)){
		echo 'Membro editado com sucesso!';
	}
	else {
		echo 'Erro na edição, tente novamente mais tarde.';
		echo '<script>alert("'.mysql_error().'")</script>';
	}
	
	
?>