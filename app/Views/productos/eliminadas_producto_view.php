<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h4 class="mt-4"><?php echo $titulo; ?></h4>
            <div>
                <p>
                    <a href="<?php echo base_url(); ?>/productos" class="btn btn-primary btn-sm">Productos</a>
                </p>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover table-sm display" id="dataTable" width="100%" cellspacing="0">
                            <thead class="table-primary">
                                <tr>
                                    <th>Id</th>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Presentación</th>
                                    <th>Principio activo</th>
                                    <th>Precio compra</th>
                                    <th>Precio venta</th>
                                    <th>Fecha de vencimiento</th>
                                    <th>Cantidad</th>
                                    <th>Cantidad minima</th>
                                    <th width="3%"></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($datos as $dato) { ?>
                                    <tr>
                                        <td><?php echo $dato['cod_producto']; ?></td>
                                        <td><?php echo $dato['codigo']; ?></td>
                                        <td><?php echo $dato['nombre_producto']; ?></td>
                                        <td><?php echo $dato['presentacion']; ?></td>
                                        <td><?php echo $dato['nombre_generico']; ?></td>
                                        <td><?php echo $dato['precio_compra']; ?></td>
                                        <td><?php echo $dato['precio_venta']; ?></td>
                                        <td><?php echo $dato['fecha_vencimiento']; ?></td>
                                        <td><?php echo $dato['stock']; ?></td>
                                        <td><?php echo $dato['stock_minimo']; ?></td>

                                        <td>
                                            <a href="#" data-href="<?php echo base_url() . '/productos/reingresar/' .
                                                                        $dato['cod_producto']; ?>" data-toggle="modal" data-target="#modal-confirma" rel="tooltip" data-placement="top" title="Reingresar registro" class="btn btn-success btn-sm">
                                                <i class="fa-solid fa-circle-arrow-up"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="modal-confirma" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reingresar Registro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¿Desea reingresar este registro?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <a class="btn btn-danger btn-ok">Si</a>
                </div>
            </div>
        </div>
    </div>