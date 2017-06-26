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

                    <h1 align="center"><i style="font-size: 4em; line-height: 1.3em; color: #dd4b39;" class="fa fa-graduation-cap fa-fw"></i></h1>

                    <div class="form-group">
                        <br>
                        <input type="text" id="busca" name="busca" class="form-control input-lg" placeholder="Procure pelo nome do vestibular...">
                    </div>
                </form>
                <?php 
                    $query = "SELECT * FROM guia_vestibulando ORDER BY id DESC";
                    $guia = mysql_query($query);
                 ?>
                <div align="center" id="resultado" class="container">
                    <?php 
                        if (mysql_num_rows($guia) != 0){
                        while ($vest = mysql_fetch_assoc($guia)) {

                            $vest['data-prova'] = html_entity_decode($vest['data-prova']);
                            $vest['link'] = html_entity_decode($vest['link']);

                                 echo '<div class="buscaContainer equipeContainer">

                                    <div align="left" class="equipeSobre col-md-8"><br>
                                        <h4><b>'.$vest['vestibular'].' - '.$vest['ano'].'</b></h4>
                                        <p><b>Data da Inscrição:</b> '.$vest['data-inscricao'].'</p>
                                        <p><b>Data da Prova:</b> '.$vest['data-prova'].'</p>
                                        <p><b>Valor:</b> '.$vest['valor'].'</p>
                                        <p style="color: '.$vest['cor-status'].'">';
                                        if($vest['status'] == 0)
                                            echo 'Inscrições Fechadas';
                                        else
                                            echo 'Inscrições Abertas';
                                        
                                        echo '</p>
                                    </div>

                                    <div class="equipeMenu col-md-2 pull-right" style=" margin-right: 30px;">
                                        <a href="ver/'.$vest['id'].'" class="hidden btn btn-success btn-block"><span class="pull-left glyphicon glyphicon-eye-open"></span> Ver
                                        </a> 
                                        <a href="editar/'.$vest['id'].'" class="btn btn-warning btn-block"><span class="pull-left glyphicon glyphicon-pencil"></span> Editar
                                        </a> 
                                        
                                        '; 
                                        if($vest['ativo'] == 1): 
                                            echo '<button id="'.$vest['id'].'" class="desativar btn btn-danger btn-block"><span class="pull-left glyphicon glyphicon-remove"></span>&ensp;Desativar</button>';
                                        else:
                                            echo '<button id="'.$vest['id'].'" class="desativar btn btn-danger btn-block"><span class="pull-left glyphicon glyphicon-remove"></span>&ensp;Ativar</button>';
                                        endif;
                                        echo '<form class="formsHidden'.$vest['id'].'">
                                            <input type="hidden" value="'.$vest['id'].'" name="id" />
                                            <input id="input'.$vest['id'].'" type="hidden" value="'.$vest['ativo'].'" name="ativo" />
                                        </form>
                                    </div>


                                 </div>';

                            }
                    } else {
                            echo '<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign"></span> Nenhum resultado encontrado</div>';
                    }
                     ?>
                </div>                

                <?php elseif($p == 'editar'): 
                    $query = "SELECT * FROM guia_vestibulando WHERE id = '$r'";

                    $result = mysql_query($query);
                    $vest = mysql_fetch_assoc($result);
                ?>

                <form enctype="multipart/form-data" method="POST" class="vestibularEditar formsEquipe">


                    <input type="hidden" name="id" value="<?php echo $vest['id']?>">                    
                    <h1 align="center"><i style="font-size: 4em; line-height: 1.3em; color: #dd4b39;" class="fa fa-graduation-cap fa-fw"></i></h1>

                    <div class="form-group">
                        <label for="vestibular">Nome do vestibular</label>
                        <input type="text" id="vestibular" class="form-control" name="vestibular" value="<?php echo $vest['vestibular'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="data-inscricao">Data da inscrição</label>
                        <input id="data-inscricao" type="text" class="form-control" name="data-inscricao" placeholder="dd/mm/aaaa até dd/mm/aaaa às hh:mm" value="<?php echo $vest['data-inscricao'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="data-prova">Data da prova</label>
                        <textarea name="data-prova" id="data-prova" cols="30" rows="10" class="form-control" placeholder="1ª fase: dd/mm/aaaa<br> 2ª fase: dd/mm/aaaa"><?php echo $vest['data-prova'] ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Links Úteis</label>
                        <textarea name="links" id="links" cols="30" rows="4" class="form-control"><?php echo $vest['link'] ?></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="valor">Preço</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        $
                                    </span>
                                    <input type="text" class="form-control" name="valor" id="valor" placeholder="100,00" value="<?php echo $vest['valor'] ?>">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="ano">Ano</label>
                                <input id="ano" name="ano" type="text" class="form-control" value="<?php echo $vest['ano'] ?>">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1" <?php if($vest['status'] == 1) echo 'selected'?>>Inscrições abertas</option>
                                    <option value="0" <?php if($vest['status'] == 0) echo 'selected'?>>Inscrições fechadas</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="text-center">
                        <button id="enviarForm" type="button" class="btn btn-primary btn-lg">Salvar</button>   

                    </div>
                </form>

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
            
            $('#busca').keyup(function () {
                
                var data = $(".alunoCadastro").serialize();
                $.ajax({
                    url: '<?php echo $root_html ?>sistema2/guia-do-vestibulando/buscar/busca.php',
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

                var data = $(".vestibularEditar").serialize();

                $.ajax({
                    url: '<?php echo $root_html?>sistema2/guia-do-vestibulando/buscar/editar.php',
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