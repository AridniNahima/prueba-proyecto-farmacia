<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid">
      <h4 class="mt-4 "><?php echo $titulo; ?></h4>


      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover table-sm display" id="dataTable" width="100%" cellspacing="0">
              <thead class="table-primary">
                <tr>
                  <th width="3%">Id</th>
                  <th scope="col">Folio</th>
                  <th scope="col">Total</th>
                  <th scope="col">Fecha</th>
                  <th width="3%"></th>
                </tr>
              </thead>

              <tbody>
                <?php foreach ($datos as $dato) {
                ?>
                  <tr>
                    <td><?php echo $dato['id_compra']; ?></td>
                    <td><?php echo $dato['folio']; ?></td>
                    <td><?php echo $dato['total']; ?></td>
                    <td><?php echo $dato['fecha_alta']; ?></td>

                    <td><a href="<?php echo base_url() . '/compras/muestraCompraPdf/' . $dato['id_compra']; ?>" title="Ver compra PDF" class="btn btn-primary btn-sm"><i class="fa-solid fa-file-lines"></i></a></td>
                  </tr>
                <?php }
                ?>
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