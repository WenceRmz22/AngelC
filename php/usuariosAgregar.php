<?php

if ( isset($_POST['nombre']) ){

	$nombre 	= mysql_real_escape_string($_POST['nombre']);
	$privilegio = mysql_real_escape_string($_POST['privilegio']);
	$usuario  	= mysql_real_escape_string($_POST['usuario']);
	$password  	= mysql_real_escape_string($_POST['password']);
	
	if ( mysql_query("INSERT INTO usuarios SET nombre='".$nombre."',privilegio='".$privilegio."',usuario='".$usuario."',password='".md5($password)."'") ){
		$errorMsg = '<div class="alert alert-success">
				<i class="fa fa-check"></i> Usuario agregado correctamente.
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
				<i class="fa fa-plus-square icon"></i> Agregar Usuario
			</header>
			<div class="panel-body">
				<form class="bs-example form-horizontal" action="" method="post">
					<?php echo $errorMsg; ?>
					<div class="row">
						<div class="col-md-12 col-lg-6">
							<div class="form-group">
								<label class="col-lg-3 control-label">Nombre</label>
								<div class="col-lg-9"><input type="text" name="nombre" class="form-control" placeholder="Nombre Completo"></div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-lg-3 control-label">Privilegios</label>
								<div class="col-lg-9">
									<select name="privilegio" id="option" class="form-control">
										<option value="1">Administrador</option>
										<option value="2">Secretaria</option>
										<option value="3">Diseñador</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 col-lg-6">
							<div class="form-group">
								<label class="col-lg-3 control-label">Usuario</label>
								<div class="col-lg-9"><input type="text" name="usuario" class="form-control" placeholder="Nombre de Usuario"></div>
							</div>
						</div>
						<div class="col-md-12 col-lg-6">
							<div class="form-group">
								<label class="col-lg-3 control-label">Contraseña</label>
								<div class="col-lg-9"><input type="text" name="password" class="form-control" placeholder="Contraseña"></div>
							</div>
						</div>
					</div>
					<div class="line line-dashed line-lg pull-in"></div>
					<div class="form-group text-right">
						<div class="col-lg-12"> 
							<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check icon"></i> Agregar</button>
							<a href="admin.php?m=usuarios" class="btn btn-sm btn-danger"><i class="fa fa-times icon"></i> Cancelar</a>
						</div>
					</div>
				</form>
			</div>
		</section>
