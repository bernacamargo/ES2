<?php include '../seguranca.php';

$title = "AdminPainel - Destinos";

if (isset($_GET['p']) && isset($_GET['r'])){
    $p = $_GET['p'];
    $r = $_GET['r'];
}
include '../head.php';
?>
<body class="hold-transition skin-black sidebar-mini fixed">

    <div class="wrapper">

    <?php include '../menu.php'; ?>

        <div class="content-wrapper">

        	<div class="container-fluid" style="width: 80%;">
				
            	<?php if($_GET['p'] == 'buscar'): ?>

					<form class="alunoCadastro">

				<h1 class="text-center" style="color: #f0f0f0;">B&ensp;U&ensp;S&ensp;C&ensp;A&ensp;R&ensp;&ensp; C&ensp;O&ensp;M&ensp;P&ensp;A&ensp;N&ensp;H&ensp;I&ensp;A <br><br><i class="fa fa-bus fa-3x" aria-hidden="true"></i></h1>

						<div class="row">
							<div class="form-group col-md-12">
		                        <br>
								<input type="text" id="busca" name="busca" class="form-control input-lg" placeholder="Procure pelo nome da companhia">
							</div>

						</div>
					</form>

					<div id="resultado">
						<?php 
						$res = mysql_query("SELECT * FROM companhias ORDER BY nome");

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
										<h4 class="text-bold">Receitas Totais</h4>
										<p><span class="text-danger">Receita bruta <b>R$<?php echo $receita_bruta ?></b></span>&ensp;&ensp;&ensp;<span class="text-success">Receita liquida: <b>R$<?php echo $receita_liquida; ?></b></span></p>
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
					</div>


                <?php elseif($_GET['p'] == 'cadastrar'): ?>




				<h1 class="text-center" style="color: #fff;">C&ensp;A&ensp;D&ensp;A&ensp;S&ensp;T&ensp;R&ensp;A&ensp;R&ensp;&ensp; C&ensp;O&ensp;M&ensp;P&ensp;A&ensp;N&ensp;H&ensp;I&ensp;A <br><br><i class="fa fa-bus fa-3x" aria-hidden="true"></i></h1>
				<form action="" id="cadastro-motorista">

					<div class="form-group col-md-6"><br>
						<input id="nome" name="nome" type="text" class="form-control input-lg" placeholder="Nome da companhia">
					</div>
					

					<div class="form-group col-md-6">
						<br>
						<input name="tamanho" type="number" class="input-lg form-control" placeholder="Tamanho da frota">
					</div>

					<div class="col-md-12 text-center">
						<button id="cadastrar" type="button" class="btn btn-lg btn-primary">Cadastrar</button>
					</div>

				</form>

                <?php elseif($_GET['p'] == 'editar'):
                    $query = "SELECT * FROM companhias WHERE id = '$r'";

                    $result = mysql_query($query);
                    $companhia = mysql_fetch_assoc($result);

                ?>

				<h1 class="text-center" style="color: #f0f0f0;">E&ensp;D&ensp;I&ensp;T&ensp;A&ensp;R&ensp;&ensp; C&ensp;O&ensp;M&ensp;P&ensp;A&ensp;N&ensp;H&ensp;I&ensp;A <br><br><i class="fa fa-bus fa-3x" aria-hidden="true"></i></h1>

				<form action="" id="editar-motorista">

					<input type="hidden" name="id" value="<?php echo $companhia['id'] ?>">
					
					<div class="form-group col-md-6"><br>
						<input id="nome" name="nome" type="text" class="form-control input-lg" placeholder="Nome da companhia" value="<?php echo $companhia['nome'] ?>">
					</div>
					

					<div class="form-group col-md-6">
						<br>
						<input name="tamanho" type="number" class="input-lg form-control" placeholder="Tamanho da frota" value="<?php echo $companhia['tamanho_da_frota'] ?>">
					</div>

					
					<div class="col-md-12 text-center">
						<button id="editar" type="button" class="btn btn-lg btn-primary">Salvar</button>

					</div>

				</form>

                <?php endif; ?>

        	</div>
        </div>

	</div>

	<?php include '../footer.php'; ?>
<script type="text/javascript">

			$('#contato').mask("(00) 00000-0000");

			$('#horario').mask("00:00");


            $('#cadastrar').click(function () {
                
                var data = $("#cadastro-motorista").serialize();
                $.ajax({
                    url: '<?php echo $root_html?>es2/companhias/cadastrar.php',
                    type: 'POST',
                    data: data,
		            complete: function() {
		                //setTimeout(function(){ location.reload();}, 500);
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

            });
            
 			$('#editar').click(function () {
                
                var data = $("#editar-motorista").serialize();
                $.ajax({
                    url: '<?php echo $root_html?>es2/companhias/editar.php',
                    type: 'POST',
                    data: data,
		            complete: function() {
		                //setTimeout(function(){ location.reload();}, 500);
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

            });

       		$('.desativar').click(function(event) {
		
				var id = $(this).attr('data-id');
				var companhia = $(this).attr('data-nome');

				if (confirm("Deseja excluir a companhia "+companhia+"?")) {
						
						var data = {
							'id': id
						}

		           		$.ajax({
		                    url: '<?php echo $root_html?>es2/companhias/excluir.php',
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

            $('#busca').keyup(function () {
                
                var data = $(".alunoCadastro").serialize();
                $.ajax({
                    url: '<?php echo $root_html ?>es2/companhias/busca.php',
                    type: 'POST',
                    data: data,
                    success: function (data) {
                        $('#resultado').html(data);
                    },
                    error: function (e) {
                        $('#resultado').html("<option>Nenhum resultado encontrado.</option>");

                    }
                });

            });

            $('#companhia').change(function () {
                
                var data = $(".alunoCadastro").serialize();
                $.ajax({
                    url: '<?php echo $root_html ?>es2/companhias/busca.php',
                    type: 'POST',
                    data: data,
                    success: function (data) {
                        $('#resultado').html(data);
                    },
                    error: function (e) {
                        $('#resultado').html("<option>Nenhum resultado encontrado.</option>");

                    }
                });

            });



            $('#enviarForm').click(function () {
                
                var data = $(".equipeEditar").serialize();
                $.ajax({
                    url: '<?php echo $root_html?>sistema2/equipe/buscar/editar.php',
                    type: 'POST',
                    data: data,
                    success: function (data) {
                        $('#resultado1').html(data);
                        setTimeout(function(){ location.reload();}, 2000);
                    },
                    error: function (e) {
                        $('#resultado1').html("<option>Nenhum resultado encontrado.</option>");
                    }
                });

            });



</script>

</body>
</html>