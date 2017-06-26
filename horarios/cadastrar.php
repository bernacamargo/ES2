<?php 
	include '../seguranca.php';

	$id_destino = $_POST['destino'];
	$horario = $_POST['horario'];

	$query = "INSERT INTO horarios (id_destino, horario) VALUES ('$id_destino', '$horario')";	

	if(mysql_query($query)){
		echo 'Horário cadastrado com sucesso!';
	}
	else {
		echo 'Erro no cadastro, tente novamente mais tarde.';
		echo '<script>alert("'.mysql_error().'")</script>';
	}

	
?>