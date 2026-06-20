<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios - MyCar</title>
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
                <h2 class="fw-bold text-white mb-1"><i class="bi bi-people me-2 text-info"></i>Gestión de Usuarios</h2>
                <p class="text-secondary small">Listado de clientes registrados en el sistema. Podés modificar sus datos o darlos de baja.</p>
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

        <div class="d-flex justify-content-end mb-3">
            <div class="position-relative w-100 style-search" style="max-width: 350px;">
                <span class="position-absolute top-50 start-3 translate-middle-y text-secondary ps-3">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" id="buscadorUsuario" class="form-control search-input ps-5 py-2 rounded-3" placeholder="Buscar por nombre...">
            </div>
        </div>

        <div class="glass-card no-hover-card p-0">
            <?php if (!empty($usuarios)) : ?>
                <div class="table-responsive">
                    <table class="table table-dark table-hover mb-0" style="background: transparent;" id="tablaUsuarios">
                        <thead>
                            <tr style="border-bottom: 2px solid rgba(255,255,255,0.1);">
                                <th class="p-4 text-secondary font-monospace" style="background: transparent;">Rol</th>
                                <th class="p-4 text-secondary font-monospace" style="background: transparent;">Nombre y Apellido</th>
                                <th class="p-4 text-secondary font-monospace" style="background: transparent;">Email</th>
                                <th class="p-4 text-secondary font-monospace" style="background: transparent;">Teléfono</th>
                                <th class="p-4 text-secondary font-monospace text-end" style="background: transparent;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($usuarios as $u) : ?>
                                <tr class="fila-usuario" style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                                    <td class="p-4 align-middle" style="background: transparent;">
                                        <span class="badge bg-secondary bg-opacity-50 text-capitalize"><?= $u['rolUsuario'] ?></span>
                                    </td>
                                    <td class="p-4 align-middle fw-bold text-white nombre-usuario" style="background: transparent;">
                                        <?= $u['nombreUsuario'] ?>
                                    </td>
                                    <td class="p-4 align-middle text-white-50" style="background: transparent;">
                                        <?= $u['emailUsuario'] ?>
                                    </td>
                                    <td class="p-4 align-middle text-white-50" style="background: transparent;">
                                        <?= $u['telefonoUsuario'] ?? '---' ?>
                                    </td>
                                    <td class="p-4 align-middle text-end" style="background: transparent;">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="<?= base_url('admin/usuarios/editar/' . $u['idUsuario']) ?>"
                                                class="btn btn-outline-warning btn-sm p-0 d-inline-flex align-items-center justify-content-center rounded-3 border-opacity-25"
                                                style="width: 35px; height: 35px;" title="Modificar datos">
                                                <i class="bi bi-pencil fs-6"></i>
                                            </a>

                                            <button type="button"
                                                onclick="mostrarConfirmacionBaja('<?= base_url('admin/usuarios/baja/' . $u['idUsuario']) ?>')"
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
                    <i class="bi bi-people fs-1 text-secondary mb-3 d-block"></i>
                    <h5 class="text-white">No hay usuarios registrados</h5>
                    <p class="text-secondary small">Cuando se registre un nuevo cliente aparecerá listado acá.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="modal fade" id="modalConfirmacionBaja" tabindex="-1" aria-labelledby="modalConfirmacionBajaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content glass-card" style="background: rgba(18, 20, 29, 0.95); border: 1px solid rgba(220, 53, 69, 0.2);">
                <div class="modal-header border-secondary border-opacity-25">
                    <h5 class="modal-title text-white" id="modalConfirmacionBajaLabel">
                        <i class="bi bi-exclamation-triangle text-danger me-2"></i>Confirmar Baja de Usuario
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body text-secondary">
                    ¿Estás seguro de que deseas dar de baja a este usuario?
                    <br><br>
                    El usuario <strong>ya no podrá iniciar sesión</strong> en el sistema, pero sus datos e historial de alquileres se mantendrán resguardados de forma segura.
                </div>
                <div class="modal-footer border-secondary border-opacity-25">
                    <button type="button" class="btn btn-outline-custom" data-bs-dismiss="modal">Cancelar</button>
                    <a href="<?= base_url('admin/usuarios/baja/(:num)') ?>" id="btnConfirmarBaja" class="btn btn-danger border-danger p-2">
                        Confirmar Baja
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function mostrarConfirmacionBaja(urlDestino) {
            document.getElementById('btnConfirmarBaja').href = urlDestino;
            var modalBootstrap = new bootstrap.Modal(document.getElementById('modalConfirmacionBaja'));
            modalBootstrap.show();
        }
        document.getElementById('buscadorUsuario').addEventListener('input', function() {
            let filtro = this.value.toLowerCase().trim();
            let filas = document.querySelectorAll('.fila-usuario');

            filas.forEach(function(fila) {
                let nombre = fila.querySelector('.nombre-usuario').textContent.toLowerCase();
                if (nombre.includes(filtro)) {
                    fila.style.setProperty("display", "", "important");
                } else {
                    fila.style.setProperty("display", "none", "important");
                }
            });
        });
    </script>
</body>

</html>