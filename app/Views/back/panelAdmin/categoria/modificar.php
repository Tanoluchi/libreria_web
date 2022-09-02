<?php $validation = \Config\Services::validation(); ?>

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
            <form method="post" action="<?php echo base_url('categoria/actualizar') ?>" class="g-3 needs-validation" novalidate>
                <div class="form-group row g-3">
                    <input type="hidden" name="id" value="<?=$categoria['id'];?>">
                    <div class="col-12">
                        <label class="mb-2" for="nombre">Nombre</label>
                        <input class="form-control w-50" type="text" id="nombre" name="nombre" value="<?=$categoria['nombre'];?>" autofocus>
                        <?php if($validation->getError('nombre')) {?>
                                    <div class='alert alert-danger mt-2'>
                                        <?php echo $validation->getError('nombre'); ?>
                                    </div>
                        <?php }?>
                    </div>
                    <div class="col-12">
                        <label class="mb-2" for="descripcion">Descripcion</label>
                        <textarea class="form-control w-50" id="descripcion" rows="3" name="descripcion"><?=$categoria['descripcion'];?></textarea>
                        <?php if($validation->getError('descripcion')) {?>
                                    <div class='alert alert-danger mt-2'>
                                        <?php echo $validation->getError('descripcion'); ?>
                                    </div>
                        <?php }?>
                    </div>
                </div>

                <a class="mt-4 btn btn-primary" href="<?php echo base_url('panelAdmin/categoria/listar') ?>">Regresar</a>
                <button type="submit" class="mt-4 btn btn-success">Guardar</button>
            </form>
        </div>
    </main>
</div>