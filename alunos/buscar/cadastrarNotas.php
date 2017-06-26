<?php 
include '../../../web/seguranca.php';

$id_usuario = $_POST['id_usuario'];
$ano = $_POST['ano'];

$query = "INSERT INTO notas (id_usuario, `maratona-do-conhecimento-1`, `maratona-do-conhecimento-2`, `concurso-literario`, `clube-de-ciencia`, ano) VALUES ('$id_usuario', '-1', '-1', '-1', '-1', '$ano')";

if(mysql_query($query)){
<<<<<<< HEAD
	echo 'Nota cadastrada com sucesso!';
}
else {
	echo 'Nota não cadastrada, tente novamente mais tarde.';
=======
	echo '<b><span class="glyphicon glyphicon-ok"></span></b>&ensp;Nota cadastrada com sucesso!';
}
else {
	echo '<b><span class="glyphicon glyphicon-alert"></span></b>&ensp;Nota não cadastrada, tente novamente mais tarde.';
>>>>>>> 531fa35a94d580d24220462f95c53a6d0faffe06
	echo mysql_error();
}
?>