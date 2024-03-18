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
                    <form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>/usuarios/actualizar_password" autocomplete="off">
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label>Usuario</label>
                                    <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $usuario['usuario'] ?>" disabled />
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $usuario['nombre'] ?>" disabled />
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">Contraseña</label>
                                    <input type="password" class="form-control" id="password" name="password" required />
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">Confirma contraseña</label>
                                    <input type="password" class="form-control" id="repassword" name="repassword" required />
                                </div>
                            </div>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="<?php echo base_url(); ?>/usuarios" class="btn btn-primary me-md-2">Regresar</a>
                            <button type="submit" class="btn btn-success">Guardar</button>

                            <?php if (isset($mensaje)) { ?>
                                <div class="alert alert-success">
                                    <?php echo $mensaje; ?>
                                </div>
                            <?php } ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>