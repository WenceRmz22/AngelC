<section class="panel panel-default pos-rlt clearfix">

	<header class="panel-heading"> <i class="fa  "></i> Stock </header>
	
	<div class="row wrapper">
		<div class="col-sm-2 m-b-xs">
			<a href="admin.php?m=stockAgregar" class="pull-left btn btn-sm btn-success"><i class="fa fa-plus"></i> Registrar Objeto </a>
		</div>
		<div class="col-sm-7 m-b-xs text-center">
			<a href="admin.php?m=requisicion" class="btn btn-warning btn-sm"><i class="fa fa-shopping-cart"> Requisicion</i></a>&nbsp;
			<a href="admin.php?m=listareq" class="btn btn-default btn-sm"><i class="fa fa-file" > Historial de Requisiciones</i></a>
		</div>
		<div class="col-sm-3">
			<div class="input-group">
				<input type="text" class="input-sm form-control" placeholder="Buscar"> <span class="input-group-btn"> <button class="btn btn-sm btn-default" type="button"> <i class="fa fa-search"></i> </button> </span>
			</div>
		</div>
	</div>

	<div class="table-responsive">
		<table class="table table-striped b-t b-light">
			<thead>
				<tr>
					<th>Articulo</th>
					<th>Marca</th>
					<th>Tipo</th>
					<th>Stock</th>
					<th width="150">Precio</th>
					<th width="150">Precio Venta</th>
					<th width="120"></th>
				</tr>
			</thead>
			<tbody>
<?php
			if ( isset($_GET['del']) ){
				$del = mysql_real_escape_string($_GET['del']);
				mysql_query("DELETE FROM stock WHERE idstock='".$del."'");
			}

			if ( isset($_GET['buscar']) ){
				$buscar = mysql_real_escape_string($_GET['buscar']);
				$consulta  = "SELECT * FROM stock WHERE 
					(articulo LIKE '%".$buscar."%' OR 
						marca LIKE '%".$buscar."%' OR 
						tipo LIKE '%".$buscar."%' OR 
						stock LIKE '%".$buscar."%' OR 
						observaciones LIKE '%".$buscar."%') 
					ORDER BY articulo ASC";
					$url = "admin.php?m=stock&buscar=".$buscar;
			} else {
				$consulta  = "SELECT * FROM stock ORDER BY articulo ASC";
				$url = "admin.php?m=stock";
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
				$stock = $q->stock;
				// $bandera = ($q->stock_alarma<=$stock);
				$bandera = ($stock <= 5);

?>
				<tr title="Volver a Ordenar" <?php echo ($bandera)?'Style="color:red;"':'Style="color:black"' ?>>
					<td><?php echo $q->articulo; ?></td>
					<td><?php echo $q->marca; ?></td>
					<td><?php echo $q->tipo; ?></td>

					<td><?php echo ($bandera)?'<a Style="color:red !important;" class="btn btn-sm btn-default" href="admin.php?m=stockAgregar&id='.$q->idstock.'">':''; ?>
						<?php echo $q->stock;
						echo ($bandera)?' &nbsp;&nbsp;<i  class="fa fa-truck icon"></i></a>':''; 
						 ?>
					</td>


					<td><?php echo $q->precio; ?></td>
					<td><?php echo $q->precioventa; ?></td>
					<td>
						<a href="admin.php?m=stockEditar&id=<?php echo $q->idstock; ?>" class="btn btn-sm btn-default"> <i class="fa fa-pencil"></i> </a> &nbsp;&nbsp;&nbsp;
						<a href="admin.php?m=stock&del=<?php echo $q->idstock; ?>" class="btn btn-sm btn-danger"> <i class="fa fa-times"></i> </a>
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