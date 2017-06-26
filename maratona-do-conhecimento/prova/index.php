<?php include '../../../web/seguranca.php';

$escola = mysql_query("SELECT DISTINCT cidade FROM escola");

include '../../head.php';
?>
<body class="hold-transition skin-blue sidebar-mini fixed">

	<div class="wrapper">

	<?php #include '../../menu.php'; ?>
		<div class="content-wrapper">

        	<div class="container-fluid" style="width: 80%;">

        		<?php if(empty($_GET['p'])): ?>
				
				<div class="row">
					<h1 class="text-center">Bem vindo a Maratona do Conhecimento</h1>
					<br>
					<h4 class="text-center">Para poder começar a sua prova, precisamos fazer algumas verificações de segurança.</h4>
					<br>
					<div class="col-md-12" style="background: #fff; border: 1px solid rgba(51,51,51,.3); padding: 20px;">
						<h4 class="text-center text-bold">Qual é a cidade e nome da sua escola?</h4>
						<form>
							<div class="form-group">
								<select name="cidade" id="cidade" class="form-control input-lg">
					                <option selected="true" value="null">Escolha uma cidade</option>
					                <?php
					                while ($e = mysql_fetch_array($escola)) {
					                    echo '<option value="' . $e['cidade'] . '">' . $e['cidade'] . '</option>';
					                }
                					?>
								</select>		
							</div>
<br>
							<div class="form-group">
								<select name="escola" id="escola" class="form-control input-lg">
									<option value="">--</option>
								</select>
							</div>

							<div class="text-center">
								<a href="#" id="select_escola" type="button" class="btn btn-primary btn-lg " disabled><span class="glyphicon glyphicon-log-in"></span>&ensp;Continuar</a>
							</div>
						</form>
					</div>

				<?php elseif(!empty($_GET['p']) && empty($_GET['r'])): 
					$id_escola = $_GET['p'];
			        $tmsp_query = mysql_query('SELECT tmsp_maratona FROM escola WHERE id_escola = ' . $id_escola);
			        $tmsp = mysql_fetch_assoc($tmsp_query);
			        $time = strtotime($tmsp['tmsp_maratona']);
			        $curtime = time();

			        if ($curtime > $time): ?>
					
					<div class="row" style="padding-top: 50px;">

					<div class="col-md-12" style="background: #fff; border: 1px solid rgba(51,51,51,.3); padding: 30px;">
						<p class="text-center">
							<h3>Que legal, já está na hora da sua prova! </h3><br>
							Agora precisamos saber qual o nível de prova você fará e se você já tem a senha secreta para liberar seu acesso. <br>
							O seu Supervisor Educacional, Coordenador Local ou Professor que está aplicando a prova deve te dar essas informações!
						</p>

					<hr>

						<form>
							<div class="form-group">
								<select name="nivel" id="nivel" class="form-control input-lg">
					                <option selected="true" value="null" hidden>Escolha um nivel</option>
					                <option value="1">6º Ano</option>
					                <option value="2">7º Ano</option>
					                <option value="3">8º Ano</option>
					                <option value="4">9º Ano</option>
					                <option value="5">Ensino Médio</option>
								</select>		
							</div>
<br>
							<div class="form-group">
								<input type="text" name="senha" class="form-control input-lg" placeholder="Senha secreta">

							</div>

							<div class="text-center">
								<a href="#" id="select_nivel" type="button" class="btn btn-primary btn-lg " disabled><span class="glyphicon glyphicon-log-in"></span>&ensp;Continuar</a>
							</div>
						</form>

					</div>

					<?php else: ?>

					<h1>NÃO ESTA NA HORA DA SUA PROVA</h1>


					<?php endif; ?>
				<?php endif; ?>
				</div>

        	</div>
        </div>

	</div>

<?php include '../../footer.php'; ?>

<script>

	$("#senha").focusout(function() {

		var id_escola = $("#escola").val();
		var nome = $("#nome").val();
		var data = {
			'senha': $(this).val(),
			'nome': nome,
			'id_escola': id_escola
		}

		$.ajax({
			url: '<?php echo $root_html ?>sistema2/maratona-do-conhecimento/prova/validaSenha.php',
			type: 'POST',
			data: data,
		})
		.done(function() {
			console.log("success");
		})
		.fail(function() {
			console.log("error");
		});		
	});

    $("#escola").change(function() {
    	$('#select_escola').removeAttr('disabled');
        var id_escola = $('#escola').val();
        var url = '<?php echo $root_html ?>maratona/'+ id_escola;
        $('#select_escola').attr('href', url);    	
    });

    $('#cidade').change(function () {

    var values = {
        'cidade': $('#cidade').val()
    };
    $.ajax({
        url: '<?php echo $root_html ?>maratona/busca_escola.php',
        type: 'POST',
        data: values,
        success: function (data) {
            $('#escola').html(data);

        },
        error: function (e) {
            $('#escola').html("<option>Nenhum resultado encontrado.</option>");

        }
    });
});

</script>