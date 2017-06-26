<?php include '../../../web/seguranca.php';

protegePaginaUnica(3, 901);

$escola1 = mysql_query("SELECT DISTINCT cidade FROM escola");


include '../../head.php';
?>
<body class="hold-transition skin-green sidebar-mini fixed">

	<div class="wrapper">

	<?php include '../../menu.php'; ?>
		<div class="content-wrapper">

        	<div class="container-fluid" style="width: 80%;">
				
				<form id="forms-cadastro" enctype="multipart/form-data" method="POST" action="cadastrar.php" class="alunoCadastro">
					<h1 align="center"><i style="font-size: 4em; line-height: 1.3em; color: #00a65a;" class="glyphicon glyphicon-bookmark"></i></h1>

					<div class="row">
						<div class="col-md-3 form-group">
							<label for="nivel">Nível</label>
							<select name="nivel" id="nivel" class="form-control">
								<option value="" hidden></option>
								<option value="1">6º Ano</option>
								<option value="2">7º Ano</option>
								<option value="3">8º Ano</option>
								<option value="4">9º Ano</option>
								<option value="5">Ensino Médio</option>
							</select>
						</div>

						<div class="col-md-3 form-group">
							<label for="numero">Número da questão</label>
							<input id="numero" name="numero" type="number" class="form-control">
						</div>

						<div class="col-md-3 form-group">
							<label for="genero">Genero</label>
							<select name="genero" id="genero" class="form-control">
								<option value="portugues">Português</option>
								<option value="matematica">Matemática</option>
								<option value="historia">História</option>
								<option value="geografia">Geografia</option>
								<option value="ciencias">Ciências</option>
								<option value="ingles">Inglês</option>
								<option value="atualidades">Atualidades</option>
								<option value="biologia">Biologia</option>
								<option value="quimica">Química</option>
								<option value="fisica">Física</option>
							</select>
						</div>

						<div class="col-md-3 form-group">
							<label for="gabarito">Resposta certa</label>
							<select name="gabarito" id="gabarito" class="form-control">
								<option value="" hidden></option>
								<option value="1">A</option>
								<option value="2">B</option>
								<option value="3">C</option>
								<option value="4">D</option>
								<option value="5">E</option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label for="questao">Questão</label>
						<textarea name="questao" id="questao" cols="30" rows="10" class="form-control"></textarea>
					</div>
					
					<h5 class="text-bold">Respostas:</h5>


					<div class="input-group">
					  <span class="input-group-addon" id="basic-addon1">A)</span>
					  <input type="text" class="form-control" name="r1">
					</div>
<br>
					<div class="input-group">
					  <span class="input-group-addon" id="basic-addon1">B)</span>
					  <input type="text" class="form-control" name="r2">
					</div>
<br>
					<div class="input-group">
					  <span class="input-group-addon" id="basic-addon1">C)</span>
					  <input type="text" class="form-control" name="r3">
					</div>
<br>
					<div class="input-group">
					  <span class="input-group-addon" id="basic-addon1">D)</span>
					  <input type="text" class="form-control" name="r4">
					</div>
<br>
					<div class="input-group">
					  <span class="input-group-addon" id="basic-addon1">E)</span>
					  <input type="text" class="form-control" name="r5">
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
	  height: 250,
	  menubar: false,
	  placeholder: true,
	  relative_urls : false,
   	  remove_script_host : true,	
	  plugins: [
	    'advlist autolink lists link image imagetools jbimages charmap print preview anchor',
	    'searchreplace visualblocks code fullscreen',
	    'insertdatetime media table contextmenu paste code'
	  ],
	  toolbar: 'undo redo | insert | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link jbimages',
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

		var data = $('#forms-cadastro').serialize();

        $.ajax({
            url: '<?php echo $root_html?>sistema2/maratona-do-conhecimento/cadastrar/cadastrar.php',
            type: 'POST',
            data: data,
            complete: function() {
                //setTimeout(function(){ location.href = '../';}, 500);
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

    $('#imagem_upload').click(function () {

        var form = $('#forms-cadastro')[0]; // You need to use standart javascript object here
        var data = new FormData(form);

        data.append('tax_file', $('input[type=file]')[0].files[0]);

        $.ajax({
            url: '<?php echo $root_html;?>sistema2/maratona-do-conhecimento/cadastrar/upload_image.php',
            type: 'POST',
            data: data,
            contentType: false,
            processData: false,
            success: function (data) {
                $('.alerta').show();
                $('.alerta_conteudo').html(data);

                setTimeout(function(){ $('.alerta').fadeOut(500).removeClass('alert-success alert-danger', 500);}, 4000);
            },
            error: function (e) {
                $('.alerta').show().addClass('alert-danger');
                $('.alerta_conteudo').html("<span class='glyphicon glyphicon-remove'></span>&ensp;Nenhum resultado encontrado");

                setTimeout(function(){ $('.alerta').fadeOut(500).removeClass('alert-danger', 500);}, 4000);
            }
        });
    });

</script>

</body>
</html>