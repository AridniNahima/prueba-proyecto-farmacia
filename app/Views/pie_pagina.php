    <footer class="py-3 bg-light mt-auto">
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Copyright &copy; Poma Canaviri Indira Noemi <?php echo date("Y") ?></div>
            </div>
        </div>
    </footer>
    </div>
    </div>
    <script src="<?php echo base_url(); ?>/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>/js/scripts.js"></script>
    <script src="<?php echo base_url(); ?>/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/demo/datatables-demo.js"></script>


    <!-- jQuery first, then Popper.js, then Bootstrap JS
    <script src="<?php echo base_url(); ?>/js/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"></script>
    -->

    <script src="<?php echo base_url(); ?>/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"></script>

    <script>
        $('#modal-confirma').on('shown.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
    </script>

    </body>

    </html>