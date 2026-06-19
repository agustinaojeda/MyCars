<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas Pendientes - MyCar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">
</head>
<body>
    <?= view('templates/nav') ?>

    <div class="container py-5">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold text-white mb-1"><i class="bi bi-clock-history me-2 text-info"></i>Reservas Pendientes</h2>
                <p class="text-secondary small">Solicitudes de clientes esperando aprobación para pasar a estado Activo.</p>
            </div>
            <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-outline-custom">
                <i class="bi bi-arrow-left me-2"></i>Volver al Panel
            </a>
        </div>

        <?php if (session()->getFlashdata('mensaje')) : ?>
            <div class="alert alert-success bg-success bg-opacity-25 border-success border-opacity-50 text-white rounded-3">
                <i class="bi bi-check-circle-fill me-2"></i><?= session()->getFlashdata('mensaje') ?>
            </div>
        <?php endif; ?>

        <div class="glass-card p-0">
            <?php if (!empty($reservas)) : ?>
                <div class="table-responsive">
                    <table class="table table-dark table-hover mb-0" style="background: transparent;">
                        <thead>
                            <tr style="border-bottom: 2px solid rgba(255,255,255,0.1);">
                                <th class="p-4 text-secondary font-monospace" style="background: transparent;">ID</th>
                                <th class="p-4 text-secondary font-monospace" style="background: transparent;">Vehículo</th>
                                <th class="p-4 text-secondary font-monospace" style="background: transparent;">Cliente</th>
                                <th class="p-4 text-secondary font-monospace" style="background: transparent;">Fechas</th>
                                <th class="p-4 text-secondary font-monospace text-end" style="background: transparent;">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reservas as $reserva) : ?>
                                <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                                    <td class="p-4 align-middle" style="background: transparent;">
                                        <span class="badge bg-secondary bg-opacity-50">#<?= $reserva['idAlquiler'] ?></span>
                                    </td>
                                    <td class="p-4 align-middle" style="background: transparent;">
                                        <div class="fw-bold text-white"><?= $reserva['marcaVehiculo'] ?> <?= $reserva['modeloVehiculo'] ?></div>
                                    </td>
                                    <td class="p-4 align-middle" style="background: transparent;">
                                        <div class="fw-bold text-white"><?= $reserva['nombreUsuario'] ?></div>
                                        <div class="small text-secondary"><?= $reserva['emailUsuario'] ?></div>
                                    </td>
                                    <td class="p-4 align-middle" style="background: transparent;">
                                        <div class="small text-info">Desde: <?= $reserva['fechaDesdeAlquiler'] ?></div>
                                        <div class="small text-secondary">Días: <?= $reserva['cantDiasAlquiler'] ?></div>
                                    </td>
                                    <td class="p-4 align-middle text-end" style="background: transparent;">
                                        <a href="<?= base_url('admin/aprobar-reserva/' . $reserva['idAlquiler']) ?>" class="btn btn-purple btn-sm py-2 px-3">
                                            Aprobar <i class="bi bi-check2 me-1"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else : ?>
                <div class="p-5 text-center">
                    <i class="bi bi-inbox fs-1 text-secondary mb-3 d-block"></i>
                    <h5 class="text-white">No hay reservas pendientes</h5>
                    <p class="text-secondary small">Todas las solicitudes han sido procesadas.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>