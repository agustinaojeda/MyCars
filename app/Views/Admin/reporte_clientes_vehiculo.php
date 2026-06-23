<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte: Clientes por Vehículo - MyCar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">
    <style>
        .no-hover-card:hover { transform: none !important; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5) !important; }
        
        /* Esta clase obliga a la tarjeta a estar "por delante" de la tabla de abajo */
        .tarjeta-buscador {
            overflow: visible !important;
            position: relative;
            z-index: 50; 
        }

        .btn-categoria-activa {
            background: rgba(13, 202, 240, 0.15) !important;
            border-color: #0dcaf0 !important;
            color: #fff !important;
            box-shadow: 0 0 15px rgba(13, 202, 240, 0.3);
        }

        /* Estilos del buscador "2 en 1" */
        .input-buscador {
            background-color: rgba(18, 20, 29, 0.8) !important;
            color: #e2e8f0 !important;
            border: 1px solid rgba(13, 202, 240, 0.3);
        }
        .input-buscador:focus {
            box-shadow: 0 0 0 0.25rem rgba(13, 202, 240, 0.25) !important;
            border-color: #0dcaf0;
        }
        
        /* La caja flotante que contiene los autos */
        .dropdown-flotante {
            display: none; 
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background-color: #0b0f19;
            border: 1px solid rgba(13, 202, 240, 0.3);
            border-radius: 0.5rem;
            margin-top: 0.25rem;
            max-height: 250px;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 0 10px 40px rgba(0,0,0,0.8);
        }
        
        .dropdown-item-custom {
            padding: 10px 15px;
            color: #e2e8f0;
            cursor: pointer;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            transition: all 0.2s;
        }
        .dropdown-item-custom:hover {
            background-color: #4f46e5;
            color: white;
            padding-left: 20px; 
        }

        /* Scrollbar elegante para la lista */
        .dropdown-flotante::-webkit-scrollbar { width: 8px; }
        .dropdown-flotante::-webkit-scrollbar-track { background: rgba(0,0,0,0.2); border-radius: 4px; }
        .dropdown-flotante::-webkit-scrollbar-thumb { background: rgba(13, 202, 240, 0.3); border-radius: 4px; }
    </style>
</head>
<body>
    <?= view('templates/nav') ?>

    <div class="container py-5">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold text-white mb-1"><i class="bi bi-people me-2 text-info"></i>Reporte: Clientes por Vehículo</h2>
                <p class="text-secondary small">Filtrá por categoría y buscá un vehículo para ver su historial.</p>
            </div>
            <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-outline-custom">
                <i class="bi bi-arrow-left me-2"></i>Volver al Panel
            </a>
        </div>

        <div class="row g-3 mb-4 justify-content-center">
            <?php 
            $categorias = [
                'suv' => 'SUV', 
                'deportivo' => 'Deportivo', 
                'sedan' => 'Sedán', 
                'compacto' => 'Compacto'
            ];
            
            foreach ($categorias as $valor => $etiqueta): 
                $claseActiva = ($categoriaSeleccionada == $valor) ? 'btn-categoria-activa' : 'btn-outline-custom';
            ?>
                <div class="col-6 col-md-3">
                    <a href="<?= base_url('admin/reporte-clientes-vehiculo?categoria=' . $valor) ?>" class="btn w-100 py-3 rounded-3 transition-all <?= $claseActiva ?> d-flex flex-column align-items-center justify-content-center gap-2">
                        <span class="fs-5 fw-medium"><?= $etiqueta ?></span>
                    </a>
                </div>
            <?php endforeach; ?>
            
            <?php if ($categoriaSeleccionada): ?>
                <div class="col-12 text-end mt-2">
                    <a href="<?= base_url('admin/reporte-clientes-vehiculo') ?>" class="text-info small text-decoration-none"><i class="bi bi-x-circle me-1"></i>Quitar filtros y ver toda la flota</a>
                </div>
            <?php endif; ?>
        </div>

        <div class="glass-card no-hover-card tarjeta-buscador p-4 mb-4">
            <form action="<?= base_url('admin/reporte-clientes-vehiculo') ?>" method="GET" class="row align-items-end g-3">
                
                <?php if($categoriaSeleccionada): ?>
                    <input type="hidden" name="categoria" value="<?= $categoriaSeleccionada ?>">
                <?php endif; ?>

                <div class="col-md-9 position-relative">
                    <label class="form-label text-secondary small text-uppercase">
                        Buscar Vehículo <?= $categoriaSeleccionada ? 'en ' . ucfirst($categoriaSeleccionada) : '' ?>
                    </label>
                    
                    <input type="hidden" name="idVehiculo" id="idVehiculoOculto" value="<?= $vehiculoSeleccionado ?>" required>
                    
                    <?php 
                        $textoPredefinido = '';
                        if ($vehiculoSeleccionado) {
                            foreach ($vehiculos as $v) {
                                if ($v['idVehiculo'] == $vehiculoSeleccionado) {
                                    $textoPredefinido = $v['marcaVehiculo'] . ' ' . $v['modeloVehiculo'] . ' (ID: #' . $v['idVehiculo'] . ')';
                                    break;
                                }
                            }
                        }
                    ?>
                    
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-info border-opacity-25 text-info">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" id="buscadorVisual" class="form-control input-buscador py-2" placeholder="Hacé clic acá para ver la lista o empezá a escribir..." value="<?= $textoPredefinido ?>" autocomplete="off" <?= empty($vehiculos) ? 'disabled' : '' ?>>
                    </div>

                    <div id="cajaFlotante" class="dropdown-flotante shadow-lg">
                        <?php if (empty($vehiculos)): ?>
                            <div class="p-3 text-secondary text-center small">No hay vehículos en esta categoría.</div>
                        <?php else: ?>
                            <?php foreach ($vehiculos as $v) : ?>
                                <div class="dropdown-item-custom" data-id="<?= $v['idVehiculo'] ?>">
                                    <?= $v['marcaVehiculo'] ?> <?= $v['modeloVehiculo'] ?> <span class="text-secondary small ms-1">(ID: #<?= $v['idVehiculo'] ?>)</span>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-purple w-100 py-2" <?= empty($vehiculos) ? 'disabled' : '' ?>>
                        <i class="bi bi-search me-2"></i>Ver Historial
                    </button>
                </div>
            </form>
        </div>

        <div class="glass-card no-hover-card p-0">
            <?php if (!empty($clientes)) : ?>
                <div class="table-responsive">
                    <table class="table table-dark table-hover mb-0" style="background: transparent;">
                        <thead>
                            <tr style="border-bottom: 2px solid rgba(255,255,255,0.1);">
                                <th class="p-4 text-secondary font-monospace" style="background: transparent;">Cliente</th>
                                <th class="p-4 text-secondary font-monospace" style="background: transparent;">Contacto</th>
                                <th class="p-4 text-secondary font-monospace" style="background: transparent;">Fecha de Retiro</th>
                                <th class="p-4 text-secondary font-monospace" style="background: transparent;">Días</th>
                                <th class="p-4 text-secondary font-monospace text-end" style="background: transparent;">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($clientes as $cliente) : ?>
                                <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                                    <td class="p-4 align-middle" style="background: transparent;">
                                        <div class="fw-bold text-white"><?= $cliente['nombreUsuario'] ?></div>
                                    </td>
                                    <td class="p-4 align-middle" style="background: transparent;">
                                        <div class="small text-white"><i class="bi bi-envelope me-1 text-info"></i><?= $cliente['emailUsuario'] ?></div>
                                        <div class="small text-secondary"><i class="bi bi-telephone me-1"></i><?= $cliente['telefonoUsuario'] ?></div>
                                    </td>
                                    <td class="p-4 align-middle" style="background: transparent;">
                                        <div class="small text-white"><?= date('d/m/Y', strtotime($cliente['fechaDesdeAlquiler'])) ?></div>
                                    </td>
                                    <td class="p-4 align-middle" style="background: transparent;">
                                        <span class="badge bg-secondary bg-opacity-25 text-white border border-secondary border-opacity-50"><?= $cliente['cantDiasAlquiler'] ?> días</span>
                                    </td>
                                    <td class="p-4 align-middle text-end" style="background: transparent;">
                                        <?php 
                                            $colorEstado = 'secondary';
                                            if ($cliente['estadoAlquiler'] == 'activo') $colorEstado = 'success';
                                            if ($cliente['estadoAlquiler'] == 'pendiente') $colorEstado = 'warning';
                                            if ($cliente['estadoAlquiler'] == 'finalizado') $colorEstado = 'info';
                                        ?>
                                        <span class="badge bg-<?= $colorEstado ?> bg-opacity-25 text-<?= $colorEstado ?> border border-<?= $colorEstado ?> border-opacity-50 text-uppercase">
                                            <?= $cliente['estadoAlquiler'] ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else : ?>
                <div class="p-5 text-center">
                    <i class="bi bi-search fs-1 text-secondary mb-3 d-block"></i>
                    <?php if ($vehiculoSeleccionado): ?>
                        <h5 class="text-white">Sin historial</h5>
                        <p class="text-secondary small">Este vehículo aún no ha sido alquilado por ningún cliente.</p>
                    <?php else: ?>
                        <h5 class="text-white">Esperando consulta</h5>
                        <p class="text-secondary small">Buscá y elegí un vehículo del listado superior para ver sus alquileres.</p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buscadorVisual = document.getElementById('buscadorVisual');
            const idVehiculoOculto = document.getElementById('idVehiculoOculto');
            const cajaFlotante = document.getElementById('cajaFlotante');
            const opciones = document.querySelectorAll('.dropdown-item-custom');

            if(!buscadorVisual) return; 

            buscadorVisual.addEventListener('focus', function() {
                cajaFlotante.style.display = 'block';
                if (idVehiculoOculto.value !== '') {
                    this.select();
                }
            });

            buscadorVisual.addEventListener('input', function() {
                cajaFlotante.style.display = 'block'; 
                const filtro = this.value.toLowerCase();
                
                opciones.forEach(opcion => {
                    const texto = opcion.textContent.toLowerCase();
                    if (texto.includes(filtro)) {
                        opcion.style.display = 'block';
                    } else {
                        opcion.style.display = 'none';
                    }
                });
            });

            opciones.forEach(opcion => {
                opcion.addEventListener('click', function() {
                    idVehiculoOculto.value = this.getAttribute('data-id');
                    buscadorVisual.value = this.textContent.replace(/\s+/g, ' ').trim();
                    cajaFlotante.style.display = 'none';
                });
            });

            document.addEventListener('click', function(evento) {
                if (!buscadorVisual.contains(evento.target) && !cajaFlotante.contains(evento.target)) {
                    cajaFlotante.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>