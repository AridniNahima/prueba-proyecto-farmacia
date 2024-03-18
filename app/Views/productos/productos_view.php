<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid">

      <h4 class="mt-4"><?php echo $titulo; ?></h4>
      <div>
        <p>
          <a href="<?php echo base_url(); ?>/productos/nuevo" class="btn btn-primary btn-sm">+ Agregar</a>
          <a href="<?php echo base_url(); ?>/productos/eliminados" class="btn btn-warning btn-sm">Historial eliminados</a>
          <!--<a href="<?php echo base_url(); ?>/productos/muestraCodigos" class="btn btn-secondary"><i class="fa-solid fa-barcode"></i> Códigos de barras</a>-->
        </p>
      </div>
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover table-sm display" id="dataTable" width="100%" cellspacing="0">
              <thead class="table-primary">
                <tr>
                  <th scope="col">Id</th>
                  <th scope="col">Código</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Presentación</th>
                  <th scope="col">Principio activo</th>
                  <th scope="col">Precio compra</th>
                  <th scope="col">Precio venta</th>
                  <th scope="col">Fecha de vencimiento</th>
                  <th scope="col">Cantidad</th>
                  <th scope="col">Ganancia</th>

                  <th width="3%"></th>
                  <th width="3%"></th>

                </tr>
              </thead>

              <tbody>
                <?php foreach ($datos as $dato) { ?>
                  <tr>
                    <td scope="row"><?php echo $dato['cod_producto']; ?></td>
                    <td><?php echo $dato['codigo']; ?></td>
                    <td><?php echo $dato['nombre_producto']; ?></td>
                    <td><?php echo $dato['presentacion']; ?></td>
                    <td><?php echo $dato['nombre_generico']; ?></td>
                    <td><?php echo $dato['precio_compra']; ?></td>
                    <td><?php echo $dato['precio_venta']; ?></td>
                    <td><?php echo $dato['fecha_vencimiento']; ?></td>
                    <td><?php echo $dato['stock']; ?></td>
                    <td><?php echo $dato['precio_venta'] - $dato['precio_compra']; ?></td>
                    <!-- <td><img src="<?php echo base_url() . '/images/productos/' . $dato['cod_producto'] . '.jpg'; ?>" width="100" /></td>-->
                    <td>
                      <a href="<?php echo base_url() . '/productos/editar/' .
                                  $dato['cod_producto']; ?>" 
                                  title="Editar registro"
                                  class="btn btn-warning btn-sm">
                        <i class="fa-solid fa-pen-to-square"></i></a>
                    </td>
                    <td>
                      <a href="#" data-href="<?php echo base_url() . '/productos/borrar/' .
                                                $dato['cod_producto']; ?>" 
                                                title="Eliminar registro"
                                                data-toggle="modal" data-target="#modal-confirma" data-placement="top" title="Eliminar registro" class="btn btn-danger btn-sm">
                        <i class="fa-solid fa-trash-can"></i></a>
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
          <h5 class="modal-title" id="exampleModalLabel">Eliminar Registro</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>¿Desea eliminar este registro?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          <a class="btn btn-danger btn-ok">Si</a>
        </div>
      </div>
    </div>
  </div>