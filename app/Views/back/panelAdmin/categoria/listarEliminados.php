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
                <a href="<?php echo base_url('panelAdmin/categoria/agregar');?>" class="btn btn-success">Agregar</a>
                <a href="<?php echo base_url('panelAdmin/categoria/eliminados');?>" class="btn btn-danger">Eliminados</a>
            </p>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" witdth="100%" cellspacing="0">
                <thead class="table-dark">
                    <tr>
                        <td>Nombre</td>
                        <td>Descripcion</td>
                        <td>Acciones</td>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach($categorias as $categoria): ?>
                        <tr>
                            <td><?=strtoupper($categoria['nombre']); ?></td>
                            <td><textarea name="" id="" cols="40" rows="3"><?=$categoria['descripcion']; ?></textarea></td>
                            <td>
                                <a class="btn btn-info" href="<?php echo base_url('categoria/modificar/'.$categoria['id']);?>">MODIFICAR</a>
                                <a class="btn btn-success" href="<?php echo base_url('categoria/activar/'.$categoria['id']);?>">ACTIVAR</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</div>