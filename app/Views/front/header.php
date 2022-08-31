<?php

$user_session = session();
$rol = $user_session->id_rol;
$id = $user_session->id_usuario;

$num_cart = 0;

if(isset($_SESSION['carrito']['productos'])){
    $num_cart = count($_SESSION['carrito']['productos']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://localhost/LucianoValenzuela_P2/public/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://localhost/LucianoValenzuela_P2/public/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="https://localhost/LucianoValenzuela_P2/public/assets/css/styles.css">
    <link rel="stylesheet" type="text/css" href="https://localhost/LucianoValenzuela_P2/public/assets/css/fontawesome.min.css">
    <script src="https://localhost/LucianoValenzuela_P2/public/assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://localhost/LucianoValenzuela_P2/public/assets/js/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://localhost/LucianoValenzuela_P2/public/assets/css/sweetalert2.min.css">
    <script src="https://localhost/LucianoValenzuela_P2/public/assets/js/all.js" crossorigin="anonymous"></script>
    <link href="https://localhost/LucianoValenzuela_P2/public/assets/css/datatable.css" rel="stylesheet" />
    
    <script src="https://localhost/LucianoValenzuela_P2/public/assets/js/all.js"></script>
    <title><?php echo $titulo;?></title>
</head>

<script>
    function success() {
        Swal.fire(
            'Buen trabajo!',
            'Se ha enviado el formulario correctamente',
            'success'
        )
    }

    // Agregar un producto
    function addProduct(id, cantidad = null){
        let url = '<?php echo base_url('carrito/agregar');?>';
        let formData = new FormData()
        if (cantidad != null){
            formData.append('id', id);
            formData.append('cantidad', cantidad);
        }else{
            cantidad = document.getElementById('cantidad').value;
            formData.append('id', id);
            formData.append('cantidad', cantidad);
        }
        
        fetch(url, {
            method: 'POST',
            body: formData,
            mode: 'cors'
        }).then(response => response.json())
        .then(data=> {
            if(data.ok){
                let elemento = document.getElementById('num_cart');
                elemento.innerHTML = data.numero
                location.reload();
            }
        })
    }

    // Actualizar cantidad de productos en el carrito

    function actualizarCantidad(cantidad, id){
        let url = '<?php echo base_url('carrito/actualizar');?>';
        let formData = new FormData()
        formData.append('action', 'agregar');
        formData.append('id', id);
        formData.append('cantidad', cantidad);
        
        fetch(url, {
            method: 'POST',
            body: formData,
            mode: 'cors'
        }).then(response => response.json())
        .then(data => {
            if(data.ok){
                let divsubtotal = document.getElementById('subtotal_' + id)
                divsubtotal.innerHTML = data.sub

                let total = 0.00
                let list = document.getElementsByName('subtotal[]')

                for(let i = 0; i < list.length; i++){
                    total += parseFloat(list[i].innerHTML.replace(/[$,]/g, ''))
                }

                total = new Intl.NumberFormat('en-US', {
                    minimumFractionDigits: 2,
                }).format(total)

                document.getElementById('total').innerHTML = '$' + total
            }
        })
    }
</script>
<?php if(session('login')){ ?>
    <div class="container-fluid alert alert-success d-flex justify-content-center align-content-center" role="alert">
        <?php echo session('login'); ?>
    </div>
<?php } ?>

<?php if(session('modificar')){ ?>
    <div class="container-fluid alert alert-success d-flex justify-content-center align-content-center" role="alert">
        <?php echo session('modificar'); ?>
    </div>
<?php } ?>
<body class="container-fluid body-main">
    <header class="container-fluid header-main">
        <!-- BARRA DE NAVEGACIÓN -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <!--  BARRA LOGO -->
                <div class="navbar-logo">
                    <a class="navbar-brand" href="#">
                        <img src="https://localhost/LucianoValenzuela_P2/public/assets/img/logo.png" height="60" alt="">
                    </a>
                </div>

                <!-- BARRA MENÚ -->
                <a class="navbar-brand fw-bold" href="<?php echo base_url('/');?>">Mundo Libro</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- BARRA ITEMS -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link fw-bold" aria-current="page" href="<?php echo base_url('/');?>">Principal</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-bold" href="<?php echo base_url('quienesSomos');?>">Quienes Somos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-bold" href="<?php echo base_url('comercializacion');?>">Comercialización</a>
                        </li>
                        <?php if($rol == null) : ?>
                        <li class="nav-item">
                            <a class="nav-link fw-bold" href="<?php echo base_url('contacto');?>">Contacto</a>
                        </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link fw-bold" href="<?php echo base_url('terminos');?>">Términos y Usos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-bold" href="<?php echo base_url('catalogo');?>"> Catálogo</a>
                        </li>
                        <?php if($rol == 1 || $rol == 2) : ?>
                        <li class="nav-item">
                            <a class="nav-link fw-bold" href="<?php echo base_url('consulta');?>">Consultas</a>
                        </li>
                        <?php endif; ?>
                        </li>
                    </ul>
                    <?php if(!($user_session->id_rol)) : ?>
                    <ul class="navbar-nav me-auto ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link fw-bold" href="<?php echo base_url('usuarios/registrar');?>">Crear cuenta</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-bold" href="<?php echo base_url('usuarios/login');?>">Iniciar Sesión</a>
                        </li>
                    </ul>
                    <?php endif; ?>
                </div>
                <?php if($rol == 1 || $rol == 2) : ?>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle fw-bold" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Bienvenido, <?php echo $user_session->nombre; ?> 
                            <i class="fas fa-user fa-fw"></i></a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown"">
                                <?php if($rol == 2) : ?>
                                <a class="dropdown-item" href="<?php echo base_url('panelAdmin/usuarios/listar');?>">Panel Administración</a>
                                <?php endif; ?>
                                <a class="dropdown-item" href="<?php echo base_url('usuarios/editar/'.$id);?>">Mis Datos</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo base_url('usuarios/cerrar_sesion');?>">Cerrar sesión</a>
                            </div>
                        </li>
                    </ul>
                    <a class="nav-link text-black" href="<?php echo base_url('carrito/');?>"><i class="fas fa-cart-shopping"></i> <span id="num_cart" class="badge background-naranja"><?php echo $num_cart; ?></span></a>
                </div>
                <?php endif; ?>
            </div>
        </nav>
    </header>