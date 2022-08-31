<?php 
$user_session = session();
$rol = $user_session->id_rol
?>
<div id="layoutSidenav">
            <div id="layoutSidenav_nav" class="d-none d-sm-block">
                <nav class="sb-sidenav accordion background-gris" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <h6 class="h6 mt-3 text-black d-sm-block text-center me-3 fw-bold text-opacity-75">Categorías</h6>
                        <hr>
                        <div class="nav categorias">
                        <a class="nav-link text-black text-opacity-75" href="<?php echo base_url('catalogo');?>">
                                <span><?=ucwords("Todos");?></span>
                            </a>
                        <?php foreach($categorias as $categoria) : ?>
                            <a class="nav-link text-black text-opacity-75" href="<?php echo base_url('catalogo/categoria/'.$categoria['id']);?>">
                                <span><?=ucwords($categoria['nombre']);?></span>
                            </a>
                            <?php endforeach; ?>
                    </div>
                </nav>
            </div>
<hr class="hr">
<main class="container-fluid aboutPage rounded">
        <form method="post" action="<?php echo base_url('catalogo/buscar') ?>" class="form-inline my-2 my-lg-0 ms-auto d-flex g-3 needs-validation" novalidate>
            <input class="form-control me-4 mr-sm-2" type="search" placeholder="Buscar producto" aria-label="search" name="buscar" id="buscar">
            <button class="btn btn-outline-primary me-4 my-2 my-sm-0" type="submit">Buscar</button>
        </form>
    <div class="container-fluid py-4">
        <div class="container-fluid row">
                <?php foreach($productos as $producto) : ?>
                    <?php if(isset($_SESSION['carrito']['productos'])) : ?>
                        <?php $stockRestante = 1000;?>
                        <?php $stockRestante = $producto['stock'] - $_SESSION['carrito']['productos'][$producto['id']];?>
                    <?php else: ?>
                        <?php $stockRestante = $producto['stock'];?>
                    <?php endif; ?>
                <?php if($stockRestante != 0) : ?>
                <div class="col mb-3">
                    <div class="card shadow">
                        <a href="<?php echo base_url('catalogo/detalles/'.$producto['id']); ?>"><img class="card-img-top" alt="Responsive image" src="https://localhost/LucianoValenzuela_P2/<?=$producto['imagen'];?>"></a>
                        <div class="card-body">
                            <a class="text-decoration-none" href="<?php echo base_url('catalogo/detalles/'.$producto['id']); ?>"><h6 class="card-title text-center text-dark"><?=strtoupper($producto['nombre']);?></h6></a>
                            <p class="card-text text-center">
                                <small class="text-dark text-muted"><?=strtoupper($producto['autor']);?></small>
                            </p>
                        <div class="d-flex justify-content-center align-items-center">
                            <span class="fw-bold">$<?=$producto['precio'];?></span>
                        </div>
                        <div class="d-flex justify-content-center align-items-center mt-3">
                            <div class="container-fluid btn-group-vertical">
                                <a href="<?php echo base_url('catalogo/detalles/'.$producto['id']); ?>" class="btn btn-primary rounded">Detalles</a>
                                <?php if($rol == 1 || $rol == 2) : ?>
                                <button type="button" class="btn btn-success mt-1 rounded" onclick="addProduct(<?php echo $producto['id'];?>, 1)">Comprar</button>
                                <?php endif; ?>
                            </div>
                        </div>
                        </div>
                    </div> 
                </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</main>
</div>