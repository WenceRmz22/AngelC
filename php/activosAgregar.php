<?php

if ( isset($_POST['articulo']) ){

	$categoria 	= mysql_real_escape_string($_POST['articulo']);
	$nombre 	= mysql_real_escape_string($_POST['observaciones']);
	$direccion  = mysql_real_escape_string($_POST['valor']);

	if ( mysql_query("INSERT INTO activos SET fecha='".date("Y-m-d")."',articulo='".$articulo."',observaciones='".$valor."',valor='") ){
		$errorMsg = '<div class="alert alert-success">
				<i class="fa fa-check"></i> Activo agregado correctamente.
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
					<a href="" class="return"><i class="fa fa-mail-reply"></i> Regresar</a>
				</div>
				<i class="fa fa-ticket icon"></i> Agregar Activo
			</header>
			<div class="panel-body">
				<form class="bs-example form-horizontal" action="" method="post">
					<?php echo $errorMsg; ?>
					<div class="row">
						<div class="col-md-12 col-lg-3	">
							<div class="form-group">
								<label class="col-lg-3 control-label">Articulo: </label>
								<div class="col-lg-9"><input type="text" name="articulo" class="form-control" placeholder=""></div>
							</div>
						</div>
						<div class="col-md-12 col-lg-3">
							<div class="form-group">
								<label class="col-lg-3 control-label">Observaciones: </label>
								<div class="col-lg-9"><textarea type="text" name="observaciones" class="form-control" placeholder=""></textarea> </div>
							</div>
						</div>
						<div class="col-md-12 col-lg-3">
							<div class="form-group">
								<label class="col-lg-3 control-label">Valor: </label>
								<div class="col-lg-9"><input type="text" name="valor" class="form-control" placeholder=""></div>
							</div>
						</div>
					</div>
					<div class="line line-dashed line-lg pull-in"></div>
					<div class="form-group text-right">
						<div class="col-lg-12"> 
							<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check icon"></i> Agregar</button>
							<a href="admin.php?m=activos" class="btn btn-sm btn-danger"><i class="fa fa-times icon"></i> Cancelar</a>
						</div>
					</div>
				</form>
			</div>
		</section>
