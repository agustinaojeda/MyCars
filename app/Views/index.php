<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cars</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        .btnReservar {
            border: 1px solid #22324d;
            color: #38bdf8;
            background-color: transparent;
        }

        .btnReservar:hover {
            background-color: #1d5f7c !important;
            color: #ffffff !important;
            border-color: #1d5f7c !important;
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
        <div class="ms-4">
            <h1 class="mt-4 text-white fw-bold">Vehículos disponibles</h1>
            <p class="text-white ">Rendimiento de primera y lujo sin complicaciones. Encuentra el vehículo ideal para tu próximo viaje entre nuestra exclusiva selección de autos.</p>
            <div class="container">
                <div class="row g-4 justify-content-center p-3">
                    <?php foreach ($vehiculos as $v) : ?>
                        <div class="col-12 col-md-6 col-lg-4 ">

                            <div class="card h-100 border-0 rounded-4 overflow-hidden position-relative shadow-lg" style="background-color: #0b0f16;">

                                <div style="height: 200px; overflow: hidden;">
                                    <img src="<?= base_url('assets/images/' . $v['imagenVehiculo']) ?>" class="w-100 h-100" alt="<?= $v['modeloVehiculo'] ?>" style="object-fit: cover; object-position: center;">
                                </div>

                                <div class="card-body p-4 d-flex flex-column justify-content-between text-white">

                                    <div class="d-flex justify-content-between align-items-start mb-4">
                                        <div>
                                            <span class="text-uppercase fw-bold tracking-wider small d-block" style="font-size: 0.75rem; letter-spacing: 1px;">
                                                <?= $v['marcaVehiculo'] ?>
                                            </span>
                                            <h4 class="fw-bold text-white my-1" style="font-size: 1.35rem;">
                                                <?= $v['modeloVehiculo'] ?>
                                            </h4>
                                        </div>
                                        <div class="text-end">
                                            <span class="fs-4 fw-bold" style="color: #cbd5e1;">
                                                $<?= number_format($v['precioAlqVehiculo'], 0, ',', '.') ?>
                                            </span>
                                            <span class="small d-block" style="font-size: 0.75rem;color: #cbd5e1;">por día</span>
                                        </div>
                                    </div>

                                    <div class="row g-2 mb-4">

                                        <div class="col-6">
                                            <div class="d-flex align-items-center p-2 rounded-3">
                                                <div class="text-white me-2 p-1 rounded bg-dark bg-opacity-20"><i class="bi bi-person p-1"></i></div>
                                                <div>
                                                    <span class="text-white d-block" style="font-size: 0.65rem; text-transform: uppercase;">Asientos</span>
                                                    <span class="fw-semibold small" style="font-size: 0.8rem;"><?= $v['nroPlazasVehiculo'] ?> Personas</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="d-flex align-items-center p-2 rounded-3">
                                                <div class="text-white me-2 p-1 rounded bg-dark bg-opacity-20"><i class="bi bi-lightning-charge p-1"></i></div>
                                                <div>
                                                    <span class="text-white d-block" style="font-size: 0.65rem; text-transform: uppercase;">Motor</span>
                                                    <span class="fw-semibold small text-truncate d-block" style="font-size: 0.8rem; max-width: 90px;"><?= $v['motorVehiculo'] ?></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="d-flex align-items-center p-2 rounded-3">
                                                <div class="text-white me-2 p-1 rounded bg-dark bg-opacity-20"><i class="bi bi-calendar3 p-1"></i></div>
                                                <div>
                                                    <span class="text-white d-block" style="font-size: 0.65rem; text-transform: uppercase;">Año</span>
                                                    <span class="fw-semibold small" style="font-size: 0.8rem;"><?= $v['anioVehiculo'] ?></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="d-flex align-items-center p-2 rounded-3">
                                                <div class="text-white me-2 p-1 rounded bg-dark bg-opacity-20"><i class="bi bi-speedometer2 p-1"></i></div>
                                                <div>
                                                    <span class="text-white d-block" style="font-size: 0.65rem; text-transform: uppercase;">Kilometraje</span>
                                                    <span class="fw-semibold small" style="font-size: 0.8rem;"><?= number_format($v['kilometrajeVehiculo'], 0, ',', '.') ?> km</span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <a href="#" class="btn w-100 py-2 rounded-3 fw-semibold transition-all btnReservar">
                                        Reservar vehículo
                                    </a>

                                </div>
                            </div>

                        </div>
                    <?php endforeach; ?>
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