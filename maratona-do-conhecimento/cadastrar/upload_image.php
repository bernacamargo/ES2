<?php

include "../../../web/seguranca.php";

// Pasta onde o arquivo vai ser salvo
$_UP['pasta'] = '../../../maratona/'.date('Y').'/';
// Tamanho máximo do arquivo (em Bytes)
$_UP['tamanho'] = 1024 * 1024 * 1; // 1Mb
// Array com as extensões permitidas
$_UP['extensoes'] = array('jpg', 'png', 'gif', 'JPG');
// Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
$_UP['renomeia'] = false;
// Array com os tipos de erros de upload do PHP
$_UP['erros'][0] = 'Não houve erro';
$_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
$_UP['erros'][4] = 'Não foi feito o upload do arquivo';

// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
/*if ($_FILES['imagem']['error'] != 0) {
    die("<span class='ajuda_user'>Não foi possível fazer o upload, erro:" . $_UP['erros'][$_FILES['imagem']['error']] . '</span>');
}*/
// Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar
// Faz a verificação da extensão do arquivo
/*$extensao = strtolower(end(explode('.', $_FILES['imagem']['name'])));
if (array_search($extensao, $_UP['extensoes']) === false) {
    echo "Por favor, envie arquivos com as seguintes extensões: jpg, png ou gif";
    exit;
}*/
// Faz a verificação do tamanho do arquivo
if ($_UP['tamanho'] < $_FILES['imagem']['size']) {
    echo "<span class='ajuda_user'>O arquivo enviado é muito grande, envie arquivos de até 2Mb.</span>";
    exit;
}
// O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
// Primeiro verifica se deve trocar o nome do arquivo
if ($_UP['renomeia'] == true) {
    // Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
    $nome_final = md5(time()).'.jpg';
} else {
    // Mantém o nome original do arquivo
    $nome_final = $_FILES['imagem']['name'];
}

// Depois verifica se é possível mover o arquivo para a pasta escolhida
if (move_uploaded_file($_FILES['imagem']['tmp_name'], $_UP['pasta'] . $nome_final)) {
    // Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
    echo "Upload efetuado com sucesso!";
} else {
    // Não foi possível fazer o upload, provavelmente a pasta está incorreta
    echo "Não foi possível enviar o arquivo, tente novamente mais tarde.";
}
