<?php include '../../web/seguranca.php'; 

$id_remetente = $_POST['id-remetente'];
$id_destinatario = $_POST['id-destinatario'];

$query = "SELECT * FROM chat WHERE (id_destinatario = '$id_destinatario' AND id_remetente = '$id_remetente') OR (id_destinatario = '$id_remetente' AND id_remetente = '$id_destinatario') ORDER BY data_hora";
$res_query = mysql_query($query);

?>
<div class="col-md-12">
    <div class="panel">
        <div class="panel-body">
            <ul class="chat">
<?php
while($mensagem = mysql_fetch_assoc($res_query)):
	                        $time1 = strtotime($mensagem['data_hora']);
                        $time2 = strtotime(date("Y-m-d H:i:s"));

                        $time_final = floor($time2 - $time1);
                        $time_flag = 0;
                        
                        // Segundos
                        if($time_final == 1){
                            $time_flag = 0;
                        }
                        else if($time_final > 1 && $time_final < 60){
                            $time_flag = 0;                  
                        }
                        // Minutos
                        else if($time_final == 60){
                            $time_final = $time_final/60;
                            $time_flag = 1;                            
                        }
                        else if($time_final > 60 && $time_final < 3600){
                            $time_final = $time_final/60;   
                            $time_flag = 1;
                        }
                        // Horas
                        else if($time_final == 3600){
                            $time_final = $time_final/(60*60);
                            $time_flag = 2;                 
                        }
                        else if($time_final > 3600 && $time_final < 86400){
                            $time_final = $time_final/(60*60);
                            $time_flag = 2;                 
                        }
                        // Dias
                        else if($time_final == 86400) {
                            $time_final = $time_final/(60*60*24);
                            $time_flag = 3;                 
                        }
                        elseif($time_final > 1440 && $time_final < 2592000){
                            $time_final = $time_final/(60*60*24);
                            $time_flag = 3;                 
                        }
                        // Meses
                        elseif($time_final == 2592000) {
                            $time_final = $time_final/(60*60*24*30);
                            $time_flag = 4;                 
                        }
                        elseif($time_final > 2592000 && $time_final < 31104000){
                            $time_final = $time_final/(60*60*24*30);
                            $time_flag = 4;                 
                        }
                        // Anos
                        elseif($time_final == 31104000) {
                            $time_final = $time_final/(60*60*24*30*12);
                            $time_flag = 5;
                        }
                        elseif($time_final > 31104000){
                            $time_final = $time_final/(60*60*24*30*12);
                            $time_flag = 5;                      
                        }

                        $time_final = floor($time_final);

                        if($time_flag == 0 && $time_final == 1){
                            $time_txt = 'segundo';
                        }
                        else if($time_flag == 0 && $time_final > 1)
                            $time_txt = 'segundos';
                        else if($time_flag == 1 && $time_final == 1)
                            $time_txt = 'minuto';
                        else if($time_flag == 1 && $time_final > 1)
                            $time_txt = 'minutos';
                        else if($time_flag == 2 && $time_final == 1)
                            $time_txt = 'hora';
                        else if($time_flag == 2 && $time_final > 1)
                            $time_txt = 'horas';
                        else if($time_flag == 3 && $time_final == 1)
                            $time_txt = 'dia';
                        else if($time_flag == 3 && $time_final > 1)
                            $time_txt = 'dias';
                        else if($time_flag == 4 && $time_final == 1)
                            $time_txt = 'mes';
                        else if($time_flag == 4 && $time_final > 1)
                            $time_txt = 'meses';
                        else if($time_flag == 5 && $time_final == 1)
                            $time_txt = 'ano';
                        else if($time_flag == 5 && $time_final > 1)
                            $time_txt = 'anos';
                       if($mensagem['id_destinatario'] == $_SESSION['usuarioID']):
?>
                <li class="left clearfix">
                	<span class="chat-img pull-left">
                    	<img src="<?php echo $root_html?>img/equipe/default_masc.jpg" alt="User Avatar" class="img-circle img-responsive" width="50px" height="auto"/>
                    </span>
                    <div class="chat-body clearfix">
                        <div class="header">
                            <strong class="primary-font"><?php echo $mensagem['nome_remetente'] ?></strong> 

                            <small class="pull-right text-muted">
                                <span class="glyphicon glyphicon-time"></span><?php echo $time_final ?> <?php echo $time_txt?> atrás
                            </small>
                        </div>
                        <p>
                            <?php echo $mensagem['mensagem'];?>
                        </p>
                    </div>
                </li>

            <?php else: ?>

                <li class="right clearfix">
                	<span class="chat-img pull-right">
                    	<img src="<?php echo $root_html?>img/equipe/default_masc.jpg" alt="User Avatar" class="img-circle img-responsive" width="50px" height="auto"/>
                    </span>
                    <div class="chat-body clearfix">
                        <div class="header">
                            <strong class="primary-font pull-right">
                            	<?php echo $mensagem['nome_remetente'] ?>
                            </strong> 

                            <small class="text-muted">
                                <span class="glyphicon glyphicon-time"></span><?php echo $time_final ?> <?php echo $time_txt?> atrás
                            </small>
                        </div>
                        <p>
                            <?php echo $mensagem['mensagem'];?>
                        </p>
                    </div>
                </li>
	

        <?php endif; ?>
           

<?php endwhile; ?>

                 </ul>
            </div>
        </div>
    </div>                            
</div>
<!-- /.box-body -->
<div class="box-footer">
    <div class="input-group">
        <textarea id="btn-input" type="text" class="form-control" placeholder="Digite sua mensagem e pressione ENTER..."></textarea>
        <span class="input-group-btn" style="height: 100%;">
            <button type="button" data-id-destinatario="<?php echo $id_remetente?>" data-id-remetente="<?php echo $id_destinatario?>" class="btn btn-warning" id="btn-chat">
                Enviar</button>
        </span>
    </div>
</div>

<script>

	$("#btn-input").keypress(function(event) {
		if(event.which == 13 && !event.shiftKey){
			event.preventDefault();
			$("#btn-chat").click();
		}
	});

	$("#btn-chat").click(function() {

		var id_remetente = $(this).attr('data-id-remetente');
		var id_destinatario = $(this).attr('data-id-destinatario');

		var data = {
			'mensagem' : $('#btn-input').val(),
			'id_remetente' : $(this).attr('data-id-remetente'),
			'id_destinatario': $(this).attr('data-id-destinatario')
		}
		$.ajax({
			url: '<?php echo $root_html?>sistema2/mensagens/enviar_msg.php',
			type: 'POST',
			data: data,
            success: function (data) {
            	var data1 = {
            		'id-destinatario': id_destinatario,
            		'id-remetente': id_remetente
            	}
                $.ajax({
		            url: '<?php echo $root_html?>sistema2/mensagens/busca_contato.php',
		            type: 'POST',
		            data: data1,
		        })
		        .success(function(data) {
		            $(".body-mensagem").html(data);
            		$(".panel-body").scrollTop(99999999999);
		        })
		        .fail(function() {
		            alert("DEU MERDA NO AJAX");
		        });
            },
            error: function (e) {
                $('.alerta').show().addClass('alert-danger');
                $('#alerta_conteudo').html("<span class='glyphicon glyphicon-remove'></span>&ensp;Nenhum resultado encontrado");

                setTimeout(function(){ $('.alerta').fadeOut(500).removeClass('alert-danger', 500);}, 4000);
            }
		});
	});
</script>
