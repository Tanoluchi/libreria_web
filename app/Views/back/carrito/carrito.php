<?php if(session('compra')){ ?>
  <div class="container-fluid success alert-success d-flex justify-content-center align-content-center" role="success">
    <?php echo session('compra'); ?>
  </div>
<?php } ?>

<main class="container-fluid">
    <div class="container-fluid">
        
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($carrito == null){
                        echo '<tr><td colspan="5" class="text-center h3"><b>Lista Vacia</b></td></tr>';
                    } else {
                        $total = 0;
                        foreach($productos as $producto){
                            if (isset($carrito[$producto['id']])){
                                    $id =  $producto['id'];
                                    $img = "https://localhost/LucianoValenzuela_P2/".$producto['imagen'];
                                    $nombre = $producto['nombre'];
                                    $stock = $producto['stock'];
                                    $precio = $producto['precio'];
                                    $cantidad = $carrito[$producto['id']];
                                    $subtotal = $cantidad * $precio;
                                    $total += $subtotal;
                                    ?>
                                    <tr>
                                    <td><img src="<?php echo $img;?>" alt="" width="70"></td>
                                    <td><?php echo $nombre;?></td>
                                    <td>$<?php echo number_format($precio, 2, '.', ',');?></td>
                                    <td>
                                        <input type="number" min="1" max="<?php echo $stock;?>" step="1" value="<?php echo $cantidad;?>" size="5" id="cantidad_<?php echo $id; ?>" onchange="actualizarCantidad(this.value, <?php echo $id;?>)">
                                    </td>
                                    <td>
                                        <div id="subtotal_<?php echo $id;?>" name="subtotal[]">$<?php echo number_format($subtotal, 2, '.', ','); ?></div>
                                    </td>
                                    <td>
                                        <a href="#" id="eliminar" class="btn btn-danger btn-sm" data-bs-id="<?php echo $id; ?>" data-bs-toggle="modal" data-bs-target="#eliminaModal">Eliminar</a>
                                    </td>
                                    </tr>
                            <?php } ?>
                        <?php } ?>
                        
                    </tbody>
                <?php } ?>
            </table>
            <?php if($carrito != null) : ?>
            <div class="d-flex justify-content-end align-content-end me-5">
                <p class="h4 me-5" id="total">Total: <?php echo number_format($total, 2, '.', ','); ?></p>
            </div>
            <hr>
            <?php endif;?>
            <div class="row d-flex justify-content-between align-content-between">
            
            <?php if($carrito != null) : ?>
                <div class="col-md-3">
                    <button class="btn btn-warning btn-lg" data-bs-toggle="modal" data-bs-target="#vaciarModal">Limpiar carrito</button>
                </div>
            <?php endif;?>
            <div class="col-md-3">
                <a href="<?php echo base_url('catalogo/');?>" class="btn btn-success text-white btn-lg"><i class="fa-solid fa-cart-arrow-down"></i> Seguir comprando</a>
            </div>
            <?php if($carrito != null) : ?>
                <div class="col-md-2 mb-5">
                    <a href="<?php echo base_url('carrito/datos');?>" class="btn btn-primary btn-lg">Comprar</a>
                </div>
            <?php endif;?>
            </div>
        </div>
    </div>
</main>

<!-- Modal: eliminar producto del carrito -->
<div class="modal fade" id="eliminaModal" tabindex="-1" aria-labelledby="eliminaModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="eliminaModalLabel">Alerta</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h6 class="text-center fw-bold">¿Desea eliminar el producto del carrito?</h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button id="btn-elimina" type="button" class="btn btn-danger" onclick="eliminar()">Eliminar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal: Vaciar carrito -->
<div class="modal fade" id="vaciarModal" tabindex="-1" aria-labelledby="vaciarModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="vaciarModalLabel">Alerta</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h6 class="text-center fw-bold">¿Desea vaciar el carrito?</h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button id="btn-vaciar" type="button" class="btn btn-danger" onclick="vaciar()">Vaciar</button>
      </div>
    </div>
  </div>
</div>

<script>
     //  Funciones del carrito
    let eliminaModal = document.getElementById('eliminaModal')
    eliminaModal.addEventListener('show.bs.modal', event => {
        let button = event.relatedTarget
        let id = button.getAttribute('data-bs-id')
        let buttonElimina = eliminaModal.querySelector('.modal-footer #btn-elimina')
        buttonElimina.value = id
    })
    
    // Eliminar producto del carrito
    function eliminar(){
        let botonElimina = document.getElementById('btn-elimina')
        let id = botonElimina.value
        
        let url = '<?php echo base_url('carrito/actualizar');?>';
        let formData = new FormData()
        formData.append('action', 'eliminar');
        formData.append('id', id);
        
        fetch(url, {
            method: 'POST',
            body: formData,
            mode: 'cors'
        }).then(response => response.json())
        .then(data => {
            if(data.ok){
                location.reload();
            }
        })
    }

    // Vaciar carrito
    function vaciar(){
        let botonVaciar = document.getElementById('btn-vaciar')
        
        let url = '<?php echo base_url('carrito/actualizar');?>';
        let formData = new FormData()
        formData.append('action', 'vaciar');
        
        fetch(url, {
            method: 'POST',
            body: formData,
            mode: 'cors'
        }).then(response => response.json())
        .then(data => {
            if(data.ok){
                location.reload();
            }
        })
    }
</script>