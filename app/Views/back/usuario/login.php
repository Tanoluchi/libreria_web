<?php $validation = \Config\Services::validation(); ?>

<?php if(session('registro')){ ?>
    <div class="container-fluid alert alert-success d-flex justify-content-center align-content-center" role="alert">
        <?php echo session('registro'); ?>
    </div>
<?php } ?>
<main class="container-fluid">
  <div class="container loginPage">
    <div class="container-fluid">
        <div class="row rounded d-flex justify-content-center">
          <div class="col-lg-5 form-login bg-body rounded shadow-lg border-0 rounded card mt-5">
            <div class="card-header">
                <h3 class="text-center font-weigth-light my-4">Iniciar sesión</h3>
            </div>
            <div class="card-body">
                <form method="post" action="<?php echo base_url('usuarios/validar_cuenta') ?>" class="g-3 needs-validation" novalidate>
                    <div class="form-group">
                        <label  class="small pb-2 py-2 mb-1 color-azul" for="email">Email</label>
                        <input id="email" type="text" class="form-control py-2" name="email" placeholder="Ingresa email">
                    </div>
                    <?php if($validation->getError('email')) {?>
                        <div class='alert alert-danger mt-2'>
                            <?php echo $validation->getError('email'); ?>
                        </div>
                    <?php }?>
                    <div class="form-group">
                        <label class="small pb-2 py-2 mb-1 color-azul" for="password">Contraseña</label>
                        <input id="password" type="password" class="form-control py-2" name="password" placeholder="Ingresa contraseña">
                    </div>
                    <?php if($validation->getError('password')) {?>
                        <div class='alert alert-danger mt-2'>
                            <?php echo $validation->getError('password'); ?>
                        </div>
                    <?php }?>
                    <button type="submit" class="btn background-azul text-white my-3">Acceder</button>
                </form>
                <hr>
                <p>
                    ¿Aún no tienes una cuenta?
                    <a href="<?php echo base_url('usuarios/registrar');?>" class="btn background-naranja text-white ms-3 my-3">Crear Cuenta</a>
                </p>
            </div>
            
          </div>
        </div>
      </div>
    </div>
</main>