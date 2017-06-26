<?php 
include '../../web/seguranca.php'; 

$id_remetente = $_POST['id-remetente'];
$id_destinatario = $_POST['id-destinatario'];

$query_update = "UPDATE chat SET lido = 1 WHERE id_destinatario = '$id_destinatario' AND id_remetente = '$id_remetente'";
mysql_query($query_update);

$query_msg_novas = "SELECT lido FROM chat WHERE id_destinatario = '$id_destinatario' AND lido = 0";
$res_msg_novas = mysql_query($query_msg_novas);
$num_msg = mysql_num_rows($res_msg_novas);

if($num_msg != 0)
	echo $num_msg;


?>