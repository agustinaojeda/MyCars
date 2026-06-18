<nav class="navbar navbar-expand navbar-dark bg-dark shadow-sm sticky-top">
    <div class="container-fluid">

        <a class="navbar-brand fw-bold" href="<?= base_url('/') ?>">MyCars</a>

        <div class="navbar-collapse justify-content-between">

            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('vehiculos') ?>">Vehículos</a>
                </li>
            </ul>

            <ul class="navbar-nav align-items-center">
                <?php if (session()->get('isLoggedIn')) : ?>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white px-2" href="#" role="button" id="userMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            Hola, <strong class="text-info"><?= session()->get('nombreUsuario') ?></strong>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end border-secondary shadow" aria-labelledby="userMenuLink">
                            <li>
                                <a class="dropdown-item text-danger d-flex align-items-center" href="<?= base_url('logout') ?>">
                                    <i class="bi bi-box-arrow-right me-2"></i> Cerrar sesión
                                </a>
                            </li>
                        </ul>
                    </li>

                <?php else : ?>
                    <li class="nav-item">
                        <a href="<?= base_url('login') ?>" class="btn btn-outline-light btn-sm">Ingresar</a>
                    </li>
                <?php endif; ?>
            </ul>

        </div>
    </div>
</nav>