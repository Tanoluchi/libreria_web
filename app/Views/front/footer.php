<?php

$user_session = session();
$rol = $user_session->id_rol;
?>
    </main>
    <!-- PIE DE PAGINA -->
    <footer class="pie-pagina">
        <!--SECTION INFORMACION -->
        <div class="container grupo-1">
            <div class="box">
                <!-- FOOTER LOGO -->
                <figure>
                    <a href="#"><img src="https://localhost/LucianoValenzuela_P2/public/assets/img/logo.png" alt="LOGO MUNDO LIBRO (LIBRO ABIERTO)"></a>
                </figure>
                <figcaption class="text-white text-center fw-bold py-2">MUNDO LIBRO</figcaption>
            </div>
            <!-- PAGINAS -->
            <div class="row box">
                <h2 class="h2 fw-bold text-center">SECCIONES</h2>
                <div class="col">
                    <ul class="sections">
                        <li class="pb-1"><a class="color-clarito text-decoration-none" href="<?php echo base_url('/');?>">Principal</a></li>
                        <li class="pb-1"><a class="color-clarito text-decoration-none" href="<?php echo base_url('quienesSomos');?>">Quienes Somos</a></li>
                        <li class="pb-1"><a class="color-clarito text-decoration-none" href="<?php echo base_url('comercializacion');?>">Comercialización</a></li>
                        <li><a class="color-clarito text-decoration-none" href="<?php echo base_url('contacto');?>">Conctacto</a></li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="sections">
                        <li class="pb-1"><a class="color-clarito text-decoration-none" href="<?php echo base_url('terminos');?>">Términos y usos</a></li>
                        <li class="pb-1"><a class="color-clarito text-decoration-none" href="<?php echo base_url('catalogo');?>">Cátalogo</a></li>
                        <?php if($rol != null) : ?>
                        <li><a class="color-clarito text-decoration-none" href="<?php echo base_url('consulta');?>">Consultas</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <!-- ICONS -->
            <div class="box">
                <h2 class="h2 fw-bold">SEGUINOS</h2>
                <div class="red-social d-flex justify-content-start align-content-start">
                    <a href="https://facebook.com/" class="button"><img src="https://localhost/LucianoValenzuela_P2/public/assets/img/facebook.svg" alt="facebook"></a>
                    <a href="https://www.instagram.com/" class="button"><img src="https://localhost/LucianoValenzuela_P2/public/assets/img/instagram.svg" alt="instagram"></a>
                    <a href="https://twitter.com/" class="button"><img src="https://localhost/LucianoValenzuela_P2/public/assets/img/twitter.svg" alt="twitter"></a>
                </div>
            </div>
        </div>
        <hr>
        <!-- SECTION DERECHOS -->
        <div class="container grupo-2">
            <small>&copy; <?php echo date('Y'); ?> <b>MUNDO LIBRO</b> - Todos los derechos reservados</small>
        </div>
    </footer>
</body>
</html>