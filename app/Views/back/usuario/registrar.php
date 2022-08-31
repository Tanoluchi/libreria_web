<?php $validation = \Config\Services::validation(); ?>

<?php if(session('error')){ ?>
    <div class="container-fluid alert alert-danger d-flex justify-content-center align-content-center" role="alert">
        <?php echo session('error'); ?>
    </div>
<?php } ?>

<main class="container-fluid">
    <div class="container-fluid aboutPage py-4">
        <div class="pageTitleSection pb-2">
            <h3 class="h3 color-azul fw-bold">Crear Cuenta</h3>
        </div>
      <div class="container-fluid shadow-lg rounded bg-white">
        <div class="row row-cols-1 row-cols-lg-2 bg-white rounded py-4 d-flex justify-content-center align-content-center">
          <div class="form-register bg-body rounded shadow-lg rounded">
          <h5 class="h5 fw-bold color-azul py-3">Información personal</h5>
            <form method="post" action="<?php echo base_url('usuarios/guardar') ?>" class="g-3 needs-validation" novalidate>
              <div class="form-group row g-3">
                <div class="col-12 col-lg-6">
                  <label  class="pb-2 py-2 color-azul" for="nombre">Nombre</label>
                  <input id="nombre" type="text" class="form-control" name="nombre" placeholder="Nombre" 
                  value="<?php echo isset($_POST['nombre']) ? $_POST['nombre'] : ''; ?>" autofocus>
                  <?php if($validation->getError('nombre')) {?>
                        <div class='alert alert-danger mt-2'>
                        <?php echo $validation->getError('nombre'); ?>
                        </div>
                  <?php }?>
                </div>
                <div class="col-12 col-lg-6">
                  <label class="pb-2 py-2 color-azul" for="apellido">Apellido</label>
                  <input id="apellido" type="text" class="form-control" name="apellido" 
                  value="<?php echo isset($_POST['apellido']) ? $_POST['apellido'] : ''; ?>" placeholder="Apellido">
                  <?php if($validation->getError('apellido')) {?>
                        <div class='alert alert-danger mt-2'>
                        <?php echo $validation->getError('apellido'); ?>
                        </div>
                  <?php }?>
                </div>
                <div class="col-12 col-lg-6">
                  <label class="pb-2 py-2 color-azul" for="email">Email</label>
                  <input id="email" type="text" class="form-control" name="email" 
                  value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" placeholder="name@example.com">
                  <?php if($validation->getError('email')) {?>
                        <div class='alert alert-danger mt-2'>
                        <?php echo $validation->getError('email'); ?>
                        </div>
              <?php }?>
                </div>
                <div class="col-12 col-lg-6">
                  <label class="pb-2 py-2 color-azul" for="telefono">Telefono</label>
                  <input id="telefono" type="text" class="form-control" name="telefono" 
                  value="<?php echo isset($_POST['telefono']) ? $_POST['telefono'] : ''; ?>" placeholder="Numero telefonico">
                  <?php if($validation->getError('telefono')) {?>
                        <div class='alert alert-danger mt-2'>
                        <?php echo $validation->getError('telefono'); ?>
                        </div>
                  <?php }?>
                </div>
                <div class="col-12 col-lg-6">
                  <label class="pb-2 py-2 color-azul" for="dni">Nº Documento</label>
                  <input id="dni" type="text" class="form-control" name="dni"
                  value="<?php echo isset($_POST['dni']) ? $_POST['dni'] : ''; ?>" placeholder="Numero DNI">
                  <?php if($validation->getError('dni')) {?>
                        <div class='alert alert-danger mt-2'>
                        <?php echo $validation->getError('dni'); ?>
                        </div>
                  <?php }?>
                </div>
              </div>
              <div class="form-group row">
                <h5 class="card-title fw-bold color-azul py-4">Información de Inicio de sesión</h5>
                <div class="col-lg-6 color-azul">
                  <label  class="pb-2" for="password1">Contraseña</label>
                  <input id="password1" type="password" class="form-control" name="password1">
                </div>
                <?php if($validation->getError('password1')) {?>
                        <div class='alert alert-danger mt-2'>
                        <?php echo $validation->getError('password1'); ?>
                        </div>
                <?php }?>
                <div class="col-lg-6 color-azul">
                  <label class="pb-2" for="password2">Confirmar contraseña</label>
                  <input id="password2" type="password" class="form-control" name="password2">
                </div>
                <?php if($validation->getError('password2')) {?>
                        <div class='alert alert-danger mt-2'>
                        <?php echo $validation->getError('password2'); ?>
                        </div>
                <?php }?>
              </div>
              <button type="submit" class="btn btn-warning fw-bold my-3">Registrarse</button>
            </form>
          </div>
        </div>
      </div>
    </div>
</main>

