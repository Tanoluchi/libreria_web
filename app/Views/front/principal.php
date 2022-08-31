<main class="container-fluid principal">
    <!-- Carousel -->
    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner color-azul">
            <div class="carousel-item active" data-bs-interval="10000">
                <img src="public/assets/img/mes_del_libro.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item" data-bs-interval="2000">
                <img src="public/assets/img/wattpad.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="public/assets/img/roma_soy_yo.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- BANNER -->
    <div class="container-fluid mt-3">
        <div class="row row-cols-1 row-cols-sm-3 g-1 banner pb-3 shadow p-3 mb-5 rounded bg-white">
            <div class="col section-banner ubicacion">
                <div class="icon-banner ubicacion">
                    <img class="img-fluid" src="https://localhost/LucianoValenzuela_P2/public/assets/img/geo-alt.svg" alt="">
                </div>
                <div class="text-banner">
                    <h2 class="titulo-banner">Envíos a todo el país</h2>
                    <p class="parrafo-banner">Recibí tu libro donde quieras</p>
                </div>
            </div>
            <div class="col section-banner entrega">
                <div class="icon-banner entrega">
                    <img class="img-fluid" src="https://localhost/LucianoValenzuela_P2/public/assets/img/box-seam.svg" alt="">
                </div>
                <div class="text-banner">
                    <h2 class="titulo-banner">Envío gratis</h2>
                    <p class="parrafo-banner">Para compras desde $3.500</p>
                </div>
            </div>
            <div class="col section-banner entrega-express">
                <div class="icon-banner entrega-express">
                    <img class="img-fluid" src="https://localhost/LucianoValenzuela_P2/public/assets/img/truck.svg" alt="">
                </div>
                <div class="text-banner">
                    <h2 class="titulo-banner">Envío express</h2>
                    <p class="parrafo-banner">Para entregas en Capital</p>
                </div>
            </div>
        </div>
    </div>

    <div class="album py-4">
        <div class="container-fluid">
            <div class="pb-3 h5 text-dark shadow p-3 mb-5 rounded w-auto text-center bg-white">Libros destacados</div>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-6 g-3">
                <?php foreach($destacados as $destacado): ?>
                    <div class="col d-flex">
                        <div class="card shadow">
                            <a href="<?php echo base_url('catalogo/detalles/'.$destacado['id']);
                            ?>"><img class="card-img-top" alt="Responsive image" src="https://localhost/LucianoValenzuela_P2/<?=$destacado['imagen'];?>"></a>
                            <div class="card-body">
                                    <a class="text-decoration-none text-dark" href="<?php echo base_url('catalogo/detalles/'.$destacado['id']);?>"><h6 class="card-title text-center text-dark"><?=strtoupper($destacado['nombre']);?></h6></a>
                                <div class="d-flex justify-content-center align-items-center">
                                        <small class="text-muted text-center"><?=strtoupper($destacado['autor']);?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
    <section class="container-fluid d-flex align-items-start registerBannerSection mt-5">
        <div class="row p-0 p-md-3">
            <div class="col background-azul">
                <div class="container my-3">
                    <h2 class="card-title h2 text-white">¡Unite a la comunidad de Mundo Libro para armar tus propias Listas, reseñar tus libros preferidos y rankear los que más te gustan!</h2>
                    <a href="<?php echo base_url('usuarios/registrar');?>" class="btn text-white fw-bold background-naranja my-3">Unite a Mundo Libro</a>
                </div>
            </div>
            <div class="col background-azul d-none d-md-block">
                <div class="container">
                    <img src="public/assets/img/register-img.png" alt="">
                </div>
            </div>
        </div>
    </section>
</main>