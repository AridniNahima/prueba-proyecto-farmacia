<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid">
      <h4 class="mt-4"><?php echo $titulo; ?></h4>
      <div>
        <p>
          <a href="<?php echo base_url(); ?>/usuarios/nuevo" class="btn btn-primary btn-sm">+ Agregar</a>
          <a href="<?php echo base_url(); ?>/usuarios/eliminados" class="btn btn-warning btn-sm">Historial eliminados</a>
        </p>
      </div>
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover table-sm display" id="dataTable" width="100%" cellspacing="0">
              <thead class="table-primary">
                <tr>
                  <th scope="col">Id</th>
                  <th scope="col">Usuario</th>
                  <th scope="col">Nombres</th>
                  <th scope="col">Apellidos</th>
                  <th width="3%"></th>
                  <th width="3%"></th>
                </tr>
              </thead>

              <tbody>
                <?php foreach ($datos as $dato) { ?>
                  <tr>
                    <td><?php echo $dato['id_usuario']; ?></td>
                    <td><?php echo $dato['usuario']; ?></td>
                    <td><?php echo $dato['nombre']; ?></td>
                    <td><?php echo $dato['apellido']; ?></td>

                    <td>
                      <a href="<?php echo base_url() . '/usuarios/editar/' .
                                  $dato['id_usuario']; ?>" title="Editar registro" class="btn btn-warning btn-sm">
                        <i class="fa-solid fa-pen-to-square"></i></a>
                    </td>
                    <td>
                      <a href="#" data-href="<?php echo base_url() . '/usuarios/borrar/' .
                                                $dato['id_usuario']; ?>" data-toggle="modal" data-target="#modal-confirma" data-placement="top" title="Eliminar registro" class="btn btn-danger  btn-sm">
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