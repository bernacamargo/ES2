<?php 
include '../../../web/seguranca.php';

$id = $_POST['id'];
$vest = htmlentities($_POST['vestibular']);
/*$data_prova = htmlentities($_POST['data-prova']);
$links_uteis = htmlentities($_POST['links']);*/
$data_prova = $_POST['data-prova'];
$links_uteis = $_POST['links'];
$data_inscricao = htmlentities($_POST['data-inscricao']);
$valor = $_POST['valor'];
$ano = $_POST['ano'];

$status = $_POST['status'];

if($status == 0)
	$cor_status = 'red';
elseif($status == 1)
	$cor_status = 'green';

$query = "UPDATE guia_vestibulando SET vestibular = '$vest', `data-inscricao` = '$data_inscricao',`data-prova` = '$data_prova', valor = '$valor', ano = '$ano', status = '$status', `cor-status` = '$cor_status', link = '$links_uteis' WHERE id = '$id'";

if(mysql_query($query)){
	echo 'Vestibular editado com sucesso!';
}
else {
	echo 'Erro na edição, tente novamente mais tarde.';
	echo mysql_error();	
}



 ?>