<?php

$user_session = session();
$rol = $user_session->id_rol;
$id = $user_session->id_usuario;

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link href="https://localhost/LucianoValenzuela_P2/public/assets/css/datatable.css" rel="stylesheet" />
        <link href="https://localhost/LucianoValenzuela_P2/public/assets/css/styles.css" rel="stylesheet" />
        <script src="https://localhost/LucianoValenzuela_P2/public/assets/js/all.js" crossorigin="anonymous"></script>
        <title><?php echo $titulo;?></title>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3 fw-bold" href="<?php echo base_url('/');?>">Mundo Libro</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <!-- <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form> -->
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Bienvenido, <?php echo $user_session->nombre; ?><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="<?php echo base_url('/');?>">Inicio</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('usuarios/editar/'.$id);?>">Mis Datos</a></li>
                        <li><hr class="dropdown-divider"/></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('usuarios/cerrar_sesion');?>">Cerrar sesión</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="<?php echo base_url('panelAdmin/usuarios/listar');?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Usuarios
                            </a>
                            <a class="nav-link" href="<?php echo base_url('panelAdmin/producto/listar');?>">
                                <div class="sb-nav-link-icon"><i class="fa-brands fa-shopify"></i></div>
                                Productos
                            </a>
                            <a class="nav-link" href="<?php echo base_url('panelAdmin/categoria/listar');?>">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-pen"></i></div>
                                Categorias
                            </a>
                            <a class="nav-link" href="<?php echo base_url('panelAdmin/contacto/listar');?>">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-envelope"></i></div>
                                Contactos
                            </a>
                            <a class="nav-link" href="<?php echo base_url('panelAdmin/consulta/listar');?>">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-circle-question"></i></div>
                                Consultas
                            </a>
                            <a class="nav-link" href="<?php echo base_url('panelAdmin/factura/listar');?>">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-cart-shopping"></i></div>
                                Compras
                            </a>
                    </div>
                </nav>
            </div>
        <div id="layoutSidenav_content">