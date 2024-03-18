<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <?php $idVentaTmp = uniqid(); ?>
            <h4 class="mt-4">Nueva venta</h4>
            <div class="card">
                <div class="card-body">
                    <form enctype="multipart/form-data" id="form_venta" name="form_venta" class="form-horizontal" method="post" action="<?php echo base_url(); ?>/ventas/guarda" autocomplete="off">
                        <!--<input type="hidden" name="id_venta" name="id_venta" value="<?php echo $idVentaTmp; ?>" />-->
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <input type="hidden" id="id_producto" name="id_producto" />
                                    <input type="hidden" id="id_venta" name="id_venta" value="<?php echo $idVentaTmp; ?>" />

                                    <label class="form-label">Código</label>
                                    <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Escribe código de producto y enter" onkeyup="buscarProducto(event, this, this.value)" autofocus />
                                    <label for="codigo" id="resultado_error" style="color:red;"></label>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label class="form-label">Nombre del producto</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" disabled />
                                </div>
                                <div class="col 12 col-sm-4">
                                    <label class="form-label">Forma de Pago: </label>
                                    <select id="forma_pago" name="forma_pago" class="form-control" required>
                                        <option value="001">Efectivo</option>
                                        <option value="002">Pago por QR</option>
                                        <option value="003">Pago por Tarjeta</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label class="form-label">Cantidad</label>
                                    <input type="text" class="form-control" id="cantidad" name="cantidad" />
                                </div>

                                <div class="col-12 col-sm-4">
                                    <label class="form-label">Precio de venta</label>
                                    <input type="text" class="form-control" id="precio_venta" name="precio_venta" disabled />
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label class="form-label"><br> &nbsp;</label>
                                    <button id="agregar_producto" name="agregar_producto" type="button" class="btn btn-success" onclick="agregarProducto(id_producto.value, cantidad.value,'<?php echo $idVentaTmp; ?>')">
                                        <i class="fa-solid fa-plus"></i> Agregar producto
                                    </button>
                                </div>

                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-12 col-sm-6 offset-md-7">
                                    <label style="font-weight: bold; font-size: 30px; text-align: center;" class="form-label">Total Bs</label>
                                    <input type="text" id="total" name="total" size="7" readonly="true" value="0.00" style="font-weight: bold; font-size: 30px; text-align: center;" />
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

<script>
    $(document).ready(function() {
        $("#completa_venta").click(function() {
            let nFila = $("#tablaProductos tr").length;
            if (nFila < 2) {
                // Puedes manejar una situación en la que no haya productos en la venta
                alert("Agrega al menos un producto a la venta antes de completarla.");
            } else {
                $("#form_venta").submit();
            }
        });
    });

    function buscarProducto(e, tagCodigo, codigo) {
        var enterKey = 13;
        if (codigo !== '') {
            if (e.which == enterKey) {
                $.ajax({
                    url: '<?php echo base_url(); ?>/productos/buscarPorCodigo/' + codigo,
                    dataType: 'json',
                    success: function(resultado) {
                        if (resultado == 0) {
                            $(tagCodigo).val('');
                        } else {
                            $(tagCodigo).removeClass('has-error');
                            $("#resultado_error").html(resultado.error);

                            if (resultado.existe) {
                                $("#id_producto").val(resultado.datos.cod_producto);
                                $("#nombre").val(resultado.datos.nombre_producto);
                                $("#nombreg").val(resultado.datos.nombre_generico);
                                $("#cantidad").val(1);
                                $("#precio_venta").val(resultado.datos.precio_venta);
                                $("#total_precio").val(resultado.datos.precio_venta);
                                $("#cantidad").focus();
                            } else {
                                $("#id_producto").val('');
                                $("#nombre").val('');
                                $("#nombreg").val('');
                                $("#cantidad").val('');
                                $("#precio_venta").val('');
                                $("#total_precio").val('');
                            }
                        }
                    }
                });
            }
        }
    }

    function agregarProducto(cod_producto, cantidad, id_venta) {
        if (cod_producto !== null && cod_producto !== 0 && cantidad > 0) {
            $.ajax({
                url: '<?php echo base_url(); ?>/TemporalCompra/insertar/' + cod_producto + "/" + cantidad + "/" + id_venta,
                success: function(resultado) {
                    if (resultado == 0) {
                        // Manejar error si es necesario
                        alert("Error al agregar el producto a la venta.");
                    } else {
                        var resultado = JSON.parse(resultado);

                        if (resultado.error === '') {
                            $("#tablaProductos tbody").empty();
                            $("#tablaProductos tbody").append(resultado.datos);
                            $("#total").val(resultado.total);
                            $("#cod_producto").val('');
                            $("#codigo").val('');
                            $("#nombre").val('');
                            $("#nombreg").val('');
                            $("#cantidad").val('');
                            $("#precio_venta").val('');
                            $("#total_precio").val('');
                        }
                    }
                }
            });
        }
    }

    function eliminaProducto(cod_producto, id_venta) {
        $.ajax({
            url: '<?php echo base_url(); ?>/TemporalCompra/eliminar/' + cod_producto + '/' + id_venta,
            success: function(resultado) {
                if (resultado == 0) {
                    // Manejar error si es necesario
                    $(tagCodigo).val('');
                    alert("Error al eliminar el producto de la venta.");
                } else {
                    var resultado = JSON.parse(resultado);
                    $("#tablaProductos tbody").empty();
                    $("#tablaProductos tbody").append(resultado.datos);
                    $("#total").val(resultado.total);
                }
            }
        });
    }
</script>