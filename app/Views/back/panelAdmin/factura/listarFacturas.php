<div id="layourSidenav_content">
    <main>
        <div class="container-fluid">
            <h4 class="mt-4"><?php echo $titulo;?></h4>
        </div>

        <div class="table-responsive mt-3">
            <table class="table table-bordered" id="dataTable" witdth="100%" cellspacing="0">
                <thead class="table-dark">
                    <tr>
                        <td>Factura</td>
                        <td>Usuario</td>
                        <td>Forma de Envio</td>
                        <td>Metodo de Pago</td>
                        <td>Importe Total</td>
                        <td>Acciones</td>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach($facturas as $factura): ?>
                        <tr>
                            <td><?=$factura['id']; ?></td>
                            <?php foreach($usuarios as $usuario): ?>
                                <?php if($factura['id_usuario'] == $usuario['id']) : ?>
                                    <td><?=$usuario['email']; ?></td>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <?php foreach($envios as $envio): ?>
                                <?php if($factura['id_envio'] == $envio['id']) : ?>
                                    <td><?=$envio['nombre']; ?></td>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <?php foreach($pagos as $pago): ?>
                                <?php if($factura['id_pago'] == $pago['id']) : ?>
                                    <td><?=$pago['nombre']; ?></td>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <td>$<?=number_format($factura['importe_total'],2, '.', ','); ?></td>
                            <td>
                                <a class="btn btn-primary" href="<?php echo base_url('panelAdmin/factura/detalles/'.$factura['id']);?>">DETALLES</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</div>