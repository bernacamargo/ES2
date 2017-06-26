<?php

include '../../../web/seguranca.php';

$_POST['busca'] = htmlentities($_POST['busca']);

$query = "SELECT * FROM equipe WHERE nome LIKE '%". htmlentities($_POST['busca'])."%' ORDER BY nome";

$result = mysql_query($query);

if (mysql_num_rows($result) != 0){
    while ($equipe = mysql_fetch_assoc($result)) {
             echo '<div class="buscaContainer equipeContainer">

                <div align="center" class="equipeFoto col-md-2">
                    <img src="'.$root_html.'img/equipe/'.$equipe['foto'].'" height="100px"/>
                </div>

                <div align="left" class="equipeSobre col-md-4"><br>
                    <p><b>'.$equipe['nome'].'</b></p>
                    <p>'.$equipe['cargo'].'</p>
                </div>

                <div class="equipeMenu col-md-2 pull-right" style="margin-right: 30px;">
                    <a href="ver/'.$equipe['id'].'" class="btn btn-success btn-block"><span class="pull-left glyphicon glyphicon-eye-open"></span> Ver
                    </a> 
                    <a href="editar/'.$equipe['id'].'" class="btn btn-warning btn-block"><span class="pull-left glyphicon glyphicon-pencil"></span> Editar
                    </a> 
                    
                    '; 
                    if($equipe['ativo'] == 1): 
                        echo '<button id="'.$equipe['id'].'" class="desativar btn btn-danger btn-block"><span class="pull-left glyphicon glyphicon-remove"></span>&ensp;Desativar</button>';
                    else:
                        echo '<button id="'.$equipe['id'].'" class="desativar btn btn-danger btn-block"><span class="pull-left glyphicon glyphicon-remove"></span>&ensp;Ativar</button>';
                    endif;
                    echo '<form class="formsHidden'.$equipe['id'].'">
                        <input type="hidden" value="'.$equipe['id'].'" name="id" />
                        <input id="input'.$equipe['id'].'" type="hidden" value="'.$equipe['ativo'].'" name="ativo" />
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
                    url: '<?php echo $root_html?>sistema2/equipe/buscar/desativar.php',
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