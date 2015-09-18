<?php
$id = mysql_real_escape_string($_GET['id']);

if ( isset($_POST['articulo']) ){

	$articulo 		= mysql_real_escape_string($_POST['articulo']);
	$marca 			= mysql_real_escape_string($_POST['marca']);
	$tipo  			= mysql_real_escape_string($_POST['tipo']);
	$stock  		= mysql_real_escape_string($_POST['stock']);
	$precio      	= mysql_real_escape_string($_POST['precio']);
	$precioventa  	= mysql_real_escape_string($_POST['precioventa']);
	$observaciones  	= mysql_real_escape_string($_POST['observaciones']);

	if ( mysql_query("UPDATE stock SET fecha='".date("Y-m-d")."',articulo='".$articulo."',marca='".$marca."',tipo='".$tipo."',stock='".$stock."',precio='".$precio."',precioventa='".$precioventa."',observaciones='".$observaciones."'") ){
		$errorMsg = '<div class="alert alert-success">
				<i class="fa fa-check"></i> Objeto editado correctamente.
			</div>';
	} else {
		$errorMsg = '<div class="alert alert-danger">
			<i class="fa fa-times"></i> Error, intenta nuevamente.
		</div>';
	}

}

$data = mysql_fetch_object(mysql_query("SELECT * FROM stock WHERE idstock='".$id."' LIMIT 1"));

?>
		<section class="panel panel-default">
			<header class="panel-heading">
				<div class="pull-right">
					<a href="" class="return"><i class="fa fa-mail-reply"></i> Regresar</a>
				</div>
				<i class="fa fa-users icon"></i> Editar Cliente
			</header>
			<div class="panel-body">
				<form class="bs-example form-horizontal" action="" method="post">
					<?php echo $errorMsg; ?>
					<div class="row">
						<div class="col-md-12 col-lg-6">
							<div class="form-group">
								<label class="col-lg-3 control-label">Articulo</label>
								<div class="col-lg-9"><input type="text" name="articulo" value="<?php echo $data->articulo; ?>" class="form-control" placeholder=""></div>
							</div>
						</div>
						<div class="col-md-12 col-lg-6">
							<div class="form-group">
								<label class="col-lg-3 control-label">Marca</label>
								<div class="col-lg-9"><input type="text" name="marca" value="<?php echo $data->marca; ?>" class="form-control" placeholder=""></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 col-lg-6">
							<div class="form-group">
								<label class="col-lg-3 control-label">Tipo</label>
								<div class="col-lg-9"><input type="text" name="tipo" value="<?php echo $data->tipo; ?>" class="form-control" placeholder=""></div>
							</div>
						</div>
						<div class="col-md-12 col-lg-6">
							<div class="form-group">
								<label class="col-lg-3 control-label">Stock</label>
								<div class="col-lg-9"><input type="text" name="stock" value="<?php echo $data->stock; ?>" class="form-control" placeholder=""></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label class="col-lg-6 control-label">Precio</label>
								<div class="col-lg-6"><input type="text" name="precio" value="<?php echo $data->precio; ?>" class="form-control" placeholder=""></div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="col-lg-6 control-label">Precio Venta</label>
								<div class="col-lg-6"><input type="text" maxlength="" name="precioventa" value="<?php echo $data->precioventa; ?>" class="form-control" placeholder=""></div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-lg-3 control-label">Observaciones</label>
								<div class="col-lg-9"><textarea class="form-control" name="observaciones" value="<?php echo $data->observaciones; ?>" style="height:85px;" placeholder=""></textarea></div>
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