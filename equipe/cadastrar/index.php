<?php include '../../../web/seguranca.php';

protegePaginaUnica(999);

$escola1 = mysql_query("SELECT DISTINCT cidade FROM escola");


include '../../head.php';
?>
<body class="hold-transition skin-red sidebar-mini fixed">

	<div class="wrapper">

	<?php include '../../menu.php'; ?>
		<div class="content-wrapper">

        	<div class="container-fluid" style="width: 80%;">
				
				<form id="cadastroEquipe" enctype="multipart/form-data" method="POST" action="cadastrar.php" class="alunoCadastro">
					<h1 align="center"><i style="font-size: 4em; line-height: 1.3em; color: #dd4b39;" class="fa fa-id-badge fa-fw"></i></h1>
					<div class="form-group">
						<label for="nome">Nome</label>
						<input type="text" id="nome" name="nome" class="form-control">
					</div>
					
					<div class="row">
						<div class="form-group col-md-6">
							<label for="cargo">Cargo</label>
							<input type="text" id="cargo" name="cargo" class="form-control">
						</div>
						
						<div class="form-group col-md-4">
							<label for="cargo_geral">Cargo Generalizado</label>
							<select id="cargo_geral" name="cargo_geral" class="form-control">
								<option value="" hidden></option>
								<option value="diretoria">Diretoria</option>
								<option value="assistente">Assistente</option>
								<option value="supervisor">Supervisor Educacional</option>
								<option value="coordenador_local">Coordenador Local</option>
								<option value="membro_honorario">Membro Honorário</option>
								<option value="membro_benemerito">Membro Benemérito</option>
								<option value="comite_cientifico">Comitê Científico</option>
								<option value="embaixador_senior">Embaixador Sênior</option>
								<option value="embaixador_jr">Embaixador Júnior</option>
							</select>
						</div>


						<div class="form-group col-md-2">
							<label for="h">Nivel de acesso</label>
							<div class="input-group">
								<select name="h" id="h" class="form-control">
									<option value="" hidden></option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="901">901</option>
									<option value="999">999</option>
								</select>
								<div class="input-group-btn">
									<button id="btn-help" type="button" class="btn btn-danger" role="button" data-toggle="popover" data-trigger="focus" title="Hierarquia" data-container="body" data-html="true" data-placement="bottom" data-content="
									<b>NIVEL 1:</b> Aluno 
									<br> 
									<b>NIVEL 2:</b> Coordenador Local 
									<br> 
									<b>NIVEL 4:</b>Embaixador Jr 
									<br> 
									<b>NIVEL 5:</b>Embaixador Senior 
									<br>
									<b>NIVEL 6:</b>Membro Honorário, Benemérito e Comitê Científico
									<br>
									<hr> 
									<b>NIVEL 901:</b> Supervisor Educacional 
									<br>
									<b>NIVEL 999: Admin</b>
									">
										<span class="glyphicon glyphicon-info-sign"></span>
									</button>
								</div>
							</div>
						</div>
					</div>
					
					<div id="cidadeSupervisor" class="form-group" hidden>
						<label for="buscaCidade">Cidade</label>
                        <select class="form-control" name="cidade" id="buscaCidade">
                            <option value="" hidden>Escolha uma cidade</option>
                            <?php
							$escola1 = mysql_query("SELECT DISTINCT cidade FROM escola");                            
                            while ($e = mysql_fetch_array($escola1)) {
                                echo '<option value="' . $e['cidade'] . '">' . $e['cidade'] . '</option>';
                            }
                            ?>
                        </select>
						<br>
						<p class="text-danger"><b><span class="glyphicon glyphicon-alert"></span></b>&ensp;Só preencha esse campo se estiver cadastrando um <b>Supervisor Educacional!</b></p>
					</div>

					<div id="cidadeCoordenadorLocal" class="form-group" hidden>
						<label for="buscaCidade">Cidade</label>
                        <select class="form-control" name="cidade" id="buscaCidade">
                            <option value="" hidden>Escolha uma cidade</option>
                            <?php
							$escola1 = mysql_query("SELECT DISTINCT cidade FROM escola");                            
                            while ($e = mysql_fetch_array($escola1)) {
                                echo '<option value="' . $e['cidade'] . '">' . $e['cidade'] . '</option>';
                            }
                            ?>
                        </select>
						<br>
						<p class="text-danger"><b><span class="glyphicon glyphicon-alert"></span></b>&ensp;Só preencha esse campo se estiver cadastrando um <b>Coordenador Local!</b></p>
					</div>

					<div id="embaixadorJR" class="form-group" hidden>
						<div class="row">
							
							<div class="col-md-6">
								<label for="cidadeEmbaixador">Cidade</label>
		                        <select class="form-control" name="cidade" id="cidadeEmbaixador">
		                            <option value="" hidden>Escolha uma cidade</option>
		                            <?php
	                                $escola1 = mysql_query("SELECT DISTINCT cidade FROM escola");

		                            while ($e = mysql_fetch_array($escola1)) {
		                                echo '<option value="' . $e['cidade'] . '">' . $e['cidade'] . '</option>';
		                            }
		                            ?>
		                        </select>
	                        </div>

	                        <div class="col-md-6">
	                        	<label for="escolaEmbaixador">Escola</label>
	                        	<select name="id_escola" id="escolaEmbaixador" class="form-control">
	                        		
	                        	</select>
	                        </div>

						</div>
<br>
						<p class="text-danger"><b><span class="glyphicon glyphicon-alert"></span></b>&ensp;Só preencha esses campos se estiver cadastrando um <b>Embaixador Júnior!</b></p>
					</div>


					<div id="embaixador_senior" class="row" hidden>

						<div class="col-md-12 form-group">
							<label for="ocupacao">Ocupação atual:</label>
							<textarea class="form-control" name="ocupacao" id="ocupacao" cols="30" rows="5"></textarea>
						</div>
						<p class="text-danger"><b><span class="glyphicon glyphicon-alert"></span></b>&ensp;Só preencha esse campo se estiver cadastrando um <b>Embaixador Sênior!</b></p>
						
					</div>

					<div class="form-group">
						<label for="descricao">Mini-currículo</label>
						<textarea id="descricao" class="form-control" rows="5" name="descricao"></textarea>
					</div>

					<div class="form-group">
						<label for="email">E-mail</label>
						<input type="email" id="email" name="email" class="form-control">
					</div>
					<div class="row">					
						<div class="form-group col-md-6">
							<label for="telefone">Telefone</label>
							<input type="text" id="telefone" name="tel" class="form-control" maxlength="10">
						</div>

						<div class="form-group col-md-6">
							<label for="celular">Celular</label>
							<input type="text" id="celular" name="cel" class="form-control" maxlength="11">
						</div>
					</div>

					<div class="form-group">
						<label for="facebook">Perfil do Facebook</label>
						<input type="text" id="facebook" name="face" class="form-control">
					</div>

					<div class="row">
						<div class="form-group col-md-6">
							<label for="sexo">Sexo</label>
							<select id="sexo" name="sexo" class="form-control">
								<option value="" hidden></option>
								<option value="1">Masculino</option>
								<option value="2">Feminino</option>
							</select>
						</div>

						<div class="form-group col-md-6">
							<label for="nasc">Data de Nascimento</label>
							<input type="text" id="nasc" name="data" class="form-control" maxlength="10">
						</div>
					</div>
					<div class="form-group">
						<label for="curriculum">Currículo Lattes</label>
						<input type="text" id="curriculum" name="curriculum" class="form-control">
						<p class="help-block">Deixe em branco caso não possua um currículo lattes</p>
					</div>

					<div class="form-group">
					  <label for="arquivoFoto">Carregar Foto</label>
					  <input name="arquivoFoto" type="file" id="arquivoFoto">
					  <p class="help-block">Tamanho máximo: 300 kbps</p>
					</div>

					<div class="text-center">
						<button id="salvarCadastro" type="submit" value="Cadastrar" class="btn btn-primary btn-lg">
							Cadastrar
						</button>	
						<input type="reset" class="btn btn-default pull-right">		
					</div>
				</form>
        	</div>
        </div>

	</div>

	<?php include '../../footer.php'; ?>

<script type="text/javascript">

	$("#btn-help").popover({
		'container': 'body'
	});

	$("#btn-help").click(function(event) {
		$("#btn-help").popover('toggle');
	});
	
	$('#telefone').mask('(00) 0000-0000');
	$('#celular').mask('(00) 00000-0000');
	$('#nasc').mask('00/00/0000');


	$('#').click(function(event){

		data = new FormData($('#cadastroEquipe'));

		data.append('arquivoFoto', $('input[type=file]')[0].files[0]);		

        $.ajax({
            url: '<?php echo $root_html?>sistema2/equipe/cadastrar/cadastrar.php',
            type: 'POST',
            data: data,
	        contentType: false,
	        processData: false,
	        cache: false,
	        /*xhr: function() {  // Custom XMLHttpRequest
	            var myXhr = $.ajaxSettings.xhr();
	            if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
	                myXhr.upload.addEventListener('progress', function () {
	                	alert('carregando');
	                }, false);
	            }
	        return myXhr;
	        },*/
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

	$('#cargo_geral').change(function(){

		if($('#cargo_geral').val() == 'embaixador_jr')
			$("#embaixadorJR").slideDown('slow');
		else
			$("#embaixadorJR").slideUp('slow');	

		if($('#cargo_geral').val() == 'embaixador_senior')
			$("#embaixador_senior").slideDown('slow');
		else
			$("#embaixador_senior").slideUp('slow');	

		if($('#cargo_geral').val() == 'supervisor')
			$("#cidadeSupervisor").slideDown('slow');
		else
			$("#cidadeSupervisor").slideUp('slow');	

		if($('#cargo_geral').val() == 'coordernador_local')
			$("#cidadeCoordenadorLocal").slideDown('slow');
		else
			$("#cidadeCoordenadorLocal").slideUp('slow');
	});


        $('#cidadeEmbaixador').change(function () {

            var values = {
                'cidade': $('#cidadeEmbaixador').val()
            };

            $.ajax({
                url: '<?php echo $root_html ?>sistema2/alunos/buscar/busca_escola.php',
                type: 'POST',
                data: values,
                success: function (data) {
                    $('#escolaEmbaixador').html(data);

                },
                error: function (e) {
                    $('#escolaEmbaixador').html("<option>Nenhum resultado encontrado.</option>");

                }
            });

        });        


</script>

</body>
</html>