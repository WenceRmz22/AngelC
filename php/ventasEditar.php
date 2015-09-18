<?php

$id = mysql_real_escape_string($_GET['id']);

if ( isset($_POST['descripcionPago']) ){
	$descripcionPago 	= mysql_real_escape_string($_POST['descripcionPago']);
	$metodoPago 		= mysql_real_escape_string($_POST['metodoPago']);
	$cantidadPago 		= mysql_real_escape_string($_POST['cantidadPago']);

	mysql_query("INSERT INTO pagos SET ordenId='".$id."',fecha='".date("Y-m-d")."',metodopago='".$metodoPago."',descripcion='".$descripcionPago."',cantidad='".$cantidadPago."'");
}

if ( isset($_POST['cliente']) ){

	$clienteId  = $_POST['cliente'][0];
	$fecha 		= $_POST['fecha'];
	$factura 	= @$_POST['factura'];
	$metodopago = @$_POST['metodopago'];
	$anticipo   = @$_POST['anticipo'];

	mysql_query("UPDATE ventas SET clienteId='".$clienteId."',fecha='".$fecha."',factura='".$factura."' WHERE idorden='".$id."'");

	$servicio 		= $_POST['servicio'];
	$descripcion 	= $_POST['descripcion'];
	$preciou 		= $_POST['preciounitario'];
	$cantidad 		= $_POST['cantidad'];
	$total 			= $_POST['precio'];
	$sql 			= array();

	mysql_query("DELETE FROM servicios WHERE ventasId='".$id."'");

	for ($i=0; $i < count($servicio); $i++) { 
		$sql[] = "(".$id.",'".$servicio[$i]."','".$descripcion[$i]."','".$preciou[$i]."','".$cantidad[$i]."','".$total[$i]."')";
	}
	
	mysql_query("INSERT INTO servicios(ventasId,servicio,descripcion,unitario,cantidad,precio) VALUES ".implode(",", $sql));
	
	if ( !empty($_POST['anticipo']) ){
		mysql_query("INSERT INTO pagos SET ventasId='".$id."',fecha='".$fecha."',descripcion='Anticipo',cantidad='".$anticipo."',metodopago='".$metodopago."'");
	}

	$errorMsg = '<div class="alert alert-success">
				<i class="fa fa-check"></i> Venta con ID: <strong>'.$id.'</strong> agregada correctamente.
			</div>';

}

$data = mysql_fetch_object(mysql_query("SELECT * FROM ventas WHERE idventa='".$id."' LIMIT 1"));
?>
<div class="modal fade" id="modal-form">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12">
						<h3 class="m-t-none m-b">Agregar Pago</h3>
						<form role="form" action="admin.php?m=ventasEditar&id=<?php echo $data->idventa; ?>#pagoAlert" method="post">
							<div class="form-group">
								<input type="text" class="form-control" name="descripcionPago" id="descripcionPago" placeholder="Descripcion">
							</div>
							<div class="row">
								<div class="form-group col-md-6">
									<select class="form-control" name="metodoPago" id="metodoPago">
										<option>Metodo de pago</option>
										<option>Efectivo</option>
										<option>Tarjeta</option>
										<option>Transferencia</option>
										<option>Cheque</option>
									</select>
								</div>
								<div class="form-group col-md-6">
									<input type="text" class="form-control" name="cantidadPago" id="cantidadPago" placeholder="Cantidad">
								</div>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-sm btn-success pull-right text-uc m-t-n-xs"><strong><i class="fa fa-check"></i> Agregar Pago</strong></button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div><!-- /.modal-content --> 
	</div><!-- /.modal-dialog -->
</div>

		<section class="panel panel-default">
			<header class="panel-heading">
				<div class="pull-right">
					<a href="" class="return"><i class="fa fa-mail-reply"></i> Regresar </a>
				</div>
				<i class="fa fa-pencil icon"></i> Editar Venta: <?php echo $data->idventa; ?>
			</header>
			<div class="panel-body">
				<form class="bs-example form-horizontal" action="" method="post">
					<?php echo $errorMsg; ?>
					<div class="row">
						<div class="col-md-offset-9 col-md-3">
							<div class="form-group">
								<label class="col-md-3 control-label">Fecha</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="fecha" placeholder="" value="<?php echo $data->fecha; ?>">
									<!-- <input class="input-sm input-s datepicker-input form-control" size="16" type="text" value="12-02-2013" data-date-format="dd-mm-yyyy"> -->
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-9">
							<div class="form-group">
								<label class="col-md-2 control-label"> Cliente </label>
								<div class="col-md-10">
									<input type="text" name="cliente[]" value="[<?php echo $data->clienteId; ?>]" class="form-control" id="magicsuggest"> 
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="col-md-3 control-label"> Factura </label>
								<div class="col-md-9">
									<select class="form-control" name="factura" id="factura">
										<option <?php if ($data->factura == "No") echo "selected"; ?>>No</option>
										<option <?php if ($data->factura == "Si") echo "selected"; ?>>Si</option>	
									</select>
								</div>
							</div>
						</div>	
					</div>
					<div class="row">
						<div class="row wrapper">
							<div class="col-md-12" >
								<div class="input-group pull-right">
									<button class="btn btn-sm btn-success" id="agregar" type="button"> <i class="fa fa-plus"> Servicio </i></button>
								</div>
							</div>
						</div>
						<div class="table-responsive">
							<table class="table table-striped b-t b-light" id="tabla1">
								<thead>
									<tr>
										<th>SERVICIO/DESCRIPCION</th>
										<th width="100">P/UNIT</th>
										<th width="100">CANTIDAD</th>
										<th width="120">PRECIO</th>
										<th width="50"></th>
									</tr>
								</thead>
								<tbody>
<?php
								$total     = 0;
								$servicios = mysql_query("SELECT * FROM servicios WHERE ventasId='".$data->idorden."' ORDER BY idservicio ASC");
								while($s = mysql_fetch_object($servicios)){
									$total += $s->precio;
?>
									<tr>
										<td>
											<input type="text" value="<?php echo $s->servicio; ?>" name="servicio[]" class="form-control m-b" placeholder="Servicio">
											<textarea class="form-control" name="descripcion[]" style="height:100px;" placeholder="Descripcion"><?php echo $s->descripcion; ?></textarea>
										</td>
										<td class="v-middle">
											<input type="text" value="<?php echo $s->unitario; ?>"name="preciounitario[]" class="form-control preciounitario">
										</td>
										<td class="v-middle">
											<input type="text" value="<?php echo $s->cantidad; ?>" name="cantidad[]" value="1" class="form-control cantidad">
										</td>
										<td class="v-middle">
											<input type="text" value="<?php echo $s->precio; ?>" name="precio[]" class="form-control precio" readonly>
										</td>
										<td class="v-middle"><button class="btn btn-sm btn-default clsEliminarFila"> <i class="fa fa-trash-o"></i></button></td>
									</tr>
<?php
								}
?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-4 pull-right">
							<h4>&nbsp;</h4>
							<table class="table table-striped">
								<tr>
									<th>Subtotal: </th>
									<td class="text-right"> $ <span id="subtotal">0.00</span> pesos</td>
								</tr>
								<tr>
									<th>IVA 16%: </th>
									<td class="text-right"> $ <span id="iva">0.00 </span> pesos</td>
								</tr>
								<tr>
									<th>Total: </th>
									<td class="text-right"> $ <span id="total"> 0.00 </span> pesos</td>
								</tr>
<?php
					$consulta = "SELECT * FROM pagos WHERE ordenId='".$data->idorden."'";
					if ( !mysql_num_rows(mysql_query($consulta)) ){
					} else {
						$suma  = 0;
						$html  = "";
						$iva   = "";
						$pagos = mysql_query("SELECT * FROM pagos WHERE ordenId='".$data->idorden."'");
						while($pago = mysql_fetch_object($pagos)){
							$suma += $pago->cantidad;

							$html .= "<tr>
										<td>".$pago->fecha."</td>
										<td>".$pago->metodopago."</td>
										<td>".$pago->descripcion."</td>
										<td class='text-right'>$ ".$pago->cantidad." pesos</td>
									</tr>";
						}

						if ( $data->factura == "Si"){
							$iva 	= $total * .16;
						}

						$restan = ($total + $iva) - $suma;
?>
							<tr class="text-success">
								<th>Abonado:</th>
								<td class="text-right">
									$ <?php echo $suma; ?> pesos
								</td>
							</tr>
							<tr class="text-danger">
								<th>Restan: </th>
								<td class="text-right">
									$ <?php echo $restan; ?> pesos
								</td>
							</tr>
<?php
					}
?>
							</table>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<h4>Pagos <a href="#modal-form" data-toggle="modal" id="agregarPago" class="btn btn-xs btn-success"> <i class="fa fa-plus"></i> Agregar Pago</a></h4>
							
<?php
						if ( isset($_POST['descripcionPago']) ){
							echo '<div class="alert alert-success" id="pagoAlert">
								<i class="fa fa-check"></i> Pago agregado correctamente: '.$descripcionPago.' > '.$cantidadPago.' '.$metodoPago.'
							</div>';
						}
?>
							
							<div class="table-responsive">
								<table class="table table-striped">
									<tr>
										<th width="100">Fecha</th>
										<th width="140">Metodo Pago</th>
										<th>Descripcion</th>
										<th width="120">Cantidad</th>
									</tr>
	<?php
								if (isset($html))
									echo $html;
	?>
								</table>
							</div>
						</div>
					</div>
					<div class="line line-dashed line-lg pull-in"></div>
					<div class="form-group text-right">
						<div class="col-lg-12"> 
							<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check icon"></i> Finalizar Venta</button>
							<a href="admin.php?m=ventas" class="btn btn-sm btn-danger"><i class="fa fa-times icon"></i> Cancelar</a>
						</div>
					</div>
				</form>
			</div>
		</section>

<script type="text/javascript">
function actualizarSaldos(){
	var paso = 1;
	var preciounitario;
	var cantidad;
	var subtotal = 0;
	var iva;
	var suma;

	$('.preciounitario, .cantidad, .precio').each(function(){
		if (paso == 1){
			preciounitario = parseFloat($(this).val());
			paso = 2;
		} else if (paso == 2){
			cantidad = parseFloat($(this).val());
			paso = 3;
		} else {
			suma 		= preciounitario * cantidad;			
			subtotal   += suma;

			$(this).val( suma.toFixed(2) );
			$("#subtotal").html(subtotal.toFixed(2));

			if ( $("#factura").val() == "Si"){
				iva = parseFloat(subtotal) * .16;
				$("#iva").html(iva);
				var total = subtotal + iva;
				$("#total").html(total.toFixed(2));
			} else {
				$("#iva").html("0.00");
				$("#total").html(subtotal.toFixed(2));
			}
			
			paso = 1;
		}
	});
}
	$(function(){
		actualizarSaldos();

		$("#factura").change(actualizarSaldos);

		$(document).on('change','.preciounitario', actualizarSaldos);
		$(document).on('change','.cantidad', actualizarSaldos);

    	var ms = $('#magicsuggest').magicSuggest({
				        data: 'php/clientesJSON.php',
				        allowFreeEntries: false,
				        valueField: 'idcliente',
				        displayField: 'nombre',
				        mode: 'remote',
				        renderer: function(data){
				            return '<div>' +
				                    '<div class="name">' + data.nombre + '</div>' +
				                    '<div class="val">' + data.direccion + '</div>' +
				                    '<div style="clear:both;"></div>' +
				                '</div>';
				        },
				        resultAsString: true,
				        selectionRenderer: function(data){
				            return '<div style="float:left;">' + data.nombre + '</div>';
				        }
    			});

	});

	var contador = 1;
    $("#agregar").click(function(){
    	contador++;

        var nuevaFila = '<tr>'+
                                '<td>'+
									'<input type="text" name="servicio[]" class="form-control m-b" placeholder="Servicio">'+
									'<textarea class="form-control" name="descripcion[]" style="height:100px;" placeholder="Descripcion"></textarea>'+
								'</td>'+
								'<td class="v-middle">'+
									'<input type="text" name="preciounitario[]" class="form-control preciounitario">'+
								'</td>'+
								'<td class="v-middle">'+
									'<input type="text" name="cantidad[]" value="1" class="form-control cantidad">'+
								'</td>'+
								'<td class="v-middle">'+
									'<input type="text" name="precio[]" class="form-control precio" readonly>'+
								'</td>'+
                                '<td class="v-middle"><button class="btn btn-sm btn-default clsEliminarFila"> <i class="fa fa-trash-o"></i></button></td>'+
                            '</tr>';
        $('table#tabla1 tr:last').after(nuevaFila);
        return false;
    });

    $(document).on('click','.clsEliminarFila',function(){

    	var paso = 1;
		var preciounitario;
		var cantidad;
		var subtotal = 0;
		var iva;
		var suma;

		$('.preciounitario, .cantidad, .precio').each(function(){
			if (paso == 1){
				preciounitario = parseFloat($(this).val());
				paso = 2;
			} else if (paso == 2){
				cantidad = parseFloat($(this).val());
				paso = 3;
			} else {
				suma 		= preciounitario * cantidad;			
				subtotal   += suma;

				$(this).val( suma.toFixed(2) );
				$("#subtotal").html(subtotal.toFixed(2));

				if ( $("#factura").val() == "Si"){
					iva = parseFloat(subtotal) * .16;
					$("#iva").html(iva);
					var total = subtotal + iva;
					$("#total").html(total.toFixed(2));
				} else {
					$("#iva").html("0.00");
					$("#total").html(subtotal.toFixed(2));
				}
				
				paso = 1;
			}
		});

    	contador--;
		var objFila = $(this).parents().get(1);
		$(objFila).remove();
	});
</script>