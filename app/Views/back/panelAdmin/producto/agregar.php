<?php $validation = \Config\Services::validation(); ?>

<div id="layourSidenav_content">
    <main>
        <div class="container-fluid">
            <h4 class="mt-4"><?php echo $titulo;?></h4>
        </div>
        <div class="container-fluid">
            <form method="post" action="<?php echo base_url('panelAdmin/producto/guardar') ?>" enctype="multipart/form-data" class="g-3 needs-validation" novalidate>
                <div class="form-group row g-3">
                    <div class="col-12 col-sm-6">
                        <label class="mb-2" for="nombre">Nombre</label>
                        <input class="form-control" type="text" id="nombre" name="nombre" autofocus>
                        <?php if($validation->getError('nombre')) {?>
                                    <div class='alert alert-danger mt-2'>
                                        <?php echo $validation->getError('nombre'); ?>
                                    </div>
                        <?php }?>
                    </div>
                    <div class="col-12 col-sm-6">
                        <label class="mb-2" for="autor">Autor</label>
                        <input class="form-control" type="text" id="autor" name="autor">
                        <?php if($validation->getError('autor')) {?>
                                    <div class='alert alert-danger mt-2'>
                                        <?php echo $validation->getError('autor'); ?>
                                    </div>
                        <?php }?>
                    </div>
                    <div class="col-12 col-sm-6">
                        <label class="mb-2" for="id_categoria">Categoria</label>
                        <select class="form-control" id="id_categoria" name="id_categoria">
                            <option value="">Seleccionar Categoria</option>
                            <?php foreach($categorias as $categoria): ?>
                                <option value="<?=$categoria['id'];?>"><?=$categoria['nombre'];?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php if($validation->getError('id_categoria')) {?>
                                    <div class='alert alert-danger mt-2'>
                                        <?php echo $validation->getError('id_categoria'); ?>
                                    </div>
                        <?php }?>
                    </div>
                    <div class="col-12 col-sm-6">
                        <label class="mb-2" for="precio">Precio</label>
                        <input class="form-control" type="number" id="precio" name="precio">
                        <?php if($validation->getError('precio')) {?>
                                    <div class='alert alert-danger mt-2'>
                                        <?php echo $validation->getError('precio'); ?>
                                    </div>
                        <?php }?>
                    </div>
                    <div class="col-12 col-sm-6">
                        <label class="mb-2" for="stock">Stock</label>
                        <input class="form-control" type="number" id="stock" name="stock" value="0">
                        <?php if($validation->getError('stock')) {?>
                                    <div class='alert alert-danger mt-2'>
                                        <?php echo $validation->getError('stock'); ?>
                                    </div>
                        <?php }?>
                    </div>
                        <div class="col-12">
                            <label class="mb-2" for="imagen">Imagen</label>
                            <input class="form-control" type="file" id="imagen" name="imagen">
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="mb-2" for="descripcion">Descripcion</label>
                            <textarea class="form-control" id="descripcion" rows="3" name="descripcion"></textarea>
                        </div>
                    </div>

                <a class="mt-4 btn btn-primary" href="<?php echo base_url('panelAdmin/producto/listar') ?>">Regresar</a>
                <button type="submit" class="mt-4 btn btn-success">Guardar</button>
            </form>
        </div>
    </main>
</div>