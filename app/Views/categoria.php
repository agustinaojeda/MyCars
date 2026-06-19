<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cars</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/categoria.css') ?>">

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
/** @var string $categoria */
/** @var string $anterior */
/** @var string $siguiente */
/** @var array $vehiculos */
?>
<div class="container mt-4">

    <div class="d-flex align-items-center gap-3 mb-2">

        <a href="<?= base_url('categoria/' . $anterior) ?>"
        class="btn btn-outline-light rounded-circle">
            <i class="bi bi-chevron-left"></i>
        </a>

        <h2 class="text-white fw-bold m-0">
            Vehículos <?= ucfirst($categoria) ?>
        </h2>

        <a href="<?= base_url('categoria/' . $siguiente) ?>"
        class="btn btn-outline-light rounded-circle">
            <i class="bi bi-chevron-right"></i>
        </a>
    </div>

    <p class="text-light mb-4">
        Encontrá el vehículo ideal para tu próximo viaje.
    </p>

    <div class="row">
        <!-- FILTROS -->
            <div class="col-md-3">
                <div class="card filtro-card shadow-sm">
                    <div class="card-body">
                        <form method="get">

                                    <h4 class="fw-bold">
                                        <i class="bi bi-funnel"></i> Filtros
                                    </h4>

                                    <hr>
                                    <!-- Marca -->
                                    <div class="mb-3">

                                        <label class="form-label fw-semibold">
                                            Marca
                                        </label>

                                        <select class="form-select" name="marca">
                                            <option value="">Todas</option>
                                            <option value="Toyota">Toyota</option>
                                            <option value="Ford">Ford</option>
                                            <option value="Volkswagen">Volkswagen</option>
                                            <option value="Jeep">Jeep</option>
                                            <option value="Renault">Renault</option>
                                            <option value="Peugeot">Peugeot</option>
                                            <option value="Fiat">Fiat</option>
                                            <option value="Hyundai">Hyundai</option>
                                            <option value="Audi">Audi</option>
                                            <option value="BMW">BMW</option>
                                            <option value="Honda">Honda</option>
                                            <option value="Jaguar">Jaguar</option>
                                            <option value="Kia">Kia</option>
                                            <option value="Mazda">Mazda</option>
                                            <option value="Mercedes">Mercedes</option>
                                            <option value="Nissan">Nissan</option>
                                            <option value="Porsche">Porsche</option>
                                        </select>
                                    </div>
                                    <!-- Precio -->
                                    <div class="mb-3">

                                        <label class="form-label fw-semibold">
                                            Precio máximo
                                        </label>

                                        <div class="input-group">

                                            <span class="input-group-text">
                                                $
                                            </span>

                                            <input type="number" 
                                                name="precio"
                                                class="form-control"
                                                placeholder="Ej: 50000">
                                        </div>
                                    </div>
                                    <!-- Plazas -->
                                    <div class="mb-3">

                                        <label class="form-label fw-semibold">
                                            Capacidad
                                        </label>
                                        <select class="form-select" name="capacidad">
                                            <option value="">Todas</option>
                                            <option value="2">2 plazas</option>
                                            <option value="3">3 plazas</option>
                                            <option value="4">4 plazas</option>
                                            <option value="5">5 plazas</option>
                                            <option value="7">7 plazas</option>
                                        </select>
                                        

                                    </div>
                                    <button class="btn btn-primary w-100">
                                        <i class="bi bi-search"></i>
                                        Buscar
                                    </button>
                        </form>
                    </div>
                </div>
            </div>
        <!-- CARDS -->
        <div class="col-md-9">
            <div class="row">
                <?php if (!empty($vehiculos)): ?>
                    <?php foreach ($vehiculos as $vehiculo): ?>

                        <div class="col-md-4 mb-4 px-2">
                            <div class="card h-100 shadow-sm card-vehiculo d-flex">

                               <img src="<?= base_url('assets/images/' . $vehiculo['imagenVehiculo']) ?>"
                                    class="card-img-top imagen-vehiculo"
                                    alt="<?= $vehiculo['marcaVehiculo'] ?>">
                                <div class="card-body">
                                    <h5>
                                        <?= $vehiculo['marcaVehiculo'] ?>
                                        <?= $vehiculo['modeloVehiculo'] ?>
                                    </h5>
                                        <p>Año: <?= $vehiculo['anioVehiculo'] ?></p>
                                        <p><?= $vehiculo['nroPlazasVehiculo'] ?> plazas</p>
                                        <p>Motor <?= $vehiculo['motorVehiculo'] ?></p>
                                    <h5>
                                        $<?= number_format($vehiculo['precioAlqVehiculo'], 0, ',', '.') ?>
                                        / día
                                    </h5>
                                    <?php if ($vehiculo['disponibleVehiculo'] == 1): ?>
                                        <span class="badge bg-success">
                                            Disponible
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">
                                            No disponible
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-primary w-100">
                                        Ver detalles
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>

                    <div class="alert alert-warning">
                        No hay vehículos disponibles en esta categoría.
                    </div>
                <?php endif; ?>
            </div>
        </div>    
    </div>
</div>
<?= view('templates/footer') ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
