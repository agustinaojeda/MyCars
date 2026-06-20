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
            <h1 class="fw-bold text-white">
                <i class="bi bi-car-front-fill text-info"></i>
                Registrar Vehículo
            </h1>
            <p class="text-secondary">
                Ingrese los datos del nuevo vehículo.
            </p>
        </div>

        <a href="<?= base_url('admin/gestionar-vehiculos') ?>" class="btn btn-outline-info">
            ← Volver
        </a>
    </div>

    <div class="glass-card shadow-lg">
        <div class="card-body p-4">
           <?php if(session()->getFlashdata('mensaje')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('mensaje') ?>
                </div>
            <?php endif; ?>

            <?php if(session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('admin/vehiculos/guardar') ?>" method="post" enctype="multipart/form-data" novalidate>
                 <?php $errors = session()->getFlashdata('errors'); ?>

                <div class="row">

                    <!-- Columna izquierda -->
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label class="form-label text-light">Marca</label>
                            <input type="text"
                                   name="marcaVehiculo"
                                   class="form-control bg-dark text-light border-secondary"
                                   value="<?= old('marcaVehiculo') ?>"
                                   required>
                                <?php if(isset($errors['marcaVehiculo'])): ?>
                                    <div class="text-danger error-campo">
                                        <?= $errors['marcaVehiculo'] ?>
                                    </div>
                                <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-light">Modelo</label>
                            <input type="text"
                                   name="modeloVehiculo"
                                   class="form-control bg-dark text-light border-secondary"
                                   value="<?= old('modeloVehiculo') ?>"
                                   required>
                                   <?php if(isset($errors['modeloVehiculo'])): ?>
                                        <div class="text-danger error-campo">
                                            <?= $errors['modeloVehiculo'] ?>
                                        </div>
                                    <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-light">Año</label>
                            <input type="number"
                                   name="anioVehiculo"
                                   class="form-control bg-dark text-light border-secondary"
                                   value="<?= old('anioVehiculo') ?>"
                                   required>
                                <?php if(isset($errors['anioVehiculo'])): ?>
                                    <div class="text-danger error-campo">
                                        <?= $errors['anioVehiculo'] ?>
                                    </div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-light">Categoría</label>
                            <select name="categoriaVehiculo"
                                    class="form-select bg-dark text-light border-secondary">
                                <option value="Compacto">Compacto</option>
                                <option value="Sedan">Sedan</option>
                                <option value="SUV">SUV</option>
                                <option value="Deportivo">Deportivo</option>
                            </select>
                            <?php if(isset($errors['categoriaVehiculo'])): ?>
                                <div class="text-danger error-campo">
                                    <?= $errors['categoriaVehiculo'] ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-light">Cantidad de plazas</label>
                            <input type="number"
                                   name="nroPlazasVehiculo"
                                   class="form-control bg-dark text-light border-secondary"
                                   value="<?= old('nroPlazasVehiculo') ?>">
                                   <?php if(isset($errors['nroPlazasVehiculo'])): ?>
                                        <div class="text-danger error-campo">
                                            <?= $errors['nroPlazasVehiculo'] ?>
                                        </div>
                                    <?php endif; ?>
                        </div>

                    </div>


                    <!-- Columna derecha -->
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label class="form-label text-light">Motor</label>
                            <input type="text"
                                   name="motorVehiculo"
                                   class="form-control bg-dark text-light border-secondary"
                                   value="<?= old('motorVehiculo') ?>">
                                   <?php if(isset($errors['motorVehiculo'])): ?>
                                        <div class="text-danger error-campo">
                                            <?= $errors['motorVehiculo'] ?>
                                        </div>
                                    <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-light">Kilometraje</label>
                            <input type="number"
                                   step="0.01"
                                   name="kilometrajeVehiculo"
                                   class="form-control bg-dark text-light border-secondary"
                                   value="<?= old('kilometrajeVehiculo') ?>">
                                   <?php if(isset($errors['kilometrajeVehiculo'])): ?>
                                        <div class="text-danger error-campo">
                                            <?= $errors['kilometrajeVehiculo'] ?>
                                        </div>
                                    <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-light">Precio por día</label>
                            <input type="number"
                                   step="0.01"
                                   name="precioAlqVehiculo"
                                   class="form-control bg-dark text-light border-secondary"
                                   value="<?= old('precioAlqVehiculo') ?>">
                                   <?php if(isset($errors['precioAlqVehiculo'])): ?>
                                        <div class="text-danger error-campo">
                                            <?= $errors['precioAlqVehiculo'] ?>
                                        </div>
                                    <?php endif; ?>
                        </div>

                       <div class="mb-3">
                            <label class="form-label text-light">Imagen</label>

                            <input type="file"
                                id="imagenVehiculo"
                                name="imagenVehiculo"
                                class="form-control bg-dark text-light border-secondary">

                            <img id="preview"
                                class="mt-3 rounded"
                                style="display:none; max-width:250px;">
                        </div>
                    </div>

                </div>

                <hr class="border-secondary">

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-info px-5">
                        Guardar Vehículo
                    </button>

                    <a href="<?= base_url('admin/gestionar-vehiculos') ?>"
                       class="btn btn-outline-danger ms-2">
                        Cancelar
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>
<script>
document.getElementById('imagenVehiculo').addEventListener('change', function () {

    const archivo = this.files[0];

    if (archivo) {
        const lector = new FileReader();

        lector.onload = function (e) {
            const preview = document.getElementById('preview');
            preview.src = e.target.result;
            preview.style.display = 'block';
        }

        lector.readAsDataURL(archivo);
    }

});
</script>
<script>
document.querySelectorAll('input, select').forEach(campo => {
    campo.addEventListener('input', function() {

        let error = this.parentElement.querySelector('.error-campo');

        if (error && this.value.trim() !== '') {
            error.style.display = 'none';
        }

    });
});
</script>
</body>
</html>    