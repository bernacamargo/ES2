<?php
include '../seguranca.php';

/*$email = htmlentities($_POST['email']);
$contato = htmlentities($_POST['contato']);*/
$query = "SELECT * FROM destinos WHERE destino LIKE '%". htmlentities($_POST['busca'])."%' ";
if(isset($_POST['companhia']) && !empty($_POST['companhia']))
	$query .= "AND id_companhia LIKE ".$_POST['companhia']." ";

$query .= "ORDER BY destino";

$res = mysql_query($query);

if(mysql_num_rows($res) != 0): 

	while($destino = mysql_fetch_assoc($res)):

		$id_companhia = $destino['id_companhia'];

		$query_companhia = "SELECT * FROM companhias WHERE id = '$id_companhia'";

		$companhia = mysql_fetch_assoc(mysql_query($query_companhia));

		?>
		
		<div class="row resultadoContainer">
			<div class="col-md-9">
				<h4 class="text-bold"><?php echo $destino['destino'] ?></h4>	<br>
				<p><b>Companhia:</b> <?php echo $companhia['nome'] ?></p>

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