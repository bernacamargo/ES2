<?php 
include '../../seguranca.php';

$id_destinatario = $_POST['id-destinatario']

$query_msg_novas = "SELECT lido FROM chat WHERE id_destinatario = '$id_destinatario' AND lido = 0";
$res_msg_novas = mysql_query($query_msg_novas);
$num_msg = mysql_num_rows($res_msg_novas);

if($num_msg != 0)
	echo $num_msg;

 ?>