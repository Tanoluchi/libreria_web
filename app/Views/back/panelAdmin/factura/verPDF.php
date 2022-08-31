<div id="layourSidenav_content">
    <main>
        <div class="container-fluid d-flex  justify-content-center align-content-center">
            <h4 class="mt-4 fw-bold"><?php echo $titulo;?></h4>
        </div>

        <div class="container-fluid mt-3">
            <div class="card row">
                <div class="col-12 embed-responsive embed-responsive-4by3 ratio ratio-16x9" style="margin-top: 20px;">
                    <iframe class="embed-responsive-item" src="<?php echo base_url('panelAdmin/factura/generarFacturaPDF/'.$id_factura);?>"></iframe>
                </div>
            </div>
        </div>
    </main>
</div>
