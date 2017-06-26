<?php 
	include '../../../web/seguranca.php';

	$ativo = $_POST['ativo'];
	$id = $_POST['id'];

	if($ativo == 1){
		$query = "UPDATE guia_vestibulando SET ativo = 0 WHERE id = $id";

		if(mysql_query($query)){
			echo '<span class="pull-left glyphicon glyphicon-ok"></span> Ativar';
		}else {
			echo '<div class="alert-danger">'.mysql_error().'</div>';
		}
	}
	else {
		$query = "UPDATE guia_vestibulando SET ativo = 1 WHERE id = $id";

		if(mysql_query($query)){
			echo '<span class="pull-left glyphicon glyphicon-remove"></span> Desativar';
		}else {
			echo '<div class="alert-danger">'.mysql_error().'</div>';
		}		
	}
?>