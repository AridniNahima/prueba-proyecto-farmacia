<?php
$user_session = session(); //trae toda la informacion de la sesion por usuario
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Farmacia</title>

    <!--
    <link href="<?php echo base_url(); ?>/css/style.css" rel="stylesheet" />
    <script src="<?php echo base_url(); ?>/js/jquery-3.2.1.slim.min.js"></script>
    <script src="<?php echo base_url(); ?>/js/jquery.min.js"></script>  
    <script src="<?php echo base_url(); ?>/js/font-icons.js"></script>
      <link href="<?php echo base_url(); ?>/css/bootstrap.min.css" rel="stylesheet" />
    -->

    <link href="<?php echo base_url(); ?>/css/styles.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>/css/toastr.min.css" rel="stylesheet" />
    <script src="<?php echo base_url(); ?>/js/all.js"></script>
    <script src="<?php echo base_url(); ?>/js/jquery-ui/external/jquery/jquery.js"></script>
    <script src="<?php echo base_url(); ?>/js/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>/js/toastr.min.js"></script>
    <script src="<?php echo base_url(); ?>/js/Chart.min.js"></script>

</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="<?php echo base_url(); ?>/inicio"><i class="fa-solid fa-prescription-bottle-medical"></i> Farmacia economía <br> y salud Pro Farma</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto me-md-3 my-2 my-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-circle-user"></i> <?php echo $user_session->nombre ?></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>/usuarios/cambia_password">Cambiar contraseña</a>
                    </li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="<?php echo base_url(); ?>/usuarios/logout">Cerrar sesión</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <!--CollapseProductos-->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProductos" aria-expanded="false" aria-controls="collapseProductos">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-capsules"></i></div>
                            Productos
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseProductos" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo base_url(); ?>/categorias">Categorias</a>
                                <a class="nav-link" href="<?php echo base_url(); ?>/productos">Productos</a>
                            </nav>
                        </div>
                        <!--CollapseProveedores-->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProveedores" aria-expanded="false" aria-controls="collapseProveedores">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-flask-vial"></i></div>
                            Laboratorios
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseProveedores" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo base_url(); ?>/proveedores">Laboratorios</a>
                            </nav>
                        </div>

                        <!--CollapseCompras-->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCompras" aria-expanded="false" aria-controls="collapseCompras">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-truck-medical"></i></i></div>
                            Compras
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseCompras" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo base_url(); ?>/compras/nuevo">Nueva Compra</a>
                                <a class="nav-link" href="<?php echo base_url(); ?>/compras">Compras</a>
                            </nav>
                        </div>
                        <!--CollapseVentas-->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseVentas" aria-expanded="false" aria-controls="collapseVentas">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-cash-register"></i></div>
                            Ventas
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseVentas" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo base_url(); ?>/ventas/venta"> Nueva Venta </a>
                                <a class="nav-link" href="<?php echo base_url(); ?>/ventas">Ventas</a>
                            </nav>
                        </div>
                        <!--CollapseReportes-->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseReportes" aria-expanded="false" aria-controls="collapseReportes">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-file-contract"></i></div>
                            Reportes
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseReportes" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo base_url(); ?>/productos/muestraMinimos">Reporte stock mínimo</a>
                            </nav>
                        </div>

                        <div class="collapse" id="collapseReportes" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo base_url(); ?>/productos/muestraPorVencer">Reporte productos vencidos</a>
                            </nav>
                        </div>

                        <!--CollapseAdministracion-->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#subAdministracion" aria-expanded="false" aria-controls="subAdministracions">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-clipboard"></i></div>
                            Administración
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="subAdministracion" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo base_url(); ?>/configuracion">Configuración</a>
                                <a class="nav-link" href="<?php echo base_url(); ?>/usuarios">Usuarios</a>
                                <a class="nav-link" href="<?php echo base_url(); ?>/roles">Roles</a>
                                <a class="nav-link" href="<?php echo base_url(); ?>/cajas">Cajas</a>
                                <a class="nav-link" href="<?php echo base_url(); ?>/logs">Logs de acceso</a>
                            </nav>
                        </div>
                    </div>
                </div>
            </nav>
        </div>

        <?php ?>