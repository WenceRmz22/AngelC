<?php
$id = mysql_real_escape_string($_GET['id']);

if ( isset($_POST['servicio']) ){

	$servicio 	= mysql_real_escape_string($_POST['servicio']);
	$tipo 		= mysql_real_escape_string($_POST['tipo']);
	$precio  	= mysql_real_escape_string($_POST['precio']);

	if ( mysql_query("UPDATE servicios SET servicio='".$servicio."',tipo='".$tipo."',precio='".$precio."'WHERE idservicios='".$id."'") ){
		$errorMsg = '<div class="alert alert-success">
				<i class="fa fa-check"></i> Servicio editado correctamente.
			</div>';
	} else {
		$errorMsg = '<div class="alert alert-danger">
			<i class="fa fa-times"></i> Error, intenta nuevamente.
		</div>';
	}

}

$data = mysql_fetch_object(mysql_query("SELECT * FROM servicios WHERE idservicios='".$id."' LIMIT 1"));

?>
		<section class="panel panel-default">
			<header class="panel-heading">
				<div class="pull-right">
					<a href="?m=servicios" class="return"><i class="fa fa-mail-reply"></i> Regresar</a>
				</div>
				<i class="fa fa-columns icon"></i> Editar Servicio
			</header>
			<div class="panel-body">
				<form class="bs-example form-horizontal" action="" method="post">
					<?php echo $errorMsg; ?>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label class="col-lg-3 control-label">Servicio</label>
								<div class="col-lg-9"><input type="text" name="servicio" value="<?php echo $data->servicio; ?>" class="form-control" placeholder=""></div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="col-lg-2 control-label">Tipo</label>
								<div class="col-lg-10"><input type="text" name="tipo" value="<?php echo $data->tipo; ?>" class="form-control" placeholder=""></div>
							</div>
						</div>					
						<div class="col-md-4">
							<div class="form-group">
								<label class="col-lg-3 control-label">Precio</label>
								<div class="col-lg-9"><input type="text" name="precio" value="<?php echo $data->precio; ?>" class="form-control" placeholder=""></div>
							</div>
						</div>
					</div>
					<div class="line line-dashed line-lg pull-in"></div>
					<div class="form-group text-right">
						<div class="col-lg-12"> 
							<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check icon"></i> Agregar</button>
							<a href="admin.php?m=servicios" class="btn btn-sm btn-danger"><i class="fa fa-times icon"></i> Cancelar</a>
						</div>
					</div>
				</form>
			</div>
		</section>
