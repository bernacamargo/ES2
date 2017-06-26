<?php 
include '../../web/seguranca.php';

$id_remetente = $_POST['id_remetente'];
$id_destinatario = $_POST['id_destinatario'];

$query_remetente = "SELECT nome FROM usuario WHERE id_usuario = '$id_remetente' LIMIT 1";
$remetente = mysql_fetch_assoc(mysql_query($query_remetente));

$query_destinatario = "SELECT nome FROM usuario WHERE id_usuario = '$id_destinatario' LIMIT 1";
$destinatario = mysql_fetch_assoc(mysql_query($query_destinatario));

// Seleciona os nomes a serem inseridos
$nome_remetente = explode(" ", $remetente['nome']);
$nome_destinatario = explode(" ", $destinatario['nome']);
$mensagem = htmlentities($_POST['mensagem']);
$time = date("Y-m-d H:i:s");

$query = "INSERT INTO chat (id_remetente, id_destinatario, nome_remetente, nome_destinatario, mensagem, data_hora, lido) VALUES ('$id_remetente', '$id_destinatario', '$nome_remetente[0]', '$nome_destinatario[0]', '$mensagem', '$time', 0)";

if(!mysql_query($query))
	echo 'Mensagem não enviada';

 ?>