<?php include '../../../web/seguranca.php'; 

if (isset($_GET['p']) && isset($_GET['r'])){
    $p = $_GET['p'];
    $r = $_GET['r'];
}
include '../../head.php';
?>
<body class="hold-transition skin-red sidebar-mini fixed">

    <div class="wrapper">

    <?php include '../../menu.php'; ?>

        <div class="content-wrapper">

        	<div class="container-fluid" style="width: 80%">

                <?php if (!isset($_GET['p']) && !isset($_GET['r'])):
                ?>
				
				<form method="POST" action="busca.php" class="alunoCadastro formsEquipe">

					<h1 align="center"><i style="font-size: 4em; line-height: 1.3em; color: #dd4b39;" class="fa fa-id-badge fa-fw"></i></h1>

					<div class="form-group">
                        <br>
						<input type="text" id="busca" name="busca" class="form-control input-lg" placeholder="Procure por nome">
					</div>
				</form>

                <div align="center" id="resultado" class="container">
                </div>                

                <?php elseif($p == 'editar'): 
                    $query = "SELECT * FROM equipe WHERE id = '$r'";

                    $result = mysql_query($query);
                    $pessoa = mysql_fetch_assoc($result);
                ?>

                <h1 align="center">Editar cadastro</h1>

                <form enctype="multipart/form-data" method="POST" class="equipeEditar formsEquipe">


                    <input type="hidden" name="id" value="<?php echo $pessoa['id']?>">                    
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" id="nome" name="nome" class="form-control" value="<?php echo $pessoa['nome']?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="cargo">Cargo</label>
                        <input type="text" id="cargo" name="cargo" class="form-control" value="<?php echo $pessoa['cargo']?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="cargo_geral">Cargo Generalizado</label>
                        <select name="cargo_geral" class="form-control">
                            <option value="" hidden></option>
                            <option value="diretoria" <?php if($pessoa['cargo_geral'] == 'diretoria') echo 'selected';?>>Diretoria</option>
                            <option value="assistente" <?php if($pessoa['cargo_geral'] == 'assistente') echo 'selected';?>>Assistente</option>
                            <option value="supervisor" <?php if($pessoa['cargo_geral'] == 'supervisor') echo 'selected';?>>Supervisor Educacional</option>
                            <option value="coordernador_local" <?php if($pessoa['cargo_geral'] == 'coordernador_local') echo 'selected';?>>Coordenador Local</option>
                            <option value="membro_honorario" <?php if($pessoa['cargo_geral'] == 'membro_honorario') echo 'selected';?>>Membro Honorário</option>
                            <option value="membro_benemerito" <?php if($pessoa['cargo_geral'] == 'membro_benemerito') echo 'selected';?>>Membro Benemérito</option>
                            <option value="comite_cientifico" <?php if($pessoa['cargo_geral'] == 'comite_cientifico') echo 'selected';?>>Comitê Científico</option>
                            <option value="embaixador_senior" <?php if($pessoa['cargo_geral'] == 'embaixador_senior') echo 'selected';?>>Embaixador Sênior</option>
                            <option value="embaixador_jr" <?php if($pessoa['cargo_geral'] == 'embaixador_jr') echo 'selected';?>>Embaixador Júnior</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <textarea id="descricao" class="form-control" rows="5" name="descricao"><?php echo $pessoa['descricao']?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email" class="form-control" value="<?php echo $pessoa['email']?>">
                    </div>
                                    
                    <div class="form-group">
                        <label for="telefone">Telefone</label>
                        <input type="text" id="telefone" name="tel" class="form-control" maxlength="10" value="<?php echo $pessoa['telefone']?>">
                    </div>

                    <div class="form-group">
                        <label for="celular">Celular</label>
                        <input type="text" id="celular" name="cel" class="form-control" maxlength="11" value="<?php echo $pessoa['celular']?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="facebook">Perfil do Facebook</label>
                        <input type="text" id="facebook" name="face" class="form-control" value="<?php echo $pessoa['face']?>">
                    </div>

                    <div class="form-group">
                        <label for="sexo">Sexo</label>
                        <select id="sexo" name="sexo" class="form-control">
                            <option value="1">Masculino</option>
                            <option value="2">Feminino</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nasc">Data de Nascimento</label>
                        <input type="text" id="nasc" name="data" class="form-control" maxlength="10" value="<?php echo $pessoa['data_nasc']?>">
                    </div>

                    <div class="form-group">
                        <label for="curriculum">Currículo Lattes</label>
                        <input type="text" id="curriculum" name="curriculum" class="form-control" value="<?php echo $pessoa['link_curriculo']?>">
                    </div>

                   <!-- <div class="form-group">
                      <label for="arquivoFoto">Alterar Foto</label>
                      <input name="arquivoFoto" type="file" id="arquivoFoto">
                      <p class="help-block">Tamanho máximo: 300 kbps</p>
                    </div> -->

                    <div class="text-center">
                        <button id="enviarForm" type="button" class="btn btn-primary btn-lg">Salvar</button>   

                    </div>
                </form>

                <div id="resultado1" class="alerta">

                </div>

                <?php elseif($p == 'ver'): 
                    $query = "SELECT * FROM equipe WHERE id = '$r'";

                    $result = mysql_query($query);
                    $pessoa = mysql_fetch_assoc($result);
                ?>

                <div class="container-fluid">

                    <div align="left" class="equipeFotoila">
                        <img src="<?php echo $root_html?>img/equipe/<?php echo $pessoa['foto']?>" height="100%">
                    </div>

                    <div class="equipeStatus">
                        <?php if($pessoa['ativo'] == 1):?>
                            <button class=" btn btn-lg btn-success"><span class="glyphicon glyphicon-ok
"></span> Ativo</button>
                        <?php else: ?>
                            <button class=" btn btn-lg btn-danger"><span class="glyphicon glyphicon-remove
"></span> Inativo</button>
                        <?php endif; ?>
                    </div> 

                    <div class="equipeTexto">
                        <p><strong>Nome: </strong><?php echo $pessoa['nome']?></p>
                        <p><strong>Cargo: </strong><?php echo $pessoa['cargo']?></p>
                        <p><strong>E-mail: </strong><?php echo $pessoa['email']?></p>
                        <p><strong>Celular: </strong><?php echo $pessoa['celular']?></p>
                        <p><strong>Telefone: </strong><?php echo $pessoa['telefone']?></p>
                        <p><strong>Data de nascimento: </strong><?php echo $pessoa['data_nasc']?></p>
                        <p><strong>Data de cadastro: </strong><?php echo $pessoa['data_cadastro']?></p>
                        <p><strong>Currículo Lattes: </strong><?php echo $pessoa['link_curriculo']?></p>
                        <p><strong>Facebook: </strong><?php echo $pessoa['face']?></p>
                        <p><strong>Descrição: </strong><br><?php echo $pessoa['descricao']?></p>


                    </div>

                </div>



                <?php endif; ?>

        	</div>
        </div>

	</div>

	<?php include '../../footer.php'; ?>
<script type="text/javascript">
$(document).ajaxStart(function() { Pace.restart(); });
            
            $('#busca').keyup(function () {
                
                var data = $(".alunoCadastro").serialize();
                $.ajax({
                    url: '<?php echo $root_html ?>sistema2/equipe/buscar/busca.php',
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