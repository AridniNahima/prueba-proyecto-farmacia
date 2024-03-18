<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h4 class="mt-4"><?php echo $titulo; ?></h4>

            <?php if (isset($validation)) { ?>
                <div class="alert alert-danger">
                    <?php echo $validation->listErrors(); ?>
                </div>
            <?php } ?>
            
            <form method="post" action="<?php echo base_url(); ?>/categorias/insertar" autocomplete="off">
                <?php csrf_field(); ?>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label>Configuracion</label>
                            <input type="text" class="form-control" 
                            id="nombre_categoria " name="nombre_categoria" 
                            value="<?php echo set_value('nombre_categoria'); ?>"
                            autofocus required
                            />
                        </div>
                    </div>
                </div>

                <a href="<?php echo base_url(); ?>/categorias" class="btn btn-primary">Regresar</a>
                <button type="submit" class="btn btn-success">Guardar</button>
            </form>
        </div>
    </main>