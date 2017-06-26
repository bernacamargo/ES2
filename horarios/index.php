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

				<h1 class="text-center" style="color: #fff;">B&ensp;U&ensp;S&ensp;C&ensp;A&ensp;R&ensp;&ensp; H&ensp;O&ensp;R&ensp;Á&ensp;R&ensp;I&ensp;O&ensp;S <br><br><i class="fa fa-bus fa-3x" aria-hidden="true"></i></h1>

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

							$id_destino = $destino['id'];

							$query_horarios = "SELECT * FROM horarios WHERE id_destino = '$id_destino'";

							$horarios = mysql_query($query_horarios);

							?>
							
							<div class="row resultadoContainer">
								<div class="col-md-9">
									<h4 class="text-bold"><?php echo $destino['destino'] ?></h4>	<br>
									
									<?php if(mysql_num_rows($horarios) != 0): 
										while($horario = mysql_fetch_assoc($horarios)):
									?>
										
										<p><b>•</b> <?php echo $horario['horario']; ?></p>	


										<?php endwhile; ?>
									<?php else: ?>
	
										<p class="text-danger">Sem horários disponíveis</p>

									<?php endif; ?>

								</div>

								<div class="col-md-3">
									<a href="../editar/<?php echo $destino['id'] ?>" class="btn btn-block btn-warning"><span class="glyphicon glyphicon-pencil"></span> Editar</a>
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



				<h1 class="text-center" style="color: #fff;">C&ensp;A&ensp;D&ensp;A&ensp;S&ensp;T&ensp;R&ensp;A&ensp;R&ensp;&ensp; H&ensp;O&ensp;R&ensp;Á&ensp;R&ensp;I&ensp;O&ensp;S <br><br><i class="fa fa-bus fa-3x" aria-hidden="true"></i></h1>

				<form action="" id="cadastro-motorista">

					<div class="form-group col-md-6"><br>
						<select name="destino" id="destino" class="input-lg form-control">
							<option value="" hidden>Selecione um destino</option>
							<?php 
							$res = mysql_query("SELECT * FROM destinos ORDER BY destino");
							while($dest = mysql_fetch_assoc($res)): ?>
								<option value="<?php echo $dest['id'] ?>"><?php echo $dest['destino'] ?></option>
							<?php endwhile; ?>
						</select>
					</div>
					
				        <div class='col-md-6'><br>
				            <div class="form-group">
				                <div class='input-group'>
				                    <input id="horario" name="horario" type='time' class="form-control input-lg"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-time"></span>
				                    </span>
				                </div>
				            </div>
				        </div>
						<br>
					<div class="col-md-12 text-center">
						<button id="cadastrar" type="button" class="btn btn-lg btn-primary">Cadastrar</button>
					</div>

				</form>

                <?php elseif($_GET['p'] == 'editar'):
                    $query = "SELECT * FROM horarios WHERE id_destino = '$r'";

                    $result = mysql_query($query);

                ?>

				<h1 class="text-center" style="color: #fff;">E&ensp;D&ensp;I&ensp;T&ensp;A&ensp;R&ensp;&ensp; H&ensp;O&ensp;R&ensp;Á&ensp;R&ensp;I&ensp;O&ensp;S <br><br><i class="fa fa-bus fa-3x" aria-hidden="true"></i></h1>

				<form action="" id="editar-motorista">

					<?php  ?>

					<?php $destino = mysql_fetch_assoc(mysql_query("SELECT * FROM destinos WHERE id = '$r'")); ?>
					<input type="hidden" name="id-destino" value="<?php echo $r ?>">
					<div class="form-group col-md-12">
						<label for="destino">Destino</label>
						<input type="text" id="destino" class="input-lg form-control" name="destino" value="<?php echo $destino['destino'] ?>" readonly>
					</div>
				
					<?php while($horario = mysql_fetch_assoc($result)): ?>

			        <div class='col-md-6'>
			            <div class="form-group">
			            	<label for="horario">Horário</label>
			                <div class='input-group'>
			                    <input data-id="<?php echo $horario['id'] ?>" name="horario" type='time' class="horario form-control input-lg" value="<?php echo $horario['horario'] ?>"/>
			                    <span class="input-group-addon">
			                        <span class="glyphicon glyphicon-time"></span>
			                    </span>
			                </div>
			            </div>
			        </div>

					<?php endwhile; ?>

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
                    url: '<?php echo $root_html?>es2/horarios/cadastrar.php',
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
            
 			$('.horario').change(function () {
                
                var data = {
                	'id': $(this).attr('data-id'),
                	'horario': $(this).val()
                }

                $.ajax({
                    url: '<?php echo $root_html?>es2/horarios/editar.php',
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
				var nome = $(this).attr('data-nome');

				if (confirm("Deseja excluir o motorista "+nome+"?")) {
						
						var data = {
							'id': id
						}

		           		$.ajax({
		                    url: '<?php echo $root_html?>es2/horarios/excluir.php',
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
                    url: '<?php echo $root_html ?>es2/horarios/busca.php',
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
                    url: '<?php echo $root_html ?>es2/horarios/busca.php',
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