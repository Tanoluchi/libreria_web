<?php $validation = \Config\Services::validation(); ?>

<?php if(session('success')){ ?>
    <div class="container-fluid alert alert-success d-flex justify-content-center align-content-center" role="alert">
        <?php echo session('success'); ?>
    </div>
<?php } ?>

<?php if(session('error')){ ?>
    <div class="container-fluid alert alert-danger d-flex justify-content-center align-content-center" role="alert">
        <?php echo session('error'); ?>
    </div>
<?php } ?>

<main class="container-fluid contactPage py-4 justify-content-start">
        <div class="pageTitleSection pb-3">
            <h3 class="h3 color-azul fw-bold">Información de contacto</h3>
        </div>
            <div class="container-fluid row row-cols-1 row-cols-lg-2 bg-white rounded py-4">
                <div class="col info-contact order-2 order-lg-1">
                    <h3 class="h3 color-azul fw-bold">Mandanos un mensaje</h3>
                    <p class="text-justify">
                        <img class="img-fluid" src="https://localhost/LucianoValenzuela_P2/public/assets/img/envelope.svg" alt="Email">
                        contacto@mundolibro.com
                    </p>
                    <p class="text-justify">
                        <img class="img-fluid" src="https://localhost/LucianoValenzuela_P2/public/assets/img/telephone.svg" alt="Telefono">
                        (+54 11) 3991 89214
                    </p>
                    <p>
                        <img class="img-fluid" src="https://localhost/LucianoValenzuela_P2/public/assets/img/people.svg" alt="Encargado">
                        Valenzuela, Luciano
                    </p>
                    <p>
                        <img class="img-fluid" src="https://localhost/LucianoValenzuela_P2/public/assets/img/building.svg" alt="Ubicacion">
                        Mundo Libro S.A.
                    </p>
                    <p>
                        <img class="img-fluid" src="https://localhost/LucianoValenzuela_P2/public/assets/img/geo.svg" alt="Ubicacion">
                        Av. 3 de Abril 3875, Corrientes Capital
                    </p>
                </div>
                <div class="col order-1 order-lg-2">
                    <div class="form-contact shadow-lg p-3 mb-5 bg-body rounded">
                        <form method="post" action="<?php echo base_url('contacto/guardar') ?>" class="needs-validation" novalidate>
                            <div class="col-md-12">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" placeholder="Ingresar nombre" name="nombre">
                            </div>
                            <?php if($validation->getError('nombre')) {?>
                                        <div class='alert alert-danger mt-2'>
                                            <?php echo $validation->getError('nombre'); ?>
                                        </div>
                            <?php }?>
                            <div class="col-md-12">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" placeholder="name@example.com" name="email">
                            </div>
                            <?php if($validation->getError('email')) {?>
                                        <div class='alert alert-danger mt-2'>
                                            <?php echo $validation->getError('email'); ?>
                                        </div>
                            <?php }?>
                            <div class="col-md-12">
                                <label for="mensaje">Mensaje</label>
                                <textarea class="form-control" id="mensaje" rows="3" name="mensaje"></textarea>
                            </div>
                            <?php if($validation->getError('mensaje')) {?>
                                        <div class='alert alert-danger mt-2'>
                                            <?php echo $validation->getError('mensaje'); ?>
                                        </div>
                            <?php }?>

                            <button type="submit" class="btn btn-warning fw-bold my-3">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</main>