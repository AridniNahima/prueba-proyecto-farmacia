<?php
$user_session = session();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Farmacia Pro Farma</title>
    <link href="<?php echo base_url(); ?>/css/styles.css" rel="stylesheet" />
    <script src="<?php echo base_url(); ?>/js/all.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/css/bootstrap.min.css">

    <style>
        body {
            background-image: url("<?php echo base_url(); ?>/images/capsulas.png");
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body>
    <?php print_r($user_session->nombre) ?>
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">

                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4"><img src="<?php echo base_url(); ?>/images/logotipo.png" width="400" /></h3>
                                </div>

                                <div class="card-body">
                                    <form method="post" action="<?php echo base_url(); ?>/usuarios/valida">

                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="usuario" name="usuario" type="text" placeholder="Ingresa tu usuario" />
                                            <label class="mb-1" for="usuario">Usuario</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="password" name="password" type="password" placeholder="Ingresa tu contraseña" />
                                            <label class="mb-1" for="password">Contraseña</label>
                                        </div>

                                        <div class="d-grid gap-2 col-6 mx-auto">
                                            <button class="btn btn-outline-info" type="submit">Iniciar Sesión</button>
                                        </div>
                                        <br>
                                        <?php if (isset($validation)) { ?>
                                            <div class="alert alert-danger">
                                                <?php echo $validation->listErrors(); ?>
                                            </div>
                                        <?php } ?>

                                        <?php if (isset($error)) { ?>
                                            <div class="alert alert-danger">
                                                <?php echo $error; ?>
                                            </div>
                                        <?php } ?>

                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
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

</body>

</html>