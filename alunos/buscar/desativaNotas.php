<?php 
include '../../../web/seguranca.php';

$id = $_POST['id'];

$query = "DELETE FROM notas WHERE id = '$id'";

if(mysql_query($query)){
<<<<<<< HEAD
	echo 'Nota desativada com sucesso!';
}
else {
	echo 'Nota não desativada, tente novamente mais tarde.';
=======
	echo '<b><span class="glyphicon glyphicon-ok"></span></b>&ensp;Nota excluida com sucesso!';
}
else {
	echo '<b><span class="glyphicon glyphicon-alert"></span></b>&ensp;Nota não pode ser excluida, tente novamente mais tarde.';
>>>>>>> 531fa35a94d580d24220462f95c53a6d0faffe06
	echo mysql_error();
}

?>