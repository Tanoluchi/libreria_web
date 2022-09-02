<?php $validation = \Config\Services::validation(); ?>
<?php if(session('mensaje')){ ?>
    <div class="alert alert-danger" role="alert">
      <?php echo session('mensaje'); ?>
    </div>
  <?php } ?>
<div id="layourSidenav_content">
    <main>
        <?php if(session('error')){ ?>
            <div class="container-fluid alert alert-danger d-flex justify-content-center align-content-center" role="alert">
                <?php echo session('error'); ?>
            </div>
        <?php } ?>
        <div class="container-fluid">
            <h4 class="mt-4"><?php echo $titulo;?></h4>
        </div>
        <div class="container-fluid">
            <form method="post" action="<?php echo base_url('producto/actualizar') ?>" enctype="multipart/form-data" class="g-3 needs-validation" novalidate>
                <div class="form-group row g-3">
                    <input type="hidden" name="id" value="<?=$producto['id'];?>">
                    <div class="col-12 col-sm-6">
                        <label class="mb-2" for="nombre">Nombre</label>
                        <input class="form-control" type="text" id="nombre" name="nombre" value="<?=$producto['nombre'];?>" autofocus>
                        <?php if($validation->getError('nombre')) {?>
                                    <div class='alert alert-danger mt-2'>
                                        <?php echo $validation->getError('nombre'); ?>
                                    </div>
                        <?php }?>
                    </div>
                    <div class="col-12 col-sm-6">
                        <label class="mb-2" for="autor">Autor</label>
                        <input class="form-control" type="text" id="autor" name="autor" value="<?=$producto['autor'];?>">
                        <?php if($validation->getError('autor')) {?>
                                    <div class='alert alert-danger mt-2'>
                                        <?php echo $validation->getError('autor'); ?>
                                    </div>
                        <?php }?>
                    </div>
                    <div class="col-12 col-sm-6">
                        <label class="mb-2" for="id_categoria">Categoria</label>
                        <select class="form-control" id="id_categoria" name="id_categoria">
                            <option value="<?=$producto['id_categoria'];?>">Seleccionar Categoria</option>
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
                        <input class="form-control" type="number" id="precio" name="precio" value="<?=$producto['precio'];?>">
                        <?php if($validation->getError('precio')) {?>
                                    <div class='alert alert-danger mt-2'>
                                        <?php echo $validation->getError('precio'); ?>
                                    </div>
                        <?php }?>
                    </div>
                    <div class="col-12 col-sm-6">
                        <label class="mb-2" for="stock">Stock</label>
                        <input class="form-control" type="number" id="stock" name="stock" value="<?=$producto['stock'];?>">
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
                            <textarea class="form-control" id="descripcion" rows="3" name="descripcion" value="<?=$producto['descripcion'];?>"><?=$producto['descripcion'];?></textarea>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <?php if($producto['destacado'] == 0) : ?>
                            <input class="form-check-input" type="checkbox" id="destacado" name="destacado" value="SI">
                            <label class="form-check-label fw-bold" for="destacado">Destacar</label>
                        <?php endif; ?>
                    </div>

                <a class="mt-4 btn btn-primary" href="<?php echo base_url('panelAdmin/producto/listar') ?>">Regresar</a>
                <button type="submit" class="mt-4 btn btn-success">Guardar</button>
            </form>
        </div>
    </main>
</div>