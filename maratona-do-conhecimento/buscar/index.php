<?php include '../../../web/seguranca.php'; 

protegePaginaUnica(3, 901);

if (isset($_GET['p']) && isset($_GET['r'])){
    $p = $_GET['p'];
    $r = $_GET['r'];
}
include '../../head.php';
?>
<body class="hold-transition skin-green sidebar-mini fixed">

    <div class="wrapper">

    <?php include '../../menu.php'; ?>

        <div class="content-wrapper">

            <div class="container-fluid" style="width: 100%">

                <?php if (!isset($_GET['p']) && !isset($_GET['r'])):
                ?>
                
                <form class="alunoCadastro formsEquipe">

                    <h1 align="center">
                        <i style="font-size: 4em; line-height: 1.3em; color: #00a65a;" class="glyphicon glyphicon-bookmark"></i>
                    </h1>
                    <br>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <select name="nivel" id="busca-nivel" class="input-lg form-control">
                                <option value="" hidden>Selecione um nível</option>
                                <option value="1">6º Ano</option>
                                <option value="2">7º Ano</option>
                                <option value="3">8º Ano</option>
                                <option value="4">9º Ano</option>
                                <option value="5">Ensino Médio</option>
                            </select>
                        </div>

                        <div class="col-md-4 form-group">
                            <input type="text" id="busca-numero" name="numero" class="form-control input-lg" placeholder="Número da questão">
                        </div>

                        <div class="col-md-4 form-group">
                            <select name="genero" id="busca-genero" class="form-control input-lg">
                                <option value="" hidden>Selecione um gênero</option>
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
                        
                    </div>
                </form>
                <?php 
                    $query = "SELECT * FROM maratona_questoes ORDER BY nivel, numero";
                    $res = mysql_query($query);
                 ?>
                <div align="center" id="resultado" class="container">
                   <?php 
                   if(mysql_num_rows($res) != 0){
                    $i = 0;
                    echo '<div class="row">';
                    while($row = mysql_fetch_assoc($res)):

                        if($row['rc'] == 1)
                            $rc = 'A';
                        elseif($row['rc'] == 2)
                            $rc = 'B';
                        elseif($row['rc'] == 3)
                            $rc = 'C';
                        elseif($row['rc'] == 4)
                            $rc = 'D';
                        elseif($row['rc'] == 5)
                            $rc = 'E';
                    ?>
                        
                          <div class="box box-solid collapsed-box col-md-2 float-left">
                            <div class="box-header with-border">
                              <h3 class="box-title text-left" style="width: 100%;">
                                QUESTÃO <b><?php echo $row['numero'] ?></b>
                                <span class="pull-right" style="margin-right: 30px;"><?php echo $row['genero'] ?></span>
                              </h3>

                              <div class="box-tools">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                </button>
                              </div>
                            </div>
                            <div class="box-body no-padding">
                                <div class="text-left">
                                    <p><?php echo $row['pergunta'] ?></p>
                                    <p class="text-success">Resposta certa: <span class="text-bold"><?php echo $rc ?></span></p>
                                    <p>
                                        Perguntas:  <br>
                                        A)<?php echo $row['r1'] ?>
                                        <br>
                                        B)<?php echo $row['r2'] ?>
                                        <br>
                                        C)<?php echo $row['r3'] ?>
                                        <br>
                                        D)<?php echo $row['r4'] ?>
                                        <br>
                                        E)<?php echo $row['r5'] ?>
                                    </p>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <div class="row">
                                    <div class="col-md-2 pull-right">
                                        <a href="#" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Excluir</a>
                                    </div>
                                    <div class="col-md-2 pull-right">
                                        <a href="editar/<?php echo $row['nivel'] ?>/<?php echo $row['numero']?>" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span> Editar</a>
                                    </div>
                                </div>
                            </div>
                          </div>
                          <!-- /.box -->

                        
                    <?php $i++;     endwhile;

                    echo '</div>';
                }
                else {
                    echo '<div class="alert alert-danger text-center">Nenhum resultado encontrado!</div>';
                }



                    ?>
                </div>                

                <?php elseif($p == 'editar'):
                    $t = $_GET['t'];

                    $query = "SELECT * FROM maratona_questoes WHERE nivel = '$r' AND numero = '$t'";

                    $result = mysql_query($query);
                    $row = mysql_fetch_assoc($result);
                ?>

                <form id="forms-cadastro" enctype="multipart/form-data" method="POST" action="cadastrar.php" class="alunoCadastro">
                    <h1 align="center"><i style="font-size: 4em; line-height: 1.3em; color: #00a65a;" class="glyphicon glyphicon-bookmark"></i></h1>

                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label for="nivel">Nível</label>
                            <select name="nivel" id="nivel" class="form-control" readonly >
                                <option value="" hidden></option>
                                <option value="1" <?php if($row['nivel'] == 1) echo 'selected'; else echo 'hidden' ?>>6º Ano</option>
                                <option value="2" <?php if($row['nivel'] == 2) echo 'selected'; else echo 'hidden' ?>>7º Ano</option>
                                <option value="3" <?php if($row['nivel'] == 3) echo 'selected'; else echo 'hidden' ?>>8º Ano</option>
                                <option value="4" <?php if($row['nivel'] == 4) echo 'selected'; else echo 'hidden' ?>>9º Ano</option>
                                <option value="5" <?php if($row['nivel'] == 5) echo 'selected'; else echo 'hidden' ?>>Ensino Médio</option>
                            </select>
                        </div>

                        <div class="col-md-3 form-group">
                            <label for="numero">Número da questão</label>
                            <input id="numero" name="numero" type="text" class="form-control" value="<?php echo $row['numero'] ?>" readonly >
                        </div>

                        <div class="col-md-3 form-group">
                            <label for="genero">Genero</label>
                            <select name="genero" id="genero" class="form-control">
                                <option value="portugues" <?php if($row['genero'] == 'portugues') echo 'selected' ?>>Português</option>
                                <option value="matematica" <?php if($row['genero'] == 'matematica') echo 'selected' ?>>Matemática</option>
                                <option value="historia" <?php if($row['genero'] == 'historia') echo 'selected' ?>>História</option>
                                <option value="geografia" <?php if($row['genero'] == 'geografia') echo 'selected' ?>>Geografia</option>
                                <option value="ciencias" <?php if($row['genero'] == 'ciencias') echo 'selected' ?>>Ciências</option>
                                <option value="ingles" <?php if($row['genero'] == 'ingles') echo 'selected' ?>>Inglês</option>
                                <option value="atualidades" <?php if($row['genero'] == 'atualidades') echo 'selected' ?>>Atualidades</option>
                                <option value="biologia" <?php if($row['genero'] == 'biologia') echo 'selected' ?>>Biologia</option>
                                <option value="quimica" <?php if($row['genero'] == 'quimica') echo 'selected' ?>>Química</option>
                                <option value="fisica" <?php if($row['genero'] == 'fisica') echo 'selected' ?>>Física</option>
                            </select>
                        </div>

                        <div class="col-md-3 form-group">
                            <label for="gabarito">Resposta certa</label>
                            <select name="gabarito" id="gabarito" class="form-control">
                                <option value="" hidden></option>
                                <option value="1" <?php if($row['rc'] == 1) echo 'selected' ?>>A</option>
                                <option value="2" <?php if($row['rc'] == 2) echo 'selected' ?>>B</option>
                                <option value="3" <?php if($row['rc'] == 3) echo 'selected' ?>>C</option>
                                <option value="4" <?php if($row['rc'] == 4) echo 'selected' ?>>D</option>
                                <option value="5" <?php if($row['rc'] == 5) echo 'selected' ?>>E</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="questao">Questão</label>
                        <textarea name="questao" id="questao" cols="30" rows="10" class="form-control"><?php echo $row['pergunta'] ?></textarea>
                    </div>
                    
                    <h5 class="text-bold">Respostas:</h5>


                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1">A)</span>
                      <input type="text" class="form-control" name="r1" value="<?php echo $row['r1'] ?>">
                    </div>
<br>
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1">B)</span>
                      <input type="text" class="form-control" name="r2" value="<?php echo $row['r2'] ?>">
                    </div>
<br>
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1">C)</span>
                      <input type="text" class="form-control" name="r3" value="<?php echo $row['r3'] ?>">
                    </div>
<br>
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1">D)</span>
                      <input type="text" class="form-control" name="r4" value="<?php echo $row['r4'] ?>">
                    </div>
<br>
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1">E)</span>
                      <input type="text" class="form-control" name="r5" value="<?php echo $row['r5'] ?>">
                    </div>

                    <br>
                    <div class="text-center">
                        <button id="enviarForm" type="button" value="Cadastrar" class="btn btn-primary btn-lg">
                            Salvar
                        </button>   
                        <input type="reset" class="btn btn-default pull-right">     
                    </div>
                </form>

                <?php endif; ?>

            </div>
        </div>

    </div>

    <?php include '../../footer.php'; ?>
<script type="text/javascript">
            
            $('#busca-numero').keyup(function () {
                
                var data = $(".alunoCadastro").serialize();
                $.ajax({
                    url: '<?php echo $root_html ?>sistema2/maratona-do-conhecimento/buscar/buscar.php',
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
            
            $('#busca-nivel, #busca-genero').change(function () {
                
                var data = $(".alunoCadastro").serialize();
                $.ajax({
                    url: '<?php echo $root_html ?>sistema2/maratona-do-conhecimento/buscar/buscar.php',
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

                tinyMCE.triggerSave();

                var data = $("#forms-cadastro").serialize();

                $.ajax({
                    url: '<?php echo $root_html?>sistema2/maratona-do-conhecimento/buscar/editar.php',
                    type: 'POST',
                    data: data,
                    complete: function() {
                        
                    },
                    success: function (data) {
                        $('.alerta').show().addClass('alert-success');
                        $('#alerta_conteudo').html(data);

                        setTimeout(function(){ $('.alerta').fadeOut(500).removeClass('alert-success', 500);}, 4000);
                        // setTimeout(function(){ location.href = '../';}, 500);                        
                    },
                    error: function (e) {
                        $('.alerta').show().addClass('alert-danger');
                        $('#alerta_conteudo').html("<span class='glyphicon glyphicon-remove'></span>&ensp;Nenhum resultado encontrado");

                        setTimeout(function(){ $('.alerta').fadeOut(500).removeClass('alert-danger', 500);}, 4000);
                    }
                });

            });

            $('.desativar').click(function () {
                var $id = $(this).attr('id');
                var $ativo = $('#input'+$id).val();

                var data = $('.formsHidden'+ $id).serialize();

                $.ajax({
                    url: '<?php echo $root_html?>sistema2/guia-do-vestibulando/buscar/desativar.php',
                    type: 'POST',
                    data: data,
                    beforeSend: function (e) {
                        if($ativo == 1)
                            $("#"+$id).html("Desativando...");
                        else
                            $("#"+$id).html("Ativando...");                        
                    },
                    success: function (data) {
                    setTimeout(function() {$('#'+$id).html(data);}, 1000);
                    },
                    complete: function (e) {
                        if($ativo == 1)
                            $("#input"+$id).val(0);
                        else
                            $("#input"+$id).val(1);         
                    },
                    error: function (e) {
                        $('#resultado1').html("<option>Nenhum resultado encontrado.</option>");
                    },
                });

            });

            tinymce.init({
              selector: '#questao',
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





</script>

</body>
</html>