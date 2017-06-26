<?php
include '../seguranca.php';

$busca = $_POST['busca'];

$query = "SELECT * FROM viagem WHERE id_destino = ".$busca." ORDER BY id_destino";

$res = mysql_query($query);

if(mysql_num_rows($res) != 0): 

	while($viagem = mysql_fetch_assoc($res)):

	// Query motorista
	$id_motorista = $viagem['id_motorista'];
	$query_motoca = "SELECT * FROM motorista WHERE id = '$id_motorista'";
	$motoca = mysql_fetch_assoc(mysql_query($query_motoca));

	// Query destino
	$id_destino = $viagem['id_destino'];
	$query_destino = "SELECT * FROM destinos WHERE id = '$id_destino'";
	$destino = mysql_fetch_assoc(mysql_query($query_destino));

	?>

	<div class="row resultadoContainer">
		<div class="col-md-9">
			<h4 class="text-bold"><?php echo $destino['destino'] ?></h4>	<br>
			<p><b>Motorista:</b> <?php echo $motoca['nome'] ?></p>
			
			<p><b>Destino:</b> <?php echo $destino['destino'] ;?></p>
			<p>
				<b>Número de passageiros:</b> <?php echo $viagem['passageiros'] ?>
			</p>

			<p>
				<b>Valor da passagem:</b> R$<?php echo $viagem['preco'] ?>
			</p>

			<p>
				<b>Custo da viagem:</b> R$<?php echo $viagem['custo'] ?>
			</p>

			<p>
				<b>Horário de inicio:</b> <?php echo strftime("%d/%m/%Y às %H:%M:%S", strtotime($viagem['datetime-inic']))?>
			</p>

			<p>
				<b>Horário de término:</b> <?php echo strftime("%d/%m/%Y às %H:%M:%S", strtotime($viagem['datetime-fim']))?>
			</p>

			<p >
				<span class="text-danger"><b>Receita bruta:</b> R$<?php echo $viagem['passageiros']*$viagem['preco'] ?></span>&ensp;&ensp;&ensp;

				<span class="text-success"><b>Receita liquida:</b> R$<?php echo $viagem['passageiros']*$viagem['preco']-$viagem['custo']?></span>
			</p>

		</div>

		<div class="col-md-3">
			<a href="../editar/<?php echo $destino['id_companhia'] ?>" class="btn btn-block btn-warning">Editar</a>
			<button data-destino="<?php echo $destino['destino'] ?>" data-id="<?php echo $destino['id'] ?>" class="desativar btn btn-block btn-danger">Excluir</button>
		</div>
	</div>

	<?php endwhile; ?>


<?php else: ?>

	<div class="alert alert-danger text-center">
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