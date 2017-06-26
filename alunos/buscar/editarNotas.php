<?php  
include '../../../web/seguranca.php';

$id = $_POST['id'];

if(isset($_POST['maratona-do-conhecimento-1'])){
	$maratona1 = $_POST['maratona-do-conhecimento-1'];
	if($maratona1 > 10)
		$maratona1 = 10;
	if($maratona1 < 0)
		$maratona1 = 0;
	

	$query = "UPDATE notas SET `maratona-do-conhecimento-1` = '$maratona1' WHERE id = '$id'";
<<<<<<< HEAD

	if(mysql_query($query)){
		echo 'Nota atualizada com sucesso!';
	}
	else {
		echo 'Nota não atualizada, tente novamente mais tarde.';
		echo mysql_error();
	}

=======
>>>>>>> 531fa35a94d580d24220462f95c53a6d0faffe06
}

if(isset($_POST['maratona-do-conhecimento-2'])){
	$maratona2 = $_POST['maratona-do-conhecimento-2'];
	
	if($maratona2 > 10)
		$maratona2 = 10;
	if($maratona2 < 0)
		$maratona2 = 0;
	

	$query = "UPDATE notas SET `maratona-do-conhecimento-2` = '$maratona2' WHERE id = '$id'";
<<<<<<< HEAD

	if(mysql_query($query)){
		echo 'Nota atualizada com sucesso!';
	}
	else {
		echo 'Nota não atualizada, tente novamente mais tarde.';
		echo mysql_error();
	}
}

if(isset($_POST['concurso-literario'])){
	$concurso_literario = $_POST['concurso-literario'];
	
	if($concurso_literario > 10)
		$concurso_literario = 10;
	if($concurso_literario < 0)
		$concurso_literario = 0;
	

	$query = "UPDATE notas SET `concurso-literario` = '$concurso_literario' WHERE id = '$id'";

	if(mysql_query($query)){
		echo 'Nota atualizada com sucesso!';
	}
	else {
		echo 'Nota não atualizada, tente novamente mais tarde.';
		echo mysql_error();
	}
=======
}

if(isset($_POST['concurso-literario'])){
	$concurso_literario = $_POST['concurso-literario'];
	
	if($concurso_literario > 10)
		$concurso_literario = 10;
	if($concurso_literario < 0)
		$concurso_literario = 0;
	

	$query = "UPDATE notas SET `concurso-literario` = '$concurso_literario' WHERE id = '$id'";
}

if(isset($_POST['clube-de-ciencia'])){
	$clube_de_ciencia = $_POST['clube-de-ciencia'];
	
	if($clube_de_ciencia > 10)
		$clube_de_ciencia = 10;
	if($clube_de_ciencia < 0)
		$clube_de_ciencia = 0;

	$query = "UPDATE notas SET `clube-de-ciencia` = '$clube_de_ciencia' WHERE id = '$id'";
}

if(mysql_query($query)){
	echo '<b><span class="glyphicon glyphicon-ok"></span></b>&ensp;Nota atualizada com sucesso!';
}
else {
	echo '<b><span class="glyphicon glyphicon-alert"></span></b>&ensp;Nota não atualizada, tente novamente mais tarde.';
	echo mysql_error();
>>>>>>> 531fa35a94d580d24220462f95c53a6d0faffe06
}

if(isset($_POST['clube-de-ciencia'])){
	$clube_de_ciencia = $_POST['clube-de-ciencia'];
	
	if($clube_de_ciencia > 10)
		$clube_de_ciencia = 10;
	if($clube_de_ciencia < 0)
		$clube_de_ciencia = 0;

	$query = "UPDATE notas SET `clube-de-ciencia` = '$clube_de_ciencia' WHERE id = '$id'";

	if(mysql_query($query)){
		echo 'Nota atualizada com sucesso!';
	}
	else {
		echo 'Nota não atualizada, tente novamente mais tarde.';
		echo mysql_error();
	}
}
?>