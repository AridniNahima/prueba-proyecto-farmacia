<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h4 class="mt-4"><?php echo $titulo; ?></h4>

            <?php if (isset($validation)) { ?>
                <div class="alert alert-danger">
                    <?php echo $validation->listErrors(); ?>
                </div>
            <?php } ?>

            <div class="card">
                <div class="card-body">
                    <form method="post" action="<?php echo base_url(); ?>/proveedores/actualizar" autocomplete="off">

                        <input type="hidden" value="<?php echo $datos['id_proveedor'] ?>" name="id_proveedor" />
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">Nit</label>
                                    <input type="text" class="form-control" id="nit" name="nit" value="<?php echo $datos['nit']; ?>" required />
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombre_proveedor" name="nombre_proveedor" value="<?php echo $datos['nombre_proveedor']; ?>" required />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">Teléfono</label>
                                    <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $datos['telefono']; ?>" required />
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">Celular</label>
                                    <input type="text" class="form-control" id="celular" name="celular" value="<?php echo $datos['celular']; ?>" required />
                                </div>
                            </div>
                        </div>
                        
                        <br>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="<?php echo base_url(); ?>/proveedores" class="btn btn-primary me-md-2">Regresar</a>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>