<?php include '../../web/seguranca.php';

protegePaginaUnica(3, 901);

include '../head.php';
    
//Query's
$id_destinatario = $_SESSION['usuarioID'];
$query_chat = "SELECT * FROM chat WHERE id_destinatario = '$id_destinatario' WHERE lido = 0";
$res_chat = mysql_query($query_chat);
$num_msg = mysql_num_rows($res_chat);
?>
<body id="corpo" class="hold-transition skin-blue sidebar-mini fixed">

    <div class="wrapper">

    <?php include '../menu.php'; ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Mensagens
        <?php if($num_msg > 1): ?>
        <small><?php echo $num_msg?> mensagens novas</small>
    <?php elseif($num_msg == 1): ?>
        <small><?php echo $num_msg?> mensagem nova</small>
    <?php elseif($num_msg == 0): ?>
        <small>Você não tem nenhuma mensagem nova</small>   
        <?php endif; ?> 
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Contatos</h3>

            <form class="forms-pesquisar-contatos" method="POST">
                <div class="input-group">
                    <input id="busca-contato" type="text" name="buscaNome" placeholder="Pesquisar contatos..." class="form-control">
                    <span class="input-group-addon">
                      <i class="fa fa-search"></i>
                    </span>
                </div>
            </form>


              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body">
                <ul class="nav menu-contatos no-padding">
                    <?php 
                        $id_destinatario = $_SESSION['usuarioID'];
                        $query_users = "SELECT DISTINCT * FROM usuario AS u, chat AS c WHERE u.id_usuario = c.id_remetente OR u.id_usuario = c.id_destinatario GROUP BY u.id_usuario ORDER BY c.data_hora DESC LIMIT 10";

                        $res_users = mysql_query($query_users);

                        while($user = mysql_fetch_assoc($res_users)):

                            if($user['id_usuario'] == $_SESSION['usuarioID']){
                                continue;
                            }

                            if($user['sexo'] == 1)
                                $url_img = $root_html.'img/equipe/default_masc.jpg';
                            elseif($user['sexo'] == 2)
                                $url_img = $root_html.'img/equipe/default_fem.jpg';

                            $nome = $user['nome'];
                            $nome_user = explode(" ", $nome);
                            $nome = $nome_user[0].' '.$nome_user[1];

                            $id_remetente = $user['id_usuario'];
                            $busca_nlidas = "SELECT * FROM chat WHERE lido = 0 AND id_remetente = '$id_remetente' AND id_destinatario='$id_destinatario'";
                            $num_nlidas = mysql_num_rows(mysql_query($busca_nlidas));
                     ?>
                        <li>
                            <a class="contato" data-id-remetente="<?php echo $id_remetente;?>" data-id-destinatario="<?php echo $_SESSION['usuarioID']?>">
                                <div class="pull-left contato-imagem">
                                    <img src="<?php echo $url_img?>" alt="" class=" img-circle">
                                </div>

                                <h5 class="contato-nome">
                                    <?php if($num_nlidas != 0): ?>
                                    <span class="label pull-right bg-blue label-msg-nlida">
                                        <?php echo $num_nlidas ?>
                                    </span>
                                <?php endif; ?>
                                    <span class="pull-left" style="text-overflow: ellipsis">&ensp;<?php echo $nome?></span>                                    
                                    <br>
                                    <?php if($user['online'] == 1):?>
                                    &ensp; <small>Online</small>
                                <?php else: ?>
                                    &ensp; <small>Offline</small>
                                <?php endif; ?>
                                </h5>
                            </a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Labels</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="#"><i class="fa fa-circle-o text-red"></i> Important</a></li>
                <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Promotions</a></li>
                <li><a href="#"><i class="fa fa-circle-o text-light-blue"></i> Social</a></li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Inbox</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <?php 

             ?>
            <div class="body-mensagem box-body no-padding">
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
    </div>
</body>
<?php include '../footer.php'; ?>

<script>

    $("#busca-contato").keyup(function(event) {

        var data = $(".forms-pesquisar-contatos").serialize();

        $.ajax({
            url: '<?php echo $root_html ?>sistema2/mensagens/contatos.php',
            type: 'POST',
            data: data,
            success: function(data){
                $('.menu-contatos').html(data);
            },
            fail: function() {

            }
        });

    });

    $(".contato").click(function(event) {

        var data = {
            'id-remetente': $(this).attr('data-id-remetente'),
            'id-destinatario': $(this).attr('data-id-destinatario')
        }

        $.ajax({

            url: '<?php echo $root_html?>sistema2/mensagens/busca_contato.php',
            type: 'POST',
            data: data,
        })
        .success(function(data) {
            $(".body-mensagem").html(data);
            $(".panel-body").scrollTop(99999999999);
        })
        .fail(function() {
            alert("DEU MERDA NO AJAX");
        });

        var data = {
            'id-remetente': $(this).attr('data-id-remetente'),
            'id-destinatario': $(this).attr('data-id-destinatario')
        }

        $.ajax({
            url: '<?php echo $root_html?>sistema2/mensagens/marca_como_lido.php',
            type: 'POST',
            data: data,
            success: function(){
                if(data != 0)
                    $('.label-msg-nlida').html(data);
                else
                    $('.label-msg-nlida').hide();
            }
        });

    });
</script>
