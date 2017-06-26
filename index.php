<?php 
include '/seguranca.php';
$title = "AdminPainel - Dashboard";
include 'head.php';

<<<<<<< HEAD
$cont_companhias = mysql_num_rows(mysql_query("SELECT * FROM companhias"));

$cont_motoristas = mysql_num_rows(mysql_query("SELECT * FROM motorista"));

$cont_destinos = mysql_num_rows(mysql_query("SELECT * FROM destinos"));

$cont_viagens = mysql_num_rows(mysql_query("SELECT * FROM horarios"));

?>
<!-- USUARIO LOGADO -->
<?php if(isset($_SESSION['user-h'])): ?>

<body class="hold-transition skin-black sidebar-mini fixed">
=======
//Conta alunos e escolas
$query_e = "SELECT DISTINCT * FROM escola ORDER BY cidade";
$result_e = mysql_query($query_e);    
$query_c = "SELECT DISTINCT * FROM";
$cont_escola = 0; 
$cont_alunos = 0;   
while($escola = mysql_fetch_assoc($result_e)){
    $cont_escola++;
    $cont = 0;
    $query_u = "SELECT id_escola FROM usuario ORDER BY id_escola DESC";
    $result_u = mysql_query($query_u);
    while($alunos = mysql_fetch_assoc($result_u)){
        if($alunos['id_escola'] == $escola['id_escola']){
            $cont++;
            $cont_alunos++;
        }
    }
}
$query_pref = "SELECT * FROM parceiros";
$result_pref = mysql_query($query_pref);
$cont_parc = mysql_num_rows($result_pref);
$cont_pref = 0;
while($pref = mysql_fetch_assoc($result_pref)){
	if($pref['prefeitura'] == 1)
		$cont_pref++;
}

$query = "SELECT * FROM visitas";
$resultado = mysql_query($query);
$contVisitas = 0;
$contVisitas_unique = 0;
while($row = mysql_fetch_assoc($resultado)){
    $contVisitas = $contVisitas + $row['pageviews'];
    $contVisitas_unique = $contVisitas_unique + $row['uniques'];
}
$k = 0;
if($contVisitas > 1000){
	$contVisitas = round(($contVisitas / 1000), 1);
	$k = 1;
}
?>
<!-- USUARIO LOGADO -->
<?php if(isset($_SESSION['h'])): ?>

<body class="hold-transition skin-yellow sidebar-mini fixed">
>>>>>>> 531fa35a94d580d24220462f95c53a6d0faffe06

	<div class="wrapper">

	<?php include 'menu.php'; ?>
	<div class="content-wrapper">
	
		<!-- Content Header (Page header) -->
		<section class="content-header">
		      <h1 style="color: #fff">
		        <i class="fa fa-dashboard"></i> Dashboard
		        <small style="color: #f0f0f0;">Control panel</small>
		      </h1>
		</section>
	    <!-- Main content -->
	    <section class="content">
		      <!-- Small boxes (Stat box) -->
		      <div class="row">
		        <div class="col-lg-3 col-xs-6">
		          <!-- small box -->
		          <div class="small-box bg-aqua">
		            <div class="inner">
		              <h3><?php echo $cont_companhias?></h3>

		              <p>Companhias</p>
		            </div>
		            <div class="icon">
		              <i class="icon ion-android-bus"></i>
		            </div>
		            <a href="#" class="small-box-footer"></a>
		          </div>
		        </div>
		        <!-- ./col -->
		        <div class="col-lg-3 col-xs-6">
		          <!-- small box -->
		          <div class="small-box bg-green">
		            <div class="inner">
		              <h3><?php echo $cont_motoristas?></h3>

		              <p>Motoristas</p>
		            </div>
		            <div class="icon">
		              <i class="icon ion-person"></i>
		            </div>
		            <a href="#" class="small-box-footer"></a>
		          </div>
		        </div>
		        <!-- ./col -->
		        <div class="col-lg-3 col-xs-6">
		          <!-- small box -->
		          <div class="small-box bg-yellow">
		            <div class="inner">
		              <h3><?php echo $cont_destinos?></h3>

		              <p>Destinos</p>
		            </div>
		            <div class="icon">
		              <i class="icon ion-map"></i>	
		            </div>
		            <a href="#" class="small-box-footer"></a>
		          </div>
		        </div>
		        <!-- ./col -->
		        <div class="col-lg-3 col-xs-6">
		          <!-- small box -->
		          <div class="small-box bg-red">
		            <div class="inner">
<<<<<<< HEAD
		              <h3><?php echo $cont_viagens*2;?></h3>

		              <p>Total de viagens</p>
=======
		              <h3><?php echo $contVisitas; if($k) echo 'k'?></h3>

		              <p>Visitantes</p>
>>>>>>> 531fa35a94d580d24220462f95c53a6d0faffe06
		            </div>
		            <div class="icon">
		              <i class="ion ion-pie-graph"></i>
		            </div>
		            <a href="#" class="small-box-footer"></a>
		          </div>
		        </div>
		        <!-- ./col -->
		      </div>
		      <!-- /.row -->

	    </section>
		<!-- /.content -->
	</div>

	</div>
</body>
<?php include 'footer.php'; ?>

<?php else: ?>

	<body class="hold-transition login-page">
	    <div class="alerta alert alert-dismissible" style="display: none;">
	        <span id="alerta_conteudo"></span>
	        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	    </div>

		<div class="login-box">
		  <div class="login-logo">
		    <a href="../../index2.html"><b>Painel de Controle</b></a>
		  </div>
		  <!-- /.login-logo -->
		  <div class="login-box-body">

<<<<<<< HEAD
=======
		    <div style="margin: 0 auto; width: 50%;">
		    	<img src="<?php echo $root_html;?>img/logo2.png" alt="" class="img-responsive">
		    </div>
			<br>
>>>>>>> 531fa35a94d580d24220462f95c53a6d0faffe06
		    <p class="login-box-msg">Entre com sua conta para iniciar a sessão</p>
		    <form id="realizarLogin">
		      <div class="form-group has-feedback">
		        <input id="login-email" type="email" name="email" class="form-control" placeholder="Email">
		        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
		      </div>
		      <div class="form-group has-feedback">
		        <input id="login-senha" type="password" name="senha" class="form-control" placeholder="Senha">
		        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
		      </div>
		      <div class="row">
		        <div class="col-xs-8 col-md-8">
		          <div class="checkbox">
		            <label>
		              <input id="remember-me" type="checkbox"> Lembrar de mim
		            </label>
		          </div>
		        </div>
		        <!-- /.col -->
		        <div class="col-xs-4 col-md-4">
		          <button id="logar" type="button" class="btn btn-primary btn-block btn-flat">Entrar</button>
		        </div>
		        <!-- /.col -->
		      </div>
		    </form>

		    <a href="#">Esqueci minha senha</a><br>

		  </div>
		  <!-- /.login-box-body -->
		</div>

	</body>
<!-- jQuery 2.2.3 -->
<<<<<<< HEAD
<script src="<?php echo $root_html?>es2/web/plugins/jQuery/jquery-2.2.3.min.js"></script>
=======
<script src="<?php echo $root_html?>sistema2/web/plugins/jQuery/jquery-2.2.3.min.js"></script>
>>>>>>> 531fa35a94d580d24220462f95c53a6d0faffe06
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<<<<<<< HEAD
<script src="<?php echo $root_html?>es2/web/bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script> 
<script src="<?php echo $root_html?>es2/web/plugins/morris/morris.min.js"></script>-->
<!-- TinyMCE -->
<script src="<?php echo $root_html?>es2/web/plugins/tinymce/tinymce.min.js"></script>

<!-- Sparkline -->
<script src="<?php echo $root_html?>es2/web/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo $root_html?>es2/web/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo $root_html?>es2/web/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo $root_html?>es2/web/plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?php echo $root_html?>es2/web/plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?php echo $root_html?>es2/web/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo $root_html?>es2/web/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- PACE -->
<script src="<?php echo $root_html?>es2/web/plugins/pace/pace.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo $root_html?>es2/web/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- iCheck -->
<script type="text/javascript" src="<?php echo $root_html?>es2/web/plugins/iCheck/icheck.js"></script>
<!-- Slimscroll -->
<script src="<?php echo $root_html?>es2/web/plugins/mask/mask.js"></script>
<!-- FastClick -->
<script src="<?php echo $root_html?>es2/web/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $root_html?>es2/web/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo $root_html?>es2/web/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo $root_html?>es2/web/js/demo.js"></script>
<script>
	/*new Morris.Line({
	  // ID of the element in which to draw the chart.
	  element: 'revenue-chart',
	  // Chart data records -- each entry in this array corresponds to a point on
	  // the chart.
	  data: [
	    { year: '2008', value: 20 },
	    { year: '2009', value: 10 },
	    { year: '2010', value: 5 },
	    { year: '2011', value: 5 },
	    { year: '2012', value: 20 }
	  ],
	  // The name of the data record attribute that contains x-values.
	  xkey: 'year',
	  // A list of names of data record attributes that contain y-values.
	  ykeys: ['value'],
	  // Labels for the ykeys -- will be displayed when you hover over the
	  // chart.
	  labels: ['Value']
	});
=======
<script src="<?php echo $root_html?>sistema2/web/bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="<?php echo $root_html?>sistema2/web/plugins/morris/morris.min.js"></script>
<!-- TinyMCE -->
<script src="<?php echo $root_html?>sistema2/web/plugins/tinymce/tinymce.min.js"></script>

<!-- Sparkline -->
<script src="<?php echo $root_html?>sistema2/web/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo $root_html?>sistema2/web/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo $root_html?>sistema2/web/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo $root_html?>sistema2/web/plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?php echo $root_html?>sistema2/web/plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?php echo $root_html?>sistema2/web/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo $root_html?>sistema2/web/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- PACE -->
<script src="<?php echo $root_html?>sistema2/web/plugins/pace/pace.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo $root_html?>sistema2/web/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- iCheck -->
<script type="text/javascript" src="<?php echo $root_html?>sistema2/web/plugins/iCheck/icheck.js"></script>
<!-- Slimscroll -->
<script src="<?php echo $root_html?>sistema2/web/plugins/mask/mask.js"></script>
<!-- FastClick -->
<script src="<?php echo $root_html?>sistema2/web/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $root_html?>sistema2/web/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo $root_html?>sistema2/web/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo $root_html?>sistema2/web/js/demo.js"></script>
<script>
>>>>>>> 531fa35a94d580d24220462f95c53a6d0faffe06

	$("#login-email, #login-senha").keypress(function(event) {
		if(event.which == 13){
			$("#logar").click();
		}
<<<<<<< HEAD
	});*/
=======
	});
>>>>>>> 531fa35a94d580d24220462f95c53a6d0faffe06

	$("#logar").click(function(event) {
    	var data = $("#realizarLogin").serialize();

        $.ajax({
<<<<<<< HEAD
            url: '<?php echo $root_html;?>es2/login.php',
=======
            url: '<?php echo $root_html;?>sistema2/login.php',
>>>>>>> 531fa35a94d580d24220462f95c53a6d0faffe06
            type: 'POST',
            data: data,
            success: function (data) {
            	setTimeout(function(){ $('.alerta').show().addClass('alert-success'); $('#alerta_conteudo').html(data);}, 300);
	            

	            setTimeout(function(){ $('.alerta').fadeOut(500).removeClass('alert-success alert-danger', 500);}, 4000);
            },
            error: function (e) {
                $('.resultado_login').html("<span class='ajuda_user'>Nenhum resultado encontrado.</span>");
            }

    	})	
    });
</script>

<?php endif; ?>



