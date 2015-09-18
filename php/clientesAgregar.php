<?php

if ( isset($_POST['nombre']) ){

	$nombre 	= mysql_real_escape_string($_POST['nombre']);
	$email  	= mysql_real_escape_string($_POST['email']);
	$direccion  = mysql_real_escape_string($_POST['direccion']);
	$telefono  	= mysql_real_escape_string($_POST['telefono']);
	$rfc  		= mysql_real_escape_string($_POST['rfc']);
	$cp  	    = mysql_real_escape_string($_POST['cp']);

	if ( mysql_query("INSERT INTO clientes SET fecha='".date("Y-m-d")."',nombre='".$nombre."',email='".$email."',direccion='".$direccion."',telefono='".$telefono."',rfc='".$rfc."',cp='".$cp."'") ){
		$errorMsg = '<div class="alert alert-success">
				<i class="fa fa-check"></i> Cliente agregado correctamente.
			</div>';
	} else {
		$errorMsg = '<div class="alert alert-danger">
			<i class="fa fa-times"></i> Error, intenta nuevamente.
		</div>';
		$errorMsg = "INSERT INTO clientes SET fecha='".date("Y-m-d")."',nombre='".$nombre."',email='".$email."',direccion='".$direccion."',telefono='".$telefono."',rfc='".$rfc."',cp='".$cp."'";
	}

}

?>
		<section class="panel panel-default">
			<header class="panel-heading">
				<div class="pull-right">
					<a href="?m=clientes" class="return"><i class="fa fa-mail-reply"></i> Regresar</a>
				</div>
				<i class="fa fa-users icon"></i> Agregar Cliente
			</header>
			<div class="panel-body">
				<form class="bs-example form-horizontal" action="" method="post">
					<?php echo $errorMsg; ?>
					<div class="row">
						<div class="col-md-12 col-lg-6">
							<div class="form-group">
								<label class="col-lg-3 control-label">Nombre</label>
								<div class="col-lg-9"><input type="text" name="nombre" class="form-control" placeholder="Nombre de Cliente"></div>
							</div>
						</div>
						<div class="col-md-12 col-lg-6">
							<div class="form-group">
								<label class="col-lg-3 control-label">E-mail</label>
								<div class="col-lg-9"><input type="text" name="email" class="form-control" placeholder="correo@servidor.com"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 col-lg-6">
							<div class="form-group">
								<label class="col-lg-3 control-label">Direcci&oacute;n</label>
								<div class="col-lg-9"><input type="text" name="direccion" class="form-control" placeholder=""></div>
							</div>
						</div>
						<div class="col-md-12 col-lg-6">
							<div class="form-group">
								<label class="col-lg-3 control-label">Tel&eacute;fono</label>
								<div class="col-lg-9"><input type="text" name="telefono" class="form-control" placeholder=""></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-lg-3 control-label">RFC</label>
								<div class="col-lg-9"><input type="text" name="rfc" class="form-control" placeholder=""></div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-lg-3 control-label">Codigo Postal</label>
								<div class="col-lg-9"><input type="text" maxlength="5" name="cp" class="form-control" placeholder="00000"></div>
							</div>
						</div>
					</div>
					<div class="line line-dashed line-lg pull-in"></div>
					<div class="form-group text-right">
						<div class="col-lg-12"> 
							<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check icon"></i> Agregar</button>
							<a href="admin.php?m=clientes" class="btn btn-sm btn-danger"><i class="fa fa-times icon"></i> Cancelar</a>
						</div>
					</div>
				</form>
			</div>
		</section>
