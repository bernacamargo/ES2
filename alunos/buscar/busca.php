<?php

include '../../../web/seguranca.php';

$_POST['nome'] = htmlentities($_POST['nome']);

$query = "SELECT * FROM usuario AS u, escola AS e WHERE u.id_escola = e.id_escola ";
if ($_POST['nome'] != '')
    $query .= "AND u.nome LIKE '". $_POST['nome']."%' ";

if (isset($_POST['cidade']) && $_POST['cidade'] != 'todas' && $_POST['cidade'] != '')
    $query .= "AND e.cidade LIKE '". htmlentities($_POST['cidade'])."' ";

if (isset($_POST['escola']) && $_POST['escola'] != 'todas' && $_POST['escola'] != '')
    $query .= "AND u.id_escola LIKE '". $_POST['escola']."' ";

if (isset($_POST['status']) && ($_POST['status'] != 'ativo'))
    $query .="AND   u.h LIKE 0 ";
else 
    $query .="AND   (u.h LIKE 1 OR u.h LIKE 4) ";

$query .= "ORDER BY u.nome ";

if($_POST['qtdBusca'] != 'all')
    $query .= "LIMIT ". $_POST['qtdBusca']."";

 // echo '<script>alert("'.$query.'")</script>';

$result = mysql_query($query);


if (mysql_num_rows($result) != 0){
    while ($aluno = mysql_fetch_assoc($result)) {
            if($aluno['h'] == 0)
                $ativado = 0;
            elseif ($aluno['h'] == 1 || $aluno['h'] == 4)
                $ativado = 1;

            echo '<div class="alunoContainer">

                <div align="left" class="alunoNome pull-left col-md-8">
                    
                    <p class="'; if(!$ativado) echo 'text-danger'; else echo 'text-success'; echo '" style="font-size: 1.3em;';echo '">'; if($aluno['h'] == 4){
                        echo '<i class="fa fa-address-card" aria-hidden="true"></i> ';
                    } echo '<b>'.$aluno['nome'].'</b></p>';

                    echo '<p style="font-size: 1.1em;">• '.$aluno['cidade'].' <br> • '.$aluno['nome_escola'].' <br>
                    • '.$aluno['serie'].'</p>
                </div>

                <div class="col-md-2 pull-left">
                    <a href="notas/'.$aluno['id_usuario'].'" class="btn btn-primary btn-block"><span class="pull-left glyphicon glyphicon-eye-open"></span>&ensp;Boletim</a>
                </div>

                <div class="alunoMenu pull-right col-md-2">
                    <a href="ver/'.$aluno['id_usuario'].'" class="btn btn-success btn-block"><span class="pull-left glyphicon glyphicon-eye-open"></span> Ver
                    </a> 
                    <a href="editar/'.$aluno['id_usuario'].'" class="btn btn-warning btn-block"><span class="pull-left glyphicon glyphicon-pencil"></span> Editar
                    </a>';
                    if($aluno['h'] != 0): 
                        echo '<button id="'.$aluno['id_usuario'].'" class="desativar btn btn-danger btn-block"><span class="pull-left glyphicon glyphicon-remove"></span> Desativar</button>';
                    else:
                        echo '<button id="'.$aluno['id_usuario'].'" class="desativar btn btn-danger btn-block"><span class="pull-left glyphicon glyphicon-remove"></span> Ativar</button>';
                    endif;
                    echo '<form class="formsHidden'.$aluno['id_usuario'].'">
                        <input type="hidden" value="'.$aluno['id_usuario'].'" name="id" />
                        <input id="input'.$aluno['id_usuario'].'" type="hidden" value="'.$aluno['h'].'" name="ativo" />
                    </form>';



                echo '</div>

            </div>';

        }
} else {

        echo "<br><br><div class='alert alert-danger'> <span class='glyphicon glyphicon-exclamation-sign'></span> Nenhum resultado encontrado</div>";
}
?>

<script type="text/javascript">
            $('.desativar').click(function () {
                var $id = $(this).attr('id');
                var $ativo = $('#input'+$id).val();

                var data = $('.formsHidden'+ $id).serialize();

                $.ajax({
                    url: '<?php echo $root_html?>sistema2/alunos/buscar/desativar.php',
                    type: 'POST',
                    data: data,
                    beforeSend: function (e) {
                        if($ativo == 1)
                            $("#"+$id).html("Desativando...");
                        else
                            $("#"+$id).html("Ativando...");                        
                    },
                    success: function (data) {
                    setTimeout(function() {$('#'+$id).html(data);}, 500);
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


