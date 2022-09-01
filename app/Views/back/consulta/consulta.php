<?php $validation = \Config\Services::validation(); 
$user_session = session();

?>

<main class="container-fluid">
    <section class="container-fluid contactPage py-4 justify-content-start">
        <div class="pageTitleSection pb-3 me-3">
            <h3 class="h3 color-azul fw-bold text-center me-5">Consultas</h3>
        </div>
        <div class="container-fluid">
            <div class="container-fluid p-3 mb-5 me-5">
                <div class="container-fluid">
                    <form method="post" action="<?php echo base_url('consulta/guardar') ?>" class="formContact g-3 needs-validation shadow-lg bg-body rounded" novalidate>
                        <div class="col-md-12">
                            <label class="mt-4" for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" placeholder="Ingresar nombre" name="nombre" value="<?php echo $user_session->nombre ?>">
                        </div>
                        <?php if($validation->getError('nombre')) {?>
                            <div class='alert alert-danger mt-2'>
                                <?php echo $validation->getError('nombre'); ?>
                            </div>
                        <?php }?>
                            <div class="col-md-12 mt-3">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" placeholder="name@example.com" name="email" value="<?php echo $user_session->email ?>">
                            </div>
                            <?php if($validation->getError('email')) {?>
                                <div class='alert alert-danger mt-2'>
                                    <?php echo $validation->getError('email'); ?>
                                </div>
                            <?php }?>
                            <div class="col-md-12 mt-3">
                                <label for="mensaje">Mensaje</label>
                                <textarea class="form-control" id="mensaje" rows="3" name="mensaje"></textarea>
                                <?php if($validation->getError('mensaje')) {?>
                                <div class='alert alert-danger mt-2'>
                                    <?php echo $validation->getError('mensaje'); ?>
                                </div>
                            <?php }?>
                            </div>

                            <button type="submit" class="btn btn-warning fw-bold my-3">Enviar</button>
                    </form>
                </div>
        </div>
    </section>
</main>