<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cars</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/detalle.css') ?>">

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
<?php
/** @var array $vehiculo */
/** @var array $anterior */
/** @var array $siguiente */
?>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">

        <a href="<?= base_url('categoria/'.$vehiculo['categoriaVehiculo']) ?>"
        class="btn btn-categoria py-3 rounded-3 text-white fw-medium border border-secondary border-opacity-20 d-flex flex-column align-items-center justify-content-center gap-2">
            Ver todos los vehículos <?= ucfirst($vehiculo['categoriaVehiculo']) ?>
        </a>
    </div>

    <div class="row">

        <!-- Imagen -->
       <div class="col-md-7 position-relative">

            <?php if ($anterior): ?>
                <a href="<?= base_url('categoria/detalle/' . $anterior['idVehiculo']) ?>"
                class="btn btn-categoria rounded-circle position-absolute top-50 start-0 translate-middle-y z-3">
                    <i class="bi bi-chevron-left"></i>
                </a>
            <?php endif; ?>

            <img
                src="<?= base_url('assets/images/'.$vehiculo['imagenVehiculo']) ?>"
                class="img-fluid img-detalle"
                alt="Vehículo">

            <?php if ($siguiente): ?>
                <a href="<?= base_url('categoria/detalle/' . $siguiente['idVehiculo']) ?>"
                class="btn btn-categoria rounded-circle position-absolute top-50 end-0 translate-middle-y z-3">
                    <i class="bi bi-chevron-right"></i>
                </a>
            <?php endif; ?>

        </div>

        <!-- Datos -->
        <div class="col-md-5">

    <div class="detalle-card">

        <div class="detalle-header">
            <h2 class="fw-bold mb-0">
                <?= $vehiculo['marcaVehiculo'] ?>
                <?= $vehiculo['modeloVehiculo'] ?>
            </h2>
        </div>

        <div class="detalle-body">

            <div class="info-item">
                <strong>Año</strong>
                <span><?= $vehiculo['anioVehiculo'] ?></span>
            </div>

            <div class="info-item">
                <strong>Plazas</strong>
                <span><?= $vehiculo['nroPlazasVehiculo'] ?></span>
            </div>

            <div class="info-item">
                <strong>Motor</strong>
                <span><?= $vehiculo['motorVehiculo'] ?></span>
            </div>

            <div class="info-item">
                <strong>Kilometraje</strong>
                <span><?= number_format($vehiculo['kilometrajeVehiculo'],0,",",".") ?> km</span>
            </div>

            <div class="info-item">
                <strong>Categoría</strong>
                <span><?= ucfirst($vehiculo['categoriaVehiculo']) ?></span>
            </div>

            <div class="mt-4">

                <h2 class="precio mb-3">
                    $<?= number_format($vehiculo['precioAlqVehiculo'],0,",",".") ?>
                    <small class="fs-5 text-light">/ día</small>
                </h2>

                <?php if($vehiculo['disponibleVehiculo']) : ?>

                    <span class="badge bg-success fs-6 mb-4">
                        Disponible
                    </span>

                <?php else : ?>

                    <span class="badge bg-danger fs-6 mb-4">
                        No disponible
                    </span>

                <?php endif; ?>

                <a href="<?= base_url('reserva/'.$vehiculo['idVehiculo']) ?>"
                   class="btn btn-reservar w-100 mt-3">
                    <i class="bi bi-calendar-check me-2"></i>
                    Realizar reserva
                </a>

            </div>

        </div>

    </div>

</div>
</div>

</div>
<?= view('templates/footer') ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>