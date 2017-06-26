<?php 
include '../../../web/seguranca.php';

$nivel = $_POST['nivel'];
$numero = $_POST['numero'];
$genero = $_POST['genero'];
$gabarito = $_POST['gabarito'];
$questao = $_POST['questao'];
// Respostas
$r1 = htmlentities($_POST['r1']);
$r2 = htmlentities($_POST['r2']);
$r3 = htmlentities($_POST['r3']);
$r4 = htmlentities($_POST['r4']);
$r5 = htmlentities($_POST['r5']);

$query = "UPDATE maratona_questoes SET numero = '$numero', genero = '$genero', rc = '$gabarito', pergunta = '$questao', r1 = '$r1', r2 = '$r2', r3 = '$r3', r5 = '$r5', r5 = '$r5' WHERE numero = '$numero' AND nivel = '$nivel'";

if(mysql_query($query)){
	echo 'Questão atualizada com sucesso!';
}
else{
	echo 'Questão não atualizada, tente novamente mais tarde';
	echo '<script>alert("'.mysql_error().'")</script>';
}

 ?>