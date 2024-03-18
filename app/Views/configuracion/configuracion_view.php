<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid">
      <h4 class="mt-4 "> <?php echo $titulo; ?></h4>

      <?php if (isset($validation)) { ?>
        <div class="alert alert-danger">
          <?php echo $validation->listErrors(); ?>
        </div>
      <?php } ?>
      <div class="card">
        <div class="card-body">
          <form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>/configuracion/actualizar" autocomplete="off">
            <?php csrf_field(); ?>
            <div class="mb-3">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <label class="form-label">Nombre de la institución</label>
                  <input type="text" class="form-control" id="tienda_nombre" name="tienda_nombre" value="<?php echo $nombre['valor']; ?>" autofocus required />
                </div>

                <div class="col-12 col-sm-6">
                  <label class="form-label">Nit de funcionamiento</label>
                  <input type="text" class="form-control" id="tienda_nit" name="tienda_nit" value="<?php echo $nit['valor']; ?>" autofocus required />
                </div>
              </div>
            </div>

            <div class="mb-3">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <label class="form-label">Telefono - Celular</label>
                  <input type="text" class="form-control" id="tienda_telefono" name="tienda_telefono" value="<?php echo $telefono['valor']; ?>" />
                </div>

                <div class="col-12 col-sm-6">
                  <label class="form-label">Dirección</label>
                  <textarea type="text" class="form-control" id="tienda_direccion" name="tienda_direccion" required><?php echo $direccion['valor']; ?>
              </textarea>
                </div>
              </div>
            </div>

            <div class="mb-3">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <label class="form-label">Email</label>
                  <input type="text" class="form-control" id="tienda_email" name="tienda_email" value="<?php echo $email['valor']; ?>" autofocus required />
                </div>
                <div class="col-12 col-sm-6">
                  <label class="form-label">Leyenda ticket</label>
                  <textarea type="text" class="form-control" id="ticket_leyenda" name="ticket_leyenda" autofocus required>
                <?php echo $leyenda['valor']; ?>
              </textarea>
                </div>
              </div>
            </div>

            <div class="mb-3">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <label class="form-label">Logotipo</label>
                  <br />
                  <img src="<?php echo base_url() . '/images/logotipo.png'; ?>" class="img-responsive" width="200" />
                  <br /> <br />
                  <input type="file" id="tienda_logo" name="tienda_logo" accept="image/png" />
                  <p class="text-danger"><em> imagen en formato png de 150x150</em> </p>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
          </form>
        </div>
      </div>
    </div>
  </main>

  <!-- Modal -->
  <div class="modal fade" id="modal-confirma" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
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