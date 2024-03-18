<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h4 class="mt-4"><?php echo $titulo; ?></h4>

            <?php if (isset($validation)) { ?>
                <div class="alert alert-danger">
                    <?php echo $validation->listErrors(); ?>
                </div>
            <?php } ?>
            <div class="card">
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>/productos/insertar" autocomplete="off">
                        <?php csrf_field(); ?>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">* Código</label>
                                    <input type="text" class="form-control" id="codigo" name="codigo" value="<?php echo set_value('codigo'); ?>" required />
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">* Nombre producto</label>
                                    <input type="text" class="form-control" id="nombre_producto" name="nombre_producto" value="<?php echo set_value('nombre_producto'); ?>" required />
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">* Presentación</label>
                                    <input type="text" class="form-control" id="presentacion" name="presentacion" value="<?php echo set_value('presentacion'); ?>" required />
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">* Principio activo</label>
                                    <input type="text" class="form-control" id="nombre_generico" name="nombre_generico" value="<?php echo set_value('nombre_generico'); ?>" required />
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">* Precio compra</label>
                                    <input type="text" class="form-control" id="precio_compra" name="precio_compra" value="<?php echo set_value('precio_compra'); ?>" placeholder="00,00" />
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">* Precio venta</label>
                                    <input type="text" class="form-control" id="precio_venta" name="precio_venta" value="<?php echo set_value('precio_venta'); ?>" placeholder="00,00" />
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">* Cantidad</label>
                                    <input type="text" class="form-control" id="stock" name="stock" value="<?php echo set_value('stock'); ?>" required />
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">* Cantidad minima</label>
                                    <input type="text" class="form-control" id="stock_minimo" name="stock_minimo" value="<?php echo set_value('stock_minimo'); ?>" required />
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">* Fecha de vencimiento</label>
                                    <input type="text" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" value="<?php echo set_value('fecha_vencimiento'); ?>" placeholder="AAAA-MM-DD" />
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">* Es inventariable</label>
                                    <select id="inventariable" name="inventariable" class="form-control" required>
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">* Categoria</label>
                                    <select id="id_categoria" name="id_categoria" class="form-select" required>
                                        <option value="">Seleccionar categoria</option>
                                        <?php foreach ($categorias as $categoria) { ?>
                                            <option value="<?php echo $categoria['id_categoria']; ?>"><?php echo $categoria['nombre_categoria']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">* Laboratorio</label>
                                    <select id="id_proveedor" name="id_proveedor" class="form-select" required>
                                        <option value="">Seleccionar laboratorio</option>
                                        <?php foreach ($proveedores as $proveedor) { ?>
                                            <option value="<?php echo $proveedor['id_proveedor']; ?>"><?php echo $proveedor['nombre_proveedor']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- 
 <br /> 
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label>Imagen</label>
                            <br>
                            <input type="file" id="img_producto" name="img_producto" accept="image/*" />
                            <p class="text-danger">Cargar imagen en formato jpeg jpg de 150x150</p>
                        </div>
                    </div>
                </div>
                 -->
                        <p style="color:grey"><em> (*) Campo obligatorio</em></p>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="<?php echo base_url(); ?>/productos" class="btn btn-primary me-md-2">Regresar</a>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>