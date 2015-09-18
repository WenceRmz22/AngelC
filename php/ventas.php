<section class="panel panel-default pos-rlt clearfix">

	<header class="panel-heading"> <i class="fa fa-usd"></i> Ventas </header>
	
	<div class="row wrapper">
		<div class="col-sm-2 m-b-xs">
			<a href="admin.php?m=ventasAgregar" class="pull-left btn btn-sm btn-success"><i class="fa fa-plus"></i> Registrar Venta </a>
		</div>
		<div class="col-sm-7 m-b-xs text-center">
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
					<th >Servicio</th>
					<th width="300">Fecha Incial</th>
					<th width="300">Fecha Entrega</th>
					<th width="300">Costo</th>
					<th width="130"></th>
				</tr>
			</thead>
			<tbody>

				<tr>
					<td>columna 1 </td>
					<td>columna 2 </td>
					<td>columna 3 </td>
					<td>columna 4 </td>
					<td width ="80">
						<a href="admin.php?m=ventasEditar&id=" class="btn btn-sm btn-default"> <i class="fa fa-pencil"></i> </a> &nbsp;&nbsp;&nbsp;
						<a href="admin.php?m=ventas&del=" class="btn btn-sm btn-danger"> <i class="fa fa-times"></i> </a>
					</td>
				</tr>
				<tr>
					<td>columna 1 </td>
					<td>columna 2 </td>
					<td>columna 3 </td>
					<td>columna 4 </td>
					<td width = "80">
						<a href="admin.php?m=ventasEitar&id=" class="btn btn-sm btn-default"> <i class="fa fa-pencil"></i> </a> &nbsp;&nbsp;&nbsp;
						<a href="admin.php?m=ventas&del=" class="btn btn-sm btn-danger"> <i class="fa fa-times"></i> </a>
					</td>
				</tr>

			</tbody>
		</table>
	</div>

</section>