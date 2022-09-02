<div id="layourSidenav_content">
    <main>
        <?php if(session('success')){ ?>
            <div class="container-fluid alert alert-success d-flex justify-content-center align-content-center" role="alert">
                <?php echo session('success'); ?>
            </div>
        <?php } ?>
        <div class="container-fluid">
            <h4 class="mt-4"><?php echo $titulo;?></h4>
        </div>
        <div class="container-fluid">
            <p>
                <a href="<?php echo base_url('panelAdmin/producto/agregar');?>" class="btn btn-success">Agregar</a>
                <a href="<?php echo base_url('panelAdmin/producto/destacados');?>" class="btn btn-warning">Destacados</a>
                <a href="<?php echo base_url('panelAdmin/producto/eliminados');?>" class="btn btn-danger">Eliminados</a>
            </p>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" witdth="100%" cellspacing="0">
                <thead class="table-dark">
                    <tr>
                        <td>Imagen</td>
                        <td>Categoria</td>
                        <td>Autor</td>
                        <td>Nombre</td>
                        <td>Precio</td>
                        <td>Stock</td>
                        <td>Destacado</td>
                        <td>Acciones</td>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach($productos as $producto): ?>
                        <tr>
                            <td><img class="img-fluid" src="https://localhost/LucianoValenzuela_P2/<?=$producto['imagen']; ?>" alt="Imagen de libro" width="80" height="60"></td>
                            <?php foreach($categorias as $categoria): ?>
                                <?php if($producto['id_categoria'] == $categoria['id']) : ?>
                                    <td><?=$categoria['nombre']; ?></td>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <td><?=strtoupper($producto['autor']); ?></td>
                            <td><?=strtoupper($producto['nombre']); ?></td>
                            <td><?=$producto['precio']; ?></td>
                            <td><?=$producto['stock']; ?></td>
                            <?php if($producto['destacado'] == 0) : ?>
                            <td>NO</td>
                            <?php endif; ?>
                            <?php if($producto['destacado'] == 1) : ?>
                            <td>SI</td>
                            <?php endif; ?>
                            <td class="btn-group-vertical" role="group">
                                <a class="btn btn-info" href="<?php echo base_url('producto/modificar/'.$producto['id']);?>">MODIFICAR</a>
                                <a class="btn btn-danger" href="<?php echo base_url('producto/eliminar/'.$producto['id']);?>">ELIMINAR</a>
                                <?php if($producto['destacado'] == 0) : ?>
                                <a class="btn btn-warning" href="<?php echo base_url('producto/destacar/'.$producto['id']);?>">DESTACAR</a>
                                <?php endif; ?>
                                <?php if($producto['destacado'] == 1) : ?>
                                <a class="btn btn-warning" href="<?php echo base_url('producto/quitar/'.$producto['id']);?>">QUITAR DESTACADO</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</div>