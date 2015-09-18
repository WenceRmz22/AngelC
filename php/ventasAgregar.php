<?php
 
if ( isset($_POST['cliente']) ){

	$clienteId  = mysql_real_escape_string($_POST['cliente'][0]);
	$fecha 		= mysql_real_escape_string($_POST['fecha']);
	$factura 	= mysql_real_escape_string($_POST['factura']);
	$metodopago = mysql_real_escape_string($_POST['metodopago']);
	$anticipo   = mysql_real_escape_string($_POST['anticipo']);

	mysql_query("INSERT INTO ventas SET clienteId='".$clienteId."',fecha='".$fecha."',factura='".$factura."'");

	$ordenId = mysql_insert_id();

	$servicio 		= $_POST['servicio'];
	$descripcion 	= $_POST['descripcion'];
	$preciou 		= $_POST['preciounitario'];
	$cantidad 		= $_POST['cantidad'];
	$total 			= $_POST['precio'];
	$sql 			= array();

	for ($i=0; $i < count($servicio); $i++) { 
		$sql[] = "(".$ordenId.",'".mysql_real_escape_string($servicio[$i])."','".mysql_real_escape_string($descripcion[$i])."','".mysql_real_escape_string($preciou[$i])."','".mysql_real_escape_string($cantidad[$i])."','".mysql_real_escape_string($total[$i])."')";
	}

	mysql_query("INSERT INTO servicios(ventaId,servicio,descripcion,unitario,cantidad,precio) VALUES ".implode(",", $sql));
	
	if ( !empty($_POST['anticipo']) ){
		mysql_query("INSERT INTO pagos SET ventaId='".$ventaId."',fecha='".$fecha."',descripcion='Anticipo',cantidad='".$anticipo."',metodopago='".$metodopago."'");
	}

	$errorMsg = '<div class="alert alert-success">
				<i class="fa fa-check"></i> Orden con ID: <strong>'.$ordenId.'</strong> agregada correctamente. &nbsp;&nbsp;&nbsp; <a href="print.php?id='.$ordenId.'" target="_blank" class="btn btn-sm btn-default">Imprimir</a>
			</div>';

}
?>
		<section class="panel panel-default">
			<header class="panel-heading">
				<div class="pull-right">
					<a href="" class="return"><i class="fa fa-mail-reply"></i> Regresar </a>
				</div>
				<i class="fa fa-plus icon"></i> Agregar Orden
			</header>
			<div class="panel-body">
				<form class="bs-example form-horizontal" action="" method="post">
					<?php echo $errorMsg; ?>
					<div class="row">
						<div class="col-md-offset-9 col-md-3">
							<div class="form-group">
								<label class="col-md-3 control-label">Fecha</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="fecha" placeholder="" value="<?php echo date("Y-m-d"); ?>">
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
									<input type="text" name="cliente[]" class="form-control" id="magicsuggest"> 
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="col-md-3 control-label"> Factura </label>
								<div class="col-md-9">
									<select class="form-control" name="factura" id="factura">
										<option>No</option>
										<option>Si</option>	
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
									<tr>
										<td>
											<input type="text" name="servicio[]" class="form-control m-b" placeholder="Servicio">
											<textarea class="form-control" name="descripcion[]" style="height:100px;" placeholder="Descripcion"></textarea>
										</td>
										<td class="v-middle">
											<input type="text" name="preciounitario[]" class="form-control preciounitario">
										</td>
										<td class="v-middle">
											<input type="text" name="cantidad[]" value="1" class="form-control cantidad">
										</td>
										<td class="v-middle">
											<input type="text" name="precio[]" class="form-control precio" readonly>
										</td>
										<td></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-offset-6 col-sm-6 col-md-offset-8 col-md-4">
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
								<tr>
									<th>Anticipo: </th>
									<td class="text-right">
										<input type="text" class="pull-right form-control input-sm" style="width:40%;" name="anticipo" value="" />
									</td>
								</tr>
								<tr>
									<th>Metodo de Pago: </th>
									<td class="text-right">
										<select class="form-control" name="metodopago">
											<option>Efectivo</option>
											<option>Tarjeta</option>
											<option>Transferencia</option>
											<option>Cheque</option>
										</select>
									</td>
								</tr>
							</table>
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
                                '<td><button class="btn btn-sm btn-default clsEliminarFila"> <i class="fa fa-trash-o"></i></button></td>'+
                            '</tr>';
        $('table#tabla1 tr:last').after(nuevaFila);
        return false;
    });

    $(document).on('click','.clsEliminarFila',function(){
    	contador--;
		var objFila = $(this).parents().get(1);
		$(objFila).remove();
	});
</script>