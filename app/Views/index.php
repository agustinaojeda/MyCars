<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cars</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        .btn-outline-custom {
            background: transparent;
            border: 1px solid rgba(13, 202, 240, 0.3);
        }

        .btn-outline-custom:hover,
        .btn-categoria:hover {
            background: rgba(13, 202, 240, 0.05);
            border-color: #0dcaf0 !important;
            color: #fff !important;
        }

        .tracking-wider {
            letter-spacing: 0.075em;
        }

        .btnVer {
            background-color: #b5dafd;
            color: #1c1b4b;
            border: none;
        }

        .btnVer:hover {
            background-color: #d6dcfe;
            transform: translateX(3px);
        }
    </style>
</head>

<body class="bg-dark">
    <?= view('templates/nav') ?>
    <?php if (isset($vehiculos)): ?>
        <?php
        $vehiculosLimitados = array_slice($vehiculos, 0, 5);
        ?>
        <div id="carruselVehiculos" class="carousel slide shadow-lg rounded-bottom-4 overflow-hidden" data-bs-ride="carousel" style="max-width: 100%; margin: 0 auto; height:70vh;">

            <div class="carousel-indicators">
                <?php foreach ($vehiculosLimitados as $index => $v) : ?>
                    <button type="button" data-bs-target="#carruselVehiculos" data-bs-slide-to="<?= $index ?>" class="<?= $index === 0 ? 'active' : '' ?>" aria-current="<?= $index === 0 ? 'true' : 'false' ?>"></button>
                <?php endforeach; ?>
            </div>

            <div class="carousel-inner" style="background-color: #0b0f19;">
                <?php foreach ($vehiculosLimitados as $index => $v) : ?>
                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?> position-relative" style="height: 70vh;">

                        <img src="<?= base_url('assets/images/' . $v['imagenVehiculo']) ?>" class="d-block w-100 h-100" alt="<?= $v['modeloVehiculo'] ?>" style="object-fit: cover; object-position: center;">

                        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.4) 40%, rgba(0,0,0,0) 100%);"></div>

                        <div class="carousel-caption d-flex flex-column justify-content-end align-items-start text-start start-0 bottom-0 w-100 p-4 p-md-5">

                            <div class="mb-3">
                                <span class="badge rounded-pill bg-secondary bg-opacity-20 text-white border border-secondary border-opacity-50 px-3 py-2 small me-2" style="backdrop-filter: blur(5px);">
                                    <?= $v['categoriaVehiculo'] ?>
                                </span>
                                <?php if ($v['disponibleVehiculo'] == 1) : ?>
                                    <span class="badge rounded-pill bg-info bg-opacity-20 text-white border border-info border-opacity-50 px-3 py-2 small" style="backdrop-filter: blur(5px);">
                                        <?= $v['marcaVehiculo'] ?>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <div class="row w-100 align-items-end">
                                <div class="col-md-8">
                                    <h2 class="display-5 fw-bold text-white mb-2">
                                        <?= $v['modeloVehiculo'] ?>
                                    </h2>
                                    <p class="text-white-50 mb-0 fs-6 fw-light" style="max-width: 500px;">
                                        Experimentá el máximo rendimiento con motor <?= $v['motorVehiculo'] ?>, capacidad para <?= $v['nroPlazasVehiculo'] ?> plazas y un andar de lujo diseñado para viajes únicos. Año <?= $v['anioVehiculo'] ?>.
                                    </p>
                                </div>

                                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                                    <span class="d-block text-white-50 small mb-0">Precio de alquiler</span>
                                    <span class="fs-3 fw-bold text-info">
                                        $<?= number_format($v['precioAlqVehiculo'], 0, ',', '.') ?> <span class="fs-6 fw-normal text-white-50">por día</span>
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carruselVehiculos" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carruselVehiculos" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>
        <div class="container my-5 py-2">
            <div class="text-center mb-4">
                <h3 class="text-white fw-bold position-relative d-inline-block pb-2">
                    Explora nuestras categorías
                    <span class="position-absolute bottom-0 start-50 translate-middle-x bg-info rounded" style="width: 50px; height: 3px;"></span>
                </h3>
            </div>

            <div class="row g-3 justify-content-center">
                <div class="col-6 col-md-3">
                    <a href="<?= base_url('/vehiculos?categoria=suv') ?>" class="btn btn-categoria w-100 py-3 rounded-3 text-white fw-medium border border-secondary border-opacity-20 d-flex flex-column align-items-center justify-content-center gap-2">
                        <span class="fs-5">SUV</span>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="<?= base_url('/vehiculos?categoria=deportivo') ?>" class="btn btn-categoria w-100 py-3 rounded-3 text-white fw-medium border border-secondary border-opacity-20 d-flex flex-column align-items-center justify-content-center gap-2">
                        <span class="fs-5">Deportivo</span>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="<?= base_url('/vehiculos?categoria=sedan') ?>" class="btn btn-categoria w-100 py-3 rounded-3 text-white fw-medium border border-secondary border-opacity-20 d-flex flex-column align-items-center justify-content-center gap-2">
                        <span class="fs-5">Sedán</span>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="<?= base_url('/vehiculos?categoria=camioneta') ?>" class="btn btn-categoria w-100 py-3 rounded-3 text-white fw-medium border border-secondary border-opacity-20 d-flex flex-column align-items-center justify-content-center gap-2">
                        <span class="fs-5">Camioneta</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="container my-5 pb-5">
            <div class="row g-4">

                <?php
                $categoriasMostrar = ['suv', 'deportivo', 'sedan', 'camioneta'];
                $tarjetasRenderizadas = 0;

                foreach ($categoriasMostrar as $cat):
                    $v = isset($ultimosPorCategoria[$cat]) ? $ultimosPorCategoria[$cat] : null;
                    if ($v):
                        $tarjetasRenderizadas++;
                ?>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="card h-100 border border-secondary border-opacity-10 rounded-4 position-relative overflow-hidden flex-column justify-content-between" style="background: linear-gradient(145deg, rgba(20, 24, 33, 0.6) 0%, rgba(11, 15, 25, 0.8) 100%); backdrop-filter: blur(10px);">

                                <div class="position-relative p-3">
                                    <img src="<?= base_url('assets/images/' . $v['imagenVehiculo']) ?>" class="card-img-top rounded-4" alt="<?= $v['modeloVehiculo'] ?>" style="height: 200px; object-fit: cover;">
                                </div>

                                <div class="card-body px-4 pt-0 pb-3">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div>
                                            <span class="text-uppercase text-secondary fw-bold tracking-wider" style="font-size: 0.65rem; letter-spacing: 1px;"><?= $v['marcaVehiculo'] ?></span>
                                            <h4 class="text-white fw-bold mb-0 fs-5"><?= $v['modeloVehiculo'] ?></h4>
                                        </div>
                                        <div class="text-end">
                                            <span class="fs-5 fw-bold text-info">$<?= number_format($v['precioAlqVehiculo'], 0, ',', '.') ?></span>
                                            <span class="text-secondary d-block" style="font-size: 0.7rem; margin-top: -3px;">por día</span>
                                        </div>
                                    </div>

                                    <div class="row g-2 mb-4">

                                        <div class="col-6">
                                            <div class="d-flex align-items-center p-2 rounded-3">
                                                <div class="text-white me-2 p-1 rounded bg-dark bg-opacity-20"><i class="bi bi-person p-1"></i></div>
                                                <div>
                                                    <span class="text-white d-block" style="font-size: 0.65rem; text-transform: uppercase;">Asientos</span>
                                                    <span class="fw-semibold small text-white" style="font-size: 0.8rem;"><?= $v['nroPlazasVehiculo'] ?> Personas</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="d-flex align-items-center p-2 rounded-3">
                                                <div class="text-white me-2 p-1 rounded bg-dark bg-opacity-20"><i class="bi bi-lightning-charge p-1"></i></div>
                                                <div>
                                                    <span class="text-white d-block" style="font-size: 0.65rem; text-transform: uppercase;">Motor</span>
                                                    <span class="text-white fw-semibold small text-truncate d-block" style="font-size: 0.8rem; max-width: 90px;"><?= $v['motorVehiculo'] ?></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="d-flex align-items-center p-2 rounded-3">
                                                <div class="text-white me-2 p-1 rounded bg-dark bg-opacity-20"><i class="bi bi-calendar3 p-1"></i></div>
                                                <div>
                                                    <span class="text-white d-block" style="font-size: 0.65rem; text-transform: uppercase;">Año</span>
                                                    <span class=" text-white fw-semibold small" style="font-size: 0.8rem;"><?= $v['anioVehiculo'] ?></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="d-flex align-items-center p-2 rounded-3">
                                                <div class="text-white me-2 p-1 rounded bg-dark bg-opacity-20"><i class="bi bi-speedometer2 p-1"></i></div>
                                                <div>
                                                    <span class="text-white d-block" style="font-size: 0.65rem; text-transform: uppercase;">Kilometraje</span>
                                                    <span class="text-white fw-semibold small" style="font-size: 0.8rem;"><?= number_format($v['kilometrajeVehiculo'], 0, ',', '.') ?> km</span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <div class="px-4 pb-4">
                                    <a href="<?= base_url('/vehiculos/detalle/' . $v['idVehiculo']) ?>" class="btn w-100 py-2 rounded-3 fw-medium transition-all <?= 'btn-outline-custom text-info' ?>" style="font-size: 0.85rem;">
                                        Ver categoría <?= $v['categoriaVehiculo'] ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                <?php
                    endif;
                endforeach;
                ?>

                <div class="col-12 col-md-6 col-lg-8">
                    <div class="card h-100 border border-secondary border-opacity-10 rounded-4 position-relative overflow-hidden p-4 p-md-5 d-flex flex-column justify-content-center align-items-start"
                        style="background: linear-gradient(rgba(0, 0, 0, 0.55), rgba(0, 0, 0, 0.85)), url('https://images.pexels.com/photos/13633258/pexels-photo-13633258.jpeg?_gl=1*1erdxoz*_ga*MTk1Mzc0MzcyLjE3NzEyNzYyOTA.*_ga_8JE65Q40S6*czE3ODE4Mzg0NTEkbzQkZzEkdDE3ODE4Mzg0NzYkajM1JGwwJGgw') center/cover no-repeat; min-height: 320px;">

                        <h2 class="display-6 fw-bold text-white mb-3" style="max-width: 450px; line-height: 1.2;">
                            El vehículo perfecto para tu próxima historia
                        </h2>

                        <p class="text-white-50 mb-4 fw-light fs-6" style="max-width: 500px;">
                            Desde la potencia de un deportivo hasta la comodidad de una SUV para toda la familia. Recorré nuestro catálogo completo y encontrá el andar que se adapta a tu próximo destino.
                        </p>

                        <a href="<?= base_url('/vehiculos') ?>" class="btn btnVer px-4 py-2.5 rounded-3 fw-medium d-flex align-items-center gap-2 transition-all">
                            Ver toda la flota<i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>

    <?php else: ?>
        <p class="text-center p-4">Aún no hay vehículos disponibles</p>
    <?php endif; ?>
    <?= view('templates/footer') ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>