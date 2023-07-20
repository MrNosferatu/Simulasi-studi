<div class="d-flex h-100">
    <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark h-100" style="width: 280px;">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <svg class="bi me-2" width="40" height="32">
                <use xlink:href="#bootstrap"></use>
            </svg>
            <span class="fs-4">Dashboard</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="<?= base_url('dashboard/konsentrasi')?>" class="nav-link <?= (current_url() == base_url('dashboard/konsentrasi')) ? 'active' : '' ?> text-white" aria-current="page">
                    <svg class="bi me-2" width="16" height="16">
                        <use xlink:href="#home"></use>
                    </svg>
                    Konsentrasi
                </a>
            </li>
            <li>
                <a href="<?= base_url('dashboard/matakuliah')?>" class="nav-link <?= (current_url() == base_url('dashboard/matakuliah')) ? 'active' : '' ?> text-white">
                    <svg class="bi me-2" width="16" height="16">
                        <use xlink:href="#grid"></use>
                    </svg>
                    Matakuliah
                </a>
            </li>
    </div>
</div>