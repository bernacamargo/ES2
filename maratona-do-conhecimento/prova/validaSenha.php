<?php 
include '../../../web/seguranca.php'; 

$nome = $_POST['nome'];
$senha = $_POST['senha'];
$id_escola = $_POST['id_escola'];
$nivel = $_POST['nivel'];

$tmsp_query = mysql_query('SELECT tmsp_maratona, senha_maratona FROM escola WHERE id_escola = ' . $id_escola);
$tmsp = mysql_fetch_assoc($tmsp_query);

// echo '<script>alert("Senha: '.$tmsp['senha_maratona'].'")</script>';

if($senha == $tmsp['senha_maratona']){

	setcookie("nome-maratona", $nome, (time()+(3*60*60)));

	echo '<script>
			$("#pass").parent().removeClass("has-error").addClass("has-success"); 
			$("#select_nivel").removeAttr("disabled");
			$("#select_nivel").attr("href", "'.$root_html.'maratona/'.$id_escola.'/'.$nivel.'/")
		</script>';
}
else{
	echo '<script>$("#pass").parent().addClass("has-error"); $("#resultado").show();</script>';
}




?>