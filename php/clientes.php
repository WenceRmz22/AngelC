<section class="panel panel-default pos-rlt clearfix">

	<header class="panel-heading"> <i class="fa fa-users"></i> Clientes </header>
	
	<div class="row wrapper">
		<div class="col-sm-2 m-b-xs">
			<a href="admin.php?m=clientesAgregar" class="pull-left btn btn-sm btn-success"><i class="fa fa-plus"></i> Nuevo Cliente </a>
		</div>
		<div class="col-sm-7 m-b-xs text-center">
		</div>
		<div class="col-sm-3">
			<form action="" id="buscarCliente" method="get">
				<div class="input-group">
					<input type="hidden" name="m" value="clientes">
					<input type="text" class="input-sm form-control" name="buscar" placeholder="Buscar">
					<span class="input-group-btn"> <button class="btn btn-sm btn-default" id="buscar" type="submit"> <i class="fa fa-search"></i> </button> </span>
				</div>
			</form>
		</div>
	</div>

	<div class="table-responsive">
		<table class="table table-striped b-t b-light">
			<thead>
				<tr>
					<th width="300">Nombre</th>
					<th width="300">Direcci&oacute;n</th>
					<th>Tel&eacute;fono</th>
					<th>E-mail</th>
					<th width="130"></th>
				</tr>
			</thead>
						<tbody>
<?php
			if ( isset($_GET['del']) ){
				$del = mysql_real_escape_string($_GET['del']);
				mysql_query("DELETE FROM clientes WHERE idclientes='".$del."'");
			}

			if ( isset($_GET['buscar']) ){
				$buscar = mysql_real_escape_string($_GET['buscar']);
				$consulta  = "SELECT * FROM clientes WHERE 
					(nombre LIKE '%".$buscar."%' OR 
						direccion LIKE '%".$buscar."%' OR 
						telefono LIKE '%".$buscar."%' OR 
						email LIKE '%".$buscar."%' OR 
					ORDER BY nombre ASC";
					$url = "admin.php?m=clientes&buscar=".$buscar;
			} else {
				$consulta  = "SELECT * FROM clientes ORDER BY nombre ASC";
				$url = "admin.php?m=clientes";
			}

			##### PAGINADOR #####
			$rows_per_page = 20;

			if(isset($_GET['pag']))
				$page = mysql_real_escape_string($_GET['pag']);
			else if (@$_GET['pag'] == "0")
				$page = 1;
			else 
				$page = 1;

			$num_rows 		= mysql_num_rows(mysql_query($consulta));
			$lastpage		= ceil($num_rows / $rows_per_page);    		
			$page     = (int)$page;
			if($page > $lastpage){
				$page = $lastpage;
			}
			if($page < 1){
				$page = 1;
			}
			$limit 		= 'LIMIT '. ($page -1) * $rows_per_page . ',' .$rows_per_page;
			$consulta  .=" $limit";

			$consulta = mysql_query($consulta);
			##### PAGINADOR #####

			while($q = mysql_fetch_object($consulta)){
?>
				<tr>
					<td><?php echo $q->nombre; ?></td>
					<td><?php echo $q->direccion; ?></td>
					<td><?php echo $q->telefono; ?></td>
					<td><?php echo $q->email; ?></td>
					<td>
						<a href="admin.php?m=clientesEditar&id=<?php echo $q->idclientes; ?>" class="btn btn-sm btn-default"> <i class="fa fa-pencil"></i> </a> &nbsp;&nbsp;&nbsp;
						<a href="admin.php?m=clientes&del=<?php echo $q->idclientes; ?>" class="btn btn-sm btn-danger"> <i class="fa fa-times"></i> </a>
					</td>
				</tr>			
<?php
			}
?>
			</tbody>
		</table>
	</div>
	<footer class="panel-footer">
		<div class="row">
			<div class="col-sm-12 text-right text-center-xs">
				<ul class="pagination pagination-sm m-t-none m-b-none">
<?php
	if($num_rows != 0){
		$nextpage = $page + 1;
		$prevpage = $page - 1;

		if ($page == 1) {
			echo '<li class="disabled"><a href="#"><i class="fa fa-chevron-left"></i></a></li>';
			
			echo '<li class="active"><a href="">1</a></li>';
			
			for($i= $page+1; $i<= $lastpage ; $i++){
				echo '<li><a href="'.$url.'&pag='.$i.'">'.$i.'</a></li> ';
			}

			if($lastpage >$page ){
				echo '<li><a href="'.$url.'&pag='.$nextpage.'"><i class="fa fa-chevron-right"></i></a></li>';
			}else{	
				echo '<li class="disabled"><a href="#"><i class="fa fa-chevron-right"></i></a></li>';
			}
		} else {
			echo '<li><a href="'.$url.'&pag='.$prevpage.'"><i class="fa fa-chevron-left"></i></a></li>';
			
			for($i= 1; $i<= $lastpage ; $i++){
				if($page == $i){
					echo '<li class="active"><a href="#">'.$i.'</a></li>';
				} else {
					echo '<li><a href="'.$url.'&pag='.$i.'">'.$i.'</a></li> ';
				}
			}
         
			if($lastpage >$page ){
				echo '<li><a href="'.$url.'&pag='.$nextpage.'"><i class="fa fa-chevron-right"></i></a></li>';
			} else {
				echo '<li class="disabled"><a href="#"><i class="fa fa-chevron-right"></i></a></li>';
			}
		}
	}
?>
				</ul>
			</div>
		</div>
	</footer>
</section>