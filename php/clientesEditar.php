<?php
$id = mysql_real_escape_string($_GET['id']);

if ( isset($_POST['nombre']) ){

	$nombre 	= mysql_real_escape_string($_POST['nombre']);
	$email  	= mysql_real_escape_string($_POST['email']);
	$direccion  = mysql_real_escape_string($_POST['direccion']);
	$telefono  	= mysql_real_escape_string($_POST['telefono']);
	$rfc  		= mysql_real_escape_string($_POST['rfc']);
	$cp     	= mysql_real_escape_string($_POST['cp']);

	if ( mysql_query("UPDATE clientes SET nombre='".$nombre."',email='".$email."',direccion='".$direccion."',telefono='".$telefono."',rfc='".$rfc."',cp='".$cp."'") ){
		$errorMsg = '<div class="alert alert-success">
				<i class="fa fa-check"></i> Cliente editado correctamente.
			</div>';
	} else {
		$errorMsg = '<div class="alert alert-danger">
			<i class="fa fa-times"></i> Error, intenta nuevamente.
		</div>';
	}

}

$data = mysql_fetch_object(mysql_query("SELECT * FROM clientes WHERE idclientes='".$id."' LIMIT 1"));

?>
		<section class="panel panel-default">
			<header class="panel-heading">
				<div class="pull-right">
					<a href="?m=clientes" class="return"><i class="fa fa-mail-reply"></i> Regresar</a>
				</div>
				<i class="fa fa-users icon"></i> Editar Cliente
			</header>
			<div class="panel-body">
				<form class="bs-example form-horizontal" action="" method="post">
					<?php echo $errorMsg; ?>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-lg-3 control-label">Nombre</label>
								<div class="col-lg-9"><input type="text" name="nombre" value="<?php echo $data->nombre; ?>" class="form-control" placeholder=""></div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-lg-2 control-label">E-mail</label>
								<div class="col-lg-10"><input type="text" name="email" value="<?php echo $data->email; ?>" class="form-control" placeholder=""></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-lg-3 control-label">Direccion</label>
								<div class="col-lg-9"><input type="text" name="direccion" value="<?php echo $data->direccion; ?>" class="form-control" placeholder=""></div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-lg-2 control-label">Telefono</label>
								<div class="col-lg-10"><input type="text" name="telefono" value="<?php echo $data->telefono; ?>" class="form-control" placeholder=""></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-lg-3 control-label">RFC</label>
								<div class="col-lg-9"><input type="text" name="rfc" value="<?php echo $data->rfc; ?>" class="form-control" placeholder=""></div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-lg-2 control-label">CP</label>
								<div class="col-lg-10"><input type="text" name="cp" value="<?php echo $data->cp; ?>" class="form-control" placeholder="00000"></div>
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
