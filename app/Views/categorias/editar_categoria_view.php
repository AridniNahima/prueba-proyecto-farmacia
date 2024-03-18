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
                    <form method="post" action="<?php echo base_url(); ?>/categorias/actualizar" autocomplete="off">
                        <input type="hidden" value="<?php echo $datos['id_categoria'] ?>" name="id_categoria" />
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">Categoria</label>
                                    <input type="text" class="form-control" id="nombre_categoria " name="nombre_categoria" value="<?php echo $datos['nombre_categoria'] ?>" autofocus required />
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="<?php echo base_url(); ?>/categorias" class="btn btn-primary me-md-2">Regresar</a>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>