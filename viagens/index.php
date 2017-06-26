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

				<h1 class="text-center" style="color: #f0f0f0;">B&ensp;U&ensp;S&ensp;C&ensp;A&ensp;R&ensp;&ensp; V&ensp;I&ensp;A&ensp;G&ensp;E&ensp;M <br><br><i class="glyphicon glyphicon-tags fa-3x" aria-hidden="true"></i></h1>

							<div class="form-group"><br>
								<select name="busca" id="busca-destino" class="input-lg form-control">
									<option value="" hidden>Selecione um destino</option>
									<?php 
									$res = mysql_query("SELECT * FROM destinos ORDER BY destino");
									while($dest = mysql_fetch_assoc($res)): ?>
										<option value="<?php echo $dest['id'] ?>"><?php echo $dest['destino'] ?></option>
									<?php endwhile; ?>
								</select>
							</div>
					</form>

					<div id="resultado">
						<?php 
						$res = mysql_query("SELECT * FROM viagem ORDER BY id_destino");

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

									<div class="well">

										<h4 class="text-bold">Receitas</h4>

										<p >
											<span class="text-danger"><b>Receita bruta:</b> R$<?php echo $viagem['passageiros']*$viagem['preco'] ?></span>&ensp;&ensp;&ensp;

											<span class="text-success"><b>Receita liquida:</b> R$<?php echo $viagem['passageiros']*$viagem['preco']-$viagem['custo']?></span>
										</p>

									</div>
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
					</div>


                <?php elseif($_GET['p'] == 'cadastrar'): ?>



				<h1 class="text-center" style="color: #f0f0f0;">C&ensp;A&ensp;D&ensp;A&ensp;S&ensp;T&ensp;R&ensp;A&ensp;R &ensp;&ensp; V&ensp;I&ensp;A&ensp;G&ensp;E&ensp;M <br><br><i class="glyphicon glyphicon-tags fa-3x" aria-hidden="true"></i></h1>

				<form action="" id="cadastro-motorista">

					<div class="form-group col-md-4"><br>
						<label for="destino">Destino</label>
						<select name="destino" id="destino" class="input-lg form-control">
							<option value="" hidden>Selecione um destino</option>
							<?php 
							$res = mysql_query("SELECT * FROM destinos ORDER BY destino");
							while($dest = mysql_fetch_assoc($res)): ?>
								<option value="<?php echo $dest['id'] ?>"><?php echo $dest['destino'] ?></option>
							<?php endwhile; ?>
						</select>
					</div>

			        <div class='col-md-4'><br>
			            <div class="form-group">
			            	<label for="datetime-inic">Horário de inicio</label>
		                    <input id="datetime-inic" name="datetime-inic" type='datetime-local' class="form-control input-lg"/>
			            </div>
			        </div>

			        <div class='col-md-4'><br>
			            <div class="form-group">
			            	<label for="datetime-final">Horário de chegada</label>
		                    <input id="datetime-final" name="datetime-final" type='datetime-local' class="form-control input-lg"/>
			            </div>
			        </div>

		            <div class="form-group col-md-6">
		            	<label for="motorista">Motorista</label>
						<select name="motorista" id="motorista" class="input-lg form-control">
							<option value="" hidden>Selecione um motorista</option>
							<?php 
							$res = mysql_query("SELECT * FROM motorista ORDER BY nome");
							while($motoca = mysql_fetch_assoc($res)): ?>
								<option value="<?php echo $motoca['id'] ?>"><?php echo $motoca['nome'] ?></option>
							<?php endwhile; ?>
						</select>
		            </div>

		            <div class="form-group col-md-6">
		            	<label for="passageiros">Número de passageiros</label>
		            	<input type="number" class="input-lg form-control" name="passageiros" id="passageiros">
		            </div>

		            <div class="form-group col-md-6">
		            	<label for="valor">Valor da passagem</label>
		            	<div class="input-group">
		            		<span class="input-group-addon">
		            			$
		            		</span>
		            		<input type="number" class="input-lg form-control" name="valor" id="valor">
		            	</div>
		            </div>

		            <div class="form-group col-md-6">
		            	<label for="custo">Custo da viagem</label>
		            	<div class="input-group">
		            		<span class="input-group-addon">
		            			$
		            		</span>
		            		<input type="number" class="input-lg form-control" name="custo" id="custo">
		            	</div>
		            </div>
<br>

					<div class="col-md-12 text-center">
						<button id="cadastrar" type="button" class="btn btn-lg btn-primary">Cadastrar</button>
					</div>

				</form>

                <?php elseif($_GET['p'] == 'editar'):
                    $query = "SELECT * FROM viagem WHERE id = '$r'";

                    $result = mysql_query($query);
                    $viagem = mysql_fetch_assoc($result);

                ?>

				<h1 class="text-center" style="color: #f0f0f0;">E&ensp;D&ensp;I&ensp;T&ensp;A&ensp;R &ensp;&ensp; V&ensp;I&ensp;A&ensp;G&ensp;E&ensp;M <br><br><i class="glyphicon glyphicon-tags fa-3x" aria-hidden="true"></i></h1>
				



				<form action="" id="editar-motorista">

					<input type="hidden" name="id" value="<?php echo $viagem['id'] ?>">

					<div class="form-group col-md-4"><br>
						<label for="destino">Destino</label>
						<select name="destino" id="destino" class="input-lg form-control">
							<option value="" hidden>Selecione um destino</option>
							<?php 
							$res = mysql_query("SELECT * FROM destinos ORDER BY destino");
							while($dest = mysql_fetch_assoc($res)): ?>
								<option <?php if($dest['id'] == $viagem['id_destino']) echo 'selected' ?> value="<?php echo $dest['id'] ?>"><?php echo $dest['destino'] ?></option>
							<?php endwhile; ?>
						</select>
					</div>

			        <div class='col-md-4'><br>
			            <div class="form-group">
			            	<label for="datetime-inic">Horário de inicio</label>
		                    <input id="datetime-inic" name="datetime-inic" type='text' class="form-control input-lg" value="<?php echo date('d/m/Y H:i', strtotime($viagem['datetime-inic'])); ?>"/>
			            </div>
			        </div>

			        <div class='col-md-4'><br>
			            <div class="form-group">
			            	<label for="datetime-final">Horário de chegada</label>
		                    <input id="datetime-final" name="datetime-final" type='text' class="form-control input-lg" value="<?php echo date('d/m/Y H:i', strtotime($viagem['datetime-fim'])); ?>"/>
			            </div>
			        </div>

		            <div class="form-group col-md-6">
		            	<label for="motorista">Motorista</label>
						<select name="motorista" id="motorista" class="input-lg form-control">
							<option value="" hidden>Selecione um motorista</option>
							<?php 
							$res = mysql_query("SELECT * FROM motorista ORDER BY nome");
							while($motoca = mysql_fetch_assoc($res)): ?>
								<option <?php if($motoca['id'] == $viagem['id_motorista']) echo 'selected' ?> value="<?php echo $motoca['id'] ?>"><?php echo $motoca['nome'] ?></option>
							<?php endwhile; ?>
						</select>
		            </div>

		            <div class="form-group col-md-6">
		            	<label for="passageiros">Número de passageiros</label>
		            	<input type="number" class="input-lg form-control" name="passageiros" id="passageiros" value="<?php echo $viagem['passageiros'] ?>">
		            </div>

		            <div class="form-group col-md-6">
		            	<label for="valor">Valor da passagem</label>
		            	<div class="input-group">
		            		<span class="input-group-addon">
		            			$
		            		</span>
		            		<input type="number" class="input-lg form-control" name="valor" id="valor" value="<?php echo $viagem['preco'] ?>">
		            	</div>
		            </div>

		            <div class="form-group col-md-6">
		            	<label for="custo">Custo da viagem</label>
		            	<div class="input-group">
		            		<span class="input-group-addon">
		            			$
		            		</span>
		            		<input type="number" class="input-lg form-control" name="custo" id="custo" value="<?php echo $viagem['custo'] ?>">
		            	</div>
		            </div>
<br>

					<div class="col-md-12 text-center">
						<button id="editar" type="button" class="btn btn-lg btn-primary">Cadastrar</button>
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
                    url: '<?php echo $root_html?>es2/viagens/cadastrar.php',
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
                    url: '<?php echo $root_html?>es2/viagens/editar.php',
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
		                    url: '<?php echo $root_html?>es2/viagens/excluir.php',
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

            $('#busca-destino').change(function () {
                
                var data = $(".alunoCadastro").serialize();
                $.ajax({
                    url: '<?php echo $root_html ?>es2/viagens/busca.php',
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
                    url: '<?php echo $root_html ?>es2/viagens/busca.php',
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