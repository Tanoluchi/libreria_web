<?php

$user_session = session();
$rol = $user_session->id_rol;
$id = $user_session->id;
?>
<main class="container-fluid aboutPage rounded">
    <a href="<?php echo base_url('catalogo/');?>" class="btn btn-danger text-white btn me-auto mb-3">Volver Atras</a>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-6 order-md-1 d-flex justify-content-center align-content-center">
                <img class="img-fluid" src="https://localhost/LucianoValenzuela_P2/<?=$producto['imagen'];?>" alt="" width="250">
            </div>
            
            <div class="col-md-6 order-md-2">
            <?php if(isset($_SESSION['carrito']['productos'])) : ?>
                <?php $stockRestante = 1000;?>
                <?php $stockRestante = $producto['stock'] - $_SESSION['carrito']['productos'][$producto['id']];?>
                <h2><?=$producto['nombre'];?></h2>
                <span class="text-muted">Autor:</span>
                <span class="text-black"> <?=$producto['autor'];?></span>
                <br>
                <span class="text-muted">Disponibilidad:</span>
                <?php if($stockRestante > 0) : ?>
                <span class="text-black">En Existencia</span>
                <br>
                <span class="text-muted">Categoria:</span>
                <a class="text-decoration-none" href="<?php echo base_url('catalogo/categoria/'.$categorias['id']);?>"><span class="text-black"> <?=ucwords($categorias['nombre']);?></span></a>
                <br>
                <label class="mb-2 mt-3" for="cantidad">Cantidad</label>
                <input class="num" type="number" id="cantidad" name="cantidad" min="1" max="<?=$producto['stock'];?>" value="1">
                <span class="text-muted">(<?=$stockRestante;?> disponibles)</span>
                <?php else: ?>
                <span class="text-muted">Sin Stock</span>
                <br>
                <span class="text-muted">Categoria:</span>
                <a class="text-decoration-none" href="<?php echo base_url('catalogo/categoria/'.$categorias['id']);?>"><span class=" text-black"> <?=ucwords($categorias['nombre']);?></span></a>
                <?php endif; ?>
                <h4>$<?=number_format($producto['precio'], 2, '.', ',');?></h4>
                
                <?php if($rol == 1 || $rol == 2) : ?>
                    <?php if($stockRestante > 0) : ?>
                <button class="btn btn-primary mt-4" type="button" onclick="addProduct(<?php echo $producto['id'];?>)">Agregar al carrito</button>
                    <?php endif; ?>
                <?php endif; ?>
                </button>
                <a href="<?php echo base_url('catalogo/');?>" class="btn btn-success text-white btn mt-4"><i class="fa-solid fa-cart-arrow-down"></i> Seguir comprando</a>
            <?php else: ?>
                <h2><?=$producto['nombre'];?></h2>
                <span class="text-muted">Autor:</span>
                <span class="text-black"> <?=$producto['autor'];?></span>
                <br>
                <span class="text-muted">Disponibilidad:</span>
                <?php if($producto['stock'] > 0) : ?>
                <span class="text-black">En Existencia</span>
                <br>
                <span class="text-muted">Categoria:</span>
                <a class="text-decoration-none" href="<?php echo base_url('catalogo/categoria/'.$categorias['id']);?>"><span class="text-black"> <?=ucwords($categorias['nombre']);?></span></a>
                <br>
                <label class="mb-2 mt-3" for="cantidad">Cantidad</label>
                <input class="num" type="number" id="cantidad" name="cantidad" min="1" max="<?=$producto['stock'];?>" value="1">
                <span class="text-muted">(<?=$producto['stock'];?> disponibles)</span>
                <?php else: ?>
                <span class="text-muted">Sin Stock</span>
                <br>
                <span class="text-muted">Categoria:</span>
                <a class="text-decoration-none" href="<?php echo base_url('catalogo/categoria/'.$categorias['id']);?>"><span class=" text-black"> <?=ucwords($categorias['nombre']);?></span></a>
                <?php endif; ?>
                <h4>$<?=number_format($producto['precio'], 2, '.', ',');?></h4>
                <?php if($rol == 1 || $rol == 2) : ?>
                <button class="btn btn-primary mt-4" type="button" onclick="addProduct(<?php echo $producto['id'];?>)">Agregar al carrito</button>
                <a href="<?php echo base_url('catalogo/');?>" class="btn btn-success text-white btn mt-4"><i class="fa-solid fa-cart-arrow-down"></i> Seguir comprando</a>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            </div>
            <div class="col-md-12 order-md-3 mt-5 bg-body shadow rounded">
                <div class="h5 text-dark p-3 rounded w-auto text-center bg-white fw-bold">Descripcion</div>
                <hr>
                <p class="text-black justify"><?=$producto['descripcion'];?></p>
            </div>
        </div>
    </div>
</main>