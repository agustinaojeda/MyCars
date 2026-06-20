<?php if (session()->getFlashdata('mensaje')) : ?>
    <div id="alerta-exito" class="position-fixed top-30 start-50 translate-middle-x mt-4 z-3" style="width: 90%; max-width: 450px; transition: opacity 0.5s ease;">

        <div class="alert alert-success d-flex align-items-center border-0 rounded-4 p-3 shadow-lg"
            role="alert"
            style="background-color: rgba(34, 88, 63, 0.85); color: #34d399; border-left: 4px solid #10b981 !important; backdrop-filter: blur(8px);">

            <i class="bi bi-check-circle-fill me-3 fs-5"></i>
            <div class="small fw-semibold pe-2">
                <?= session()->getFlashdata('mensaje') ?>
            </div>
            <button type="button" class="btn-close btn-close-white ms-auto small" data-bs-dismiss="alert" aria-label="Close" style="font-size: 0.75rem;"></button>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const alerta = document.getElementById('alerta-exito');

            if (alerta) {
                setTimeout(function() {
                    alerta.style.opacity = '0';

                    setTimeout(function() {
                        alerta.remove();
                    }, 500);

                }, 4000);
            }
        });
    </script>
<?php endif; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
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
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center px-3">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 glass-card">
                <div class="mb-4">
                    <a href="<?= base_url('/') ?>" class="text-decoration-none"><h1 class="fw-bold text-white h3 mb-1 text-center">MyCars</h1></a>
                    
                </div>
                <div class="mb-4">
                    <h2 class="fw-bold text-white h4 mb-1">¡Bienvenido de nuevo!</h2>
                    <p class="text-secondary small">Por favor completa con tus datos de inicio de sesión.</p>
                </div>

                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger bg-danger bg-opacity-50 border-danger border-opacity-20 small p-2" style="color: #e2bebe;" role="alert">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('/login/verificar') ?>" method="POST" class="d-flex flex-column gap-3">
                    <?= csrf_field() ?>

                    <div class="d-flex flex-column gap-1">
                        <label for="email" class="small text-secondary fw-medium" style="font-size: 0.75rem;">Correo electrónico</label>
                        <input type="email" id="email" name="emailUsuario" placeholder="name@example.com" required
                            class="form-control form-control-custom">
                    </div>

                    <div class="d-flex flex-column gap-1">
                        <label for="password" class="small text-secondary fw-medium" style="font-size: 0.75rem;">Contraseña</label>
                        <input type="password" id="password" name="passwordUsuario" placeholder="••••••••" required
                            class="form-control form-control-custom">
                    </div>

                    <div class="d-flex justify-content-between align-items-center small mt-1" style="font-size: 0.75rem;">

                        <a href="#" class="text-decoration-none" style="color: #a78bfa;">¿Olvidaste tu contraseña?</a>
                    </div>

                    <button type="submit" class="btn btn-purple w-100 mt-2">
                        Iniciar sesión
                    </button>
                </form>



                <p class="small text-center text-secondary mt-4 mb-0" style="font-size: 0.75rem;">
                    ¿Todavía no tienes una cuenta? <a href="<?= base_url('/registrarse') ?>" class="text-decoration-none fw-medium" style="color: #22d3ee;">Registrarse</a>
                </p>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>