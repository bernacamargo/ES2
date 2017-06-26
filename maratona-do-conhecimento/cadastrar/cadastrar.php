<?php 
include '../../../web/seguranca.php';

$nivel = $_POST['nivel'];
$numero = $_POST['numero'];
$genero = $_POST['genero'];
$gabarito = $_POST['gabarito'];
$questao = $_POST['questao'];
$questao = addslashes($questao);
// Respostas
$r1 = htmlentities($_POST['r1']);
$r2 = htmlentities($_POST['r2']);
$r3 = htmlentities($_POST['r3']);
$r4 = htmlentities($_POST['r4']);
$r5 = htmlentities($_POST['r5']);

$query = "INSERT INTO maratona_questoes (nivel, numero, genero, pergunta, r1, r2, r3, r4, r5, rc) VALUES ('$nivel', '$numero', '$genero', '$questao', '$r1', '$r2', '$r3', '$r4', '$r5', '$gabarito')";

if(mysql_query($query)){
	echo 'Questão cadastrada com sucesso!';
}
else{
	echo 'Questão não cadastrada, tente novamente mais tarde';
	echo '<script>alert("'.mysql_error().'")</script>';
}

 ?>