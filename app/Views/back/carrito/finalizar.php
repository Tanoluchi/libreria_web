<?php $validation = \Config\Services::validation();?>
<main class="container-fluid">
        <div class="pageTitleSection pb-3 me-5">
            <h3 class="h3 color-azul fw-bold text-center me-5"><?php echo $titulo ?></h3>
        </div>
        <div class="container-fluid">
            <hr>
            <h5 class="h5 color-azul fw-bold text-start me-5">Datos personales</h5>
            <div class="row">
                <div class="col-12">
                    <span class="fw-bold">Provincia:</span>
                    <span><?php echo $direccion['provincia'] ?></span>
                </div>
                <br>
                <div class="col-12">
                    <span class="fw-bold">Localidad:</span>
                    <span><?php echo $direccion['localidad'] ?></span>
                </div>
                <br>
                <div class="col-12">
                    <span class="fw-bold">Calle:</span>
                    <span><?php echo $direccion['calle'] ?> </span>
                    <span><?php echo $direccion['numero'] ?></span>
                </div>
                <br>
                <div class="col-12">
                    <span class="fw-bold">Codigo postal:</span>
                    <span><?php echo $direccion['codigoPostal'] ?></span>
                </div>
                <br>
                <div class="col-12">
                    <span class="fw-bold">Metodo de envio:</span>
                    <span><?php echo $envio['nombre'] ?></span>
                </div>
                <br>
                <div class="col-12">
                    <span class="fw-bold">Metodo de pago:</span>
                    <span><?php echo $pago['nombre'] ?></span>
                </div>
            </div>
            <h5 class="h5 color-azul fw-bold text-start mt-5">Datos de compra</h5>
        </div>
        
        <div class="container-fluid">
            <div class="table-responsive mt-4">
                <table class="table table-bordered" id="dataTable" witdth="100%" cellspacing="0">
                    <thead class="table-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0; ?>
                        <?php foreach($productos as $producto){
                            if (isset($carrito[$producto['id']])){
                                $id =  $producto['id'];
                                $nombre = $producto['nombre'];
                                $precio = $producto['precio'];
                                $cantidad = $carrito[$producto['id']];
                                $subtotal = $cantidad * $precio;
                                $total += $subtotal;
                                ?>
                                <tr>
                                    <td><?php echo $nombre;?></td>
                                    <td>$<?php echo number_format($precio, 2, '.', ',');?></td>
                                    <td><?php echo $cantidad;?></td>
                                    <td>$<?php echo number_format($subtotal, 2, '.', ','); ?></td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                        <?php $total += $envio['precio']; ?>
                        <tr>
                            <td><?php echo $envio['nombre']?></td>
                            <td>$<?php echo number_format($envio['precio'], 2, '.', ',');?></td>
                            <td>1</td>
                            <td>$<?php echo number_format($envio['precio'], 2, '.', ','); ?></td>
                        </tr>
                        
                    </tbody>
                </table>
        </div>
            <div class="d-flex justify-content-end align-content-end me-5">
                <p class="h4 me-5 fw-bold me-5" id="total">Total: <?php echo number_format($total, 2, '.', ','); ?></p>
            </div>
            <form method="post" action="<?php echo base_url('factura/guardar') ?>" class="container-fluid d-flex justify-content-between align-content-between ">
                <input type="hidden" name="id_envio" value="<?=$envio['id'];?>">
                <input type="hidden" name="id_pago" value="<?=$pago['id'];?>">
                <input type="hidden" name="total" value="<?=$total;?>">
                <a href="<?php echo base_url('carrito/') ?>" class="btn btn-danger fw-bold my-3 mt-4">Cancelar</a>
                <button type="submit" class="btn btn-success fw-bold my-3 mt-4">Confirmar compra</button>
            </form>
</main>