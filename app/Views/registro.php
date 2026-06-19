<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(180deg, rgba(10, 11, 15, 0.4) 0%, rgba(10, 11, 15, 0.9) 100%),
                url('https://images.unsplash.com/photo-1617788138017-80ad40651399?q=80&w=1470&auto=format&fit=crop') no-repeat center center;
            background-size: cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
            color: #e2e8f0;
        }

        .glass-card {
            background: rgba(18, 20, 29, 0.65);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            padding: 3rem;
        }

        .form-control-custom {
            background-color: #ffffff !important;
            color: #0f172a !important;
            border: none;
            padding: 0.65rem 1rem;
            font-size: 0.875rem;
            border-radius: 0.5rem;
        }

        .form-control-custom::placeholder {
            color: #94a3b8;
        }

        .form-control-custom:focus {
            box-shadow: 0 0 0 3px rgba(111, 66, 193, 0.5);
            outline: none;
        }

        .btn-purple {
            background-color: #4f46e5;
            color: white;
            border: none;
            padding: 0.65rem;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: 0.5rem;
            transition: background 0.2s;
        }

        .btn-purple:hover {
            background-color: #6366f1;
            color: white;
        }

        .form-control-custom.is-invalid {
            border-width: 1.5px !important;
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 0.25rem rgba(219, 49, 66, 0.49) !important;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center px-3">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 glass-card">

                <div class="mb-4">
                    <h2 class="fw-bold text-white h3 mb-1">¡Bienvenido!</h2>
                    <p class="text-secondary small">Por favor completa con tus datos para registrarte.</p>
                </div>

                <form action="<?= base_url('/registrarse/verificar') ?>" method="POST" class="d-flex flex-column gap-3">
                    <?= csrf_field() ?>

                    <div class="d-flex flex-column gap-1">
                        <label for="nombre" class="small fw-medium <?= validation_errors() && isset(validation_errors()['nombre']) ? 'text-danger' : 'text-secondary' ?>" style="font-size: 0.75rem;">Nombre y apellido</label>

                        <input type="text" id="nombre" name="nombre" minlength="6" placeholder="Nombre y apellido" required
                            value="<?= old('nombre') ?>"
                            class="form-control form-control-custom <?= (validation_errors() && isset(validation_errors()['nombre'])) ? 'is-invalid' : '' ?>">

                        <?php if (validation_show_error('nombre')) : ?>
                            <span class="text-danger small mt-1" style="font-size: 0.75rem;"><?= validation_show_error('nombre') ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="d-flex flex-column gap-1">
                        <label for="direccion" class="small fw-medium <?= validation_errors() && isset(validation_errors()['direccion']) ? 'text-danger' : 'text-secondary' ?>" style="font-size: 0.75rem;">Dirección</label>

                        <input type="text" id="direccion" name="direccion" minlength="10" placeholder="Dirección 123" required
                            value="<?= old('direccion') ?>"
                            class="form-control form-control-custom <?= (validation_errors() && isset(validation_errors()['direccion'])) ? 'is-invalid' : '' ?>">

                        <?php if (validation_show_error('direccion')) : ?>
                            <span class="text-danger small mt-1" style="font-size: 0.75rem;"><?= validation_show_error('direccion') ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="d-flex flex-column gap-1">
                        <label for="telefono" class="small fw-medium <?= validation_errors() && isset(validation_errors()['telefono']) ? 'text-danger' : 'text-secondary' ?>" style="font-size: 0.75rem;">Teléfono</label>

                        <input type="tel" id="telefono" name="telefono" placeholder="11412346"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                            value="<?= old('telefono') ?>" autocomplete="tel" required
                            class="form-control form-control-custom <?= (validation_errors() && isset(validation_errors()['telefono'])) ? 'is-invalid' : '' ?>">

                        <?php if (validation_show_error('telefono')) : ?>
                            <span class="text-danger small mt-1" style="font-size: 0.75rem;"><?= validation_show_error('telefono') ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="d-flex flex-column gap-1">
                        <label for="email" class="small fw-medium <?= validation_errors() && isset(validation_errors()['emailUsuario']) ? 'text-danger' : 'text-secondary' ?>" style="font-size: 0.75rem;">Correo electrónico</label>

                        <input type="email" id="email" name="emailUsuario" placeholder="nombre@dominio.com" required
                            value="<?= old('emailUsuario') ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
                            title="Por favor, ingresa un correo electrónico válido (ej: nombre@dominio.com)"
                            class="form-control form-control-custom <?= (validation_errors() && isset(validation_errors()['emailUsuario'])) ? 'is-invalid' : '' ?>">

                        <?php if (validation_show_error('emailUsuario')) : ?>
                            <span class="text-danger small mt-1" style="font-size: 0.75rem;"><?= validation_show_error('emailUsuario') ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="d-flex flex-column gap-1">
                        <label for="password" class="small fw-medium <?= validation_errors() && isset(validation_errors()['passwordUsuario']) ? 'text-danger' : 'text-secondary' ?>" style="font-size: 0.75rem;">Contraseña (Mínimo 6 caracteres)</label>

                        <input type="password" id="password" name="passwordUsuario" minlength="6" placeholder="••••••••" required
                            class="form-control form-control-custom <?= (validation_errors() && isset(validation_errors()['passwordUsuario'])) ? 'is-invalid' : '' ?>">

                        <?php if (validation_show_error('passwordUsuario')) : ?>
                            <span class="text-danger small mt-1" style="font-size: 0.75rem;"><?= validation_show_error('passwordUsuario') ?></span>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn btn-purple w-100 mt-2">
                        Registrarse
                    </button>
                </form>
                <p class="small text-center text-secondary mt-4 mb-0" style="font-size: 0.75rem;">
                    ¿Ya tienes una cuenta? <a href="<?= base_url('/login') ?>" class="text-decoration-none fw-medium" style="color: #22d3ee;">Iniciar sesión</a>
                </p>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>