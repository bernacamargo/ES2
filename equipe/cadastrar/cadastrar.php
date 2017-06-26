<?php 
	include '../../../web/seguranca.php';
	$erro = 0;
	$erroUpload = 0;
	$file = 1;
	$upload['tamanho'] = 1024 * 300; //Tam max = 500 kbts
	$upload['extensoes'] = array('jpg', 'png');
	// $upload['destino'] = 'D:/xampp/htdocs/fc/img/equipe/';
	$upload['destino'] =  '../../../img/equipe/';

	if(empty($_FILES['arquivoFoto']['name']))
		$file = 0;

	if ($file && $_FILES['arquivoFoto']['error'] != 0) {
	  die("Não foi possível fazer o upload, erro:" . $upload['erros'][$_FILES['arquivoFoto']['error']]);
	  exit; // Para a execução do script
	}

	// Faz a verificação da extensão do arquivo
	/*$extensao = strtolower(end(explode('.', $_FILES['arquivoFoto']['name'])));
	if (array_search($extensao, $upload['extensoes']) === false) {
	  echo "Por favor, envie a imagem com uma das seguintes extensões: jpg ou png";
	  echo $_FILES['arquivoFoto']['name'];
	  exit;
	}*/

	// Faz a verificação do tamanho do arquivo
	if ($file && $upload['tamanho'] < $_FILES['arquivoFoto']['size']) {
	  echo "O arquivo enviado é muito grande, envie arquivos de até 300kbts";
	  exit;
	}

	$_POST['nome'] = htmlentities($_POST['nome']);
	$_POST['cargo'] = htmlentities($_POST['cargo']);
	$_POST['descricao'] = htmlentities($_POST['descricao']);

	if(!isset($_POST['cidade']))
		$cidade = "";
	else
		$cidade = htmlentities($_POST['cidade']);

	if(!isset($_POST['ocupacao']))
		$ocupacao = "";
	else
		$ocupacao = htmlentities($_POST['ocupacao']);

	$id_escola = $_POST['id_escola'];

	$nome = $_POST['nome'];
	$nome_maiusculo = strtoupper($nome);
	$senha = 'pfc2017';
	$cargo = $_POST['cargo'];
	$cargo_geral = $_POST['cargo_geral'];
	$descricao = $_POST['descricao'];
	$link_curriculo = $_POST['curriculum'];
	//$foto = basename($_FILES['arquivoFoto']['name']);
	$email = $_POST['email'];
	$telefone = $_POST['tel'];
	$celular = $_POST['cel'];
	$data_nasc = $_POST['data'];
	$data_cadastro = date("d/m/Y");
	$sexo = $_POST['sexo'];
	$face = $_POST['face'];
	$h = $_POST['h'];

	$query_existe_user = "SELECT * FROM usuario WHERE nome LIKE '$nome' OR nome LIKE '$nome_maiusculo' LIMIT 1";
	$res_existe_user = mysql_query($query_existe_user);

	// Verifica se ja existe na tabela de usuario
	if(mysql_num_rows($res_existe_user) == 0){
		// Não existe
		$query_user = "INSERT INTO usuario (nome, email, senha, h, sexo, face) VALUES ('$nome', '$email', '$senha', '$h', '$sexo', '$face')";
		if(!mysql_query($query_user)){
			$erro = 1;
			echo 'Erro no cadastro, tente novamente mais tarde!';
			exit;
		}
		else
			$id = mysql_insert_id();			
	}
	else{
		// Ja existe
		$user = mysql_fetch_assoc($res_existe_user);
		// Seleciona o $id
		$id = $user['id_usuario'];
		echo 'Usuario já existe, atualizando dados...<br>';
	}

	if(!$erro){

		$foto = $id.'.jpg';
		//$foto = basename($_FILES['arquivoFoto']['name']);
		$nome_original = $_FILES['arquivoFoto']['name'];

		$uploadfile = $upload['destino'] . $foto;

		// echo '<script>alert("'.isset($_FILES).'")</script>';

		if ($file && !move_uploaded_file($_FILES['arquivoFoto']['tmp_name'], $uploadfile)){
			echo 'Erro de upload!';
			print_r($_FILES);
			exit;
		}
		
		if($cargo_geral == 'supervisor'){
			$query_supervisor = "INSERT INTO supervisores (id_usuario, cidade) VALUES ('$id', '$cidade')";
			if(!mysql_query($query_supervisor))
				$erro = 1;
		}
		elseif($cargo_geral == 'coordenador_local'){
			$query_coordenador = "INSERT INTO coordenadores_locais (id_usuario, cidade) VALUES ('$id', '$cidade')";
			if(!mysql_query($query_coordenador))
				$erro = 1;
		}
		elseif($cargo_geral == 'embaixador_jr'){
			$query_embaixadorJRH = "UPDATE usuario SET h = 4 WHERE id_usuario = '$id'";

			if(!mysql_query($query_embaixadorJRH))
				$erro = 1;
		}
		elseif($cargo_geral == 'embaixador_senior'){
			$query_embaixador_senior = "INSERT INTO embaixadores_senior (id_usuario, ocupacao) VALUES ('$id', '$ocupacao')";

			if(!mysql_query($query_embaixador_senior))
				$erro = 1;
		}

		$query = "INSERT INTO equipe (id_usuario, nome, cargo, cargo_geral, descricao, link_curriculo, email, telefone, data_cadastro,  celular, foto, ativo) VALUES ('$id', '$nome', '$cargo', '$cargo_geral', '$descricao', '$link_curriculo', '$email', '$telefone', '$data_cadastro', '$celular', '$foto', 1)";

		if(mysql_query($query)){
			echo 'Membro cadastrado com sucesso!';
		}
		else {
			echo 'Erro no cadastro, tente novamente mais tarde.';
			echo mysql_error();
		}
	}
	else {
		echo 'Erro no cadastro, tente novamente mais tarde.';
	}
	
?>