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
<style>
    .reserva-card {
        background: rgba(255,255,255,.03);
        border: 1px solid rgba(255,255,255,.08);
        border-radius: 20px;
        overflow: hidden;
        transition: .3s;
    }

    .reserva-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 0 25px rgba(13,202,240,.15);
    }

    .vehiculo-img {
        height: 180px;
        object-fit: cover;
        border-radius: 15px;
    }

    .badge-pendiente {
        background-color: #ffc107;
        color: #000;
    }

    .badge-activo {
        background-color: #198754;
    }

    .badge-finalizado {
        background-color: #0d6efd;
    }

    .badge-cancelado {
        background-color: #dc3545;
    }
</style>

<div class="container py-5">

    <div class="mb-4">
        <h2 class="text-white fw-bold">
            Mis Reservas
        </h2>

        <p class="text-secondary">
            Historial y estado de tus reservas.
        </p>
    </div>

    <?php if(empty($reservas)): ?>

        <div class="alert alert-info">
            Todavía no realizaste ninguna reserva.
        </div>

    <?php else: ?>

        <div class="row">

            <?php foreach($reservas as $reserva): ?>

                <div class="col-lg-6 mb-4">

                    <div class="card reserva-card text-light h-100">

                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-4 text-center">

                                    <img
                                        src="<?= base_url('assets/images/'.$reserva['imagenVehiculo']) ?>"
                                        class="img-fluid vehiculo-img">

                                </div>

                                <div class="col-md-8">

                                    <h4 class="fw-bold">
                                        <?= esc($reserva['marcaVehiculo']) ?>
                                        <?= esc($reserva['modeloVehiculo']) ?>
                                    </h4>

                                    <hr>

                                    <p>
                                        <strong>Fecha desde:</strong>
                                        <?= esc($reserva['fechaDesdeAlquiler']) ?>
                                    </p>

                                    <p>
                                        <strong>Fecha hasta:</strong>
                                        <?= esc($reserva['fechaHastaAlquiler']) ?>
                                    </p>

                                    <p>
                                        <strong>Días:</strong>
                                        <?= esc($reserva['cantDiasAlquiler']) ?>
                                    </p>

                                    <p>
                                        <strong>Conductor:</strong>
                                        <?= esc($reserva['nombreConductor']) ?>
                                    </p>

                                    <p>
                                        <strong>Forma de pago:</strong>
                                        <?= esc($reserva['formaPago']) ?>
                                    </p>

                                    <p>
                                        <strong>Estado:</strong>

                                        <?php if($reserva['estadoAlquiler'] == 'pendiente'): ?>
                                            <span class="badge badge-pendiente">
                                                Pendiente
                                            </span>

                                        <?php elseif($reserva['estadoAlquiler'] == 'activo'): ?>
                                            <span class="badge badge-activo">
                                                Aprobada
                                            </span>

                                        <?php elseif($reserva['estadoAlquiler'] == 'finalizado'): ?>
                                            <span class="badge badge-finalizado">
                                                Finalizado
                                            </span>

                                        <?php else: ?>
                                            <span class="badge badge-cancelado">
                                                Cancelado
                                            </span>
                                        <?php endif; ?>

                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    <?php endif; ?>

</div>



<?= view('templates/footer') ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>
</html>    
