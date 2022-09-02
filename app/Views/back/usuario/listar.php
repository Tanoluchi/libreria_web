<main class="container-fluid">
        <?php if(session('success')){ ?>
            <div class="container-fluid alert alert-success d-flex justify-content-center align-content-center" role="alert">
                <?php echo session('success'); ?>
            </div>
        <?php } ?>
    <div class="pageTitleSection pb-2">
        <h4 class="mt-4"><?php echo $titulo;?></h4>
        <p>
                <a href="<?php echo base_url('panelAdmin/usuarios/listar');?>" class="btn btn-primary">Todos</a>
                <a href="<?php echo base_url('panelAdmin/usuarios/activos');?>" class="btn btn-success">Activos</a>
                <a href="<?php echo base_url('panelAdmin/usuarios/eliminados');?>" class="btn btn-warning">Eliminados</a>
        </p>
    </div>
        <div class="row bg-white rounded py-4">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>DNI</th>
                            <th>Email</th>
                            <th>Telefono</th>
                            <th>Activo</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($usuarios as $usuario): ?>
                            <tr>
                                <td><?=$usuario['id']; ?></td>
                                <td><?=$usuario['nombre']; ?></td>
                                <td><?=$usuario['apellido']; ?></td>
                                <td><?=$usuario['dni']; ?></td>
                                <td><?=$usuario['email']; ?></td>
                                <td><?=$usuario['telefono']; ?></td>
                                <?php if($usuario['activo'] == 1) : ?>
                                    <td>SI</td>
                                <?php else : ?>
                                    <td>NO</td>
                                <?php endif; ?>
                                <?php if($usuario['id_rol'] == 1) : ?>
                                    <td>Cliente</td>
                                <?php else : ?>
                                    <td>Administrador</td>
                                <?php endif; ?>
                                <?php if($usuario['activo'] == 1) : ?>
                                    <td>
                                        <a href="<?php echo base_url('usuarios/eliminar/'.$usuario['id']);?>" class="btn btn-danger fw-bold" type="button">Eliminar</a> 
                                    </td>
                                <?php else : ?>
                                    <td>
                                        <a href="<?php echo base_url('usuarios/activar/'.$usuario['id']);?>" class="btn btn-success fw-bold" type="button">Activar</a> 
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
</main>