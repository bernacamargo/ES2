<?php include '../seguranca.php';

$title = "AdminPainel - Motoristas";

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

				<h1 class="text-center" style="color: #f0f0f0">B&ensp;U&ensp;S&ensp;C&ensp;A&ensp;R&ensp;&ensp; M&ensp;O&ensp;T&ensp;O&ensp;R&ensp;I&ensp;S&ensp;T&ensp;A <br><br><i class="fa fa-id-card-o fa-3x" aria-hidden="true"></i></h1>

						<div class="form-group">
	                        <br>
	                        <div class="input-group">
								<input type="text" id="busca" name="busca" class="form-control input-lg" placeholder="Procure por nome">
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-search"></span>
								</span>
							</div>
						</div>
					</form>

					<div id="resultado">
						<?php 
						$res = mysql_query("SELECT * FROM motorista ORDER BY nome");

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

							<div class="alert alert-danger text-center">
								<i class="text-bold glyphicon glyphicon-alert"></i>&ensp;Nenhum resultado encontrado
							</div>


						<?php endif; ?>
					</div>

                <?php elseif($_GET['p'] == 'cadastrar'): ?>



				<h1 class="text-center" style="color: #f0f0f0">C&ensp;A&ensp;D&ensp;A&ensp;S&ensp;T&ensp;R&ensp;A&ensp;R&ensp;&ensp; M&ensp;O&ensp;T&ensp;O&ensp;R&ensp;I&ensp;S&ensp;T&ensp;A <br><br><i class="fa fa-id-card-o fa-3x" aria-hidden="true"></i></h1>

				<form action="" id="cadastro-motorista">
					
					<div class="form-group">
						<label for="nome">Nome</label>
						<input type="text" id="nome" class="input-lg form-control" name="nome" placeholder="Digite o nome completo do motorista">
					</div>
					<div class="form-group">
						<label for="email">E-mail</label>
						<input type="text" id="email" class="input-lg form-control" name="email" placeholder="Digite o e-mail do motorista">
					</div>
					<div class="form-group">
						<label for="contato">Contato</label>
						<input type="text" id="contato" class="input-lg form-control" name="contato" placeholder="Celular para contato">
					</div>
					
					<div class="col-md-12 text-center">
						<button id="cadastrar" type="button" class="btn btn-lg btn-primary">Cadastrar</button>
					</div>

				</form>

                <?php elseif($_GET['p'] == 'editar'):
                    $query = "SELECT * FROM motorista WHERE id = '$r'";

                    $result = mysql_query($query);
                    $motorista = mysql_fetch_assoc($result);
                ?>

				<h1 class="text-center" style="color: #f0f0f0">E&ensp;D&ensp;I&ensp;T&ensp;A&ensp;R&ensp;&ensp; M&ensp;O&ensp;T&ensp;O&ensp;R&ensp;I&ensp;S&ensp;T&ensp;A <br><br><i class="fa fa-id-card-o fa-3x" aria-hidden="true"></i></h1>

				<form action="" id="editar-motorista">

					<input type="hidden" name="id" value="<?php echo $motorista['id'] ?>">
					
					<div class="form-group">
						<label for="nome">Nome</label>
						<input type="text" id="nome" class="form-control" name="nome" value="<?php echo $motorista['nome'] ?>">
					</div>
					<div class="form-group">
						<label for="email">E-mail</label>
						<input type="text" id="email" class="form-control" name="email" value="<?php echo $motorista['email'] ?>">
					</div>
					<div class="form-group">
						<label for="contato">Contato</label>
						<input type="text" id="contato" class="form-control" name="contato" value="<?php echo $motorista['contato'] ?>">
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

            $('#cadastrar').click(function () {
                
                var data = $("#cadastro-motorista").serialize();
                $.ajax({
                    url: '<?php echo $root_html?>es2/motoristas/cadastrar.php',
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
                    url: '<?php echo $root_html?>es2/motoristas/editar.php',
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

            $('#busca').keyup(function () {
                
                var data = $(".alunoCadastro").serialize();
                $.ajax({
                    url: '<?php echo $root_html ?>es2/motoristas/busca.php',
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