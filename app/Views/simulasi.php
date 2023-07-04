<?php include 'layouts/header.php'; ?>
<div class="container p-5">
    <h1>Simulasi Studi</h1>
    <div class="row">
        <div class="col">
            <form id="form">
                <div class="mb-3">
                    <label for="kode_fakultas" class="form-label">Pilih Fakultas :</label>
                    <select id="kode_fakultas" name="kode_fakultas" class="form-select">
                        <option value="">-- Select an option --</option>
                        <?php foreach ($fakultas as $row): ?>
                            <option value="<?= $row['kode_fakultas'] ?>"><?= $row['nama'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div id="prodiField"></div>
                <div id="matakuliahField"></div>
                <div id="sksField" class="mb-3">Total SKS: 0</div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
<script>
    window.addEventListener('beforeunload', event => {
        event.preventDefault(); // Cancel the default behavior

        // Display a confirmation dialog
        event.returnValue = ''; // Required for Chrome and Firefox
        return ''; // Required for Safari
    });
</script>
<script>
    const kode_fakultas = document.getElementById('kode_fakultas');
    const prodiField = document.getElementById('prodiField');

    kode_fakultas.addEventListener('change', () => {
        const value = kode_fakultas.value;

        if (value) {
            fetch(`/get-data?kode_fakultas=${value}`)
                .then(response => response.json())
                .then(data => {
                    sks_minimal = data.sks_minimal; // Extract the sks_minimal value from the response and store it in a variable

                    // Create a new label element
                    const label = document.createElement('label');
                    label.htmlFor = 'kode_prodi';
                    label.className = 'form-label';
                    label.textContent = 'Pilih Program Studi:';

                    // Create a new select field
                    const select = document.createElement('select');
                    select.name = 'kode_prodi';
                    select.id = 'kode_prodi';
                    select.className = 'form-select mb-3';

                    const option = document.createElement('option');
                    option.value = '';
                    option.text = 'Pilih Program Studi';
                    select.appendChild(option);

                    // Add an option for each item in the data array
                    data.forEach(item => {
                        const option = document.createElement('option');
                        option.value = item.kode_prodi;
                        option.text = item.nama;
                        select.appendChild(option);
                    });

                    // Replace the dynamic fields div with the new label and select field
                    prodiField.innerHTML = '';
                    prodiField.appendChild(label);
                    prodiField.appendChild(select);

                    var script = document.createElement('script');
                    script.src = "<?= base_url('assets/js/semester.js') ?>";
                    document.body.appendChild(script);

                })
                .catch(error => console.error(error));
        } else {
            prodiField.innerHTML = '';
        }
    });
</script>
<?php include 'layouts/footer.php'; ?>