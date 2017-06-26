<?php 
include '../../../web/seguranca.php';

$query = "SELECT * FROM guia_vestibulando WHERE vestibular LIKE '%".$_POST['busca']."%' ORDER BY id DESC";
$guia = mysql_query($query);

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
                    <p>'.$vest['status'].'</p>
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

 <script>
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

</script>