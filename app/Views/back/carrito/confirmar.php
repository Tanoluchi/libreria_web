<?php $validation = \Config\Services::validation(); ?>
<main class="container-fluid">
    <section class="container-fluid aboutPage py-4 justify-content-start">
        <div class="pageTitleSection pb-3 me-5">
            <h3 class="h3 color-azul fw-bold text-center me-5"><?php echo $titulo ?></h3>
        </div>
        <div class="container-fluid">
            <div class="form-contact p-3 mb-5 me-5">
                <div class="container-fluid w-50">
                    <form method="post" action="<?php echo base_url('carrito/confirmar') ?>" class="container-fluid g-3 needs-validation shadow-lg bg-body rounded row" novalidate>
                        <h4 class="pt-2">Dirección</h4>
                        <div class="col-12 col-md-6">
                            <label for="localidad">Localidad</label>
                            <input type="text" class="form-control" id="localidad" placeholder="Ingresar Localidad" name="localidad" value="<?php echo $direccion['localidad']?>">
                            <?php if($validation->getError('localidad')) {?>
                            <div class='alert alert-danger mt-2'>
                                <?php echo $validation->getError('localidad'); ?>
                            </div>
                            <?php }?>
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="provincia">Provincia</label>
                            <input type="text" class="form-control" id="provincia" placeholder="Ingresar Provincia" name="provincia" value="<?php echo $direccion['provincia']?>">
                            <?php if($validation->getError('provincia')) {?>
                            <div class='alert alert-danger mt-2'>
                                <?php echo $validation->getError('provincia'); ?>
                            </div>
                            <?php }?>
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="calle">Calle</label>
                            <input type="text" class="form-control" id="calle" placeholder="Ingresar calle" name="calle" value="<?php echo $direccion['calle']?>">
                            <?php if($validation->getError('calle')) {?>
                            <div class='alert alert-danger mt-2'>
                                <?php echo $validation->getError('calle'); ?>
                            </div>
                            <?php }?>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="nrocalle">Nº calle (opcional)</label>
                            <input type="text" class="form-control" id="nrocalle" placeholder="Ingresar numero de calle" name="nrocalle" value="<?php echo $direccion['numero']?>">
                            <?php if($validation->getError('nrocalle')) {?>
                            <div class='alert alert-danger mt-2'>
                                <?php echo $validation->getError('nrocalle'); ?>
                            </div>
                            <?php }?>
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="codigo">Codigo Postal</label>
                            <input type="text" class="form-control" id="codigo" placeholder="Ingresar codigo postal" name="codigo" value="<?php echo $direccion['codigoPostal']?>">
                            <?php if($validation->getError('codigo')) {?>
                            <div class='alert alert-danger mt-2'>
                                <?php echo $validation->getError('codigo'); ?>
                            </div>
                            <?php }?>
                        </div>
                        <hr>
                            <div class="col-md-12 mt-3">
                                <label for="id_pago">Método de pago</label>
                                <select class="form-control" id="id_pago" name="id_pago" required>
                                <option value="">Seleccionar Método de Pago</option>
                                <?php foreach($metodospago as $metodopago): ?>
                                    <option value="<?=$metodopago['id'];?>"><?=$metodopago['nombre'];?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php if($validation->getError('id_pago')) {?>
                                <div class='alert alert-danger mt-2'>
                                    <?php echo $validation->getError('id_pago'); ?>
                                </div>
                            <?php }?>
                            </div>
                            
                            <div class="col-md-12 mt-3">
                                <label for="id_envio">Método de envio</label>
                                <select class="form-control" id="id_envio" name="id_envio" required>
                                    <option value="">Seleccionar Forma de Envio</option>
                                    <?php foreach($formasenvio as $formaenvio): ?>
                                    <option value="<?=$formaenvio['id'];?>"><?=$formaenvio['nombre'];?></option>
                                <?php endforeach; ?>
                                </select>
                                <?php if($validation->getError('id_envio')) {?>
                                <div class='alert alert-danger mt-2'>
                                    <?php echo $validation->getError('id_envio'); ?>
                                </div>
                            <?php }?>
                            </div>
                            <div class="d-flex justify-content-between align-content-between">
                                <a href="<?php echo base_url('carrito/') ?>" class="btn btn-danger fw-bold my-3 mt-4">Cancelar</a>
                                <button type="submit" class="btn btn-success fw-bold my-3 mt-4">Continuar</button>
                            </div>
                            
                            
                    </form>
                </div>
        </div>
    </section>
</main>