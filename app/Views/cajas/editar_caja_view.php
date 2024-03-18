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
                    <form method="post" action="<?php echo base_url(); ?>/cajas/actualizar" autocomplete="off">
                        <input type="hidden" value="<?php echo $datos['id_caja'] ?>" name="id_caja" />
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">Número Caja</label>
                                    <input type="text" class="form-control" id="numero_caja" name="numero_caja" value="<?php echo $datos['numero_caja']; ?>" required />
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">Nombre Caja</label>
                                    <input type="text" class="form-control" id="nombre_caja" name="nombre_caja" value="<?php echo $datos['nombre_caja']; ?>" required />
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">Folio</label>
                                    <input type="text" class="form-control" id="folio" name="folio" value="<?php echo $datos['folio']; ?>" required />
                                </div>
                            </div>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="<?php echo base_url(); ?>/cajas" class="btn btn-primary me-md-2">Regresar</a>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>