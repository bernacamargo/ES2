<?php 

include '../../../web/seguranca.php';

$numero = $_POST['numero'];
$nivel = $_POST['nivel'];
$genero = $_POST['genero'];

$query = "SELECT * FROM maratona_questoes WHERE";

if(!empty($_POST['nivel']))
	$query .= " nivel = '$nivel'";

if(!empty($_POST['numero']) && !empty($_POST['nivel']))
	$query .= " AND numero = '$numero'";
elseif(!empty($_POST['numero']) && empty($_POST['nivel']))
	$query .= " numero = '$numero'";

if(!empty($_POST['genero']) && !empty($_POST['numero']))
	$query .= " AND genero = '$genero'";
elseif(!empty($_POST['genero']) && empty($_POST['numero']))
	$query .= " genero = '$genero'";

$res = mysql_query($query);

// echo '<script>alert("'.$query.'")</script>';

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
						Perguntas: 	<br>
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

		
	<?php $i++; 	endwhile;

	echo '</div>';
}
else {
	echo '<div class="alert alert-danger text-center">Nenhum resultado encontrado!</div>';
}

 ?>