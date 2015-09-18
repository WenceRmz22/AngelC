<?php

if ( isset($_POST['servicio']) ){

	$servicio 	= mysql_real_escape_string($_POST['servicio']);
	$tipo 		= mysql_real_escape_string($_POST['tipo']);
	$precio  	= mysql_real_escape_string($_POST['precio']);

	if ( mysql_query("INSERT INTO servicios SET fecha='".date("Y-m-d")."',servicio='".$servicio."',tipo='".$tipo."',precio='".$precio."'") ){
		$errorMsg = '<div class="alert alert-success">
				<i class="fa fa-check"></i> Servicio agregado correctamente.
			</div>';
	} else {
		$errorMsg = '<div class="alert alert-danger">
			<i class="fa fa-times"></i> Error, intenta nuevamente.
		</div>';
	}

}

?>
		<section class="panel panel-default">
			<header class="panel-heading">
				<div class="pull-right">
					<a href="?m=servicios" class="return"><i class="fa fa-mail-reply"></i> Regresar</a>
				</div>
				<i class="fa fa-columns icon"></i> Agregar Servicio
			</header>
			<div class="panel-body">
				<form class="bs-example form-horizontal" action="" method="post">
					<?php echo $errorMsg; ?>
					<div class="row">
						<div class="col-md-12 col-lg-4">
							<div class="form-group">
								<label class="col-lg-3 control-label">Servicio</label>
								<div class="col-lg-9"><input type="text" name="servicio" class="form-control" placeholder=""></div>
							</div>
						</div>
						<div class="col-md-12 col-lg-4">
							<div class="form-group">
								<label class="col-lg-3 control-label">Tipo</label>
								<div class="col-lg-9"><input type="text" name="tipo" class="form-control" placeholder=""></div>
							</div>
						</div>					
						<div class="col-md-12 col-lg-4">
							<div class="form-group">
								<label class="col-lg-3 control-label">Precio</label>
								<div class="col-lg-9"><input type="text" name="precio" class="form-control" placeholder=""></div>
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
