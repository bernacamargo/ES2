<?php include '../../../web/seguranca.php'; 
protegePaginaUnica(3, 901);
if (isset($_GET['p']) && isset($_GET['r'])){
    $p = $_GET['p'];
    $r = $_GET['r'];
    $query = "SELECT * FROM usuario AS u, escola AS e WHERE u.id_escola = e.id_escola AND (u.h = 0 OR u.h = 1 OR u.h = 4) AND u.id_usuario=" . $r . "";

    $result = mysql_query($query);
    $aluno = mysql_fetch_assoc($result);

    $escola1 = mysql_query("SELECT DISTINCT cidade FROM escola");
    $query_qs = "SELECT * FROM questionariose ORDER BY pergunta_num";
    $result_qs = mysql_query($query_qs);

}
include '../../head.php';
    
//Query's
$escola = mysql_query("SELECT DISTINCT cidade FROM escola");

?>
<body id="corpo" class="hold-transition skin-green sidebar-mini fixed">

    <div class="wrapper">

    <?php include '../../menu.php'; ?>
        <div class="content-wrapper">

        	<div class="container-fluid">

                <?php if (!isset($_GET['p']) && !isset($_GET['r'])):
                ?>
				
				<form method="POST" action="busca.php" class="alunoBusca alunoCadastro formsEquipe">

					<h1 align="center"><i style="font-size: 4em; color: #00a65a;" class="fa fa-user fa-fw"></i></h1>
<br>
					<div class="form-group col-md-12">
						<input type="text" id="buscaNome" name="nome" class="input-lg form-control" placeholder="Pesquise pelo nome do aluno">
					</div>

                    <!-- =======================================================
                    ============================================================
                    ======================== VISAO SUPERVISOR ==================
                    ============================================================
                    ======================================================== -->

                    <?php if($_SESSION['h'] == 3): 

                    $id = $_SESSION['usuarioID'];
                    $query = "SELECT * FROM supervisores WHERE id_usuario = '$id' LIMIT 1";
                    $res = mysql_query($query);
                    $supervisor = mysql_fetch_assoc($res);

                    $query_escola = "SELECT id_escola, nome_escola FROM escola WHERE cidade LIKE '".$supervisor['cidade']."'";
                    $result = mysql_query($query_escola);

                    ?> 
                    
                    <div class="form-group col-md-6">
                        <label for="buscaCidade">Cidade</label>
                        <select name="cidade" id="buscaCidade" class="form-control">
                            <option value="<?php echo $result['cidade'];?>" selected><?php echo $supervisor['cidade'];?></option>
                        </select>

                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="escola">Escola</label>
                        <select name="escola" id="buscaEscola" class="form-control">
                    <?php 
                    while ($escola1 = mysql_fetch_assoc($result)) {
                            echo '<option value="'.$escola1['id_escola'].'">'.$escola1['nome_escola'].'</option>';
                        }
                     ?>
                        </select>
                    </div>

                    <!-- =======================================================
                    ============================================================
                    ========================== VISAO ADMIN =====================
                    ============================================================
                    ======================================================== -->

                    <?php else: 

                    $escola = mysql_query("SELECT DISTINCT cidade FROM escola");

                    ?>
                    
                    <div class="form-group col-md-6">
                        <label for="cidade">Cidade</label>
                        <select class="form-control" name="cidade" id="buscaCidade">
                            <option value="" hidden>Escolha uma cidade</option>
                            <option value="todas">Todas</option>
                            <?php
                            while ($e = mysql_fetch_array($escola)) {
                                echo '<option value="' . $e['cidade'] . '">' . $e['cidade'] . '</option>';
                            }
                            ?>
                        </select>

                    </div>

                    <div class="form-group col-md-6">
                        <label for="escola">Escola</label>
                        <select name="escola" id="buscaEscola" class="form-control">
                            <option value="">--</option>
                        </select>
                    </div>


                    <?php endif; ?>


                    <div align="center" class="col-md-12">
                        <label for="ativo" class="radio-inline">
                            <input class="buscaStatus" type="radio" name="status" id="ativo" value="ativo" checked/> Ativos
                        </label>
                        <label for="inativo" class="radio-inline">                        
                            <input class="buscaStatus" type="radio" name="status" id="inativo" value="inativo" />Inativos
                        </label>
                    </div>

                    <div class="row">
                        <div class="container-fluid">
                            <div class="form-group col-md-3 pull-left">
                                <select class="form-control" name="qtdBusca" id="qtdBusca">
                                    <option value="50">50 resultados</option>
                                    <option value="100">100 resultados</option>
                                    <option value="200">200 resultados</option>
                                    <option value="all">Todos resultados</option>
                                </select>
                            </div>
                        </div>

                    </div>

				</form>
                <div align="center" class="row" style="margin: -30px auto; width: 80%;">
                    <div  id="resultado" class="container">
                    </div>           
                </div>   

                <!-- 
                ============================================
                ============================================
                ================== EDITAR ==================
                ============================================
                ============================================
                -->

                <?php elseif($p == 'editar'): 

                ?>

                <h1 align="center">Editar cadastro</h1>

                <form id="editarCadastro" method="POST" action="editar.php" class="alunoCadastro formsEquipe">

                    <input type="hidden" name="id_usuario" value="<?php echo $aluno['id_usuario']; ?>">

                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" id="nome" name="nome_cadastrar" class="form-control" value="<?php echo $aluno['nome']?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="h">Hierarquia <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" data-placement="top" title="Escolha entre Aluno ou Embaixador Jr."></span></label>
                        <select name="h" id="h" class="form-control">
                            <option value="" hidden></option>
                            <option value="1" <?php if($aluno['h'] == 1) echo 'selected'; ?>>1 - Aluno</option>
                            <option value="4" <?php if($aluno['h'] == 4) echo 'selected'; ?>>2 - Embaixador Jr.</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email" class="form-control" value="<?php echo $aluno['email']?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input type="password" id="senha" name="senha" class="form-control" value="<?php echo $aluno['senha']?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="rg">RG</label>
                        <input type="text" id="rg" name="rg" class="form-control" value="<?php echo $aluno['rg']?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="ra">RA</label>
                        <input type="text" id="ra" name="ra" class="form-control" value="<?php echo $aluno['ra']?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="endereco">Endereço</label>
                        <input type="text" id="endereco" name="end" class="form-control" value="<?php echo $aluno['end']?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="telefone">Telefone</label>
                        <input type="text" id="telefone" name="tel" class="form-control" value="<?php echo $aluno['tel']?>">
                    </div>

                    <div class="form-group">
                        <label for="celular">Celular</label>
                        <input type="text" id="celular" name="cel" class="form-control" value="<?php echo $aluno['cel']?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="facebook">Perfil do Facebook</label>
                        <input type="text" id="facebook" name="face" class="form-control" value="<?php echo $aluno['face']?>">
                    </div>
                    <div class="form-group">
                        <label for="sexo">Sexo</label>
                        <select id="sexo" name="sexo" class="form-control">
                            <option value="1" <?php if ($aluno['sexo']==1) echo 'selected'; ?>>Masculino</option>
                            <option value="2" <?php if ($aluno['sexo']==2) echo 'selected'; ?>>Feminino</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="etnia">Etnia</label>
                        <select id="etnia" name="etnia" class="form-control">
                            <option>--</option>
                            <option value="1" <?php if ($aluno['etnia']==1) echo 'selected'; ?>>Branco(a)</option>
                            <option value="2" <?php if ($aluno['etnia']==2) echo 'selected'; ?>>Pardo(a)</option>
                            <option value="3" <?php if ($aluno['etnia']==3) echo 'selected'; ?>>Negro(a)</option>
                            <option value="4" <?php if ($aluno['etnia']==4) echo 'selected'; ?>>Amarelo(a)</option>
                            <option value="5" <?php if ($aluno['etnia']==5) echo 'selected'; ?>>Indígena</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nome_pai">Nome do Pai</label>
                        <input type="text" id="nome_pai" name="pai" class="form-control" value="<?php echo $aluno['pai']?>">
                    </div>

                    <div class="form-group">
                        <label for="nome_mae">Nome da Mãe</label>
                        <input type="text" id="nome_mae" name="mae" class="form-control" value="<?php echo $aluno['mae']?>">
                    </div>

                    <div class="form-group">
                        <label for="nasc">Data de Nascimento</label>
                        <input type="text" id="nasc" name="data" class="form-control" value="<?php echo $aluno['data_nasc']?>">
                    </div>

                    <div class="form-group">
                        <label for="camiseta">Tamanho da Camiseta</label>
                        <input type="text" id="camiseta" name="camiseta" class="form-control" value="<?php echo $aluno['camiseta']?>">
                    </div>
                    <div class="form-group">
                        <label for="cidade">Cidade</label>
                        <select id="cidade" name="" class="form-control">
                            <option selected="true" value="null">Escolha uma cidade</option>
                            <?php
                            while ($e1 = mysql_fetch_array($escola1)) {
                                if ($e1['cidade'] == $aluno['cidade']) {
                                    echo '<option selected value="' . $e1['cidade'] . '">' . $e1['cidade'] . '</option>';
                                } else {
                                    echo '<option value="' . $e1['cidade'] . '">' . $e1['cidade'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="escola1">Escola</label>
                        <select name="escola1" id="escola1" class="form-control">
                            <option value="<?php echo $aluno['id_escola'] ?>"><?php echo $aluno['nome_escola'] ?></option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="serie">Série</label>
                        <input type="text" id="serie" name="serie" class="form-control" value="<?php echo $aluno['serie']?>">
                    </div>  

                                    <br><br> 
                <?php 
                while ($questao = mysql_fetch_assoc($result_qs)){
                    $query_respostase = "SELECT resposta FROM respostase WHERE usuario_id = '".$r."' AND pergunta_num = '".$questao['pergunta_num']."'";
                    $result_respostase = mysql_query($query_respostase);
                    $respostase = mysql_fetch_assoc($result_respostase);
                    echo '<div style="text-align: left; width: 100%">';
                    echo $questao['pergunta_num'].') '.$questao['pergunta_texto'].'<br><br>';
                    switch ($questao['tipo']){
                    case 1:
                        echo '<select name="r'.$questao['pergunta_num'].'">';
                        for ($i=1;$i<=$questao['questoes'];$i++){
                            echo '<option value="'.$i.'"';
                            if ($i == $respostase['resposta']){
                                echo 'selected = "true" ';
                            }
                            echo '>'.$questao['r'.$i].'</option>';
                        }
                        echo '</select>';
                        break;
                    case 2:
                        
                        $respostase['resposta'] = explode(',', $respostase['resposta']);
                        for ($i=1;$i<=$questao['questoes'];$i++){
     
                                echo '<input type="checkbox" name="r'.$questao['pergunta_num'].'[]" value="'.$i.'"';
                                for ($j=0; $j < count($respostase['resposta']) ; $j++) { 
                                    if ($i == $respostase['resposta'][$j]){
                                        echo 'checked ';
                                    }
                                }
                                echo '>'.$questao['r'.$i];
                                if ($i!=$questao['questoes'])
                                    echo '<br>';
                        }
                        break;
                    case 3:
                        echo '<textarea name="r'.$questao['pergunta_num'].'" class="form-control">'.$respostase['resposta'].'</textarea>';
                        break;
  
                    
                    }
                    echo '<br><br></div>';
                }
                ?>


                    <div class="text-center">
                        <button id="salvar" type="button" class="btn btn-primary btn-lg">Salvar</button> 
                        <input type="reset" class="btn btn-default pull-right">     
                    </div>
                </form>


                <!-- 
                ============================================
                ============================================
                ==================== VER ===================
                ============================================
                ============================================
                -->

                <?php elseif($p == 'ver'): 
                ?>

                <div class="container-fluid">

                    <div class="equipeStatus">
                        <?php if($aluno['h'] == 1):?>
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


                <!-- 
                ============================================
                ============================================
                =================== NOTAS ==================
                ============================================
                ============================================
                -->

            <?php elseif($p == 'notas'): 

                $query = "SELECT * FROM notas WHERE id_usuario = ".$r." ORDER BY ano DESC";
                $result = mysql_query($query);

                $query_aluno = "SELECT * FROM usuario WHERE id_usuario = ".$r." LIMIT 1";
                $result_aluno = mysql_query($query_aluno);
                $aluno = mysql_fetch_assoc($result_aluno);
            ?>
            <div class="row">

                <h1 align="center"><b><?php echo $aluno['nome']?></b></h1>

                    <?php 
                    /* Verifica se existem resultados */
                    if(mysql_num_rows($result) != 0):
                        /* Cria o array notas[] com os resultados de uma linha */
                        $nota = mysql_fetch_assoc($result);
                        while($nota != NULL):
                            $ano = $nota['ano'];
                    ?>
                            <div class="col-md-6 col-md-offset-3" style="background: #fff; margin-top: 30px; border: 1px solid rgba(51,51,51,.2)">
                                <button type="button" data-ano="<?php echo $ano?>" data-id="<?php echo $nota['id'];?>" class="removeAno btn btn-circle btn-danger pull-right" style="margin-right: -30px; margin-top: -20px;">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </button>

                                <table class="table table-hover table-bordered bgWhite">
                                    <h2 align="center"><?php echo $ano?></h2>

                                    <tr align="center">
                                        <td align="center"><b>Atividade</b></td>
                                        <td align="center"><b>Nota</b></td>
                                    </tr>

                                    <?php 
                                    while($nota['ano'] == $ano):?>
                                        <!-- MARATONA DO CONHECIMENTO 1 FASE -->
                                        <tr class="linhaNota" data-id="<?php echo $nota['id'];?>" data-tipo="maratona1" align="center">
                                            <!-- VER -->                                 
                                            <td class="view">
                                                Maratona do Conhecimento 1ª Fase
                                            </td>
                                            <td class="view" id="viewMaratona1<?php echo $nota['id'];?>">
                                                <?php echo $nota['maratona-do-conhecimento-1']?>
                                            </td>
                                            <!-- EDITAR -->
                                            <form id="formsEditarMaratona1<?php echo $nota['id'];?>">
                                                <td class="edit" id="editMaratona1<?php echo $nota['id'];?>" hidden>
                                                    <input style="width: 25%;" type="text" name="maratona-do-conhecimento-1" value="<?php echo $nota['maratona-do-conhecimento-1']?>">
                                                </td>
                                                <input type="hidden" value="<?php echo $nota['id'];?>" name="id">
                                            </form>
                                        </tr>

                                        <!-- MARATONA DO CONHECIMENTO 2 FASE -->
                                        <tr class="linhaNota" data-id="<?php echo $nota['id'];?>" data-tipo="maratona2" align="center">
<<<<<<< HEAD
                                            <!-- VER -->                                 
                                            <td class="view">
                                                Maratona do Conhecimento 2ª Fase
                                            </td>
                                            <td class="view" id="viewMaratona2<?php echo $nota['id'];?>">
                                                <?php echo $nota['maratona-do-conhecimento-2']?>
                                            </td>
                                            <!-- EDITAR -->
                                            <form id="formsEditarMaratona2<?php echo $nota['id'];?>">
                                                <td class="edit" id="editMaratona2<?php echo $nota['id'];?>" hidden>
                                                    <input style="width: 25%;" type="text" name="maratona-do-conhecimento-2" value="<?php echo $nota['maratona-do-conhecimento-2']?>">
                                                </td>
                                                <input type="hidden" value="<?php echo $nota['id'];?>" name="id">
                                            </form>
                                        </tr>
                                        <!-- Concurso Literario -->
                                        <tr class="linhaNota" data-id="<?php echo $nota['id'];?>" data-tipo="concurso-literario" align="center">
                                            <!-- VER -->                                 
                                            <td class="view">
                                                Concurso Literário
                                            </td>
                                            <td class="view" id="viewLiterario<?php echo $nota['id'];?>">
                                                <?php echo $nota['concurso-literario']?>
                                            </td>
                                            <!-- EDITAR -->
                                            <form id="formsEditarLiterario<?php echo $nota['id'];?>">
                                                <td class="edit" id="editLiterario<?php echo $nota['id'];?>" hidden>
                                                    <input style="width: 25%;" type="text" name="concurso-literario" value="<?php echo $nota['concurso-literario']?>">
=======
                                            <!-- VER -->                                 
                                            <td class="view">
                                                Maratona do Conhecimento 2ª Fase
                                            </td>
                                            <td class="view" id="viewMaratona2<?php echo $nota['id'];?>">
                                                <?php echo $nota['maratona-do-conhecimento-2']?>
                                            </td>
                                            <!-- EDITAR -->
                                            <form id="formsEditarMaratona2<?php echo $nota['id'];?>">
                                                <td class="edit" id="editMaratona2<?php echo $nota['id'];?>" hidden>
                                                    <input style="width: 25%;" type="text" name="maratona-do-conhecimento-2" value="<?php echo $nota['maratona-do-conhecimento-2']?>">
>>>>>>> 531fa35a94d580d24220462f95c53a6d0faffe06
                                                </td>
                                                <input type="hidden" value="<?php echo $nota['id'];?>" name="id">
                                            </form>
                                        </tr>
<<<<<<< HEAD
=======
                                        <!-- Concurso Literario -->
                                        <tr class="linhaNota" data-id="<?php echo $nota['id'];?>" data-tipo="concurso-literario" align="center">
                                            <!-- VER -->                                 
                                            <td class="view">
                                                Concurso Literário
                                            </td>
                                            <td class="view" id="viewLiterario<?php echo $nota['id'];?>">
                                                <?php echo $nota['concurso-literario']?>
                                            </td>
                                            <!-- EDITAR -->
                                            <form id="formsEditarLiterario<?php echo $nota['id'];?>">
                                                <td class="edit" id="editLiterario<?php echo $nota['id'];?>" hidden>
                                                    <input style="width: 25%;" type="text" name="concurso-literario" value="<?php echo $nota['concurso-literario']?>">
                                                </td>
                                                <input type="hidden" value="<?php echo $nota['id'];?>" name="id">
                                            </form>
                                        </tr>
>>>>>>> 531fa35a94d580d24220462f95c53a6d0faffe06
                                        <!-- Clubes de Ciência -->
                                        <tr class="linhaNota" data-id="<?php echo $nota['id'];?>" data-tipo="clube-de-ciencia" align="center">
                                            <!-- VER -->                                 
                                            <td class="view">
                                                Clube de Ciência
                                            </td>
                                            <td class="view" id="viewClube<?php echo $nota['id'];?>">
                                                <?php echo $nota['clube-de-ciencia']?>
                                            </td>
                                            <!-- EDITAR -->
                                            <form id="formsEditarClube<?php echo $nota['id'];?>">
                                                <td class="edit" id="editClube<?php echo $nota['id'];?>" hidden>
                                                    <input style="width: 25%;" type="text" name="clube-de-ciencia" value="<?php echo $nota['clube-de-ciencia']?>">
                                                </td>
                                                <input type="hidden" value="<?php echo $nota['id'];?>" name="id">
                                            </form>
                                        </tr>

                                    <?php
                                        $nota = mysql_fetch_assoc($result);
                                    endwhile;
                            /* Atualiza o $ano */
                            $ano = $nota['ano'];   
                            echo '</table></div>';
                        endwhile;
                    else:
                        echo '<div style="margin-top: 50px;" class="alert alert-warning text-center col-md-4 col-md-offset-4"> <h2><span class="glyphicon glyphicon-exclamation-sign"></span></h2> Nenhuma nota cadastrada. <br> Clique no botão abaixo para adicionar uma nota ao aluno.</div>';
                    endif;
                    ?>
                  
                    <div class="row" align="center">
                        <div class="col-md-12">
                            <br><br>
<<<<<<< HEAD
                            <button type="button" id="adicionaAno" class="btn-circle btn-lg btn btn-primary"><span class="glyphicon glyphicon-plus"></span></button>
                            <form id="cadastraAno" action="" style="width: 12%;" onSubmit="return false;">                                
                                <br>
                                <input class="form-control" type="text" placeholder="ano desejado" style="display: none;" name="ano">
                                <input type="hidden" name="id_usuario" value="<?php echo $r ?>">
=======
                            <form id="cadastraAno" action="" style="width: 6%;" onSubmit="return false;">                            
                                <button id="adicionaAno" type="button" class="btn btn-circle btn-lg btn-primary" data-container="body" data-toggle="popover" data-placement="top" data-html="true" title="Digite o ano que deseja cadastrar" data-content='                                
                                        <input id="inputAno" class="form-control" type="text" placeholder="" name="ano">
                                        <input id="inputID" type="hidden" name="id_usuario" value="<?php echo $r ?>">'>
                                    <span class="glyphicon glyphicon-plus"></span>

                                </button>
>>>>>>> 531fa35a94d580d24220462f95c53a6d0faffe06
                            </form>
                        </div>
                    </div>

            </div> <!-- /row -->

            <?php endif; ?>
        	</div>
        </div>

	</div>

	<?php include '../../footer.php'; ?>
<script type="text/javascript">

<<<<<<< HEAD
=======
            $(function () {
              $('[data-toggle="tooltip"]').tooltip()
            });

>>>>>>> 531fa35a94d580d24220462f95c53a6d0faffe06
            $('.removeAno').click(function() {
                var id = $(this).attr('data-id');
                var ano = $(this).attr('data-ano');
                var data = {
                    'id': id
                }
                if(confirm('Deseja realmente excluir o boletim de '+ano+'?')){
                    $.ajax({
                        url: '<?php echo $root_html?>sistema2/alunos/buscar/desativaNotas.php',
                        type: 'POST',
                        data: data,
                        complete: function() {
                            location.reload(200);
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
                }

            });

            $('#adicionaAno').click(function(){
<<<<<<< HEAD
                $('#cadastraAno input').show().focus().keypress(function(event) {
                    if(event.which == 13){
                        $('#cadastraAno input').hide();
                        var data = $('#cadastraAno').serialize();
=======
                $('#adicionaAno').popover('toggle');                
                $('input.form-control').keypress(function(event) {
                    if(event.which == 13){
                        var id_usuario = $('#inputID').val()
                        var ano = $('#inputAno').val();
                        var data = {
                            'id_usuario': id_usuario,
                            'ano': ano
                        }
>>>>>>> 531fa35a94d580d24220462f95c53a6d0faffe06
                        $.ajax({
                            url: '<?php echo $root_html?>sistema2/alunos/buscar/cadastrarNotas.php',
                            type: 'POST',
                            data: data,
                            complete: function() {
                                location.reload();
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

                    }
                });;
            });

            $('.linhaNota').click(function(){
                var id = $(this).attr('data-id');
                var tipo = $(this).attr('data-tipo');
                switch(tipo){
                    case 'maratona1':
                        $('#viewMaratona1'+id).hide();
                        $('#editMaratona1'+id).show();
                        $("#editMaratona1"+id+" > input").focus().select();
                    break;

                    case 'maratona2':
                        $('#viewMaratona2'+id).hide();
                        $('#editMaratona2'+id).show();
                        $("#editMaratona2"+id+" > input").focus().select();
                    break;

                    case 'concurso-literario':
                        $('#viewLiterario'+id).hide();
                        $('#editLiterario'+id).show();
                        $("#editLiterario"+id+" > input").focus().select();
                    break;

                    case 'clube-de-ciencia':
                        $('#viewClube'+id).hide();
                        $('#editClube'+id).show();
                        $("#editClube"+id+" > input").focus().select();
                    break;
                }
                
                $("#editMaratona1"+id).focusout(function(){
                    $("#editMaratona1"+id).hide();
                    $("#editMaratona2"+id).hide();
                    $("#editLiterario"+id).hide();
                    $("#editClube"+id).hide();
                    $("#viewMaratona1"+id).show();
                });
                $("#editMaratona2"+id).focusout(function(){
                    $("#editMaratona1"+id).hide();
                    $("#editMaratona2"+id).hide();
                    $("#editLiterario"+id).hide();
                    $("#editClube"+id).hide();
                    $("#viewMaratona2"+id).show();
                });
                $("#editLiterario"+id).focusout(function(){
                    $("#editMaratona1"+id).hide();
                    $("#editMaratona2"+id).hide();
                    $("#editLiterario"+id).hide();
                    $("#editClube"+id).hide();
                    $("#viewLiterario"+id).show();
                });
                $("#editClube"+id).focusout(function(){
                    $("#editMaratona1"+id).hide();
                    $("#editMaratona2"+id).hide();
                    $("#editLiterario"+id).hide();
                    $("#editClube"+id).hide();
                    $("#viewClube"+id).show();
                });
                $("#editMaratona1"+id).keypress(function(event) {
                    if(event.which == 13){
                        $("#editMaratona1"+id).hide();
                        $("#editMaratona2"+id).hide();
                        $("#editLiterario"+id).hide();
                        $("#editClube"+id).hide();
                        $("#viewMaratona1"+id).show();
                        var data = $('#formsEditarMaratona1'+id).serialize();
                        $.ajax({
                            url: '<?php echo $root_html?>sistema2/alunos/buscar/editarNotas.php',
                            type: 'POST',
                            data: data,
                            complete: function() {
                                $("#viewMaratona1"+id).html($("#editMaratona1"+id+" input").val());
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
                    }
                });
                $("#editMaratona2"+id).keypress(function(event) {
                    if(event.which == 13){
                        $("#editMaratona1"+id).hide();
                        $("#editMaratona2"+id).hide();
                        $("#editLiterario"+id).hide();
                        $("#editClube"+id).hide();
                        $("#viewMaratona2"+id).show();
                        var data = $('#formsEditarMaratona2'+id).serialize();
                        $.ajax({
                            url: '<?php echo $root_html?>sistema2/alunos/buscar/editarNotas.php',
                            type: 'POST',
                            data: data,
                            complete: function() {
                                $("#viewMaratona2"+id).html($("#editMaratona2"+id+" input").val());
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
                    }
                });
                $("#editLiterario"+id).keypress(function(event) {
                    if(event.which == 13){
                        $("#editMaratona1"+id).hide();
                        $("#editMaratona2"+id).hide();
                        $("#editLiterario"+id).hide();
                        $("#editClube"+id).hide();
                        $("#viewLiterario"+id).show();
                        var data = $('#formsEditarLiterario'+id).serialize();
                        $.ajax({
                            url: '<?php echo $root_html?>sistema2/alunos/buscar/editarNotas.php',
                            type: 'POST',
                            data: data,
                            complete: function() {
                                $("#viewLiterario"+id).html($("#editLiterario"+id+" input").val());
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
                    }
                });
                $("#editClube"+id).keypress(function(event) {
                    if(event.which == 13){
                        $("#editMaratona1"+id).hide();
                        $("#editMaratona2"+id).hide();
                        $("#editLiterario"+id).hide();
                        $("#editClube"+id).hide();
                        $("#viewClube"+id).show();
                        var data = $('#formsEditarClube'+id).serialize();
                        $.ajax({
                            url: '<?php echo $root_html?>sistema2/alunos/buscar/editarNotas.php',
                            type: 'POST',
                            data: data,
                            complete: function() {
                                $("#viewClube"+id).html($("#editClube"+id+" input").val());
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
                    }
                });
            });

            $('#busca').keyup(function () {
                
                var data = $(".alunoCadastro").serialize();
                $.ajax({
                    url: '<?php echo $root_html ?>sistema2/alunos/buscar/busca.php',
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

            $('#salvar').click(function () {
                
                var data = $("#editarCadastro").serialize();
                $.ajax({
                    url: '<?php echo $root_html?>sistema2/alunos/buscar/editar.php',
                    type: 'POST',
                    data: data,
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


            $('#buscaCidade').change(function () {

                var values = {
                    'cidade': $('#buscaCidade').val()
                };
                $.ajax({
                    url: '<?php echo $root_html ?>sistema2/alunos/buscar/busca_escola.php',
                    type: 'POST',
                    data: values,
                    success: function (data) {
                        $('#buscaEscola').html(data);

                    },
                    error: function (e) {
                        $('#buscaEscola').html("<option>Nenhum resultado encontrado.</option>");

                    }
                });

            });

            $('#buscaNome').keyup(function () {

                var data = $(".alunoBusca").serialize();
                $.ajax({
                    url: '<?php echo $root_html ?>sistema2/alunos/buscar/busca.php',
                    type: 'POST',
                    data: data,
                    success: function (data) {
                        $('#resultado').html(data);

                    },
                    error: function (e) {
                        $('#resultado').html("<span class='ajuda_user'>Nenhum resultado encontrado.</span>");

                    }
                });

            });
                
            $('#buscaCidade, #buscaEscola, .buscaStatus, #qtdBusca').change(function () {

                var data = $(".alunoBusca").serialize();
                $.ajax({
                    url: '<?php echo $root_html ?>sistema2/alunos/buscar/busca.php',
                    type: 'POST',
                    data: data,
                    success: function (data) {
                        $('#resultado').html(data);

                    },
                    error: function (e) {
                        $('#resultado').html("<span class='ajuda_user'>Nenhum resultado encontrado.</span>");

                    }
                });

            });
                                





</script>

</body>
</html>