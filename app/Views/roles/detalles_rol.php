<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h4 class="mt-4 "><?php echo $titulo; ?></h4>
      <div>
        <p>
          <a href="<?php echo base_url(); ?>/roles" class="btn btn-primary btn-sm">Roles</a>
        </p>
      </div>
      <div class="card">
        <div class="card-body">
          <form enctype="multipart/form-data" id="form_permisos" name="form_permisos" method="post" action="<?php echo base_url() . '/roles/guardaPermisos'; ?>">
            <div class="mb-3">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <input type="hidden" name="id_rol" value="<?php echo $id_rol ?>" />
                  <?php foreach ($permisos as $permiso) { ?>
                    <input type="checkbox" value="<?php echo $permiso['id_permisos']; ?>" name="permisos[]" <?php if (isset($asignado[$permiso['id_permisos']])) {
                                                                                                              echo 'checked';
                                                                                                            } ?> />
                    <label class="form-label"><?php echo $permiso['nombre']; ?></label>
                    </br>
                  <?php } ?>
                </div>
              </div>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
              <a href="<?php echo base_url(); ?>/roles" class="btn btn-primary me-md-2">Regresar</a>
              <button type="submit" class="btn btn-success">Guardar</button>
            </div>
          </form>
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
          <p>Desea eliminar este registro?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          <a class="btn btn-danger btn-ok">Si</a>
        </div>
      </div>
    </div>
  </div>