<?php 
	include '../seguranca.php';

	$id = $_POST['id'];
	$horario = $_POST['horario'];

	$query = "UPDATE horarios SET horario = '$horario' WHERE id = '$id'";

	if(mysql_query($query)){
		echo 'Horário editado com sucesso!';
	}
	else {
		echo 'Erro na edição, tente novamente mais tarde.';
		echo '<script>alert("'.mysql_error().'")</script>';
	}
	
	
?>