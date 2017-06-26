<?php 
include '../seguranca.php';

$id = $_POST['id'];

$query = "DELETE FROM viagem WHERE id = '$id'";

if(mysql_query($query)){
	echo 'Destino deletado com sucesso!';
}
else {
	echo 'Destino não pôde ser deletado, tente novamente mais tarde';
	echo '<script>alert("'.mysql_error().'")</script>';
}

 ?>