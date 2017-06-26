<?php 
include '../../../web/seguranca.php';
$id_usuario = $_POST['id_usuario'];
$query = "UPDATE usuario SET nome = '".$_POST['nome_cadastrar']."', email = '".$_POST['email']."', tel = '".$_POST['tel']."', id_escola = '".$_POST['escola1']."', camiseta = '".$_POST['camiseta']."', serie = '".$_POST['serie']."', senha = '".$_POST['senha']."', data_nasc = '".$_POST['data']."', rg = '".$_POST['rg']."', ra = '".$_POST['ra']."', end = '".$_POST['end']."', cel = '".$_POST['cel']."', sexo = '".$_POST['sexo']."', etnia = '".$_POST['etnia']."', mae = '".$_POST['mae']."', pai = '".$_POST['pai']."', face = '".$_POST['face']."', h = '".$_POST['h']."' ";
/*if (isset($_POST['ativoinativo']) && ($_POST['ativoinativo']=='on')) {
    $query .="h = 0 ";
}else {
    $query .="h = 1 ";    
}*/
$query .= "WHERE id_usuario = '".$_POST['id_usuario']."'";

if (mysql_query($query)){
    
    $erro = 0;
    for ($i = 1; $i <= 11; $i++) {
        $query2 = "SELECT * FROM respostase WHERE usuario_id = '$id_usuario'";
        $result2 = mysql_query($query2);
        if (isset($_POST['r'. $i])){
            if (is_array($_POST['r'. $i])){
                $resposta = implode(',', $_POST['r'. $i]);
            }else{
            $resposta = $_POST['r'. $i];
            }
        }else{
            $resposta ='';
        }
        if (mysql_num_rows($result2)!= 0){
            $query = "UPDATE respostase SET resposta = '$resposta' WHERE usuario_id = '$id_usuario' AND pergunta_num = '$i'";
        }else{
          
             $query = "INSERT INTO respostase (usuario_id, pergunta_num, resposta) VALUES ('$id_usuario','$i','$resposta');";
        }
        if (!mysql_query($query)){
            $erro = 1;
        }
    }
    if ($erro != 1) {
        echo '<span class="glyphicon glyphicon-ok"></span></b>&ensp;Dados atualizados com sucesso!';
    } else {
        echo "<span class='ajuda_user'>Dados não atualizados!</span><br>";
        echo mysql_error();
    }
}else{
    echo "<span class='ajuda_user'>Dados não atualizados!</span><br>";
    echo mysql_error();
}


?>