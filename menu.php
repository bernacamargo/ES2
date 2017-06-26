  <?php
<<<<<<< HEAD
    $arquivo = $root_html.'es2/img/'.$_SESSION['user-id'].'.jpg';
    if(!file_exists($arquivo)){
        $img_url = $root_html.'es2/img/';
        if($_SESSION['user-sexo'] == 'masculino')
          $img_url .= 'default_masc.jpg';
        else if($_SESSION['user-sexo'] == 'feminino')
          $img_url .= 'default_fem.jpg';
      }
      else
        $img_url = $root_html.'es2/img/'.$_SESSION['user-id'].'.jpg';
=======
    $arquivo = $root_html.'img/equipe/'.$_SESSION['usuarioID'].'.jpg';
    if(!file_exists($arquivo)){
        $img_url = $root_html.'img/equipe/';
        if($_SESSION['usuarioSexo'] == 1)
          $img_url .= 'default_masc.jpg';
        else if($_SESSION['usuarioSexo'] == 2)
          $img_url .= 'default_fem.jpg';
      }
      else
        $img_url = $root_html.'img/equipe/'.$_SESSION['usuarioID'].'.jpg';
>>>>>>> 531fa35a94d580d24220462f95c53a6d0faffe06
   ?>

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo $root_html;?>es2/" class="logo" style="">
      <!-- mini logo for sidebar mini 50x50 pixels -->
<<<<<<< HEAD
      <span class="logo-mini"><b>A</b>Painel</span>
=======
      <span class="logo-mini">PFC</span>
>>>>>>> 531fa35a94d580d24220462f95c53a6d0faffe06
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>Painel</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
<<<<<<< HEAD
          
=======
          <!-- ============================================================= 
            ================================================================
            ========================== MENSAGENS ===========================
            ================================================================
            ================================================================ -->

            <?php 
                $id_destinatario = $_SESSION['usuarioID'];
                $query_msg = "SELECT * FROM chat WHERE id_destinatario = '$id_destinatario' AND lido=0 ORDER BY data_hora DESC LIMIT 5";
                $res_msg = mysql_query($query_msg);
                $mensagem = mysql_fetch_assoc($res_msg);
                $query_msg_novas = "SELECT lido FROM chat WHERE id_destinatario = '$id_destinatario' AND lido = 0";
                $res_msg_novas = mysql_query($query_msg_novas);
                $num_msg = mysql_num_rows($res_msg_novas);

             ?>

          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
            <?php if($num_msg != 0): ?>
              <span class="label label-success label-msg-nlida"><?php echo $num_msg ?></span>
            <?php endif ?>

            </a>
            <ul class="dropdown-menu">
            <?php if($num_msg != 0): ?>

            <?php if($num_msg > 1): ?>
              <li class="header">Você tem <?php echo $num_msg ?> mensagens novas</li>
          <?php elseif($num_msg == 1): ?>
                <li class="header">Você tem <?php echo $num_msg ?> mensagem nova</li>
            <?php elseif($num_msg == 0): ?>
                <li class="header">Você não tem nenhuma mensagem nova</li>
      <?php endif; ?>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                    <?php do{

                        $time1 = strtotime($mensagem['data_hora']);
                        $time2 = strtotime(date("Y-m-d H:i:s"));

                        $time_final = floor($time2 - $time1);
                        
                        // Segundos
                        if($time_final == 1){
                            $time_flag = 0;
                        }
                        else if($time_final > 1 && $time_final < 60){
                            $time_flag = 0;                  
                        }
                        // Minutos
                        else if($time_final == 60){
                            $time_final = $time_final/60;
                            $time_flag = 1;                            
                        }
                        else if($time_final > 60 && $time_final < 3600){
                            $time_final = $time_final/60;   
                            $time_flag = 1;
                        }
                        // Horas
                        else if($time_final == 3600){
                            $time_final = $time_final/(60*60);
                            $time_flag = 2;                 
                        }
                        else if($time_final > 3600 && $time_final < 86400){
                            $time_final = $time_final/(60*60);
                            $time_flag = 2;                 
                        }
                        // Dias
                        else if($time_final == 86400) {
                            $time_final = $time_final/(60*60*24);
                            $time_flag = 3;                 
                        }
                        elseif($time_final > 1440 && $time_final < 2592000){
                            $time_final = $time_final/(60*60*24);
                            $time_flag = 3;                 
                        }
                        // Meses
                        elseif($time_final == 2592000) {
                            $time_final = $time_final/(60*60*24*30);
                            $time_flag = 4;                 
                        }
                        elseif($time_final > 2592000 && $time_final < 31104000){
                            $time_final = $time_final/(60*60*24*30);
                            $time_flag = 4;                 
                        }
                        // Anos
                        elseif($time_final == 31104000) {
                            $time_final = $time_final/(60*60*24*30*12);
                            $time_flag = 5;
                        }
                        elseif($time_final > 31104000){
                            $time_final = $time_final/(60*60*24*30*12);
                            $time_flag = 5;                      
                        }

                        $time_final = floor($time_final);

                        if($time_flag == 0 && $time_final == 1){
                            $time_txt = 'segundo';
                        }
                        else if($time_flag == 0 && $time_final > 1)
                            $time_txt = 'segundos';
                        else if($time_flag == 1 && $time_final == 1)
                            $time_txt = 'minuto';
                        else if($time_flag == 1 && $time_final > 1)
                            $time_txt = 'minutos';
                        else if($time_flag == 2 && $time_final == 1)
                            $time_txt = 'hora';
                        else if($time_flag == 2 && $time_final > 1)
                            $time_txt = 'horas';
                        else if($time_flag == 3 && $time_final == 1)
                            $time_txt = 'dia';
                        else if($time_flag == 3 && $time_final > 1)
                            $time_txt = 'dias';
                        else if($time_flag == 4 && $time_final == 1)
                            $time_txt = 'mes';
                        else if($time_flag == 4 && $time_final > 1)
                            $time_txt = 'meses';
                        else if($time_flag == 5 && $time_final == 1)
                            $time_txt = 'ano';
                        else if($time_flag == 5 && $time_final > 1)
                            $time_txt = 'anos';



                      echo '<li class="mensagem"><!-- start message -->';
                        echo '<a href="'.$root_html.'sistema2/mensagens" class="contato '; if($mensagem['lido'] == 0) echo 'active'; echo '" data-id-remetente="'.$mensagem['id_remetente'].'" data-id-destinatario="'.$mensagem['id_destinatario'].'">';
                          echo '<div class="pull-left">';
                            echo '<img src="'; echo $root_html.'img/equipe/default_masc.jpg" class="img-circle" alt="User Image">';
                          echo '</div>';
                          echo '<h4>';
                            echo $mensagem['nome_remetente'];
                            echo '<small><i class="fa fa-clock-o"></i> '.$time_final.' '.$time_txt.'</small>';
                          echo '</h4>';
                          echo '<p>'.$mensagem['mensagem'].'</p>';
                        echo '</a>';
                      echo '</li>';
                  }while($mensagem = mysql_fetch_assoc($res_msg));
                   ?>

                  <!-- end message -->
                </ul>
              </li>
              <li class="footer"><a href="<?php echo $root_html?>sistema2/mensagens/">Ver todas as mensagens</a></li>
              
          <?php else: ?>
                <li align="center" style="padding: 0px 10px"><h2 style="color: #999;"><span class="glyphicon glyphicon-comment"></span> <br>Nenhuma mensagem nova</h2></li>

              <li class="footer"><a href="<?php echo $root_html?>sistema2/mensagens/">Ver todas as mensagens</a></li>
            

      <?php endif; ?>                
            </ul>

          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i> 5 new members joined
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i> You changed your username
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Create a nice theme
                        <small class="pull-right">40%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">40% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Some task I need to do
                        <small class="pull-right">60%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Make beautiful transitions
                        <small class="pull-right">80%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">80% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
>>>>>>> 531fa35a94d580d24220462f95c53a6d0faffe06
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <style>
                  .user-img {
                    width: 100px;
                    height: 100px;
                    border-radius: 50%;
                    margin: 0 auto;
                    overflow: hidden;
                  }
              </style>
              <img src="<?php echo $img_url?>" class="user-image" alt="User Image">
<<<<<<< HEAD
              <span class="hidden-xs"><?php echo $_SESSION['user-nome']?></span>
=======
              <span class="hidden-xs"><?php echo $_SESSION['usuarioNome']?></span>
>>>>>>> 531fa35a94d580d24220462f95c53a6d0faffe06
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                
                <div class="user-img">
                  <img src="<?php echo $img_url?>" class="img-responsive" alt="User Image">
                </div>
                <?php
<<<<<<< HEAD
                  $id = $_SESSION['user-id'];
                  $query = "SELECT * FROM users WHERE id_user = '$id' LIMIT 1";
=======
                  $id = $_SESSION['usuarioID'];
                  $query = "SELECT * FROM equipe WHERE id_usuario = '$id' LIMIT 1";
>>>>>>> 531fa35a94d580d24220462f95c53a6d0faffe06
                  $res = mysql_query($query);
                  $result = mysql_fetch_assoc($res);
                 ?>
                <p>
<<<<<<< HEAD
                  <b><?php echo $_SESSION['user-nome']?></b> <br> Administrador
=======
                  <b><?php echo $_SESSION['usuarioNome']?></b> <br> <?php echo $result['cargo'] ?>
>>>>>>> 531fa35a94d580d24220462f95c53a6d0faffe06
                </p>
              </li>
              <!-- Menu Body -->
              <li hidden class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Seguidores</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#"></a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Amigos</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
<<<<<<< HEAD
                <div class="pull-left" hidden>
                  <a href="#" class="btn btn-default btn-flat"><span class="glyphicon glyphicon-user"></span> Perfil</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo $root_html;?>es2/sair" class="btn btn-default btn-flat"><span class="glyphicon glyphicon-log-out"></span> Sair</a>
=======
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat"><span class="glyphicon glyphicon-user"></span> Perfil</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo $root_html;?>sistema2/sair" class="btn btn-default btn-flat"><span class="glyphicon glyphicon-log-out"></span> Sair</a>
>>>>>>> 531fa35a94d580d24220462f95c53a6d0faffe06
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li style="display: none;">
            <a href="#" data-toggle="control-sidebar"><i class="glyphicon glyphicon-option-vertical
"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo $img_url ?>" alt="User Image" >
        </div>
        <div class="pull-left info">
<<<<<<< HEAD
          <p><?php echo $_SESSION['user-nome']?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
=======
          <p><?php echo $_SESSION['usuarioNome']?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Pesquisar...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
>>>>>>> 531fa35a94d580d24220462f95c53a6d0faffe06
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MENU</li>
        <li class="treeview">
          <a href="<?php echo $root_html?>es2/">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
<<<<<<< HEAD
        <li>
=======
        
        <!-- 
		===================================================================================
		===================================================================================
		=============================== VISÃO DO SUPERVISOR ===============================
		===================================================================================
		===================================================================================
         -->


        <?php if($_SESSION['h'] == 3 || $_SESSION['h'] == 901): ?>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-user"></i>
                <span>Alunos</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo $root_html?>sistema2/alunos/cadastrar/"><i class="fa fa-circle-o"></i> Cadastrar</a></li>
                <li><a href="<?php echo $root_html?>sistema2/alunos/buscar/"><i class="fa fa-circle-o"></i> Buscar</a></li>
            <!--<li><a href="pages/layout/fixed.html" class="disabled"><i class="fa fa-circle-o"></i> Desempenho</a></li> -->
                <li>
                  <a href="#"><i class="fa fa-circle-o"></i>Relatório</a>
                  <ul class="treeview-menu">
                    <li class="dropdown-menu2"><a href="<?php echo $root_html?>sistema2/alunos/relatorio/geral"><i class="fa fa-circle-o"></i> Geral</a> </li>
                </ul>
                </li>
              </ul>
            </li>
        <?php endif; ?>

        <!-- 
		===================================================================================
		===================================================================================
		================================= VISÃO DO ADMIN ==================================
		===================================================================================
		===================================================================================
         -->


        <?php if($_SESSION['h'] == 999): ?>        
        <li class="treeview">
>>>>>>> 531fa35a94d580d24220462f95c53a6d0faffe06
          <a href="#">
           <i class="fa fa-bus" aria-hidden="true"></i> <span>Companhias</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo $root_html?>es2/companhias/cadastrar/"><i class="fa fa-circle-o"></i> Cadastrar</a></li>
            <li><a href="<?php echo $root_html?>es2/companhias/buscar/"><i class="fa fa-circle-o"></i> Buscar</a></li>
          </ul>          
<<<<<<< HEAD
=======
        </li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i>
            <span>Alunos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo $root_html?>sistema2/alunos/cadastrar/"><i class="fa fa-circle-o"></i> Cadastrar</a></li>
            <li><a href="<?php echo $root_html?>sistema2/alunos/buscar/"><i class="fa fa-circle-o"></i> Buscar</a></li>
            <!--<li><a href="pages/layout/fixed.html" class="disabled"><i class="fa fa-circle-o"></i> Desempenho</a></li> -->
            <li>
              <a href="#"><i class="fa fa-circle-o"></i>Relatório</a>
              <ul class="treeview-menu">
                <li class="dropdown-menu2"><a href="<?php echo $root_html?>sistema2/alunos/relatorio/geral"><i class="fa fa-circle-o"></i> Geral</a> </li>
            </ul>
            </li>
          </ul>
        </li>
        <li class="treeview">
          <a href="<?php echo $root_html?>sistema2/nucleos/">
            <i class="fa fa-university"></i> <span>Núcleos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo $root_html?>sistema2/nucleos/cadastrar/"><i class="fa fa-circle-o"></i> Cadastrar</a></li>
            <!-- <li><a href="<?php echo $root_html?>sistema2/nucleos/buscar/"><i class="fa fa-circle-o"></i> Buscar</a></li> -->
          </ul>          
>>>>>>> 531fa35a94d580d24220462f95c53a6d0faffe06
        </li>        
        <li>
          <a href="#">
            <i class="fa fa-id-card-o" aria-hidden="true"></i> <span>Motoristas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo $root_html?>es2/motoristas/cadastrar/"><i class="fa fa-circle-o"></i> Cadastrar</a></li>
            <li><a href="<?php echo $root_html?>es2/motoristas/buscar/"><i class="fa fa-circle-o"></i> Buscar</a></li>
          </ul>          
        </li>
        <li>
          <a href="#">
            <i class="icon ion-map" style="font-size: 1.4em;" aria-hidden="true"></i>&ensp;<span>Destinos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo $root_html?>es2/destinos/cadastrar/"><i class="fa fa-circle-o"></i> Cadastrar</a></li>
            <li><a href="<?php echo $root_html?>es2/destinos/buscar/"><i class="fa fa-circle-o"></i> Buscar</a></li>
          </ul>          
        </li>
        <li>
          <a href="#">
<<<<<<< HEAD
            <i class="glyphicon glyphicon-time" aria-hidden="true"></i> <span>Horários</span>
=======
            <i class="fa fa-graduation-cap fa-fw"></i> <span>Guia do Vestibulando</span>
>>>>>>> 531fa35a94d580d24220462f95c53a6d0faffe06
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
<<<<<<< HEAD
            <li><a href="<?php echo $root_html?>es2/horarios/cadastrar/"><i class="fa fa-circle-o"></i> Cadastrar</a></li>
            <li><a href="<?php echo $root_html?>es2/horarios/buscar/"><i class="fa fa-circle-o"></i> Buscar</a></li>
          </ul>          
        </li>
        <li>
          <a href="#">
            <i class="fa fa-tags" aria-hidden="true"></i> <span>Viagens</span>
=======
            <li><a href="<?php echo $root_html?>sistema2/guia-do-vestibulando/cadastrar/"><i class="fa fa-circle-o"></i> Cadastrar</a></li>
            <li><a href="<?php echo $root_html?>sistema2/guia-do-vestibulando/buscar/"><i class="fa fa-circle-o"></i> Buscar</a></li>
          </ul>

        </li>
        <li>
          <a href="#">
            <i class="glyphicon glyphicon-bookmark"></i> <span>Maratona do Conhecimento</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo $root_html?>sistema2/maratona-do-conhecimento/cadastrar/"><i class="fa fa-circle-o"></i> Cadastrar</a></li>
            <li><a href="<?php echo $root_html?>sistema2/maratona-do-conhecimento/buscar/"><i class="fa fa-circle-o"></i> Buscar</a></li>
          </ul>

        </li>
        <li>
          <a href="pages/mailbox/mailbox.html">
            <i class="fa fa-handshake-o"></i> <span>Parceiros</span>
>>>>>>> 531fa35a94d580d24220462f95c53a6d0faffe06
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo $root_html?>es2/viagens/cadastrar/"><i class="fa fa-circle-o"></i> Cadastrar</a></li>
            <li><a href="<?php echo $root_html?>es2/viagens/buscar/"><i class="fa fa-circle-o"></i> Buscar</a></li>
          </ul>          
        </li>
      </ul>

<<<<<<< HEAD
=======
    <?php endif; ?>
>>>>>>> 531fa35a94d580d24220462f95c53a6d0faffe06
    </section>
    <!-- /.sidebar -->
  </aside>

<div class="alerta alert" style="display: none;">
    <span id="alerta_conteudo"></span>
</div>
