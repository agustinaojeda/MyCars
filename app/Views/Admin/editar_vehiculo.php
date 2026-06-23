<?php helper('form'); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Vehículo - MyCar</title>
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
                <h2 class="fw-bold text-white mb-1"><i class="bi bi-pencil-square me-2 text-warning"></i>Modificar Vehículo</h2>
                <p class="text-secondary small mb-0">Editando: <strong class="text-white"><?= $vehiculo['marcaVehiculo'] ?> <?= $vehiculo['modeloVehiculo'] ?></strong></p>
            </div>
            <a href="<?= base_url('admin/gestionar-vehiculos') ?>" class="btn btn-outline-custom">
                <i class="bi bi-arrow-left me-2"></i>Volver al Listado
            </a>
        </div>

        <div class="glass-card no-hover-card p-4 p-md-5 mx-auto" style="max-width: 700px; background: linear-gradient(145deg, rgba(20, 24, 33, 0.6) 0%, rgba(11, 15, 25, 0.8) 100%);">

            <form action="<?= base_url('admin/vehiculos/actualizar/' . $vehiculo['idVehiculo']) ?>" method="POST" enctype="multipart/form-data" class="d-flex flex-column gap-4">
                <?= csrf_field() ?>

                <div class="row g-3">
                    <div class="col-12 col-md-6 d-flex flex-column gap-1">
                        <label class="small fw-medium <?= (validation_errors() && isset(validation_errors()['marcaVehiculo'])) ? 'text-danger' : 'text-secondary' ?>" style="font-size: 0.75rem;">Marca</label>
                        <input type="text" name="marcaVehiculo" required value="<?= old('marcaVehiculo', $vehiculo['marcaVehiculo']) ?>" class="form-control form-control-custom py-2.5 rounded-3 <?= (validation_errors() && isset(validation_errors()['marcaVehiculo'])) ? 'is-invalid' : '' ?>">
                        <?= validation_show_error('marcaVehiculo') ? '<span class="text-danger small" style="font-size: 0.72rem;"><i class="bi bi-exclamation-circle me-1"></i>' . validation_show_error('marcaVehiculo') . '</span>' : '' ?>
                    </div>

                    <div class="col-12 col-md-6 d-flex flex-column gap-1">
                        <label class="small fw-medium <?= (validation_errors() && isset(validation_errors()['modeloVehiculo'])) ? 'text-danger' : 'text-secondary' ?>" style="font-size: 0.75rem;">Modelo</label>
                        <input type="text" name="modeloVehiculo" required value="<?= old('modeloVehiculo', $vehiculo['modeloVehiculo']) ?>" class="form-control form-control-custom py-2.5 rounded-3 <?= (validation_errors() && isset(validation_errors()['modeloVehiculo'])) ? 'is-invalid' : '' ?>">
                        <?= validation_show_error('modeloVehiculo') ? '<span class="text-danger small" style="font-size: 0.72rem;"><i class="bi bi-exclamation-circle me-1"></i>' . validation_show_error('modeloVehiculo') . '</span>' : '' ?>
                    </div>

                    <div class="col-12 col-md-6 d-flex flex-column gap-1">
                        <label class="small fw-medium <?= (validation_errors() && isset(validation_errors()['categoriaVehiculo'])) ? 'text-danger' : 'text-secondary' ?>" style="font-size: 0.75rem;">Categoría</label>
                        <select name="categoriaVehiculo" class="form-select form-select-custom py-2.5 rounded-3" required>
                            <option value="sedan" <?= old('categoriaVehiculo', $vehiculo['categoriaVehiculo']) == 'sedan' ? 'selected' : '' ?>>Sedan</option>
                            <option value="suv" <?= old('categoriaVehiculo', $vehiculo['categoriaVehiculo']) == 'suv' ? 'selected' : '' ?>>SUV</option>
                            <option value="deportivo" <?= old('categoriaVehiculo', $vehiculo['categoriaVehiculo']) == 'deportivo' ? 'selected' : '' ?>>Deportivo</option>
                            <option value="compacto" <?= old('categoriaVehiculo', $vehiculo['categoriaVehiculo']) == 'compacto' ? 'selected' : '' ?>>Compacto</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6 d-flex flex-column gap-1">
                        <label class="small fw-medium <?= (validation_errors() && isset(validation_errors()['anioVehiculo'])) ? 'text-danger' : 'text-secondary' ?>" style="font-size: 0.75rem;">Año</label>
                        <input type="number" name="anioVehiculo" required value="<?= old('anioVehiculo', $vehiculo['anioVehiculo']) ?>" class="form-control form-control-custom py-2.5 rounded-3 <?= (validation_errors() && isset(validation_errors()['anioVehiculo'])) ? 'is-invalid' : '' ?>">
                        <?= validation_show_error('anioVehiculo') ? '<span class="text-danger small" style="font-size: 0.72rem;"><i class="bi bi-exclamation-circle me-1"></i>' . validation_show_error('anioVehiculo') . '</span>' : '' ?>
                    </div>

                    <div class="col-12 col-md-6 d-flex flex-column gap-1">
                        <label class="small fw-medium <?= (validation_errors() && isset(validation_errors()['motorVehiculo'])) ? 'text-danger' : 'text-secondary' ?>" style="font-size: 0.75rem;">Motor (Ej: 2.0 Turbo)</label>
                        <input type="text" name="motorVehiculo" required value="<?= old('motorVehiculo', $vehiculo['motorVehiculo']) ?>" class="form-control form-control-custom py-2.5 rounded-3 <?= (validation_errors() && isset(validation_errors()['motorVehiculo'])) ? 'is-invalid' : '' ?>">
                        <?= validation_show_error('motorVehiculo') ? '<span class="text-danger small" style="font-size: 0.72rem;"><i class="bi bi-exclamation-circle me-1"></i>' . validation_show_error('motorVehiculo') . '</span>' : '' ?>
                    </div>

                    <div class="col-12 col-md-6 d-flex flex-column gap-1">
                        <label class="small fw-medium <?= (validation_errors() && isset(validation_errors()['kilometrajeVehiculo'])) ? 'text-danger' : 'text-secondary' ?>" style="font-size: 0.75rem;">Kilometraje</label>
                        <input type="number" name="kilometrajeVehiculo" required value="<?= old('kilometrajeVehiculo', $vehiculo['kilometrajeVehiculo']) ?>" class="form-control form-control-custom py-2.5 rounded-3 <?= (validation_errors() && isset(validation_errors()['kilometrajeVehiculo'])) ? 'is-invalid' : '' ?>">
                        <?= validation_show_error('kilometrajeVehiculo') ? '<span class="text-danger small" style="font-size: 0.72rem;"><i class="bi bi-exclamation-circle me-1"></i>' . validation_show_error('kilometrajeVehiculo') . '</span>' : '' ?>
                    </div>

                    <div class="col-12 col-md-6 d-flex flex-column gap-1">
                        <label class="small fw-medium <?= (validation_errors() && isset(validation_errors()['precioAlqVehiculo'])) ? 'text-danger' : 'text-secondary' ?>" style="font-size: 0.75rem;">Precio de Alquiler por Día ($)</label>
                        <input type="number" name="precioAlqVehiculo" required value="<?= old('precioAlqVehiculo', $vehiculo['precioAlqVehiculo']) ?>" class="form-control form-control-custom py-2.5 rounded-3 <?= (validation_errors() && isset(validation_errors()['precioAlqVehiculo'])) ? 'is-invalid' : '' ?>">
                        <?= validation_show_error('precioAlqVehiculo') ? '<span class="text-danger small" style="font-size: 0.72rem;"><i class="bi bi-exclamation-circle me-1"></i>' . validation_show_error('precioAlqVehiculo') . '</span>' : '' ?>
                    </div>
                    <div class="col-12 col-md-6 d-flex flex-column gap-1">
                        <label class="small fw-medium <?= (validation_errors() && isset(validation_errors()['nroPlazasVehiculo'])) ? 'text-danger' : 'text-secondary' ?>" style="font-size: 0.75rem;">Cantidad de plazas</label>
                        <input type="number" name="nroPlazasVehiculo" required value="<?= old('nroPlazasVehiculo', $vehiculo['nroPlazasVehiculo']) ?>" class="form-control form-control-custom py-2.5 rounded-3 <?= (validation_errors() && isset(validation_errors()['nroPlazasVehiculo'])) ? 'is-invalid' : '' ?>">
                        <?= validation_show_error('nroPlazasVehiculo') ? '<span class="text-danger small" style="font-size: 0.72rem;"><i class="bi bi-exclamation-circle me-1"></i>' . validation_show_error('nroPlazasVehiculo') . '</span>' : '' ?>
                    </div>



                    <div class="col-12 d-flex flex-column gap-2 mt-2">
                        <label class="small fw-medium <?= (validation_errors() && isset(validation_errors()['imagenVehiculo'])) ? 'text-danger' : 'text-secondary' ?>" style="font-size: 0.75rem;">Imagen del Auto (Dejar vacío para conservar la actual)</label>
                        <div class="d-flex align-items-center gap-3">
                            <img src="<?= base_url('assets/images/' . $vehiculo['imagenVehiculo']) ?>" class="rounded-3 border border-secondary border-opacity-30" style="width: 90px; height: 60px; object-fit: cover;">
                            <input type="file" name="imagenVehiculo" class="form-control form-control-custom py-2.5 rounded-3 <?= (validation_errors() && isset(validation_errors()['imagenVehiculo'])) ? 'is-invalid' : '' ?>" accept="image/*">
                        </div>
                        <?= validation_show_error('imagenVehiculo') ? '<span class="text-danger small" style="font-size: 0.72rem;"><i class="bi bi-exclamation-circle me-1"></i>' . validation_show_error('imagenVehiculo') . '</span>' : '' ?>
                    </div>
                </div>

                <button type="submit" class="btn btn-purple py-2.5 rounded-3 fw-medium mt-3">
                    Guardar vehículo</i>
                </button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>