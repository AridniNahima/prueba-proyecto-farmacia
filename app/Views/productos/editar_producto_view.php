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
                    <form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>/productos/actualizar" autocomplete="off">
                        <input type="hidden" id="cod_producto" name="cod_producto" value="<?php echo $producto['cod_producto']; ?>" />
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">Código</label>
                                    <input type="text" class="form-control" id="codigo" name="codigo" value="<?php echo $producto['codigo']; ?>" autofocus required />
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">Nombre Producto</label>
                                    <input type="text" class="form-control" id="nombre_producto" name="nombre_producto" value="<?php echo $producto['nombre_producto']; ?>" required />
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row"> 
                            <div class="col-12 col-sm-6">
                                    <label class="form-label">Presentación</label>
                                    <input type="text" class="form-control" id="presentacion" name="presentacion" value="<?php echo $producto['presentacion']; ?>" required />
                                </div>                              
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">Principio activo</label>
                                    <input type="text" class="form-control" id="nombre_generico" name="nombre_generico" value="<?php echo $producto['nombre_generico']; ?>" required />
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">Precio Compra</label>
                                    <input type="text" class="form-control" id="precio_compra" name="precio_compra" value="<?php echo $producto['precio_compra']; ?>" required />
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">Precio Venta</label>
                                    <input type="text" class="form-control" id="precio_venta" name="precio_venta" value="<?php echo $producto['precio_venta']; ?>" required />
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">Cantidad</label>
                                    <input type="text" class="form-control" id="stock" name="stock" value="<?php echo $producto['stock']; ?>" required />
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">Cantidad minima</label>
                                    <input type="text" class="form-control" id="stock_minimo" name="stock_minimo" value="<?php echo $producto['stock_minimo']; ?>" required />
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">

                                <div class="col-12 col-sm-6">
                                    <label class="form-label">Fecha de Vencimiento</label>
                                    <input type="text" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" value="<?php echo $producto['fecha_vencimiento']; ?>" required />
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">Es inventariable</label>
                                    <select id="inventariable" name="inventariable" class="form-control">
                                        <option value="1" <?php if ($producto['inventariable'] == 1) {
                                                                echo 'selected';
                                                            } ?>>Si
                                        </option>
                                        <option value="0" <?php if ($producto['inventariable'] == 0) {
                                                                echo 'selected';
                                                            } ?>>No
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">Categoria</label>
                                    <select id="id_categoria" name="id_categoria" class="form-select" required>
                                        <option value="">Seleccionar categoria</option>
                                        <?php foreach ($categorias as $categoria) { ?>
                                            <option value="<?php echo $categoria['id_categoria']; ?>" <?php if ($categoria['id_categoria'] == $producto['id_categoria']) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>
                                                <?php echo $categoria['nombre_categoria']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">Proveedor</label>
                                    <select id="id_proveedor" name="id_proveedor" class="form-select" required>
                                        <option value="">Seleccionar proveedor</option>
                                        <?php foreach ($proveedores as $proveedor) { ?>
                                            <option value="<?php echo $proveedor['id_proveedor']; ?>" <?php if ($proveedor['id_proveedor'] == $producto['id_proveedor']) {
                                                                                                            echo 'selected';
                                                                                                        } ?>><?php echo $proveedor['nombre_proveedor']; ?></option>
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
                            <br />
                            <img src="<?php echo base_url() . '/images/productos/' . $producto['cod_producto'] . '.jpg'; ?>" class="img-responsive" width="200" />
                            <br /> <br />
                            <input type="file" id="img_producto" name="img_producto" accept="image/*" />
                            <p class="text-danger">Cargar imagen en formato jpeg jpg de 150x150</p>
                        </div>
                    </div>
                </div>-->
                        <br>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="<?php echo base_url(); ?>/productos" class="btn btn-primary me-md-2">Regresar</a>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>