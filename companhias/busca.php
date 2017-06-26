<?php
include '../seguranca.php';

$query = "SELECT * FROM companhias WHERE nome LIKE '%". htmlentities($_POST['busca'])."%' ORDER BY nome";

$res = mysql_query($query);

						if(mysql_num_rows($res) != 0): 

							while($companhia = mysql_fetch_assoc($res)):
								$id_companhia = $companhia['id'];
								$q = "SELECT * FROM destinos AS d, viagem as v WHERE d.id = v.id_destino AND id_companhia = '$id_companhia'";
								$res_destino = mysql_query($q);
								$receita_bruta = 0;
								$receita_liquida = 0;
								while($dest = mysql_fetch_assoc($res_destino)){
									$receita_bruta += $dest['preco']*$dest['passageiros'];
									$receita_liquida += $dest['preco']*$dest['passageiros']-$dest['custo'];
								}

							?>
							
							<div class="row resultadoContainer">
								<div class="col-md-9">
									<h4 class="text-bold"><?php echo $companhia['nome'] ?></h4>	<br>
									<p><b>Frota:</b> <?php echo $companhia['tamanho_da_frota'] ?></p>
									<div class="well">
										<h4>Receitas Totais</h4>
										<p><span class="text-danger">Receita bruta: <b>R$<?php echo $receita_bruta ?></b></span>&ensp;&ensp;&ensp;<span class="text-success">Receita liquida: <b>R$<?php echo $receita_liquida; ?></b></span></p>
									</div>		
								</div>

								<div class="col-md-3">
									<a href="../editar/<?php echo $companhia['id'] ?>" class="btn btn-block btn-warning">Editar</a>
									<button data-nome="<?php echo $companhia['nome'] ?>" data-id="<?php echo $companhia['id'] ?>" class="desativar btn btn-block btn-danger">Excluir</button>
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