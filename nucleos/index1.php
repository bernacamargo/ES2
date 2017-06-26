<?php
$titulo = ' NDCs - Programa Futuro Cientista®';
$descricao = '';
$img = '';
$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

include '../../web/seguranca.php';

protegePagina(3);
?>


<?php
if (isset($_GET['p']) && isset($_GET['r'])):
    $p = $_GET['p'];
    $r = $_GET['r'];
    $query = "SELECT * FROM escola WHERE id_escola = '".$r."'";
    $result = mysql_query($query);
    $escola = mysql_fetch_assoc($result);
    ?>

    <?php if ($p == 'ver'): // VER   ?>

        <div id="corpo" style="font-size: 1.2em;">
            <br><br>
            <div style="width: 76%; position: relative; left: 10%; background: lightgray;; text-align: justify; padding: 2%;">

                 <span style="color: #ff6600">Nome:</span> <?php echo $escola['nome_escola']; ?><br>
                <span style="color: #ff6600"> E-mail do Responsável:</span> <?php echo $escola['email_responsavel']; ?><br>
                <span style="color: #ff6600">Telefone Fixo: </span><?php echo $escola['telefone_fixo']; ?><br>
                <span style="color: #ff6600"> Logradouro:</span> <?php echo $escola['logradouro']; ?><br>
                <span style="color: #ff6600"> Bairro: </span><?php echo $escola['bairro']; ?><br>
                <span style="color: #ff6600"> CEP: </span><?php echo $escola['cep']; ?><br>
                <span style="color: #ff6600"> Cidade: </span> <?php echo $escola['cidade']; ?><br>
                <span style="color: #ff6600">  Nome do Diretor: </span> <?php echo $escola['nome_diretor']?><br><br>
                <div style="text-align: center">
                    <button type="button" onclick="window.location.href = '<?php echo $root_html; ?>sistema/nucleos'"><i class="fa fa-arrow-circle-left fa-1x"></i> Voltar</button> | 
                    <button type="button" onclick="window.location.href = '<?php echo $root_html; ?>sistema/nucleos/editar/<?php echo $escola['id_escola'] ?>'"><i class="fa fa-pencil-square fa-1x"></i> Editar</button> | 
                    <button type="button" onclick="window.location.href = '<?php echo $root_html; ?>sistema/nucleos/excluir/<?php echo $escola['id_escola'] ?>'"><i class="fa fa-times-circle fa-1x"></i> Excluir</button>
                </div>
            </div>



        </div>




        <?php
    elseif ($p == 'editar'):

        $escola1 = mysql_query("SELECT DISTINCT cidade FROM escola");
// EDITAR  
        ?>

        <script>
            $(document).ready(function () {

                $('#salvar_botao').click(function () {


                    var data = $(".formulario").serialize();
                    $.ajax({
                        url: '<?php echo $root_html ?>sistema/nucleos/atualizar.php',
                        type: 'POST',
                        data: data,
                        success: function (data) {
                            $('#resultado_salvar').html(data);

                        },
                        error: function (e) {
                            $('#resultado_salvar').html("<span class='ajuda_user'>Nenhum resultado encontrado.</span>");

                        }
                    });


                });


                $('#escola1').click(function () {
                    var values = {
                        'cidade': $('#cidade1').val()
                    };
                    $.ajax({
                        url: '<?php echo $root_html ?>sistema/nucleos/busca_escola.php',
                        type: 'POST',
                        data: values,
                        success: function (data) {
                            $('#escola1').html(data);

                        },
                        error: function (e) {
                            $('#escola1').html("<option>Nenhum resultado encontrado.</option>");

                        }
                    });

                });

                $('#cidade1').change(function () {



                    var values = {
                        'cidade': $('#cidade1').val()
                    };
                    $.ajax({
                        url: '<?php echo $root_html ?>sistema/nucleos/busca_escola.php',
                        type: 'POST',
                        data: values,
                        success: function (data) {
                            $('#escola1').html(data);

                        },
                        error: function (e) {
                            $('#escola1').html("<option>Nenhum resultado encontrado.</option>");

                        }
                    });

                });

                $('#data_input').mask("99/99/9999");
            });
        </script>

        <div id="menu1">
            <div class="container" ><span style="display:inline-block; vertical-align:middle">
                    <span style="display:inline-block; vertical-align:middle"><i class="fa fa-user fa-1x"></i> NDCs - Editar </span>
            </div>
        </div>
        <div id="corpo"><br><br>
            <form class="formulario" id="cadastrar_form" enctype="multipart/form-data">
                <br>
               <input style="display: none" type="text" name="id_escola" placeholder="Nome" value="<?php echo $r ?>">             
                <label>Nome:</label><input type="text" name="nome_cadastrar" placeholder="Nome" value="<?php echo $escola['nome_escola'] ?>"><br><br>
                <label>E-mail do Responsável:</label><input type="text" name="email" placeholder="E-mail do Responsável" value="<?php echo $escola['email_responsavel'] ?>"><br><br>
                <label>Telefone Fixo:</label><input type="text" name="telefone_fixo" placeholder="Telefone Fixo"  value="<?php echo $escola['telefone_fixo'] ?>"><br><br>
                <label>Logradouro:</label><input type="text" name="logradouro" placeholder="Logradouro"  value="<?php echo $escola['logradouro'] ?>"><br><br>
                <label>Bairro:</label><input type="text" name="bairro" placeholder="Bairro"  value="<?php echo $escola['bairro'] ?>"><br><br>
                <label>CEP:</label><input type="text" name="cep" placeholder="CEP"  value="<?php echo $escola['cep'] ?>"><br><br>
                <label>Cidade::</label><input type="text" name="cidade" placeholder="Cidade"  value="<?php echo $escola['cidade'] ?>"><br><br>
                <label>Nome do Diretor:</label><input type="text" name="nome_diretor" placeholder="Nome do Diretor"  value="<?php echo $escola['nome_diretor'] ?>"><br><br>
                
                <button type="button" id="salvar_botao"><i class="fa fa-save fa-1x"></i> Salvar</button>
                <button type="button" onclick="history.go(-1);"><i class="fa fa-arrow-circle-left fa-1x"></i> Voltar</button>
                <br><br><div id="resultado_salvar"></div>
            </form><br><br>
        </div>
       



    <?php elseif ($p == 'excluir'): // EXCLUIR   ?>
        
         <script>
            $(document).ready(function () {

                $('#excluir_botao').click(function () {

                    var values = {
                        'escola': '<?php echo $r ?>'
                    };
                    $.ajax({
                        url: '<?php echo $root_html ?>sistema/nucleos/excluir.php',
                        type: 'POST',
                        data: values,
                        success: function (data) {
                            $('#resultado_excluir').html(data);

                        },
                        error: function (e) {
                            $('#resultado_excluir').html("<span class='ajuda_user'>Nenhum resultado encontrado.</span>");

                        }
                    });


                });
                });

</script>
        <div id="menu1">
            <div class="container" ><span style="display:inline-block; vertical-align:middle">
                    <span style="display:inline-block; vertical-align:middle"><i class="fa fa-building fa-1x"></i> Nucleos - Excluir </span>
            </div>
        </div>
        <div id="corpo">
            
            <div style="width: 76%; position: relative; left: 10%; background: lightgray;; text-align: justify; padding: 2%;">
                <div style="font-size: 1.5em; color: red; text-align: center; width: 100%">Tem certeza que deseja excluir esta escola?</div><br><br>
                <span style="color: #ff6600">Nome:</span> <?php echo $escola['nome_escola']; ?><br>
                <span style="color: #ff6600"> E-mail do Responsável:</span> <?php echo $escola['email_responsavel']; ?><br>
                <span style="color: #ff6600">Telefone Fixo: </span><?php echo $escola['telefone_fixo']; ?><br>
                <span style="color: #ff6600"> Logradouro:</span> <?php echo $escola['logradouro']; ?><br>
                <span style="color: #ff6600"> Bairro: </span><?php echo $escola['bairro']; ?><br>
                <span style="color: #ff6600"> CEP: </span><?php echo $escola['cep']; ?><br>
                <span style="color: #ff6600"> Cidade: </span> <?php echo $escola['cidade']; ?><br>
                <span style="color: #ff6600">  Nome do Diretor: </span> <?php echo $escola['nome_diretor']?><br><br>
                <div style="text-align: center">
                    <button type="button" onclick="window.location.href = '<?php echo $root_html; ?>sistema/nucleos'"><i class="fa fa-arrow-circle-left fa-1x"></i> Voltar</button> | 
                    
                    <button type="button" id="excluir_botao"><i class="fa fa-times-circle fa-1x"></i> Excluir</button>
                </div>
                <br><div id="resultado_excluir" style="width: 100%; text-align: center;"></div>
            </div>

        </div>




        <?php
    else:
        die("<script>location.href = '" . $root_html . "erro404'</script>");
    endif;


else: //NORMAL
    $query = "SELECT * FROM escola";
    $result = mysql_query($query);
    $escola = mysql_query("SELECT DISTINCT cidade FROM escola");
  
    ?>
    <script type="text/javascript">

        $(document).ready(function () {

            $('#nome').keyup(function () {

                $('#resultados').show();
                $('#cadastrar').hide();

                var data = $(".formulario").serialize();
                $.ajax({
                    url: '<?php echo $root_html ?>sistema/nucleos/busca.php',
                    type: 'POST',
                    data: data,
                    success: function (data) {
                        $('#resultados').html(data);

                    },
                    error: function (e) {
                        $('#resultados').html("<span class='ajuda_user'>Nenhum resultado encontrado.</span>");

                    }
                });


            });
            $('#cidade').change(function () {
                $('#resultados').show();
                $('#cadastrar').hide();


                var data = $(".formulario").serialize();
                $.ajax({
                    url: '<?php echo $root_html ?>sistema/nucleos/busca.php',
                    type: 'POST',
                    data: data,
                    success: function (data) {
                        $('#resultados').html(data);

                    },
                    error: function (e) {
                        $('#resultados').html("<span class='ajuda_user'>Nenhum resultado encontrado.</span>");

                    }
                });



            });


            $('#cadastrar_botao').click(function () {


                var data = $(".formulario").serialize();
                $.ajax({
                    url: '<?php echo $root_html ?>sistema/nucleos/cadastrar.php',
                    type: 'POST',
                    data: data,
                    success: function (data) {
                        $('#resultado_cadastro').html(data);

                    },
                    error: function (e) {
                        $('#resultado_cadastro').html("<span class='ajuda_user'>Nenhum resultado encontrado.</span>");

                    }
                });


            });

          







        });



    </script>


    <div id="menu1">
        <div class="container" ><span style="display:inline-block; vertical-align:middle">
                <span style="display:inline-block; vertical-align:middle"><i class="fa fa-building fa-1x"></i> NDCs - Principal </span>
        </div>
    </div>


    <div id="corpo">
        <form class="formulario" style="height: auto" enctype="multipart/form-data" action="busca.php" method="POST">

            <label for="titulo_input">Nome: </label>  <input style="width: 35%" id="nome" name="nome" type="text" autocomplete="off" /> | 
            <label for="titulo_input">Cidade: </label> <select style="width: 35%" id="cidade"  name="cidade">
                <option selected="true" value="null">Escolha uma cidade</option>
                <?php
                while ($e = mysql_fetch_array($escola)) {
                    echo '<option value="' . $e['cidade'] . '">' . $e['cidade'] . '</option>';
                }
                ?>
            </select>
        <br><br>
            <button type="button" onclick="$('#resultados').hide();
                        $('#cadastrar').show();"><i class="fa fa-plus fa-1x"></i> Cadastrar NDC</button> | 
            <button type="button" onclick="$('#resultados').show();
                        $('#cadastrar').hide();"><i class="fa fa-eye fa-1x"></i> Ver Nucleos</button> | 

            <button type="button" onclick="window.location.href = '<?php echo $root_html; ?>sistema'"><i class="fa fa-arrow-circle-left fa-1x"></i> Voltar</button>
        </form><br>
        <div id="resultados">
            <?php
            while ($escola = mysql_fetch_assoc($result)) {
                echo '<div class="resultado"><div class="resultado_titulo" >';
                echo $escola["nome_escola"];
                echo '<div style="float: right;"><small><small><button type="button" onclick="window.location.href = \'' . $root_html . 'sistema/nucleos/ver/' . $escola['id_escola'] . '\'"><i class="fa fa-plus fa-1x"></i> Ver Mais</button> | <button type="button" onclick="window.location.href = \'' . $root_html . 'sistema/nucleos/editar/' . $escola['id_escola'] . '\'"><i class="fa fa-pencil-square fa-1x"></i> Editar</button> | <button type="button" onclick="window.location.href = \'' . $root_html . 'sistema/nucleos/excluir/' . $escola['id_escola'] . '\'"><i class="fa fa-times-circle fa-1x"></i> Excluir</button></small></small></div>';
                echo ' </div>';
                echo '<div class="resultado_descricao" >';
                echo $escola["cidade"] . ' | ' . $escola['telefone_fixo'].' | ' . $escola['nome_diretor'];
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>




        <div id="cadastrar" style="display: none;">
            <form class="formulario" id="cadastrar_form" enctype="multipart/form-data">
                <br>Preencha todos os campos:<br><br>
                <input type="text" name="nome_cadastrar" placeholder="Nome Escola"><br><br>
                <input type="text" name="cidade1" placeholder="Cidade"><br><br>
                <input type="text" name="email" placeholder="E-mail do Responsável"><br><br>
                <input type="text" name="logradouro" placeholder="Logradouro"><br><br>
                <input type="text" name="bairro" placeholder="Bairro"><br><br>
                <input type="text" name="cep" placeholder="CEP"><br><br>
                <input type="text" name="tel" placeholder="Telefone Fixo"><br><br>
                 <input type="text" name="nome_diretor" placeholder="Nome do Diretor"><br><br>
                
                
                <button type="button" id="cadastrar_botao"><i class="fa fa-plus fa-1x"></i> Cadastrar</button>
                <button type="button" onclick="$('#resultados').show();
                            $('#cadastrar').hide();"><i class="fa fa-arrow-circle-left fa-1x"></i> Voltar</button><br><br>
                <div id="resultado_cadastro"></div>
            </form>

        </div>




    </div>
<?php endif; ?>
<?php
if (!$mobile) {
    include '../../web/footer.php';
} else {
    include '../menu_aluno_mobile.php';
}
?>