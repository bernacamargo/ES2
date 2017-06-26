<?php 
	include '../seguranca.php';

	$destino = $_POST['destino'];
	$motorista = $_POST['motorista'];
	$passageiros = $_POST['passageiros'];
	$valor = $_POST['valor'];
	$custo = $_POST['custo'];
	$datetime_inic = $_POST['datetime-inic'];
	$datetime_final = $_POST['datetime-final'];

	$query = "INSERT INTO viagem (id_destino, id_motorista, passageiros, preco, custo, `datetime-inic`, `datetime-fim`) VALUES ('$destino', '$motorista', '$passageiros', '$valor', '$custo', '$datetime_inic', '$datetime_final')";	

	if(mysql_query($query)){
		echo 'Viagem cadastrado com sucesso!';
	}
	else {
		echo 'Erro no cadastro, tente novamente mais tarde.';
		echo '<script>alert("'.mysql_error().'")</script>';
	}
	
	
?>