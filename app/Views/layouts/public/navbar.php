<nav class="navbar navbar-expand-lg navbar-dark bg-ungu-dark">
    <!-- Container wrapper -->
    <div class="container-fluid">
        <!-- Navbar brand -->
        <h3 class="text-white">Simulasi Studi</h3>
    </a>
        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarCenteredExample" aria-controls="navbarCenteredExample" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarCenteredExample">
            <!-- Left links -->
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?= (current_url() == base_url('/')) ? 'active' : '' ?>" aria-current="page" href="<?=base_url('')?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (current_url() == base_url('/simulasi')) ? 'active' : '' ?>" href="<?=base_url('/simulasi')?>">Simulasi</a>
                </li>
            </ul>
            <!-- Left links -->
        </div>
        <!-- Collapsible wrapper -->
    </div>
    <!-- Container wrapper -->
</nav>