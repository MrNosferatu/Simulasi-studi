<?php include '../../layouts/header.php'; ?>

<form action="<?= base_url('/data/fakultas/store') ?>" method="post">
    <h1>Form Fakultas</h1>
    <div class="mb-3">
        <label for="nama">Name:</label>
        <input type="text" id="nama" name="nama" class="form-control" required minlength="3" maxlength="128" value="admin">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<form action="<?= base_url('/data/prodi/store') ?>" method="post">
    <h1>Form Prodi</h1>
    <div class="mb-3">
        <label for="nama" class="form-label">Nama:</label>
        <input type="text" id="nama" name="nama" class="form-control">
    </div>
    <div class="mb-3">
        <label for="sks_minimal" class="form-label">SKS Minimal:</label>
        <input type="number" id="sks_minimal" name="sks_minimal" class="form-control">
    </div>
    <div class="mb-3">
        <label for="nilai_d_maksimal" class="form-label">Nilai D Maksimal:</label>
        <input type="number" id="nilai_d_maksimal" name="nilai_d_maksimal" class="form-control">
    </div>
    <div class="mb-3">
        <label for="kode_fakultas" class="form-label">Fakultas:</label>
        <select id="kode_fakultas" name="kode_fakultas" class="form-control">
            <?php foreach ($fakultas as $row): ?>
                <option value="<?= $row['kode_fakultas'] ?>"><?= $row['nama'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<form action="<?= base_url('/data/matakuliah/store') ?>" method="post">
    <h1>Form Matakuliah</h1>
    <div class="mb-3">
        <label for="kode_prodi" class="form-label">Kode Prodi:</label>
        <select id="kode_prodi" name="kode_prodi" class="form-control">
            <?php foreach ($prodi as $row): ?>
                <option value="<?= $row['kode_prodi'] ?>"><?= $row['nama'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="nama" class="form-label">Nama:</label>
        <input type="text" id="nama" name="nama" class="form-control">
    </div>
    <div class="mb-3">
        <label for="sks" class="form-label">SKS:</label>
        <input type="number" id="sks" name="sks" class="form-control" value="2">
    </div>
    <div class="mb-3">
        <label for="semester" class="form-label">Semester:</label>
        <input type="number" id="semester" name="semester" class="form-control" value="5">
    </div>
    <div class="mb-3">
        <label for="sifat" class="form-label">Sifat:</label>
        <select id="sifat" name="sifat" class="form-control">
            <option value="1">Wajib</option>
            <option value="2" selected>Pilihan</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="nilai_minimal" class="form-label">Nilai Minimal:</label>
        <input type="text" id="nilai_minimal" name="nilai_minimal" class="form-control" value="B">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<form action="<?= base_url('/data/konsentrasi/store') ?>" method="post">
    <h1>Form Konsentrasi</h1>
    <div class="mb-3">
        <label for="nama" class="form-label">Nama:</label>
        <input type="text" id="nama" name="nama" class="form-control">
    </div>
    <div class="mb-3">
        <label for="sks_minimal" class="form-label">SKS Minimal:</label>
        <input type="number" id="sks_minimal" name="sks_minimal" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>

</form>

<form action="<?= base_url('/data/konsentrasi/store') ?>" method="post">
    <h1>Form Konsentrasi</h1>
    <div class="mb-3">

        <label for="kode_matakuliah" class="form-label">Kode Matakuliah:</label>
        <select id="kode_matakuliah" name="kode_matakuliah" class="form-control">
            <?php foreach ($matakuliah as $row): ?>
                <option value="<?= $row['kode_matakuliah'] ?>"><?= $row['nama'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="kode_konsentrasi" class="form-label">Kode Konsentrasi:</label>
        <select id="kode_konsentrasi" name="kode_konsentrasi" class="form-control">
            <?php foreach ($konsentrasi as $row): ?>
                <option value="<?= $row['kode_konsentrasi'] ?>"><?= $row['nama'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>

</form>
<?php include '../../layouts/footer.php'; ?>