<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <?php $idVentaTmp = uniqid(); ?>
            <h4 class="mt-4">Nueva venta</h4>
            <div class="card">
                <div class="card-body">
                    <form enctype="multipart/form-data" id="form_venta" name="form_venta" class="form-horizontal" method="post" action="<?php echo base_url(); ?>/ventas/guarda" autocomplete="off">
                        <input type="hidden" name="id_venta" name="id_venta" value="<?php echo $idVentaTmp; ?>" />
                        <div class="mb-3">
                            <div class="row">
                                <!--<div class="col-12 col-sm-6">
                                    <div class="ui-widget">
                                        <label>Productos: </label>
                                        <input type="hidden" id="cod_producto" name="cod_producto" value="1" />
                                        <input type="text" class="form-control" id="producto" name="producto" placeholder="Escribe el nombre del producto" autocomplete="off" required />
                                    </div>
                                </div>-->
                                <div class="col-12 col-sm-4">
                                    <input type="hidden" id="cod_producto" name="cod_producto" />
                                    <label class="form-label">Código de barras: </label>
                                    <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Escribe código de producto y enter" onkeyup=" agregarProducto(event, this.value, 1, '<?php echo $idVentaTmp; ?>');" autofocus />
                                </div>
                                <div class="col-12 col-sm-2">
                                    <label class="form-label" for="codigo" id="resultado_error" style="color:red"></label>
                                </div>
                                <div class="col 12 col-sm-5">
                                    <label class="form-label">Forma de Pago: </label>
                                    <select id="forma_pago" name="forma_pago" class="form-control" required>
                                        <option value="001">Efectivo</option>
                                        <option value="002">Pago por QR</option>
                                        <option value="003">Pago por Tarjeta</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-12 col-sm-6 offset-md-6">
                                    <label style="font-weight: bold; font-size: 30px; text-align: center;" class="form-label" >Total Bs</label>
                                    <input type="text" id="total" name="total" size="7" readonly="true" value="0.00" style="font-weight: bold; font-size: 30px; text-align: center;"/>
                                    <button type="button" id="completa_venta" name="completa_venta" class="btn btn-success"><i class="fa-regular fa-circle-check"></i> Completar Venta</button>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <table id="tablaProductos" class="table table-hover table-striped table-sm table-responsive tablaProductos" width="100%">
                                    <thead class="table-dark">
                                        <th>Nro</th>
                                        <th>Código</th>
                                        <th>Nombre</th>
                                        <th>Nombre Genérico</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Total</th>
                                        <th width="1%"></th>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <!-- busca por nombre de producto 
$(function() {
            $("#producto").autocomplete({
                source: "<?php echo base_url(); ?>/productos/autocompleteData",
                minLength: 3,
                select: function(event, ui) {
                    event.preventDefault();
                    $("#cod_producto").val(ui.item.id);
                    $("#nombre_producto").val(ui.item.value);
                }
            });
        });
-->
    <script>
        //<!-- busca por codigo de producto  CODIGO DE BARRAS-->

        $(function() {
            $("#codigo").autocomplete({
                source: "<?php echo base_url(); ?>/productos/autocompleteDataCod",
                minLength: 3,
                select: function(event, ui) {
                    event.preventDefault();
                    $("#codigo").val(ui.item.value);
                    setTimeout(
                        function() {
                            e = jQuery.Event("keypress");
                            e.which = 13; //13 enter en ascii
                            agregarProducto(e, ui.item.id, 1, '<?php echo $idVentaTmp; ?>'); //agregarProducto(e, ui.item.id,  cantidad.value, '<?php echo $idVentaTmp; ?>');
                        });
                }
            });
        });

        function agregarProducto(e, cod_producto, cantidad, id_venta) {
            let enterKey = 13;
            if (codigo != '') {
                if (e.which == enterKey) {
                    if (cod_producto != null && cod_producto != 0 && cantidad > 0) {
                        $.ajax({
                            url: '<?php echo base_url(); ?>/TemporalCompra/insertar/' + cod_producto + "/" + cantidad + "/" + id_venta,
                            success: function(resultado) {
                                if (resultado == 0) {
                                    alert("Error al agregar el producto a la venta.");
                                } else {

                                    var resultado = JSON.parse(resultado);

                                    if (resultado.error == '') {
                                        $("#tablaProductos tbody").empty(); //limpia todo
                                        $("#tablaProductos tbody").append(resultado.datos); //trae toda la tabla
                                        $("#total").val(resultado.total);
                                        $("#cod_producto").val('');
                                        $("#codigo").val('');
                                        $("#nombre").val('');
                                        $("#nombreg").val('');
                                        $("#cantidad").val('');
                                        $("#precio_compra").val('');
                                        $("#total_precio").val('');
                                    }
                                }
                            }
                        });
                    }
                }
            }
        }

        function eliminaProducto(cod_producto, id_venta) {
            $.ajax({
                url: '<?php echo base_url(); ?>/TemporalCompra/eliminarVenta/' + cod_producto + '/' + id_venta,

                success: function(resultado) {
                    if (resultado == 0) {
                        $(tagCodigo).val('');
                    } else {
                        var resultado = JSON.parse(resultado);
                        $("#tablaProductos tbody").empty(); //se limpia la tabla 
                        $("#tablaProductos tbody").append(resultado.datos); //datos trae toda la tabla 
                        $("#total").val(resultado.total);
                    }
                }
            });
        }

        $(function() {
            $("#completa_venta").click(function() {
                let nFilas = $("#tablaProductos tr").length;
                if (nFilas < 2) {
                    alert("Debe agregar un producto");
                } else {
                    $("#form_venta").submit();
                }
            });
        });
    </script>