<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid">
      <h4 class="mt-4 "><?php echo $titulo; ?></h4>
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover table-sm display" id="dataTable" width="100%" cellspacing="0">
              <thead class="table-success">
                <tr>
                  <th width="3%">Id</th>
                  <th>Usuario</th>
                  <th scope="col" width="10%">Ip</th>
                  <th scope="col" width="8%">Evento</th>
                  <th>Detalles</th>
                  <th scope="col" width="12.5%">Fecha y hora</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($datos as $dato) { ?>
                  <tr>
                    <td><?php echo $dato['id_logs']; ?></td>
                    <td><?php echo $dato['cajero']; ?></td>
                    <td><?php echo $dato['ip']; ?></td>
                    <td><?php echo $dato['evento']; ?></td>
                    <td><?php echo $dato['detalles']; ?></td>
                    <td><?php echo $dato['fecha']; ?></td>
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