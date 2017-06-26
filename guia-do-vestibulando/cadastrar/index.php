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
				
				<form id="forms-cadastro" enctype="multipart/form-data" method="POST" action="cadastrar.php" class="alunoCadastro">
					<h1 align="center"><i style="font-size: 4em; line-height: 1.3em; color: #dd4b39;" class="fa fa-graduation-cap fa-fw"></i></h1>

					<div class="form-group">
						<label for="vestibular">Nome do vestibular</label>
						<input type="text" id="vestibular" class="form-control" name="vestibular">
					</div>

					<div class="form-group">
						<label for="data-inscricao">Data da inscrição</label>
						<input id="data-inscricao" type="text" class="form-control" name="data-inscricao" placeholder="dd/mm/aaaa até dd/mm/aaaa às hh:mm">
					</div>

					<div class="form-group">
						<label for="data-prova">Data da prova</label>
						<textarea name="data-prova" id="data-prova" cols="30" rows="10" class="form-control" placeholder="1ª fase: dd/mm/aaaa<br> 2ª fase: dd/mm/aaaa"></textarea>
					</div>

					<div class="form-group">
						<label for="">Links Úteis</label>
						<textarea name="links" id="links" cols="30" rows="4" class="form-control"></textarea>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="valor">Preço</label>
								<div class="input-group">
									<span class="input-group-addon">
										$
									</span>
									<input type="text" class="form-control" name="valor" id="valor" placeholder="100,00">
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="ano">Ano</label>
								<input id="ano" name="ano" type="text" class="form-control">
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="status">Status</label>
								<select name="status" id="status" class="form-control">
									<option value="" hidden selected></option>
									<option value="1">Inscrições abertas</option>
									<option value="0">Inscrições fechadas</option>
								</select>
							</div>
						</div>

					</div>
					
					<br>
					<div class="text-center">
						<button id="salvarCadastro" type="button" value="Cadastrar" class="btn btn-primary btn-lg">
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

	tinymce.init({
	  selector: 'textarea',
	  height: 100,
	  menubar: false,
	  placeholder: true,
	  plugins: [
	    'advlist autolink lists link image charmap print preview anchor',
	    'searchreplace visualblocks code fullscreen',
	    'insertdatetime media table contextmenu paste code'
	  ],
	  toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
	  content_css: [
	    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
	    '//www.tinymce.com/css/codepen.min.css']
	});

	
	$('#telefone').mask('(00) 0000-0000');
	$('#celular').mask('(00) 00000-0000');
	$('#data-inscricao-inicio').mask('00/00/0000');
	$('#data-inscricao-final').mask('00/00/0000');


	$('#salvarCadastro').click(function(event){
		
		tinyMCE.triggerSave();

		data = $('#forms-cadastro').serialize();

        $.ajax({
            url: '<?php echo $root_html?>sistema2/guia-do-vestibulando/cadastrar/cadastrar.php',
            type: 'POST',
            data: data,
            complete: function() {
                setTimeout(function(){ location.href = '../';}, 500);
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

</script>

</body>
</html>