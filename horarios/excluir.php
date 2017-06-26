<?php 
include '../seguranca.php';

$id = $_POST['id'];

$query = "DELETE FROM motorista WHERE id = '$id'";

if(mysql_query($query)){
	echo 'Motorista deletado com sucesso!';
}
else {
	echo 'Motorista não pode ser deletado, tente novamente mais tarde';
	echo '<script>alert("'.mysql_error().'")</script>';
}

 ?>