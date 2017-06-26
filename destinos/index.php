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

				<h1 class="text-center" style="color: #f0f0f0;">B&ensp;U&ensp;S&ensp;C&ensp;A&ensp;R&ensp;&ensp; D&ensp;E&ensp;S&ensp;T&ensp;I&ensp;N&ensp;O <br><i class="icon ion-map fa-4x" aria-hidden="true"></i></h1>

						<div class="row">
							<div class="form-group col-md-6">
		                        <br>
								<input type="text" id="busca" name="busca" class="form-control input-lg" placeholder="Procure pelo destino">
							</div>

							<div class="form-group col-md-6"><br>
								<select name="companhia" id="companhia" class="form-control input-lg">
									<option value="" hidden>Companhias</option>
									<?php $query = "SELECT * FROM companhias ORDER BY nome";
										$res = mysql_query($query);
										while($companhia = mysql_fetch_assoc($res)):
									 ?>
											<option value="<?php echo $companhia['id'] ?>"><?php echo $companhia['nome'] ?></option>
										<?php endwhile; ?>
								</select>
							</div>
						</div>
					</form>

					<div id="resultado">
						<?php 
						$res = mysql_query("SELECT * FROM destinos ORDER BY destino");

						if(mysql_num_rows($res) != 0): 

							while($destino = mysql_fetch_assoc($res)):

							$id_companhia = $destino['id_companhia'];
							$id_destino = $destino['id'];

							$query_companhia = "SELECT * FROM companhias WHERE id = '$id_companhia'";

							$companhia = mysql_fetch_assoc(mysql_query($query_companhia));


							/* VIAGENS POR DIA */
							$query = "SELECT * FROM horarios WHERE id_destino = '$id_destino'";
							$res_cont = mysql_query($query);
							$contador_viagens = mysql_num_rows($res_cont);
							?>
							
							<div class="row resultadoContainer">
								<div class="col-md-9">
									<h4 class="text-bold"><?php echo $destino['destino'] ?></h4>	<br>
									<p><b>Companhia:</b> <?php echo $companhia['nome'] ?></p>

									<p><b>Número de viagens por dia:</b> <?php echo $contador_viagens*2 ?></p>

								</div>

								<div class="col-md-3">
									<a href="../editar/<?php echo $destino['id'] ?>" class="btn btn-block btn-warning">Editar</a>
									<button data-destino="<?php echo $destino['destino'] ?>" data-id="<?php echo $destino['id'] ?>" class="desativar btn btn-block btn-danger">Excluir</button>
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



				<h1 class="text-center" style="color: #f0f0f0;">C&ensp;A&ensp;D&ensp;A&ensp;S&ensp;T&ensp;R&ensp;A&ensp;R&ensp;&ensp; D&ensp;E&ensp;S&ensp;T&ensp;I&ensp;N&ensp;O <br><i class="icon ion-map fa-4x" aria-hidden="true"></i></h1>

				<form action="" id="cadastro-motorista">

					<div class="form-group col-md-6"><br>
						<input id="destino" name="destino" type="text" class="form-control input-lg" placeholder="Nome do destino">
					</div>
					
					<div class="form-group col-md-6"><br>
						<select name="id_companhia" id="id_companhia" class="form-control input-lg">
							<option value="" hidden>Companhias</option>
							<?php $query = "SELECT * FROM companhias ORDER BY nome";
								$res = mysql_query($query);
								while($companhia = mysql_fetch_assoc($res)):
							 ?>
									<option value="<?php echo $companhia['id'] ?>"><?php echo $companhia['nome'] ?></option>
								<?php endwhile; ?>
						</select>
					</div>
					
				        <div class='col-md-6 col-md-offset-3' hidden>
				            <div class="form-group">
				                <div class='input-group'>
				                    <input id="horario" name="horario" type='time' class="form-control input-lg"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-time"></span>
				                    </span>
				                </div>
				            </div>
				        </div>
						<br><br>
					<div class="col-md-12 text-center"><br>
						<button id="cadastrar" type="button" class="btn btn-lg btn-primary">Cadastrar</button>
					</div>

				</form>

                <?php elseif($_GET['p'] == 'editar'):
                    $query = "SELECT * FROM destinos WHERE id = '$r'";

                    $result = mysql_query($query);
                    $destino = mysql_fetch_assoc($result);

                    $id_companhia = $destino['id_companhia'];

                ?>

				<h1 class="text-center" style="color: #f0f0f0;">E&ensp;D&ensp;I&ensp;T&ensp;A&ensp;R&ensp;&ensp; D&ensp;E&ensp;S&ensp;T&ensp;I&ensp;N&ensp;O <br><i class="icon ion-map fa-4x" aria-hidden="true"></i></h1>

				<form action="" id="editar-motorista">

					<input type="hidden" name="id" value="<?php echo $destino['id'] ?>">
					
					<div class="form-group col-md-6"><br>
						<input id="destino" name="destino" type="text" class="form-control input-lg" placeholder="Nome do destino" value="<?php echo $destino['destino'] ?>">
					</div>
					
					<div class="form-group col-md-6"><br>
						<select name="id_companhia" id="id_companhia" class="form-control input-lg">
							<option value="" hidden>Companhias</option>
							<?php $query = "SELECT * FROM companhias ORDER BY nome";
								$res = mysql_query($query);
								while($companhia = mysql_fetch_assoc($res)):
							 ?>
									<option <?php if($companhia['id'] == $destino['id_companhia']) echo 'selected' ?> value="<?php echo $companhia['id'] ?>"><?php echo $companhia['nome'] ?></option>
								<?php endwhile; ?>
						</select>
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
                    url: '<?php echo $root_html?>es2/destinos/cadastrar.php',
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
                    url: '<?php echo $root_html?>es2/destinos/editar.php',
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
				var destino = $(this).attr('data-destino');

				if (confirm("Deseja excluir o motorista "+destino+"?")) {
						
						var data = {
							'id': id
						}

		           		$.ajax({
		                    url: '<?php echo $root_html?>es2/destinos/excluir.php',
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
                    url: '<?php echo $root_html ?>es2/destinos/busca.php',
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
                    url: '<?php echo $root_html ?>es2/destinos/busca.php',
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