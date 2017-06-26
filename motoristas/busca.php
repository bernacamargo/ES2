<?php
include '../seguranca.php';

/*$email = htmlentities($_POST['email']);
$contato = htmlentities($_POST['contato']);*/

$res = mysql_query("SELECT * FROM motorista WHERE nome LIKE '%". htmlentities($_POST['busca'])."%' ORDER BY nome");

if(mysql_num_rows($res) != 0): 

	while($motorista = mysql_fetch_assoc($res)):
	?>
	
		<div class="row resultadoContainer">
			<div class="col-md-9">
				<h4 class="text-bold"><?php echo $motorista['nome'] ?></h4>	<br>
				<?php echo $motorista['email'] ?><br>
				<?php echo $motorista['contato'] ?>
			</div>

			<div class="col-md-3">
				<a href="../editar/<?php echo $motorista['id'] ?>" id="editar<?php echo $motorista['id'] ?>" class="btn btn-block btn-warning">Editar</a>
				<button data-nome="<?php echo $motorista['nome'] ?>" data-id="<?php echo $motorista['id'] ?>" class="desativar btn btn-block btn-danger">Excluir</button>
			</div>
		</div>

	<?php endwhile; ?>


<?php else: ?>

	<div class="alert alert-danger">
		<i class="text-bold glyphicon glyphicon-alert"></i>&ensp;Nenhum resultado encontrado
	</div>


<?php endif; ?>


<script>
	
	$('.desativar').click(function(event) {
		
		var id = $(this).attr('data-id');
		var nome = $(this).attr('data-nome');

		if (confirm("Deseja excluir o motorista "+nome+"?")) {
				
				var data = {
					'id': id
				}

           		$.ajax({
                    url: '<?php echo $root_html?>es2/motoristas/excluir.php',
                    type: 'POST',
                    data: data,
		            complete: function() {
		                setTimeout(function(){ location.reload();}, 2000);
		            },
		            success: function (data) {
		                $('.alerta').show().addClass('alert-success');
		                $('#alerta_conteudo').html(data);

		                setTimeout(function(){ $('.alerta').fadeOut(500).removeClass('alert-success', 500);}, 4000);
		            },
		            error: function (e) {
		                $('.alerta').show().addClass('alert-danger');
		                $('#alerta_conteudo').html("<span class='glyphicon glyphicon-remove'></span>&ensp;Nenhum resultado encontrado");

		                setTimeout(function(){ $('.alerta').fadeOut(500).removeClass('alert-danger', 500);}, 4000);
		            }
                });

		}

	});
</script>