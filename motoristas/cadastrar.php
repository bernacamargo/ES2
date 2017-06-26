<?php 
	include '../seguranca.php';

	$nome = htmlentities($_POST['nome']);
	$email = htmlentities($_POST['email']);
	$contato = htmlentities($_POST['contato']);

	$query = "INSERT INTO motorista (nome, email, contato) VALUES ('$nome', '$email', '$contato')";	

	if(mysql_query($query)){
		echo 'Membro cadastrado com sucesso!';
	}
	else {
		echo 'Erro no cadastro, tente novamente mais tarde.';
		echo mysql_error();
	}
	
	
?>