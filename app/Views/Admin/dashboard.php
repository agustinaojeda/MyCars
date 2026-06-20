<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - MyCar</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">
</head>

<body>
    <?= view('templates/nav') ?>

    <div class="container py-5">
        <div class="row mb-5 align-items-center">
            <div class="col-md-8">
                <h1 class="display-5 fw-bold text-white mb-2">Panel de Control</h1>
                <p class="text-secondary fs-5">Bienvenido al sistema de gestión de alquileres MyCar. Selecciona una
                    acción para continuar.</p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <span
                    class="badge rounded-pill bg-info bg-opacity-20 text-white border border-info border-opacity-50 px-3 py-2">
                    <i class="bi bi-person-badge me-2"></i>Modo Administrador
                </span>
            </div>
        </div>

        <div class="row g-4">

            <div class="col-12 col-lg-4">
                <div class="glass-card p-4 h-100 d-flex flex-column">
                    <div class="d-flex align-items-center mb-4">
                        <div class="icon-circle me-3 text-info">
                            <i class="bi bi-calendar2-check fs-4"></i>
                        </div>
                        <h3 class="h5 fw-bold text-white mb-0">Gestión de Alquileres</h3>
                    </div>
                    <p class="text-secondary small mb-4 flex-grow-1">
                        Administra el flujo de los vehículos. Aprueba las reservas entrantes y registra cuando los
                        clientes devuelven los autos.
                    </p>
                    <div class="d-flex flex-column gap-2 mt-auto">
                        <a href="<?= base_url('admin/reservas-pendientes') ?>" class="btn btn-purple w-100 text-start">
                            <i class="bi bi-check-circle me-2"></i>Validar Reservas Pendientes
                        </a>
                        <a href="<?= base_url('admin/devoluciones') ?>" class="btn btn-outline-custom w-100 text-start">
                            <i class="bi bi-arrow-return-left me-2"></i>Registrar Devolución
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="glass-card p-4 h-100 d-flex flex-column">
                    <div class="d-flex align-items-center mb-4">
                        <div class="icon-circle me-3" style="color: #a78bfa;">
                            <i class="bi bi-bar-chart fs-4"></i>
                        </div>
                        <h3 class="h5 fw-bold text-white mb-0">Reportes Avanzados</h3>
                    </div>
                    <p class="text-secondary small mb-4 flex-grow-1">
                        Consulta la información cruzada de la base de datos para obtener métricas y listados detallados
                        del negocio.
                    </p>
                    <div class="d-flex flex-column gap-2 mt-auto">
                        <a href="<?= base_url('admin/reporte-clientes-vehiculo') ?>"
                            class="btn btn-outline-custom w-100 text-start">
                            <i class="bi bi-people me-2"></i>Clientes por Vehículo
                        </a>
                        <a href="<?= base_url('admin/reporte-vehiculos-cliente') ?>"
                            class="btn btn-outline-custom w-100 text-start">
                            <i class="bi bi-car-front me-2"></i>Vehículos por Cliente
                        </a>
                        <a href="<?= base_url('admin/reporte-activos') ?>"
                            class="btn btn-outline-custom w-100 text-start">
                            <i class="bi bi-key me-2"></i>Alquileres Actuales Activos
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="glass-card p-4 h-100 d-flex flex-column">
                    <div class="d-flex align-items-center mb-4">
                        <div class="icon-circle me-3 text-white">
                            <i class="bi bi-grid fs-4"></i>
                        </div>
                        <h3 class="h5 fw-bold text-white mb-0">Accesos Rápidos</h3>
                    </div>
                    <p class="text-secondary small mb-4 flex-grow-1">
                        Atajos hacia las funciones de control base de datos (ABM) administradas por los otros módulos
                        del sistema.
                    </p>
                    <div class="d-flex flex-column gap-2 mt-auto">
                        <a href="<?= base_url('admin/gestionar-usuarios') ?>" class="btn w-100 text-start"
                            style="background: rgba(255,255,255,0.05); color: #e2e8f0; border: 1px solid rgba(255,255,255,0.1);">
                            <i class="bi bi-person-gear me-2"></i>Gestionar Usuarios
                        </a>
                        <a href="<?= base_url('admin/gestionar-vehiculos') ?>" class="btn w-100 text-start"
                            style="background: rgba(255,255,255,0.05); color: #e2e8f0; border: 1px solid rgba(255,255,255,0.1);">
                            <i class="bi bi-car-front-fill me-2"></i>Gestionar Vehículos
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>