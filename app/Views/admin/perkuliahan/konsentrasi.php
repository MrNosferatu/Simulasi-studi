<?php
include(APPPATH . 'views/layouts/header.php');
?>
<div class="d-flex h-100">
    <div class="fixed-sidebar">
        <?php include(APPPATH . 'views/layouts/admin/sidebar.php'); ?>
    </div>
    <div class="flex-grow-1 overflow-auto">
        <div class="w-100 p-5">
            <form action="<?= base_url('data/konsentrasi/store') ?>" method="post">
                <h1>Form Fakultas</h1>

                <div class="mb-3">
                    <label for="prodi" class="form-label">Program Studi:</label>
                    <select id="prodi" name="prodi" class="form-select">
                        <?php foreach ($prodi as $row): ?>
                            <option value="<?= $row['kode_prodi'] ?>"><?= $row['nama'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="Nama" class="form-label">Nama:</label>
                    <input type="text" id="Nama" name="nama" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="Nama" class="form-label">Sks:</label>
                    <input type="text" id="Nama" name="sks_minimal" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
<?php include(APPPATH . 'views/layouts/footer.php'); ?>