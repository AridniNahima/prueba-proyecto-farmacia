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
                    <form method="post" enctype="multipart/form-data"
                     action="<?php echo base_url(); ?>/cajas/nuevo_arqueo" autocomplete="off">
                        <?php csrf_field(); ?>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">Número de Caja</label>
                                    <input type="text" class="form-control" id="numero_caja" name="numero_caja" value="<?php echo $caja['numero_caja']; ?>" autofocus required />
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">Nombre</label>
                                    <input class="form-control" type="text" id="nombre" name="nombre" value="<?php echo $session->nombre; ?>" required />
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">* Monto inicial</label>
                                    <input type="text" class="form-control" id="monto_inicial" name="monto_inicial" value="" required />
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">Folio</label>
                                    <input type="text" class="form-control" id="folio" name="folio" value="<?php echo $caja['folio']; ?>" required />
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">Fecha</label>
                                    <input type="text" class="form-control" id="fecha" name="fecha" value="<?php echo date('Y-m-d'); ?>" required />
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">Hora</label>
                                    <input type="text" class="form-control" id="hora" name="hora" value="<?php echo date('H:i:s'); ?>" autofocus required />
                                </div>
                            </div>
                        </div>

                        <p style="color:grey"><em> (*) Campo obligatorio</em></p>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="<?php echo base_url(); ?>/cajas" class="btn btn-primary  me-md-2">Regresar</a>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>