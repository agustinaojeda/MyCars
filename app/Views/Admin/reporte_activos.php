<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte: Alquileres Activos - MyCar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">
    <style>
        .no-hover-card:hover { transform: none !important; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5) !important; }
    </style>
</head>
<body>
    <?= view('templates/nav') ?>

    <div class="container py-5">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold text-white mb-1"><i class="bi bi-file-earmark-bar-graph me-2" style="color: #a78bfa;"></i>Reporte: Alquileres Activos</h2>
                <p class="text-secondary small">Listado general de todos los vehículos que se encuentran actualmente alquilados.</p>
            </div>
            <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-outline-custom">
                <i class="bi bi-arrow-left me-2"></i>Volver al Panel
            </a>
        </div>

        <div class="glass-card no-hover-card p-0">
            <?php if (!empty($alquileres)) : ?>
                <div class="table-responsive">
                    <table class="table table-dark table-hover mb-0" style="background: transparent;">
                        <thead>
                            <tr style="border-bottom: 2px solid rgba(255,255,255,0.1);">
                                <th class="p-4 text-secondary font-monospace" style="background: transparent;">ID Reserva</th>
                                <th class="p-4 text-secondary font-monospace" style="background: transparent;">Vehículo</th>
                                <th class="p-4 text-secondary font-monospace" style="background: transparent;">Cliente</th>
                                <th class="p-4 text-secondary font-monospace" style="background: transparent;">Contacto</th>
                                <th class="p-4 text-secondary font-monospace" style="background: transparent;">Periodo</th>
                                <th class="p-4 text-secondary font-monospace text-end" style="background: transparent;">Tarifa Diaria</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($alquileres as $alq) : ?>
                                <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                                    <td class="p-4 align-middle" style="background: transparent;">
                                        <span class="badge bg-secondary bg-opacity-50">#<?= $alq['idAlquiler'] ?></span>
                                    </td>
                                    <td class="p-4 align-middle" style="background: transparent;">
                                        <div class="fw-bold text-white"><?= $alq['marcaVehiculo'] ?></div>
                                        <div class="small text-secondary"><?= $alq['modeloVehiculo'] ?></div>
                                    </td>
                                    <td class="p-4 align-middle" style="background: transparent;">
                                        <div class="fw-bold text-white"><?= $alq['nombreUsuario'] ?></div>
                                    </td>
                                    <td class="p-4 align-middle" style="background: transparent;">
                                        <div class="small text-info"><i class="bi bi-telephone me-1"></i><?= $alq['telefonoUsuario'] ?></div>
                                    </td>
                                    <td class="p-4 align-middle" style="background: transparent;">
                                        <div class="small text-white"><?= date('d/m/Y', strtotime($alq['fechaDesdeAlquiler'])) ?> al <?= date('d/m/Y', strtotime($alq['fechaHastaAlquiler'])) ?></div>
                                    </td>
                                    <td class="p-4 align-middle text-end" style="background: transparent;">
                                        <div class="fw-bold text-info">$<?= number_format($alq['precioAlqVehiculo'], 0, ',', '.') ?></div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else : ?>
                <div class="p-5 text-center">
                    <i class="bi bi-clipboard-x fs-1 text-secondary mb-3 d-block"></i>
                    <h5 class="text-white">No hay resultados para mostrar</h5>
                    <p class="text-secondary small">Actualmente no hay ningún vehículo en estado activo.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>