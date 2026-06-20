<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Vehículos - MyCar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">
    <style>
        .no-hover-card:hover {
            transform: none !important;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5) !important;
        }

        .search-input {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #fff !important;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: #0dcaf0;
            box-shadow: 0 0 0 0.25rem rgba(13, 202, 240, 0.15);
        }

        .search-input::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        .alerta-temporal {
            animation: desvanecer 1s ease-in-out 3s forwards;
        }

        @keyframes desvanecer {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
                display: none;
            }
        }
    </style>
</head>

<body class="bg-dark">
    <?= view('templates/nav') ?>

    <div class="container py-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold text-white mb-1"><i class="bi bi-car-front me-2 text-info"></i>Gestión de Flota</h2>
                <p class="text-secondary small">Listado de vehículos activos en el sistema. Podés modificar especificaciones o darlos de baja.</p>
            </div>
            <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-outline-custom">
                <i class="bi bi-arrow-left me-2"></i>Volver al Panel
            </a>
        </div>

        <?php if (session()->getFlashdata('mensaje')) : ?>
            <div class="alert alert-success bg-success bg-opacity-25 border-success border-opacity-50 text-white rounded-3 alerta-temporal">
                <i class="bi bi-check-circle-fill me-2"></i><?= session()->getFlashdata('mensaje') ?>
            </div>
        <?php endif; ?>

        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-stretch align-items-sm-center gap-3 mb-3">
            <div>
                <a href="<?= base_url('admin/vehiculos/crear') ?>" class="btn btn-outline-custom px-4 py-1 rounded-3 fw-medium d-inline-flex align-items-center gap-2">
                    <i class="bi bi-plus-circle fs-5"></i> Registrar Vehículo
                </a>
            </div>

            <div class="position-relative w-100 style-search" style="max-width: 350px;">
                <span class="position-absolute top-50 start-3 translate-middle-y text-secondary ps-3">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" id="buscadorVehiculo" class="form-control search-input ps-5 py-2 rounded-3" placeholder="Buscar por marca o modelo...">
            </div>
        </div>

        <div class="glass-card no-hover-card p-0">
            <?php if (!empty($vehiculos)) : ?>
                <div class="table-responsive">
                    <table class="table table-dark table-hover mb-0" style="background: transparent;">
                        <thead>
                            <tr style="border-bottom: 2px solid rgba(255,255,255,0.1);">
                                <th class="p-4 text-secondary font-monospace" style="background: transparent;">Foto</th>
                                <th class="p-4 text-secondary font-monospace" style="background: transparent;">Vehículo</th>
                                <th class="p-4 text-secondary font-monospace" style="background: transparent;">Categoría</th>
                                <th class="p-4 text-secondary font-monospace" style="background: transparent;">Motor / Km</th>
                                <th class="p-4 text-secondary font-monospace" style="background: transparent;">Precio por día</th>
                                <th class="p-4 text-secondary font-monospace text-end" style="background: transparent;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($vehiculos as $v) : ?>
                                <tr class="fila-vehiculo" style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                                    <td class="p-4 align-middle" style="background: transparent;">
                                        <img src="<?= base_url('assets/images/' . $v['imagenVehiculo']) ?>"
                                            class="rounded-3 border border-secondary border-opacity-20"
                                            style="width: 65px; height: 45px; object-fit: cover;"
                                            alt="Foto auto">
                                    </td>
                                    <td class="p-4 align-middle" style="background: transparent;">
                                        <div class="fw-bold text-white nombre-auto"><?= $v['marcaVehiculo'] ?> <?= $v['modeloVehiculo'] ?></div>
                                        <span class="text-secondary small">Año: <?= $v['anioVehiculo'] ?></span>
                                    </td>
                                    <td class="p-4 align-middle text-capitalize text-white-50" style="background: transparent;">
                                        <span class="badge bg-dark border border-secondary border-opacity-25 text-secondary"><?= $v['categoriaVehiculo'] ?></span>
                                    </td>
                                    <td class="p-4 align-middle text-white-50" style="background: transparent;">
                                        <div><?= $v['motorVehiculo'] ?></div>
                                        <span class="text-secondary small font-monospace"><?= number_format($v['kilometrajeVehiculo'], 0, ',', '.') ?> km</span>
                                    </td>
                                    <td class="p-4 align-middle fw-bold text-secondary" style="background: transparent;">
                                        $<?= number_format($v['precioAlqVehiculo'], 0, ',', '.') ?>
                                    </td>
                                    <td class="p-4 align-middle text-end" style="background: transparent;">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="<?= base_url('admin/vehiculos/editar/' . $v['idVehiculo']) ?>"
                                                class="btn btn-outline-warning btn-sm p-0 d-inline-flex align-items-center justify-content-center rounded-3 border-opacity-25"
                                                style="width: 35px; height: 35px;" title="Modificar Vehículo">
                                                <i class="bi bi-pencil fs-6"></i>
                                            </a>
                                            <button type="button"
                                                onclick="mostrarConfirmacionBaja('<?= base_url('admin/vehiculos/baja/' . $v['idVehiculo']) ?>')"
                                                class="btn btn-outline-danger btn-sm p-0 d-inline-flex align-items-center justify-content-center rounded-3 border-opacity-25"
                                                style="width: 35px; height: 35px;" title="Dar de baja">
                                                <i class="bi bi-trash3 fs-6"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else : ?>
                <div class="p-5 text-center">
                    <i class="bi bi-car-front fs-1 text-secondary mb-3 d-block"></i>
                    <h5 class="text-white">No hay vehículos registrados</h5>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="modal fade" id="modalConfirmacionBaja" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content glass-card" style="background: rgba(18, 20, 29, 0.95); border: 1px solid rgba(220, 53, 69, 0.2);">
                <div class="modal-header border-secondary border-opacity-25">
                    <h5 class="modal-title text-white"><i class="bi bi-exclamation-triangle text-danger me-2"></i>Confirmar Baja</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-secondary">
                    ¿Estás seguro de que deseas dar de baja este vehículo? Ya no estará disponible para alquileres públicos, pero se conservará su historial de reservas.
                </div>
                <div class="modal-footer border-secondary border-opacity-25">
                    <button type="button" class="btn btn-outline-custom" data-bs-dismiss="modal">Cancelar</button>
                    <a href="#" id="btnConfirmarBaja" class="btn btn-danger px-3 p-2">Confirmar Baja</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function mostrarConfirmacionBaja(urlDestino) {
            document.getElementById('btnConfirmarBaja').href = urlDestino;
            new bootstrap.Modal(document.getElementById('modalConfirmacionBaja')).show();
        }

        document.getElementById('buscadorVehiculo').addEventListener('input', function() {
            let filtro = this.value.toLowerCase().trim();
            document.querySelectorAll('.fila-vehiculo').forEach(function(fila) {
                let texto = fila.querySelector('.nombre-auto').textContent.toLowerCase();
                fila.style.setProperty("display", texto.includes(filtro) ? "" : "none", "important");
            });
        });
    </script>
</body>

</html>