<?php

if ( isset($_POST['nombre']) ){

	$articulo 	= mysql_real_escape_string($_POST['articulo']);
	$marca 		= mysql_real_escape_string($_POST['marca']);
	$cantidad 	= mysql_real_escape_string($_POST['cantidad']);
	$telefono  	= mysql_real_escape_string($_POST['punitario']);
	$punitario  = mysql_real_escape_string($_POST['contacto']);
	$total  	= mysql_real_escape_string($_POST['total']);

	if ( mysql_query("INSERT INTO requisiciones SET fecha='".date("Y-m-d")."',articulo='".$articulo."',marca='".$marca."',cantidad='".$cantidad."',punitario='".$punitario."',total='".$total."'") ){
		$errorMsg = '<div class="alert alert-success">
				<i class="fa fa-check"></i> Requisicion solicitada correctamente.
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
				<i class="fa fa-shopping-cart icon"></i> Agregar Requisicion
			</header>
			<div class="panel-body">
				<form class="bs-example form-horizontal" action="" method="post">
					<?php echo $errorMsg; ?>
					<div class="row">
						<div class="col-sm-8">
							<div class="col-md-12 col-lg-4">
								<div class="form-group">
									<label class="col-lg-3 control-label">Articulo</label>
									<div class="col-lg-9"><input type="text" name="articulo" class="form-control" placeholder=""></div>
								</div>
							</div>
							<div class="col-md-12 col-lg-4">
								<div class="form-group">
									<label class="col-lg-3 control-label">Marca</label>
									<div class="col-lg-9"><input type="text" name="marca" class="form-control" placeholder=""></div>
								</div>
							</div>
							<div class="col-md-12 col-lg-4">
								<div class="form-group">
									<label class="col-lg-3 control-label">Cantidad</label>
									<div class="col-lg-9"><input type="text" name="cantidad" class="form-control" placeholder=""></div>
								</div>
							</div>
							<div class="col-md-4"></div>
							<div class="col-md-12 col-lg-4">
								<div class="form-group">
									<label class="col-lg-3 control-label">P. Unitario</label>
									<div class="col-lg-9"><input type="text" name="punitario" class="form-control" placeholder=""></div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="col-lg-3 control-label">Total</label>
									<div class="col-lg-9"><input type="text" name="total" class="form-control" placeholder=""></div>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-lg-3 control-label">Informcion Adicional</label>
								<div class="col-lg-9"><textarea style="height:80px;" type="text" name="total" class="form-control" placeholder=""></textarea></div>
							</div>
						</div>
					</div>
					<div class="line line-dashed line-lg pull-in"></div>
					<div class="form-group text-right">
						<div class="col-lg-12"> 
							<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check icon"></i> Solicitar</button>
							<a href="admin.php?m=stock" class="btn btn-sm btn-danger"><i class="fa fa-times icon"></i> Cancelar</a>
						</div>
					</div>
				</form>
			</div>
		</section>
