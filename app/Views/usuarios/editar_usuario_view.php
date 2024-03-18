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
                    <form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>/usuarios/actualizar" autocomplete="off">
                        <input type="hidden" id="id_usuario" name="id_usuario" value="<?php echo $datos['id_usuario'] ?>" />
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">Usuario</label>
                                    <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $datos['usuario'] ?>" autofocus required />
                                </div>
                            </div>
                        </div>


                        <div class="mb-3">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">Nombres</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $datos['nombre'] ?>" required />
                                </div>

                                <div class="col-12 col-sm-6">
                                    <label class="form-label">Apellidos</label>
                                    <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $datos['apellido'] ?>" required />
                                </div>
                            </div>
                        </div>


                        <div class="mb-3">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">Caja</label>
                                    <select id="id_caja" name="id_caja" class="form-select" required>
                                        <option value="">Seleccionar caja</option>
                                        <?php foreach ($cajas as $caja) { ?>
                                            <option value="<?php echo $caja['id_caja']; ?>" <?php if ($caja['id_caja'] == $datos['id_caja']) {
                                                                                                echo 'selected';
                                                                                            } ?>>
                                                <?php echo $caja['nombre_caja']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">Rol</label>
                                    <select id="id_rol" name="id_rol" class="form-select" required>
                                        <option value="">Seleccionar rol</option>
                                        <?php foreach ($roles as $rol) { ?>
                                            <option value="<?php echo $rol['id_rol']; ?>" <?php if ($rol['id_rol'] == $datos['id_rol']) {
                                                                                                echo 'selected';
                                                                                            } ?>>
                                                <?php echo $rol['nombre_rol']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="<?php echo base_url(); ?>/usuarios" class="btn btn-primary me-md-2">Regresar</a>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </form>
                </div>
    </main>