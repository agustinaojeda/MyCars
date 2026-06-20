<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Devoluciones - MyCar</title>
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
                <h2 class="fw-bold text-white mb-1"><i class="bi bi-key me-2 text-info"></i>Registrar Devolución</h2>
                <p class="text-secondary small">Alquileres en curso. Registrá el ingreso para liberar los vehículos.</p>
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

        <div class="glass-card no-hover-card p-0">
            <?php if (!empty($alquileres)) : ?>
                <div class="table-responsive">
                    <table class="table table-dark table-hover mb-0" style="background: transparent;">
                        <thead>
                            <tr style="border-bottom: 2px solid rgba(255,255,255,0.1);">
                                <th class="p-4 text-secondary font-monospace" style="background: transparent;">Reserva</th>
                                <th class="p-4 text-secondary font-monospace" style="background: transparent;">Vehículo</th>
                                <th class="p-4 text-secondary font-monospace" style="background: transparent;">Cliente</th>
                                <th class="p-4 text-secondary font-monospace" style="background: transparent;">Devolución Esperada</th>
                                <th class="p-4 text-secondary font-monospace text-end" style="background: transparent;">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($alquileres as $alquiler) : ?>
                                <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                                    <td class="p-4 align-middle" style="background: transparent;">
                                        <span class="badge bg-secondary bg-opacity-50">#<?= $alquiler['idAlquiler'] ?></span>
                                    </td>
                                    <td class="p-4 align-middle" style="background: transparent;">
                                        <div class="fw-bold text-white"><?= $alquiler['marcaVehiculo'] ?> <?= $alquiler['modeloVehiculo'] ?></div>
                                    </td>
                                    <td class="p-4 align-middle" style="background: transparent;">
                                        <div class="fw-bold text-white"><?= $alquiler['nombreUsuario'] ?></div>
                                    </td>
                                    <td class="p-4 align-middle" style="background: transparent;">
                                        <div class="fw-bold text-info"><?= date('d/m/Y', strtotime($alquiler['fechaHastaAlquiler'])) ?></div>
                                    </td>
                                    <td class="p-4 align-middle text-end" style="background: transparent;">
                                        <button type="button" 
                                                onclick="mostrarConfirmacion('<?= base_url('admin/confirmar-devolucion/' . $alquiler['idAlquiler']) ?>')" 
                                                class="btn btn-outline-info btn-sm py-2 px-3">
                                            Recibir Auto <i class="bi bi-arrow-return-left me-1"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else : ?>
                <div class="p-5 text-center">
                    <i class="bi bi-emoji-smile fs-1 text-secondary mb-3 d-block"></i>
                    <h5 class="text-white">No hay alquileres activos</h5>
                    <p class="text-secondary small">Toda la flota está disponible o pendiente de aprobación.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="modal fade" id="modalConfirmacion" tabindex="-1" aria-labelledby="modalConfirmacionLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content glass-card" style="background: rgba(18, 20, 29, 0.95); border: 1px solid rgba(13, 202, 240, 0.2);">
                <div class="modal-header border-secondary border-opacity-25">
                    <h5 class="modal-title text-white" id="modalConfirmacionLabel">
                        <i class="bi bi-exclamation-triangle text-info me-2"></i>Confirmar Devolución
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body text-secondary">
                    ¿Estás seguro de que el cliente entregó las llaves y devolvió el vehículo en condiciones? 
                    <br><br>
                    Al confirmar esta acción, el alquiler se dará por finalizado y el auto volverá a estar disponible en el catálogo público para nuevas reservas.
                </div>
                <div class="modal-footer border-secondary border-opacity-25">
                    <button type="button" class="btn btn-outline-custom" data-bs-dismiss="modal">Cancelar</button>
                    <a href="#" id="btnConfirmarAccion" class="btn btn-purple px-4">
                        Sí, recibir auto <i class="bi bi-check2 me-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function mostrarConfirmacion(urlDestino) {
            // Buscamos el botón de confirmación dentro del modal y le asignamos la ruta correspondiente al alquiler
            document.getElementById('btnConfirmarAccion').href = urlDestino;
            
            // Instanciamos el modal de Bootstrap y lo mostramos en pantalla
            var modalBootstrap = new bootstrap.Modal(document.getElementById('modalConfirmacion'));
            modalBootstrap.show();
        }
    </script>
</body>
</html>