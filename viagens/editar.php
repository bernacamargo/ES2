<?php 
	include '../seguranca.php';

	$id = $_POST['id'];
	$destino = $_POST['destino'];
	$motorista = $_POST['motorista'];
	$passageiros = $_POST['passageiros'];
	$valor = $_POST['valor'];
	$custo = $_POST['custo'];
	$datetime_inic = $_POST['datetime-inic'];
	$datetime_final = $_POST['datetime-final'];

	$query = "UPDATE viagem SET id_destino = '$destino', id_motorista = '$destino', passageiros = '$passageiros', preco = '$valor', custo = '$custo', `datetime-inic` = '$datetime_inic', `datetime-fim` = '$datetime_final'  WHERE id = '$id'";

	if(mysql_query($query)){
		echo 'Viagem editado com sucesso!';
	}
	else {
		echo 'Erro na edição, tente novamente mais tarde.';
		echo '<script>alert("'.mysql_error().'")</script>';
	}
	
	
?>