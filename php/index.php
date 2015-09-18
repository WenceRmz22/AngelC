 <div class="row">
<?php
if ($_SESSION['userPv'] == "3"){
?>
	<div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
		<a href="admin.php?m=agentes">
			<div class="panel bg-f403 panel-colorful text-center">
				<div class="panel-body">
					<i class="fa fa-file-o" style="font-size:90px;"></i>
				</div>
				<div class="bg-white" style="padding:5px;">
					<h4 class="mar-no text-thin">Agentes</h4>
				</div>
			</div>
		</a>
	</div>
<?php
}

if ($_SESSION['userPv'] != "3"){
?>
<div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
		<a href="admin.php?m=polizas">
			<div class="panel bg-f403 panel-colorful text-center">
				<div class="panel-body">
					<i class="fa fa-file-text-o" style="font-size:90px;"></i>
				</div>
				<div class="bg-white" style="padding:5px;">
					<h4 class="mar-no text-thin">Polizas</h4>
				</div>
			</div>
		</a>
	</div>
	<div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
		<a href="admin.php?m=clientes">
			<div class="panel bg-f403 panel-colorful text-center">
				<div class="panel-body">
					<i class="fa fa-archive" style="font-size:90px;"></i>
				</div>
				<div class="bg-white" style="padding:5px;">
					<h4 class="mar-no text-thin">Clientes</h4>
				</div>
			</div>
		</a>
	</div>
	<div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
		<a href="admin.php?m=agentes">
			<div class="panel bg-f403 panel-colorful text-center">
				<div class="panel-body">
					<i class="fa fa-male" style="font-size:90px;"></i>
				</div>
				<div class="bg-white" style="padding:5px;">
					<h4 class="mar-no text-thin">Agentes</h4>
				</div>
			</div>
		</a>
	</div>
<?php
}

if ($_SESSION['userPv'] == "1"){
?>
	<div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
		<a href="admin.php?m=aseguradoras">
			<div class="panel bg-f403 panel-colorful text-center">
				<div class="panel-body">
					<i class="fa fa-medkit" style="font-size:90px;"></i>
				</div>
				<div class="bg-white" style="padding:5px;">
					<h4 class="mar-no text-thin">Aseguradoras</h4>
				</div>
			</div>
		</a>
	</div>
	<div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
		<a href="admin.php?m=ramos">
			<div class="panel bg-f403 panel-colorful text-center">
				<div class="panel-body">
					<i class="fa fa-code-fork" style="font-size:90px;"></i>
				</div>
				<div class="bg-white" style="padding:5px;">
					<h4 class="mar-no text-thin">Ramos</h4>
				</div>
			</div>
		</a>
	</div>
	<div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
		<a href="admin.php?m=usuarios">
			<div class="panel bg-f403 panel-colorful text-center">
				<div class="panel-body">
					<i class="fa fa-users" style="font-size:90px;"></i>
				</div>
				<div class="bg-white" style="padding:5px;">
					<h4 class="mar-no text-thin">Usuarios</h4>
				</div>
			</div>
		</a>
	</div>

<?php
}
?>
</div>