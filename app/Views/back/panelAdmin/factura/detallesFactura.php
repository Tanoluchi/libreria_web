<?php 
$cant_productos = $num_cart = count($detallesFactura);

foreach($detallesFactura as $detalle){
    foreach($productos as $producto){
        if($detalle['id_producto'] == $producto['id']){
            $sub += $producto['precio'] * $detalle['cantidad'];
        }
    }
}

?>
<div id="layourSidenav_content">
    <main>
        <div class="container-fluid d-flex  justify-content-center align-content-center">
            <h4 class="mt-4 fw-bold"><?php echo $titulo;?></h4>
        </div>

        <div class="container-fluid mt-3">
            <div class="container-fluid d-flex justify-content-center align-content-center row row-cols-1 row-cols-2 row-cols-3">
                <div class="col-12 card mb-3 shadow border" style="max-width: 30rem;">
                    <div class="card-header bg-transparent text-muted"><small>Factura | #<?=$factura['id'];?></small> </div>
                    <div class="card-body row">
                        <div class="col-6">
                            <span class="card-text">Productos (<?=$cant_productos;?>)</span>
                        </div>
                        <div class="col-6">
                            <span class="card-text d-flex justify-content-end align-content-end">$ <?=number_format($sub, 2, '.', ',');?></span>
                        </div>
                        <div class="col-6">
                            <span class="card-text">Envío</span>
                        </div>
                        <div class="col-6">
                            <span class="card-text d-flex justify-content-end align-content-end">$ <?=number_format($envio['precio'], 2, '.', ',');?></span>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent row">
                        <div class="col-6">
                            <span class="fw-bold">Total</span>
                        </div>
                        <div class="col-6">
                            <span class="fw-bold d-flex justify-content-end align-content-end">$ <?=number_format($factura['importe_total'], 2, '.', ',');?></span>
                        </div>
                        <hr class="mt-4">
                        <div class="col-12 mb-3">
                            <a class="text-decoration-none" href="<?php echo base_url('panelAdmin/factura/mostrarPDF/' . $factura['id']);?>">Descargar factura</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid d-flex  justify-content-center align-content-center">
                    <h6 class="mt-4 fw-bold">Detalles del pago</h4>
            </div>
            <div class="container-fluid d-flex justify-content-center align-content-center row row-cols-1 row-cols-2 row-cols-3">
                <div class="col-12 card mb-3 shadow mt-2 border" style="max-width: 30rem;">
                        <div class="card-header bg-transparent mt-2"><h6>$<?=number_format($factura['importe_total'], 2, '.', ',');?></h6></div>
                        <div class="card-body row">
                            <div class="col-12">
                                <span class="card-text text-muted"><?=$pago['nombre'];?></span>
                            </div>
                            <div class="col-12">
                                <span class="card-text text-success">Pago aprobado</span>
                            </div>
                        </div>
                </div>
            </div>
            <div class="container-fluid d-flex  justify-content-center align-content-center">
                    <h6 class="mt-4 fw-bold">Detalles de envío</h4>
            </div>
            <div class="container-fluid d-flex justify-content-center align-content-center row row-cols-1 row-cols-2 row-cols-3">
                <div class="col-12 card mb-3 shadow" style="max-width: 30rem;">
                        <div class="card-header bg-transparent fw-bold">
                            <span><?=$envio['nombre'];?></span>
                        </div>
                        <div class="card-body row">
                            <div class="col-12">
                                <span><?=$direccion['calle'];?></span>
                                <span><?=$direccion['numero'];?></span>
                            </div>
                            <div class="col-12">
                                <span class="card-text text-muted"><?=$direccion['localidad'];?>, <?=$direccion['provincia'];?></span>
                            </div>
                        </div>
                </div>
            </div>

            <?php foreach($detallesFactura as $detalle) : ?>
                <?php foreach($productos as $producto) : ?>
                    <?php if($detalle['id_producto'] == $producto['id']) : ?>
                        <?php $unidad += 1 ?>
                        <div class="container-fluid d-flex justify-content-center align-content-center row row-cols-1 row-cols-2 row-cols-3">
                            <div class="col-12 card mb-3 shadow" style="max-width: 30rem;">
                                    <div class="card-header bg-transparent fw-bold"><h6 class="fw-bold mt-3">Paquete <?=$unidad;?></h6></div>
                                    <div class="card-body row">
                                        <div class="col-4 imgbord ms-0 ms-md-3" style="background-image: url(https://localhost/LucianoValenzuela_P2/<?=$producto['imagen'];?>)">
                                        </div>
                                        <div class="col-4 d-flex justify-content-center align-content-center mt-3 ms-3 ms-md-0">
                                        <span class="card-text"><?=$producto['nombre'];?></span>
                                        </div>
                                        <div class="col-4 d-flex justify-content-center align-content-center mt-3 ms-3 ms-md-0">
                                            <span class="card-text text-muted">$<?=$producto['precio'] * $detalle['cantidad'];?> | <?=$detalle['cantidad'];?></span>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </div>
    </main>
</div>