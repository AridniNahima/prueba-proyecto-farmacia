<?php
$id_compra = uniqid();
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h4 class="mt-4">Nueva compra</h4>
            <div class="card">
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data" id="form_compra" name="form_compra" action="<?php echo base_url(); ?>/compras/guarda" autocomplete="off">
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <input type="hidden" id="id_producto" name="id_producto" />
                                    <input type="hidden" id="id_compra" name="id_compra" value="<?php echo $id_compra; ?>" />

                                    <label class="form-label">Código</label>
                                    <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Escribe código de producto y enter" onkeyup="buscarProducto(event, this, this.value)" autofocus />
                                    <label for="codigo" id="resultado_error" style="color:red;"></label>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <label class="form-label">Nombre del producto</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" disabled />
                                </div>

                                <div class="col-12 col-sm-4">
                                    <label class="form-label">Nombre genérico</label>
                                    <input type="text" class="form-control" id="nombreg" name="nombreg" disabled />
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label class="form-label">Cantidad</label>
                                    <input type="text" class="form-control" id="cantidad" name="cantidad" />
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label class="form-label">Precio de compra</label>
                                    <input type="text" class="form-control" id="precio_compra" name="precio_compra" disabled />
                                </div>

                                <div class="col-12 col-sm-4">
                                    <label class="form-label"><br> &nbsp;</label>
                                    <button id="agregar_producto" name="agregar_producto" type="button" class="btn btn-success" 
                                    onclick="agregarProducto(id_producto.value, cantidad.value,'<?php echo $id_compra; ?>')">
                                        <i class="fa-solid fa-plus"></i> Agregar producto
                                    </button>
                                </div>

                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <table id="tablaProductos" class="table table-hover table-striped table-sm table-responsive tablaProductos" width="90%">
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
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-12 col-sm-6 offset-md-6">
                                        <label class="form-label" style="font-weight: bold; font-size: 30px; text-align: center;">Total Bs</label>
                                        <input type="text" id="total" name="total" size="7" readonly="true" value="0.00" style="font-weight: bold; font-size: 30px; text-align: center;" />
                                        <button type="button" id="completa_compra" name="completa_compra" class="btn btn-success"><i class="fa-regular fa-circle-check"></i> Completar compra</button>
                                    </div>
                                </div>
                            </div>

                    </form>
                </div>
            </div>
        </div>
    </main>


    <script>
        $(document).ready(function() {
            $("#completa_compra").click(function() {
                let nFila = $("#tablaProductos tr").length;
                if (nFila < 2) {
                    alert("Debe agregar un producto");
                } else {
                    $("#form_compra").submit();
                }
            });
        });

        function buscarProducto(e, tagCodigo, codigo) { //evento, nombre del campo codigo, codigo que añade el usuario
            var enterKey = 13;
            if (codigo != '') {
                if (e.which == enterKey) {
                    $.ajax({
                        url: '<?php echo base_url(); ?>/productos/buscarPorCodigo/' + codigo,
                        dataType: 'json',
                        success: function(resultado) {
                            if (resultado == 0) {
                                $(tagCodigo).val('');
                            } else {

                                $(tagCodigo).removeClass('has-error');
                                $("#resultado_error").html(resultado.error); //move

                                if (resultado.existe) {
                                    $("#id_producto").val(resultado.datos.cod_producto);
                                    $("#nombre").val(resultado.datos.nombre_producto);
                                    $("#nombreg").val(resultado.datos.nombre_generico);
                                    $("#cantidad").val(1); //$("#cantidad").val(resultado.datos.stock);
                                    $("#precio_compra").val(resultado.datos.precio_compra);
                                    $("#total_precio").val(resultado.datos.precio_compra);
                                    $("#cantidad").focus(); //s eagrega la cantidad a comprar
                                } else {
                                    $("#id_producto").val('');
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

        function agregarProducto(cod_producto, cantidad, id_compra) {
            if (cod_producto != null && cod_producto != 0 && cantidad > 0) {
                $.ajax({
                    url: '<?php echo base_url(); ?>/TemporalCompra/insertar/' + cod_producto + "/" + cantidad + "/" + id_compra,
                    success: function(resultado) {
                        if (resultado == 0) {

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

        function eliminaProducto(cod_producto, id_compra) {
            $.ajax({
                url: '<?php echo base_url(); ?>/TemporalCompra/eliminar/' + cod_producto + '/' + id_compra,

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
    </script>