<?php

if ( isset($_POST['articulo']) ){

	$articulo 		= mysql_real_escape_string($_POST['articulo']);
	$marca 			= mysql_real_escape_string($_POST['marca']);
	$tipo  			= mysql_real_escape_string($_POST['tipo']);
	$stock  		= mysql_real_escape_string($_POST['stock']);
	$precio      	= mysql_real_escape_string($_POST['precio']);
	$precioventa  	= mysql_real_escape_string($_POST['precioventa']);
	$observaciones  	= mysql_real_escape_string($_POST['observaciones']);

	if ( mysql_query("INSERT INTO stock SET fecha='".date("Y-m-d")."',articulo='".$articulo."',marca='".$marca."',tipo='".$tipo."',stock='".$stock."',precio='".$precio."',precioventa='".$precioventa."',observaciones='".$observaciones."'") ){
		$errorMsg = '<div class="alert alert-success">
				<i class="fa fa-check"></i> Cliente agregado correctamente.
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
				<i class="fa fa-file-text-o"></i> Agregar Objeto
			</header>
			<div class="panel-body">
				<form class="bs-example form-horizontal" action="" method="post">
					<?php echo $errorMsg; ?>
					<div class="row">
						<div class="col-md-12 col-lg-6">
							<div class="form-group">
								<label class="col-lg-3 control-label">Articulo</label>
								<div class="col-lg-9"><input type="text" name="articulo" class="form-control" placeholder=""></div>
							</div>
						</div>
						<div class="col-md-12 col-lg-6">
							<div class="form-group">
								<label class="col-lg-3 control-label">Marca</label>
								<div class="col-lg-9"><input type="text" name="marca" class="form-control" placeholder=""></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 col-lg-6">
							<div class="form-group">
								<label class="col-lg-3 control-label">Tipo</label>
								<div class="col-lg-9"><input type="text" name="tipo" class="form-control" placeholder=""></div>
							</div>
						</div>
						<div class="col-md-12 col-lg-6">
							<div class="form-group">
								<label class="col-lg-3 control-label">Stock</label>
								<div class="col-lg-9"><input type="text" name="stock" class="form-control" placeholder=""></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label class="col-lg-6 control-label">Precio</label>
								<div class="col-lg-6"><input type="text" name="precio" class="form-control" placeholder=""></div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="col-lg-6 control-label">Precio Venta</label>
								<div class="col-lg-6"><input type="text" maxlength="" name="precioventa" class="form-control" placeholder=""></div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-lg-3 control-label">Observaciones</label>
								<div class="col-lg-9"><textarea class="form-control" name="observaciones" style="height:85px;" placeholder=""></textarea></div>
							</div>
						</div>
					</div>
					<div class="line line-dashed line-lg pull-in"></div>
					<div class="form-group text-right">
						<div class="col-lg-12"> 
							<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check icon"></i> Agregar</button>
							<a href="admin.php?m=stock" class="btn btn-sm btn-danger"><i class="fa fa-times icon"></i> Cancelar</a>
						</div>
					</div>
				</form>
			</div>
		</section>
