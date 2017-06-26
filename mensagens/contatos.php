<?php 
include '../../web/seguranca.php';

$id_destinatario = $_SESSION['usuarioID'];
if($_POST['buscaNome'] != ''){
	$query_users = "SELECT * FROM usuario WHERE nome LIKE '". htmlentities($_POST['buscaNome'])."%'  ORDER BY nome LIMIT 10";
}
else{
    $query_users = "SELECT DISTINCT * FROM usuario AS u, chat AS c WHERE (u.id_usuario = c.id_remetente OR u.id_usuario = c.id_destinatario)  GROUP BY u.id_usuario ORDER BY c.data_hora DESC LIMIT 10";
}

$res_users = mysql_query($query_users);

while($user = mysql_fetch_assoc($res_users)):

	if($user['id_usuario'] == $_SESSION['usuarioID']){
		continue;
	}

    if($user['sexo'] == 1)
        $url_img = $root_html.'img/equipe/default_masc.jpg';
    elseif($user['sexo'] == 2)
        $url_img = $root_html.'img/equipe/default_fem.jpg';

    $nome = $user['nome'];
    $nome_user = explode(" ", $nome);
    $nome = $nome_user[0].' '.$nome_user[1];

    $id_remetente = $user['id_usuario'];
    $busca_nlidas = "SELECT * FROM chat WHERE lido = 0 AND id_remetente = '$id_remetente' AND id_destinatario='$id_destinatario'";
    $num_nlidas = mysql_num_rows(mysql_query($busca_nlidas));
?>
<li>
    <a class="contato" data-id-remetente="<?php echo $id_remetente;?>" data-id-destinatario="<?php echo $_SESSION['usuarioID']?>">
        <div class="pull-left contato-imagem">
            <img src="<?php echo $url_img?>" alt="" class=" img-circle">
        </div>

        <h5 class="contato-nome">
            <?php if($num_nlidas != 0): ?>
            <span class="label pull-right bg-blue label-msg-nlida">
                <?php echo $num_nlidas ?>
            </span>
        <?php endif; ?>
            <span class="pull-left" style="text-overflow: ellipsis">&ensp;<?php echo $nome?></span>                                    
            <br>
            <?php if($user['online'] == 1):?>
            &ensp; <small>Online</small>
        <?php else: ?>
            &ensp; <small>Offline</small>
        <?php endif; ?>
        </h5>
    </a>
</li>
<?php endwhile; ?>

<script>
	
	    $(".contato").click(function(event) {

        var data = {
            'id-remetente': $(this).attr('data-id-remetente'),
            'id-destinatario': $(this).attr('data-id-destinatario')
        }

        $.ajax({

            url: '<?php echo $root_html?>sistema2/mensagens/busca_contato.php',
            type: 'POST',
            data: data,
        })
        .success(function(data) {
            $(".body-mensagem").html(data);
            $(".panel-body").scrollTop(99999999999);
        })
        .fail(function() {
            alert("DEU MERDA NO AJAX");
        });

        var data = {
            'id-remetente': $(this).attr('data-id-remetente'),
            'id-destinatario': $(this).attr('data-id-destinatario')
        }

        $.ajax({
            url: '<?php echo $root_html?>sistema2/mensagens/marca_como_lido.php',
            type: 'POST',
            data: data,
            success: function(){
                if(data != 0)
                    $('.label-msg-nlida').html(data);
                else
                    $('.label-msg-nlida').hide();
            }
        });

    });

</script>