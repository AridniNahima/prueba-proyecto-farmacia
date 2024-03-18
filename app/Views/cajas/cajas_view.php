<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid">
      <h4 class="mt-4 "><?php echo $titulo; ?></h4>

      <div>
        <p>
          <a href="<?php echo base_url(); ?>/cajas/nuevo" class="btn btn-primary btn-sm">Agregar</a>
          <a href="<?php echo base_url(); ?>/cajas/eliminados" class="btn btn-warning btn-sm">Historial eliminados</a>
        </p>
      </div>
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover table-sm display" id="dataTable" width="100%" cellspacing="0">
              <thead class="table-primary">
                <tr>
                  <th width="3%">Id</th>
                  <th scope="col">Número de Caja</th>
                  <th scope="col">Nombre Caja</th>
                  <th scope="col">Folio</th>
                  <th width="6.9%"></th>
                  <th width="3%"></th>
                  <th width="3%"></th>
                </tr>
              </thead>

              <tbody>
                <?php foreach ($datos as $dato) { ?>
                  <tr>
                    <td><?php echo $dato['id_caja']; ?></td>
                    <td><?php echo $dato['numero_caja']; ?></td>
                    <td><?php echo $dato['nombre_caja']; ?></td>
                    <td><?php echo $dato['folio']; ?></td>

                    <td>
                      <a href="<?php echo base_url() . '/cajas/arqueo/' . $dato['id_caja']; ?>" title="Apertura y cierre de caja" class="btn btn-primary btn-sm"><i class="fa-solid fa-clipboard-list"></i> Arqueo</a>
                    </td>

                    <td>
                      <a href="<?php echo base_url() . '/cajas/editar/' . $dato['id_caja']; ?>" title="Editar registro" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                    </td>
                    <td>
                      <a href="#" data-href="<?php echo base_url() . '/cajas/borrar/' .
                                                $dato['id_caja']; ?>" data-toggle="modal" data-target="#modal-confirma" data-placement="top" title="Eliminar registro" class="btn btn-danger btn-sm">
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
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
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