<?php 
include '../../../web/seguranca.php';

$vest = htmlentities($_POST['vestibular']);
/*$data_prova = htmlentities($_POST['data-prova']);
$links_uteis = htmlentities($_POST['links']);*/
$data_prova = $_POST['data-prova'];
$links_uteis = $_POST['links'];
$data_inscricao = htmlentities($_POST['data-inscricao']);
$valor = 'R$'.$_POST['valor'];
$ano = $_POST['ano'];

$status = $_POST['status'];

if($status == 0)
	$cor_status = 'red';
elseif($status == 1)
	$cor_status = 'green';

$query = "INSERT INTO guia_vestibulando (vestibular, ano, `data-inscricao`, `data-prova`, valor, link, status, `cor-status`, ativo) VALUES ('$vest', '$ano', '$data_inscricao', '$data_prova', '$valor', '$links_uteis', '$status', '$cor_status', 1)";

if(mysql_query($query)){
	echo 'Vestibular cadastrado com sucesso!';
}
else {
	echo 'Erro no cadastro, tente novamente mais tarde.';
	echo mysql_error();	
}



 ?>