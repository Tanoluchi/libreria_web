<div id="layourSidenav_content">
    <main>
        <div class="container-fluid">
            <h4 class="mt-4"><?php echo $titulo;?></h4>
        </div>
        <div class="container-fluid">
            <p>
                <a href="<?php echo base_url('panelAdmin/contacto/listar');?>" class="btn btn-primary">Todos</a>
                <a href="<?php echo base_url('panelAdmin/contacto/resueltos');?>" class="btn btn-success">Resueltos</a>
                <a href="<?php echo base_url('panelAdmin/contacto/pendientes');?>" class="btn btn-warning">Pendientes</a>
            </p>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" witdth="100%" cellspacing="0">
                <thead class="table-dark">
                    <tr>
                        <td>Nombre</td>
                        <td>Email</td>
                        <td>Mensaje</td>
                        <td>Resuelto</td>
                        <td>Acciones</td>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach($contactos as $contacto): ?>
                        <tr>
                            <td><?=strtoupper($contacto['nombre']); ?></td>
                            <td><?=$contacto['email']; ?></td>
                            <td><textarea name="" id="" cols="40" rows="3"><?=$contacto['mensaje']; ?></textarea></td>
                            <?php if($contacto['resuelto'] == 0) : ?>
                            <td>NO</td>
                            <?php endif; ?>
                            <?php if($contacto['resuelto'] == 1) : ?>
                            <td>SI</td>
                            <?php endif; ?>
                            <td>
                                <?php if($contacto['resuelto'] == 1) : ?>
                                <a class="btn btn-warning" href="<?php echo base_url('contacto/pendiente/'.$contacto['id']);?>">PENDIENTE</a>
                                <?php endif; ?>
                                <?php if($contacto['resuelto'] == 0) : ?>
                                <a class="btn btn-success" href="<?php echo base_url('contacto/resuelto/'.$contacto['id']);?>">RESUELTO</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</div>