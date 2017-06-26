<?php 
include '../seguranca.php';

$id = $_POST['id'];

$query = "DELETE FROM companhias WHERE id = '$id'";

if(mysql_query($query)){
	echo 'Companhia deletado com sucesso!';
}
else {
	echo 'Companhia não pôde ser deletado, tente novamente mais tarde';
	echo '<script>alert("'.mysql_error().'")</script>';
}

 ?>