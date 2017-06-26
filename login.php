<?php

<<<<<<< HEAD
include 'seguranca.php';

=======
include '../web/seguranca.php';
>>>>>>> 531fa35a94d580d24220462f95c53a6d0faffe06
$email = $_POST["email"];
$senha = $_POST["senha"];
//$senha = md5(sha1($senha));

if($email == '' || $senha == '') {
    echo '<i class="fa fa-warning fa-1x"></i> Por favor preencha todos os campos';
    echo '<script>$(".alerta").removeClass("alert-success").addClass("alert-danger");</script>';
}
elseif (validaUsuario($email, $senha)) {
    echo '<script>$(".alerta").removeClass("alert-danger").addClass("alert-success");</script>';	
    echo '<b><i class="fa fa-check fa-1x"></i></b> Login realizado com sucesso';
    echo '<script>setTimeout(function(){ location.reload(0);}, 1000);</script>';
    
} else {
    echo '<b><i class="fa fa-warning fa-1x"></i></b> Login ou senha incorretos!';
    echo '<script>$(".alerta").removeClass("alert-success").addClass("alert-danger");</script>';    
}
?>
