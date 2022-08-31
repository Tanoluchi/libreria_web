<div id="layourSidenav_content">
    <main>
        <div class="container-fluid">
            <h4 class="mt-4"><?php echo $titulo;?></h4>
        </div>
        <div class="container-fluid">
            <p>
                <a href="<?php echo base_url('panelAdmin/consulta/listar');?>" class="btn btn-primary">Todos</a>
                <a href="<?php echo base_url('panelAdmin/consulta/resueltos');?>" class="btn btn-success">Resueltos</a>
                <a href="<?php echo base_url('panelAdmin/consulta/pendientes');?>" class="btn btn-warning">Pendientes</a>
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
                    <?php foreach($consultas as $consulta): ?>
                        <tr>
                            <td><?=strtoupper($consulta['nombre']); ?></td>
                            <td><?=$consulta['email']; ?></td>
                            <td><textarea name="" id="" cols="40" rows="3"><?=$consulta['mensaje']; ?></textarea></td>
                            <?php if($consulta['resuelto'] == 0) : ?>
                            <td>NO</td>
                            <?php endif; ?>
                            <?php if($consulta['resuelto'] == 1) : ?>
                            <td>SI</td>
                            <?php endif; ?>
                            <td>
                                <?php if($consulta['resuelto'] == 1) : ?>
                                <a class="btn btn-warning" href="<?php echo base_url('consulta/pendiente/'.$consulta['id']);?>">PENDIENTE</a>
                                <?php endif; ?>
                                <?php if($consulta['resuelto'] == 0) : ?>
                                <a class="btn btn-success" href="<?php echo base_url('consulta/resuelto/'.$consulta['id']);?>">RESUELTO</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</div>