<footer class="text-white pt-5 pb-4 mt-5" style="background-color: #0b0f19; border-top: 1px solid #1a2333;">
    <div class="container">
        <div class="row text-start text-md-left">

            <div class="col-md-6 col-lg-6 col-xl-6 mx-auto mt-3">
                <a class="navbar-brand fw-bold fs-4 text-white d-block mb-3" href="<?= base_url('/') ?>">MyCar</a>
                <p class="text-white-50 small" style="max-width: 300px; line-height: 1.6;">
                    Experimentá el máximo rendimiento y el confort de nuestra flota premium diseñada para viajes únicos y exigentes.
                </p>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-6 mx-auto mt-3">
                <h6 class="text-uppercase mb-4 fw-bold text-info" style="font-size: 0.85rem; letter-spacing: 1px;">Navegación</h6>
                <p class="mb-2">
                    <a href="<?= base_url('/') ?>" class="text-white-50 text-decoration-none small transition-all footer-link">Inicio</a>
                </p>
                <p class="mb-2">
                    <a href="<?=base_url('categoria/suv')?>" class="text-white-50 text-decoration-none small transition-all footer-link">Categorías</a>
                </p>
                <p class="mb-2">
                    <?php if (session()->get('isLoggedIn') && session()->get('rolUsuario') == 'cliente'): ?>
                        <a href="<?=base_url('mis-reservas')?>" class="text-white-50 text-decoration-none small transition-all footer-link">Mis reservas</a>
                    <?php endif; ?>
                </p>
            </div>
            

        </div>

        <hr class="mb-4 mt-5 border-secondary border-opacity-25">

        <div class="row align-items-center">
            <div class="col-md-12 col-lg-12 text-md-end text-center">
                <p class="text-white-50 small mb-0">
                    Dágata, Brisa Ahylin - Ojeda Somare, Agustina - Rivero, Seyla Gisel
                </p>
            </div>
        </div>
    </div>
</footer>

<style>
    .footer-link:hover {
        color: #38bdf8 !important;
        padding-left: 3px;
    }

    .footer-link {
        transition: all 0.2s ease-in-out;
    }
</style>