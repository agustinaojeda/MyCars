<?php helper('form'); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Usuario - MyCar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">
    <style>
        .form-control-custom,
        .form-select-custom {
            background: rgba(255, 255, 255, 0.05) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: #fff !important;
            transition: all 0.3s ease;
        }

        .form-control-custom:focus,
        .form-select-custom:focus {
            background: rgba(255, 255, 255, 0.08) !important;
            border-color: #0dcaf0 !important;
            box-shadow: 0 0 0 0.25rem rgba(13, 202, 240, 0.15) !important;
        }

        .form-select-custom option {
            background: #12141d !important;
            color: #fff;
        }

        .form-control-custom.is-invalid,
        .form-select-custom.is-invalid {
            border-color: #e6616c !important;
            background-image: none !important;
        }

        .form-control-custom.is-invalid:focus,
        .form-select-custom.is-invalid:focus {
            box-shadow: 0 0 0 0.25rem rgba(234, 134, 143, 0.15) !important;
            border-color: #e6616c !important;
        }
    </style>
</head>

<body class="bg-dark">
    <?= view('templates/nav') ?>

    <div class="container py-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold text-white mb-1"><i class="bi bi-pencil-square me-2 text-warning"></i>Modificar Usuario</h2>
                <p class="text-secondary small mb-0">Editando el perfil de: <strong class="text-white"><?= $usuario['nombreUsuario'] ?></strong> (ID #<?= $usuario['idUsuario'] ?>)</p>
            </div>
            <a href="<?= base_url('admin/gestionar-usuarios') ?>" class="btn btn-outline-custom">
                <i class="bi bi-arrow-left me-2"></i>Volver al Listado
            </a>
        </div>

        <div class="glass-card no-hover-card p-4 p-md-5 mx-auto" style="max-width: 600px; background: linear-gradient(145deg, rgba(20, 24, 33, 0.6) 0%, rgba(11, 15, 25, 0.8) 100%);">

            <form action="<?= base_url('admin/usuarios/actualizar/' . $usuario['idUsuario']) ?>" method="POST" class="d-flex flex-column gap-4">
                <?= csrf_field() ?>

                <div class="d-flex flex-column gap-1">
                    <label for="nombreUsuario" class="small fw-medium <?= (validation_errors() && isset(validation_errors()['nombreUsuario'])) ? 'text-danger' : 'text-secondary' ?>" style="font-size: 0.75rem;">Nombre y Apellido</label>

                    <input type="text" id="nombreUsuario" name="nombreUsuario" required
                        value="<?= old('nombreUsuario', $usuario['nombreUsuario']) ?>"
                        class="form-control form-control-custom py-2.5 rounded-3 <?= (validation_errors() && isset(validation_errors()['nombreUsuario'])) ? 'is-invalid' : '' ?>">

                    <?php if (validation_show_error('nombreUsuario')) : ?>
                        <span class="text-danger small mt-1" style="font-size: 0.75rem;"><i class="bi bi-exclamation-circle me-1"></i><?= validation_show_error('nombreUsuario') ?></span>
                    <?php endif; ?>
                </div>

                <div class="d-flex flex-column gap-1">
                    <label for="emailUsuario" class="small fw-medium <?= (validation_errors() && isset(validation_errors()['emailUsuario'])) ? 'text-danger' : 'text-secondary' ?>" style="font-size: 0.75rem;">Correo Electrónico</label>

                    <input type="email" id="emailUsuario" name="emailUsuario" required
                        value="<?= old('emailUsuario', $usuario['emailUsuario']) ?>"
                        class="form-control form-control-custom py-2.5 rounded-3 <?= (validation_errors() && isset(validation_errors()['emailUsuario'])) ? 'is-invalid' : '' ?>">

                    <?php if (validation_show_error('emailUsuario')) : ?>
                        <span class="text-danger small mt-1" style="font-size: 0.75rem;"><i class="bi bi-exclamation-circle me-1"></i><?= validation_show_error('emailUsuario') ?></span>
                    <?php endif; ?>
                </div>

                <div class="d-flex flex-column gap-1">
                    <label for="telefonoUsuario" class="small fw-medium text-secondary" style="font-size: 0.75rem;">Teléfono</label>
                    <input type="tel" id="telefonoUsuario" name="telefonoUsuario"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                        value="<?= old('telefonoUsuario', $usuario['telefonoUsuario']) ?>"
                        class="form-control form-control-custom py-2.5 rounded-3" placeholder="No registrado">
                </div>

                <div class="d-flex flex-column gap-1">
                    <label for="passwordUsuario" class="small fw-medium <?= (validation_errors() && isset(validation_errors()['passwordUsuario'])) ? 'text-danger' : 'text-secondary' ?>" style="font-size: 0.75rem;">Nueva Contraseña (opcional)</label>

                    <input type="password" id="passwordUsuario" name="passwordUsuario" minlength="6" placeholder="••••••••"
                        class="form-control form-control-custom py-2.5 rounded-3 <?= (validation_errors() && isset(validation_errors()['passwordUsuario'])) ? 'is-invalid' : '' ?>">

                    <?php if (validation_show_error('passwordUsuario')) : ?>
                        <span class="text-danger small mt-1" style="font-size: 0.75rem;"><i class="bi bi-exclamation-circle me-1"></i><?= validation_show_error('passwordUsuario') ?></span>
                    <?php endif; ?>
                </div>

                <div class="d-flex flex-column gap-1">
                    <label for="rolUsuario" class="small fw-medium <?= (validation_errors() && isset(validation_errors()['rolUsuario'])) ? 'text-danger' : 'text-secondary' ?>" style="font-size: 0.75rem;">Rol del Usuario</label>

                    <select id="rolUsuario" name="rolUsuario" class="form-select form-select-custom py-2.5 rounded-3 <?= (validation_errors() && isset(validation_errors()['rolUsuario'])) ? 'is-invalid' : '' ?>" required>
                        <option value="cliente" <?= old('rolUsuario', $usuario['rolUsuario']) === 'cliente' ? 'selected' : '' ?>>
                            Cliente (Acceso estándar a alquileres)
                        </option>
                        <option value="admin" <?= old('rolUsuario', $usuario['rolUsuario']) === 'admin' ? 'selected' : '' ?>>
                            Administrador (Acceso total al Panel de Control)
                        </option>
                    </select>

                    <?php if (validation_show_error('rolUsuario')) : ?>
                        <span class="text-danger small mt-1" style="font-size: 0.75rem;"><i class="bi bi-exclamation-circle me-1"></i><?= validation_show_error('rolUsuario') ?></span>
                    <?php endif; ?>
                </div>

                <button type="submit" class="btn btn-purple py-2.5 rounded-3 fw-medium mt-2">
                    Guardar cambios</i>
                </button>
            </form>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>