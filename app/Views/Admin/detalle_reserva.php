<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Reserva - MyCar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">
    <style>
        .info-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #94a3b8;
            margin-bottom: 0.2rem;
            display: block;
        }
        .info-value {
            font-size: 1rem;
            color: #f8fafc;
            font-weight: 500;
        }
        .no-hover-card:hover { transform: none !important; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5) !important; }
    </style>
</head>
<body>
    <?= view('templates/nav') ?>

    <div class="container py-5">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold text-white mb-1"><i class="bi bi-file-earmark-text me-2 text-info"></i>Detalle de Reserva #<?= $reserva['idAlquiler'] ?></h2>
                <p class="text-secondary small">Revisá la información antes de aprobar o rechazar la solicitud.</p>
            </div>
            <a href="<?= base_url('admin/reservas-pendientes') ?>" class="btn btn-outline-custom">
                <i class="bi bi-arrow-left me-2"></i>Volver a Pendientes
            </a>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-12 col-md-4">
                <div class="glass-card no-hover-card p-4 h-100">
                    <h5 class="text-white border-bottom border-secondary border-opacity-25 pb-2 mb-4"><i class="bi bi-person-lines-fill me-2 text-info"></i>Datos del Cliente</h5>
                    
                    <div class="mb-3">
                        <span class="info-label">Nombre y Apellido</span>
                        <span class="info-value"><?= $reserva['nombreUsuario'] ?></span>
                    </div>
                    <div class="mb-3">
                        <span class="info-label">Correo Electrónico</span>
                        <span class="info-value"><?= $reserva['emailUsuario'] ?></span>
                    </div>
                    <div class="mb-3">
                        <span class="info-label">Teléfono</span>
                        <span class="info-value"><?= $reserva['telefonoUsuario'] ?></span>
                    </div>
                    <div>
                        <span class="info-label">Dirección</span>
                        <span class="info-value"><?= $reserva['direccionUsuario'] ?></span>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="glass-card no-hover-card p-4 h-100">
                    <h5 class="text-white border-bottom border-secondary border-opacity-25 pb-2 mb-4"><i class="bi bi-car-front me-2 text-info"></i>Vehículo Solicitado</h5>
                    <div class="mb-3">
                        <span class="info-label">Conductor</span>
                        <span class="info-value"><?= $reserva['nombreConductor'] ?>
                    </div>
                    <div class="mb-3">
                        <span class="info-label">Modelo</span>
                        <span class="info-value"><?= $reserva['marcaVehiculo'] ?> <?= $reserva['modeloVehiculo'] ?></span>
                    </div>
                    <div class="mb-3">
                        <span class="info-label">Año y Plazas</span>
                        <span class="info-value"><?= $reserva['anioVehiculo'] ?> | <?= $reserva['nroPlazasVehiculo'] ?> Asientos</span>
                    </div>
                    <div class="mb-3">
                        <span class="info-label">Motor</span>
                        <span class="info-value"><?= $reserva['motorVehiculo'] ?></span>
                    </div>
                    <div>
                        <span class="info-label">Tarifa Diaria</span>
                        <span class="info-value text-info fw-bold">$<?= number_format($reserva['precioAlqVehiculo'], 0, ',', '.') ?></span>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="glass-card no-hover-card p-4 h-100">
                    <h5 class="text-white border-bottom border-secondary border-opacity-25 pb-2 mb-4"><i class="bi bi-calendar-check me-2 text-info"></i>Periodo de Alquiler</h5>
                    
                    <div class="mb-3">
                        <span class="info-label">Fecha de Retiro</span>
                        <span class="info-value"><?= date('d/m/Y', strtotime($reserva['fechaDesdeAlquiler'])) ?></span>
                    </div>
                    <div class="mb-3">
                        <span class="info-label">Fecha de Devolución</span>
                        <span class="info-value"><?= date('d/m/Y', strtotime($reserva['fechaHastaAlquiler'])) ?></span>
                    </div>
                    <div class="mb-3">
                        <span class="info-label">Duración</span>
                        <span class="info-value"><?= $reserva['cantDiasAlquiler'] ?> Días</span>
                    </div>
                    
                    <?php $montoTotal = $reserva['cantDiasAlquiler'] * $reserva['precioAlqVehiculo']; ?>
                    <div class="mt-4 p-3 rounded" style="background: rgba(13, 202, 240, 0.1); border: 1px solid rgba(13, 202, 240, 0.3);">
                        <span class="info-label text-info">Monto Total Estimado</span>
                        <span class="info-value fs-4 fw-bold text-info">$<?= number_format($montoTotal, 0, ',', '.') ?></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="glass-card no-hover-card p-4 d-flex justify-content-end gap-3">
            <a href="<?= base_url('admin/rechazar-reserva/' . $reserva['idAlquiler']) ?>" class="btn btn-outline-danger px-4" onclick="return confirm('¿Estás seguro de que querés rechazar y cancelar esta reserva?');">
                <i class="bi bi-x-circle me-2"></i>Rechazar
            </a>
            <a href="<?= base_url('admin/aprobar-reserva/' . $reserva['idAlquiler']) ?>" class="btn btn-purple px-5">
                <i class="bi bi-check2-circle me-2"></i>Aprobar Reserva
            </a>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>