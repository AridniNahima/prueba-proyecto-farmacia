<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid">
      <h4 class="mt-4 "><?php echo $titulo; ?></h4>

      <div>
        <p>
          <a href="<?php echo base_url(); ?>/cajas/nuevo_arqueo" class="btn btn-primary btn-sm">Nueva apertura de caja</a>

      </div>
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover table-sm display" id="dataTable" width="100%" cellspacing="0">
              <thead class="table-primary">
                <tr>
                  <th width="3%">Id</th>
                  <th>Fecha Apertura</th>
                  <th>Fecha Cierre</th>
                  <th>Monto Inicial</th>
                  <th>Monto Final</th>
                  <th>Total Ventas</th>
                  <th width="5%">Estado</th>
                  <th width="3%"></th>
                </tr>
              </thead>

              <tbody>
                <?php foreach ($datos as $dato) { ?>
                  <tr>
                    <td><?php echo $dato['id_arqueo']; ?></td>
                    <td><?php echo $dato['fecha_inicio']; ?></td>
                    <td><?php echo $dato['fecha_fin']; ?></td>
                    <td><?php echo $dato['monto_inicial']; ?></td>
                    <td><?php echo $dato['monto_final']; ?></td>
                    <td><?php echo $dato['total_ventas']; ?></td>
                    <?php if ($dato['estado'] == 1) { ?>
                      <td style="color:green"><strong>Abierta</strong></td>
                      <td>
                        <a href="#" data-href="<?php echo base_url() . '/cajas/cerrar/' .
                                                  $dato['id_arqueo']; ?>" data-toggle="modal" data-target="#modal-confirma" data-placement="top" title="Cerrar caja" class="btn btn-danger btn-sm">
                          <i class="fa-solid fa-lock"></i></a>
                      </td>
                    <?php } else { ?>
                      <td style="color:grey"><strong>Cerrada</strong></td>
                      <td>
                        <a href="<?php echo base_url() . '/cajas/muestraCierreCaja/' .
                                    $dato['id_arqueo']; ?>" title="Detalle venta" class="btn btn-secondary btn-sm">
                          <i class="fa-solid fa-print"></i></a>
                      </td>
                    <?php } ?>
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
          <h5 class="modal-title" id="exampleModalLabel">Cerrar caja</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>¿Desea cerrar caja?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          <a class="btn btn-danger btn-ok">Si</a>
        </div>
      </div>
    </div>
  </div>