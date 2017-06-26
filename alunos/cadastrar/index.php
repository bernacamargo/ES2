<?php include '../../../web/seguranca.php';
$query_qs = "SELECT * FROM questionariose ORDER BY pergunta_num";
$result_qs = mysql_query($query_qs);

include '../../head.php';
?>
<body class="hold-transition skin-green sidebar-mini fixed">

	<div class="wrapper">

	<?php include '../../menu.php'; ?>
		<div class="content-wrapper">
        	<div class="container-fluid" style="width: 80%">
				
				<form method="POST" action="cadastrar.php" class="alunoCadastro">

					<h1 align="center"><i style="font-size: 4em; color: #00a65a;" class="fa fa-user fa-fw"></i></h1>

					<div class="form-group">
						<label for="nome">Nome</label>
						<input type="text" id="nome" name="nome_cadastrar" class="form-control">
					</div>
					
					<div class="form-group">
						<label for="email">E-mail</label>
						<input type="email" id="email" name="email" class="form-control">
					</div>
					
					<div class="form-group">
						<label for="senha">Senha</label>
						<input type="password" id="senha" name="senha" class="form-control">
					</div>
					
					<div class="form-group">
						<label for="rg">RG</label>
						<input type="text" id="rg" name="rg" class="form-control">
					</div>
					
					<div class="form-group">
						<label for="ra">RA</label>
						<input type="text" id="ra" name="ra" class="form-control">
					</div>
					
					<div class="form-group">
						<label for="endereco">Endereço</label>
						<input type="text" id="endereco" name="end" class="form-control">
					</div>
					
					<div class="form-group">
						<label for="telefone">Telefone</label>
						<input type="text" id="telefone" name="tel" class="form-control">
					</div>

					<div class="form-group">
						<label for="celular">Celular</label>
						<input type="text" id="celular" name="cel" class="form-control">
					</div>
					
					<div class="form-group">
						<label for="facebook">Perfil do Facebook</label>
						<input type="text" id="facebook" name="face" class="form-control">
					</div>
					<div class="form-group">
						<label for="sexo">Sexo</label>
						<select id="sexo" name="sexo" class="form-control">
							<option value="1">Masculino</option>
							<option value="2">Feminino</option>
						</select>
					</div>

					<div class="form-group">
						<label for="etnia">Etnia</label>
						<select id="etnia" name="etnia" class="form-control">
							<option>--</option>
							<option value="1">Branco(a)</option>
							<option value="2">Pardo(a)</option>
							<option value="3">Negro(a)</option>
							<option value="4">Amarelo(a)</option>
							<option value="5">Indígena</option>
						</select>
					</div>

					<div class="form-group">
						<label for="nome_pai">Nome do Pai</label>
						<input type="text" id="nome_pai" name="pai" class="form-control">
					</div>

					<div class="form-group">
						<label for="nome_mae">Nome da Mãe</label>
						<input type="text" id="nome_mae" name="mae" class="form-control">
					</div>

					<div class="form-group">
						<label for="nasc">Data de Nascimento</label>
						<input type="date" id="nasc" name="data" class="form-control">
					</div>

					<div class="form-group">
						<label for="camiseta">Tamanho da Camiseta</label>
						<input type="text" id="camiseta" name="camiseta" class="form-control">
					</div>

                    <?php if($_SESSION['h'] == 3): 

                    $id = $_SESSION['usuarioID'];
                    $query = "SELECT * FROM supervisores WHERE id_usuario = '$id' LIMIT 1";
                    $res = mysql_query($query);
                    $supervisor = mysql_fetch_assoc($res);

					$query_escola = "SELECT id_escola, nome_escola FROM escola WHERE cidade LIKE '".$supervisor['cidade']."'";
					$result = mysql_query($query_escola);

                    ?> 

					<div class="form-group">
                   		<label for="buscaCidade">Cidade</label>
                        <select name="cidade" id="buscaCidade" class="form-control">
                            <option value="<?php echo $result['cidade'];?>"><?php echo $supervisor['cidade'];?></option>
                        </select>

					</div>
					
					<div class="form-group">
						<label for="escola">Escola</label>
						<select name="escola1" id="escola" class="form-control">
					<?php 
				    while ($escola1 = mysql_fetch_assoc($result)) {
				            echo '<option value="'.$escola1['id_escola'].'">'.$escola1['nome_escola'].'</option>';
				        }
					 ?>
					 	</select>
					</div>

                    <?php else: 

                    $escola = mysql_query("SELECT DISTINCT cidade FROM escola");

                    ?>
					
					<div class="form-group">
						<label for="cidade">Cidade</label>
                        <select class="form-control" name="cidade" id="cidade">
                            <option value="" hidden>Escolha uma cidade</option>
                            <option value="todas">Todas</option>
                            <?php
                            while ($e = mysql_fetch_array($escola)) {
                                echo '<option value="' . $e['cidade'] . '">' . $e['cidade'] . '</option>';
                            }
                            ?>
                        </select>

					</div>

					<div class="form-group">
						<label for="escola">Escola</label>
						<select name="escola1" id="escola" class="form-control">
							<option value="">--</option>
						</select>
					</div>


                    <?php endif; ?>


					<div class="form-group">
						<label for="serie">Série</label>
						<input type="text" id="serie" name="serie" class="form-control">
					</div>	


					<h1>Formulário Socio-Econômico</h1>	
					<br><br>

	                <?php 
                while ($questao = mysql_fetch_assoc($result_qs)){
                    echo '<div style="text-align: left; width: 100%">';
                    echo '<label>'.$questao['pergunta_num'].') '.$questao['pergunta_texto'].'</label><br><br>';
                    switch ($questao['tipo']){
                    case 1:
                        echo '<select class="form-control" name="r'.$questao['pergunta_num'].'">';
                        for ($i=1;$i<=$questao['questoes'];$i++){
                            echo '<option value="'.$i.'">'.$questao['r'.$i].'</option>';
                        }
                        echo '</select>';
                        break;
                    case 2:
                        echo '<input type="checkbox" onclick="CheckAll() id="selecionar_tudo"> <label for="selecionar_tudo" style="cursor: pointer;"> Selecionar Tudo</label><br>';
                        for ($i=1;$i<=$questao['questoes'];$i++){
     
                                echo '<input type="checkbox" name="r'.$questao['pergunta_num'].'[]" value="'.$i.'">'.$questao['r'.$i];
                                if ($i!=$questao['questoes'])
                                    echo '<br>';
                        }
                        break;
                    case 3:
                        echo '<input class="upper" type="text" name="r'.$questao['pergunta_num'].'">';
                        break;
  
                    
                    }
                    echo '<br><br></div>';
                }
                ?>


					<div class="text-center">
						<input type="submit" class="btn btn-primary btn-lg">	
						<input type="reset" class="btn btn-default pull-right">		
					</div>
				</form>

        	</div>
        </div>

	</div>

	<?php include '../../footer.php'; ?>
<script type="text/javascript">

            $('#cidade').change(function () {


                var values = {
                    'cidade': $('#cidade').val()
                };
                $.ajax({
                    url: '<?php echo $root_html ?>sistema1/aluno/cadastrar/busca_escola.php',
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

</body>
</html>