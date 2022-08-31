<?php

$user_session = session();
$rol = $user_session->id_rol;
$id = $user_session->id;

$validation = \Config\Services::validation(); ?>

<?php if(session('error')){ ?>
    <div class="container-fluid alert alert-success d-flex justify-content-center align-content-center" role="alert">
        <?php echo session('error'); ?>
    </div>
<?php } ?>

<main class="container-fluid">
  <div class="container-fluid aboutPage py-4">
    <div class="pageTitleSection pb-2">
      <h3 class="h3 color-azul fw-bold">Editar Usuario</h3>
    </div>
    <div class="container-fluid shadow-lg rounded bg-white">
        <div class="row row-cols-1 row-cols-lg-2 bg-white rounded py-4 d-flex justify-content-center align-content-center">
          <div class="form-register bg-body rounded shadow-lg rounded">
            <h5 class="h5 fw-bold color-azul py-3">Información personal</h5>
            <form method="post" action="<?php echo base_url('usuarios/actualizar') ?>" class="g-3 needs-validation">
              <div class="form-group row g-3">
              <input type="hidden" name="id" value="<?=$usuarios['id'];?>">
                <div class="col-12 col-lg-6">
                  <label  class="pb-2 py-2 color-azul" for="nombre">Nombre</label>
                  <input id="nombre" type="text" class="form-control" name="nombre" placeholder="Nombre" value="<?=$usuarios['nombre'];?>">
                </div>
                <?php if($validation->getError('nombre')) {?>
                        <div class='alert alert-danger mt-2'>
                            <?php echo $validation->getError('nombre'); ?>
                        </div>
                <?php }?>
                <div class="col-12 col-lg-6">
                  <label class="pb-2 py-2 color-azul" for="apellido">Apellido</label>
                  <input id="apellido" type="text" class="form-control" name="apellido" placeholder="Apellido" value="<?=$usuarios['apellido'];?>">
                </div>
                <?php if($validation->getError('apellido')) {?>
                        <div class='alert alert-danger mt-2'>
                            <?php echo $validation->getError('apellido'); ?>
                        </div>
                <?php }?>
                <div class="col-12 col-lg-6">
                  <label class="pb-2 py-2 color-azul" for="email">Email</label>
                  <input id="email" type="text" class="form-control" name="email" placeholder="name@example.com" value="<?=$usuarios['email'];?>">
                </div>
                <?php if($validation->getError('email')) {?>
                        <div class='alert alert-danger mt-2'>
                            <?php echo $validation->getError('email'); ?>
                        </div>
                <?php }?>
                <div class="col-12 col-lg-6">
                  <label class="pb-2 py-2 color-azul" for="telefono">Telefono</label>
                  <input id="telefono" type="text" class="form-control" name="telefono" placeholder="Numero telefonico" value="<?=$usuarios['telefono'];?>">
                </div>
                <?php if($validation->getError('telefono')) {?>
                        <div class='alert alert-danger mt-2'>
                            <?php echo $validation->getError('telefono'); ?>
                        </div>
                <?php }?>
                <div class="col-12 col-lg-6">
                  <label class="pb-2 py-2 color-azul" for="dni">Nº Documento</label>
                  <input id="dni" type="text" class="form-control" name="dni" placeholder="Numero DNI" value="<?=$usuarios['dni'];?>">
                </div>
                <?php if($validation->getError('dni')) {?>
                        <div class='alert alert-danger mt-2'>
                            <?php echo $validation->getError('dni'); ?>
                        </div>
                <?php }?>
              </div>
            <div class="form-group row">
              <h5 class="card-title fw-bold color-azul py-4">Información de Inicio de sesión</h5>
              <div class="col-lg-6 color-azul">
                <label class="pb-2" for="password">Contraseña</label>
                <input id="password" type="password" class="form-control" name="password">
              </div>
              <?php if($validation->getError('password')) {?>
                        <div class='alert alert-danger mt-2'>
                            <?php echo $validation->getError('password'); ?>
                        </div>
              <?php }?>
            </div>
              <button type="submit" class="btn btn-warning fw-bold my-3">Actualizar</button>
              <a href="<?php echo base_url('/');?>" class="btn btn-danger fw-bold">Cancelar</a>
            </form>
          </div>
        </div>
      </div>
    </div>
</main>