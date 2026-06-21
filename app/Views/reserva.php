<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cars</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/reserva.css') ?>">

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
<?php
/** @var array $vehiculo */
?>
<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow border-0 reserva-card">

                <div class="card-header reserva-header text-white"
                    style=" border-radius:20px 20px 0 0;">
                    <h3 class="mb-0">
                        Reserva de Vehículo
                    </h3>
                </div>

                <div class="card-body">
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

                    <div class="row">

                        <!-- Imagen -->
                        <div class="col-md-5 text-center">

                            <img
                                src="<?= base_url('assets/images/'.$vehiculo['imagenVehiculo']) ?>"
                                class="img-fluid reserva-img mb-3"
                                alt="Vehículo">

                        </div>

                        <!-- Datos -->
                        <div class="col-md-7">

                            <h4 class="fw-bold">
                                <?= $vehiculo['marcaVehiculo'] ?>
                                <?= $vehiculo['modeloVehiculo'] ?>
                            </h4>

                            <p>
                                <strong>Año:</strong>
                                <?= $vehiculo['anioVehiculo'] ?>
                            </p>

                            <p>
                                <strong>Motor:</strong>
                                <?= $vehiculo['motorVehiculo'] ?>
                            </p>

                            <p>
                                <strong>Plazas:</strong>
                                <?= $vehiculo['nroPlazasVehiculo'] ?>
                            </p>

                            <p>
                                <strong>Precio por día:</strong>

                                <span class="text-success fw-bold">
                                    $<?= number_format($vehiculo['precioAlqVehiculo'], 0, ',', '.') ?>
                                </span>
                            </p>

                        </div>

                    </div>

                    <hr>

                    <form action="<?= base_url('alquiler/guardar') ?>" method="post" novalidate>
                        <?php $errors = session()->getFlashdata('errors'); ?>

                        <input
                            type="hidden"
                            name="idVehiculo"
                            value="<?= $vehiculo['idVehiculo'] ?>">

                        <div class="mb-3">

                            <label class="form-label">
                                Fecha desde
                            </label>

                            <input
                                type="date"
                                name="fechaDesde"
                                class="form-control"
                                min="<?= date('Y-m-d') ?>"
                                value="<?= old('fechaDesde') ?>"
                                required>
                                <?php if(isset($errors['fechaDesde'])): ?>
                                    <small class="text-danger error-msg">
                                        <?= $errors['fechaDesde'] ?>
                                    </small>
                                <?php endif; ?>

                        </div>

                        <div class="mb-4">

                            <label class="form-label">
                                Cantidad de días
                            </label>

                            <input
                                type="number"
                                name="cantDias"
                                min="1"
                                class="form-control"
                                value="<?= old('cantDias') ?>"
                                required>
                                <?php if(isset($errors['cantDias'])): ?>
                                    <small class="text-danger error-msg">
                                        <?= $errors['cantDias'] ?>
                                    </small>
                                <?php endif; ?>

                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Nombre del conductor
                            </label>

                            <input
                                type="text"
                                name="nombreConductor"
                                class="form-control"
                                placeholder="Ingrese su nombre"
                                minlength="3"
                                maxlength="100"
                                value="<?= old('nombreConductor') ?>"
                                required>
                                <?php if(isset($errors['nombreConductor'])): ?>
                                    <small class="text-danger error-msg">
                                        <?= $errors['nombreConductor'] ?>
                                    </small>
                                <?php endif; ?>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">
                                Forma de pago
                            </label>

                            <select
                                name="formaPago"
                                id="formaPago"
                                class="form-select"
                                required>

                                <option value="">Seleccione una opción</option>
                                <option value="Tarjeta de crédito">Tarjeta de crédito</option>
                                <?= old('formaPago') == 'Tarjeta de crédito' ? 'selected' : '' ?>>
                                <option value="Tarjeta de débito">Tarjeta de débito</option>
                                <?= old('formaPago') == 'Tarjeta de débito' ? 'selected' : '' ?>>
                                <option value="Transferencia">Transferencia</option>
                                <?= old('formaPago') == 'Transferencia' ? 'selected' : '' ?>>
                                <option value="Efectivo">Efectivo</option>
                                <?= old('formaPago') == 'Efectivo' ? 'selected' : '' ?>>

                            </select>
                            <?php if(isset($errors['formaPago'])): ?>
                                <small class="text-danger error-msg">
                                    <?= $errors['formaPago'] ?>
                                </small>
                            <?php endif; ?>
                        </div>
                        <div class="card resumen-card shadow-sm mb-4">

                            <div class="card-header resumen-header fw-bold">
                                Resumen de la reserva
                            </div>

                            <div class="card-body">

                                <p>
                                    <strong>Vehículo:</strong>
                                    <?= $vehiculo['marcaVehiculo'] ?>
                                    <?= $vehiculo['modeloVehiculo'] ?>
                                </p>

                                <p>
                                    <strong>Precio por día:</strong>
                                    $<?= number_format($vehiculo['precioAlqVehiculo'],0,',','.') ?>
                                </p>
                                <p>
                                    <strong>Conductor:</strong>
                                    <span id="resNombre">-</span>
                                </p>

                                <p>
                                    <strong>Fecha desde:</strong>
                                    <span id="resFecha">-</span>
                                </p>

                                <p>
                                    <strong>Cantidad de días:</strong>
                                    <span id="resDias">0</span>
                                </p>

                                <p>
                                    <strong>Forma de pago:</strong>
                                    <span id="resPago">-</span>
                                </p>

                                <hr>

                                <h4 class="total-reserva">
                                    Total:
                                    <span id="total">$0</span>
                                </h4>

                            </div>

                        </div>
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle"></i>
                            La reserva será enviada y quedará pendiente hasta ser aprobada por un administrador.
                        </div>

                        <div class="d-flex justify-content-between">

                            <a
                                href="<?= previous_url() ?>"
                                class="btn btn-outline-secondary rounded-pill px-4">

                                Cancelar

                            </a>

                            <button
                                type="submit"
                                class="btn btn-confirmar">

                                Enviar Reserva

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<?= view('templates/footer') ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

<script>
const precioDia = <?= $vehiculo['precioAlqVehiculo'] ?>;
const inputNombre = document.querySelector('[name="nombreConductor"]');
const resNombre = document.getElementById('resNombre');

const inputDias = document.querySelector('[name="cantDias"]');
const inputFecha = document.querySelector('[name="fechaDesde"]');
const inputPago = document.getElementById('formaPago');

const total = document.getElementById('total');
const resDias = document.getElementById('resDias');
const resFecha = document.getElementById('resFecha');
const resPago = document.getElementById('resPago');

function actualizarResumen() {

    const dias = parseInt(inputDias.value) || 0;

    resDias.textContent = dias;

    total.textContent =
        '$' + (dias * precioDia).toLocaleString('es-AR');

    resFecha.textContent =
        inputFecha.value || '-';

    resPago.textContent =
        inputPago.value || '-';

    resNombre.textContent =
    inputNombre.value || '-';    
}

inputDias.addEventListener('input', actualizarResumen);
inputFecha.addEventListener('change', actualizarResumen);
inputPago.addEventListener('change', actualizarResumen);
inputNombre.addEventListener('input', actualizarResumen);
actualizarResumen();
</script>
<script>
document.querySelectorAll("input, select").forEach(campo => {
    campo.addEventListener("input", function () {
        let error = this.parentElement.querySelector(".error-msg");

        if (error) {
            error.style.display = "none";
        }
    });

    campo.addEventListener("change", function () {
        let error = this.parentElement.querySelector(".error-msg");

        if (error) {
            error.style.display = "none";
        }
    });
});
</script>
</body>
</html>    
