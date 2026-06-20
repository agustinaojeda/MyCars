<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte: Vehículos por Cliente - MyCar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">
    <style>
        .no-hover-card:hover { transform: none !important; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5) !important; }
        .tarjeta-buscador { overflow: visible !important; position: relative; z-index: 50; }
        .input-buscador { background-color: rgba(18, 20, 29, 0.8) !important; color: #e2e8f0 !important; border: 1px solid rgba(13, 202, 240, 0.3); }
        .dropdown-flotante { display: none; position: absolute; top: 100%; left: 0; right: 0; background-color: #0b0f19; border: 1px solid rgba(13, 202, 240, 0.3); border-radius: 0.5rem; margin-top: 0.25rem; max-height: 250px; overflow-y: auto; z-index: 1000; box-shadow: 0 10px 40px rgba(0,0,0,0.8); }
        .dropdown-item-custom { padding: 10px 15px; color: #e2e8f0; cursor: pointer; border-bottom: 1px solid rgba(255,255,255,0.05); }
        .dropdown-item-custom:hover { background-color: #4f46e5; color: white; }
    </style>
</head>
<body>
    <?= view('templates/nav') ?>
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold text-white mb-1"><i class="bi bi-car-front me-2 text-info"></i>Reporte: Vehículos por Cliente</h2>
                <p class="text-secondary small">Seleccioná un cliente para ver su historial de alquileres.</p>
            </div>
            <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-outline-custom"><i class="bi bi-arrow-left me-2"></i>Volver al Panel</a>
        </div>

        <div class="glass-card no-hover-card tarjeta-buscador p-4 mb-4">
            <form action="<?= base_url('admin/reporte-vehiculos-cliente') ?>" method="GET" class="row align-items-end g-3">
                <div class="col-md-9 position-relative">
                    <label class="form-label text-secondary small text-uppercase">Buscar Cliente</label>
                    <input type="hidden" name="idCliente" id="idClienteOculto" value="<?= $clienteSeleccionado ?>" required>
                    
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-info border-opacity-25 text-info"><i class="bi bi-person-search"></i></span>
                        <input type="text" id="buscadorVisual" class="form-control input-buscador py-2" placeholder="Escribí nombre o email del cliente..." autocomplete="off">
                    </div>

                    <div id="cajaFlotante" class="dropdown-flotante shadow-lg">
                        <?php foreach ($clientes as $c) : ?>
                            <div class="dropdown-item-custom" data-id="<?= $c['idUsuario'] ?>">
                                <?= $c['nombreUsuario'] ?> <span class="text-secondary small ms-1">(<?= $c['emailUsuario'] ?>)</span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-purple w-100 py-2"><i class="bi bi-search me-2"></i>Ver Historial</button>
                </div>
            </form>
        </div>

        <div class="glass-card no-hover-card p-0">
            <?php if (!empty($vehiculos)) : ?>
                <div class="table-responsive">
                    <table class="table table-dark table-hover mb-0" style="background: transparent;">
                        <thead>
                            <tr style="border-bottom: 2px solid rgba(255,255,255,0.1);">
                                <th class="p-4 text-secondary">Vehículo</th>
                                <th class="p-4 text-secondary">Categoría</th>
                                <th class="p-4 text-secondary">Fecha</th>
                                <th class="p-4 text-secondary text-end">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($vehiculos as $v) : ?>
                                <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                                    <td class="p-4 text-white"><?= $v['marcaVehiculo'] . ' ' . $v['modeloVehiculo'] ?></td>
                                    <td class="p-4 text-secondary"><?= ucfirst($v['categoriaVehiculo']) ?></td>
                                    <td class="p-4 text-white"><?= date('d/m/Y', strtotime($v['fechaDesdeAlquiler'])) ?></td>
                                    <td class="p-4 text-end"><span class="badge bg-info bg-opacity-25 text-info"><?= ucfirst($v['estadoAlquiler']) ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="p-5 text-center text-secondary">Buscá un cliente para ver su historial de vehículos.</div>
            <?php endif; ?>
        </div>
    </div>
    
<script>
        document.addEventListener('DOMContentLoaded', function() {
            const buscadorVisual = document.getElementById('buscadorVisual');
            const idClienteOculto = document.getElementById('idClienteOculto'); // Acá usamos el ID del cliente
            const cajaFlotante = document.getElementById('cajaFlotante');
            const opciones = document.querySelectorAll('.dropdown-item-custom');

            if(!buscadorVisual) return; 

            // 1. Mostrar la lista al hacer clic
            buscadorVisual.addEventListener('focus', function() {
                cajaFlotante.style.display = 'block';
                if (idClienteOculto.value !== '') {
                    this.select();
                }
            });

            // 2. Filtrar a medida que se escribe
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

            // 3. Al hacer clic en un cliente de la lista
            opciones.forEach(opcion => {
                opcion.addEventListener('click', function() {
                    idClienteOculto.value = this.getAttribute('data-id');
                    buscadorVisual.value = this.textContent.replace(/\s+/g, ' ').trim();
                    cajaFlotante.style.display = 'none';
                });
            });

            // 4. Ocultar si hacen clic afuera
            document.addEventListener('click', function(evento) {
                if (!buscadorVisual.contains(evento.target) && !cajaFlotante.contains(evento.target)) {
                    cajaFlotante.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>