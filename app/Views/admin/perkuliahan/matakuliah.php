<?php
include(APPPATH . 'views/layouts/header.php');
?>
<div class="d-flex">
    <div class="fixed-sidebar">
        <?php include(APPPATH . 'views/layouts/admin/sidebar.php'); ?>
    </div>
    <div class="flex-grow-1 overflow-auto">
        <div class="w-100 p-5">
            <form id="matakuliah-form" action="<?= base_url('/data/matakuliah/store') ?>" method="post">
                <h1>Form Matakuliah</h1>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama:</label>
                    <input type="text" id="nama" name="nama" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="sks" class="form-label">SKS:</label>
                    <input type="number" id="sks" name="sks" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="semester" class="form-label">Semester:</label>
                    <input type="number" id="semester" name="semester" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="sifat" class="form-label">Sifat:</label>
                    <select id="sifat" name="sifat" class="form-control">
                        <option value="1">Wajib</option>
                        <option value="2">Pilihan</option>
                        <option value="3">Konsentrasi</option>
                    </select>
                </div>
                <div class="mb-3" id="konsentrasiContainer">
                </div>
                <div class="mb-3">
                    <label for="nilai_minimal" class="form-label">Nilai Minimal:</label>
                    <input type="text" id="nilai_minimal" name="nilai_minimal" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <table id="matakuliah-table" class="table">
                <thead>
                    <tr>
                        <th scope="col">Nama</th>
                        <th scope="col">SKS</th>
                        <th scope="col">Semester</th>
                        <th scope="col">Sifat</th>
                        <th scope="col">Konsentrasi</th>
                        <th scope="col">Nilai Minimal</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Group matakuliah data by kode_matakuliah
                    $groupedMatakuliahData = [];
                    foreach ($matakuliah as $matakuliah) {
                        $kodeMatakuliah = $matakuliah['kode_matakuliah'];
                        if (!isset($groupedMatakuliahData[$kodeMatakuliah])) {
                            $groupedMatakuliahData[$kodeMatakuliah] = $matakuliah;
                            $groupedMatakuliahData[$kodeMatakuliah]['nama_konsentrasi'] = $matakuliah['nama_konsentrasi'] ?? '-';
                        } else {
                            if (!empty($matakuliah['nama_konsentrasi'])) {
                                $groupedMatakuliahData[$kodeMatakuliah]['nama_konsentrasi'] .= ', ' . $matakuliah['nama_konsentrasi'];
                            }
                        }
                    }

                    // Loop through the grouped data and display it in the table
                    foreach ($groupedMatakuliahData as $matakuliah) {
                        echo '<tr>';
                        echo '<td>' . $matakuliah['nama'] . '</td>';
                        echo '<td>' . $matakuliah['sks'] . '</td>';
                        echo '<td>' . $matakuliah['semester'] . '</td>';
                        echo '<td>' . ($matakuliah['sifat'] == 1 ? 'Wajib' : ($matakuliah['sifat'] == 2 ? 'Pilihan' : 'Konsentrasi')) . '</td>';
                        echo '<td>' . $matakuliah['nama_konsentrasi'] . '</td>';
                        echo '<td>' . $matakuliah['nilai_minimal'] . '</td>';
                        echo '<td>';
                        echo '<button class="btn btn-primary edit-btn" data-id="' . $matakuliah['kode_matakuliah'] . '">Edit</button> ';
                        echo '<button class="btn btn-danger delete-btn" data-id="' . $matakuliah['kode_matakuliah'] . '">Delete</button>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Edit Modal -->
        <div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="edit-modal-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="edit-form" action="<?= base_url('/data/matakuliah/update') ?>" method="post">
                        <div class="modal-header">
                            <h5 class="modal-title" id="edit-modal-label">Edit Matakuliah</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="edit-id" name="id">
                            <div class="mb-3">
                                <label for="edit-nama" class="form-label">Nama:</label>
                                <input type="text" id="edit-nama" name="nama" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="edit-sks" class="form-label">SKS:</label>
                                <input type="number" id="edit-sks" name="sks" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="edit-semester" class="form-label">Semester:</label>
                                <input type="number" id="edit-semester" name="semester" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="edit-sifat" class="form-label">Sifat:</label>
                                <select id="edit-sifat" name="sifat" class="form-control">
                                    <option value="1">Wajib</option>
                                    <option value="2">Pilihan</option>
                                    <option value="3">Konsentrasi</option>
                                </select>
                            </div>
                            <div class="mb-3" id="edit-konsentrasiContainer">
                            </div>
                            <div class="mb-3">
                                <label for="edit-nilai_minimal" class="form-label">Nilai Minimal:</label>
                                <input type="text" id="edit-nilai_minimal" name="nilai_minimal" class="form-control">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <div class="modal fade" id="delete-modal" tabindex="-1" aria-labelledby="delete-modal-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="delete-modal-label">Delete Matakuliah</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="delete-form" action="<?= base_url('/data/matakuliah/delete') ?>" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="id" id="delete-id">
                            <p>Are you sure you want to delete this matakuliah?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- </div> -->
<?php include(APPPATH . 'views/layouts/footer.php'); ?>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.min.js"></script>
<script>
    $(document).on('click', '.edit-btn', function () {
        var id = $(this).data('id');
        var nama = $(this).closest('tr').find('td:eq(0)').text();
        var sks = $(this).closest('tr').find('td:eq(1)').text();
        var semester = $(this).closest('tr').find('td:eq(2)').text();
        var sifat = $(this).closest('tr').find('td:eq(3)').text();
        var nilai_minimal = $(this).closest('tr').find('td:eq(5)').text();
        $('#edit-id').val(id);
        $('#edit-nama').val(nama);
        $('#edit-sks').val(sks);
        $('#edit-semester').val(semester);
        setSelectedOptionByText('#edit-sifat', sifat);
        $('#edit-nilai_minimal').val(nilai_minimal);
        $('#edit-modal').modal('show');
    });

    $(document).on('change', '#edit-sifat', function () {
        var sifat = $(this).val();
        var konsentrasiContainer = document.getElementById('edit-konsentrasiContainer');
        if (sifat === '3') {
            // Generate checkboxes for konsentrasi values
            // and append them to the edit-konsentrasiContainer div
            createKonsentrasiCheckboxes(konsentrasiContainer);
        } else {
            // Remove the konsentrasi checkboxes
            $('#edit-konsentrasiContainer').empty();
        }
    });

    const sifatSelect = document.getElementById('sifat');
    const konsentrasiContainer = document.getElementById('konsentrasiContainer');

    sifatSelect.addEventListener('change', () => {
        if (sifatSelect.value === '3') {
            // Create the konsentrasi checkboxes
            createKonsentrasiCheckboxes(konsentrasiContainer);
        } else {
            // Remove the konsentrasi checkboxes
            konsentrasiContainer.innerHTML = '';
        }
    });

    function setSelectedOptionByText(selectId, text) {
        $(`${selectId} option`).filter(function () {
            return $(this).text() === text;
        }).prop('selected', true);
    }

    function createKonsentrasiCheckboxes(container) {
        if (!container || !container.appendChild) {
            console.error('Invalid container element:', container);
            return;
        }
        const konsentrasiLabel = document.createElement('label');
        konsentrasiLabel.textContent = 'Konsentrasi:';
        container.appendChild(konsentrasiLabel);

        <?php foreach ($konsentrasi as $row): ?>
            const konsentrasi<?= $row['kode_konsentrasi'] ?> = document.createElement('div');
            konsentrasi<?= $row['kode_konsentrasi'] ?>.classList.add('form-check');
            konsentrasi<?= $row['kode_konsentrasi'] ?>.innerHTML = `
                                    <input class="form-check-input" type="checkbox" name="konsentrasi[]" value="<?= $row['kode_konsentrasi'] ?>" id="konsentrasi<?= $row['kode_konsentrasi'] ?>">
                                    <label class="form-check-label" for="konsentrasi<?= $row['kode_konsentrasi'] ?>">
                                        <?= $row['nama'] ?>
                                    </label>
                                `;
            container.appendChild(konsentrasi<?= $row['kode_konsentrasi'] ?>);
    <?php endforeach; ?>
}
</script>
<script>
    // Delete button click handler
    $(document).on('click', '.delete-btn', function () {
        var id = $(this).data('id');
        $('#delete-id').val(id);
        $('#delete-modal').modal('show');
    });

    function updateMatakuliahTable(data) {
    $('#matakuliah-table tbody').empty();
    var groupedData = groupMatakuliahData(data.matakuliah);
    $.each(groupedData, function (index, row) {
        var html = '<tr>';
        html += '<td>' + row.nama + '</td>';
        html += '<td>' + row.sks + '</td>';
        html += '<td>' + row.semester + '</td>';
        html += '<td>' + (row.sifat == 1 ? 'Wajib' : (row.sifat == 2 ? 'Pilihan' : 'Konsentrasi')) + '</td>';
        html += '<td>' + row.nama_konsentrasi + '</td>';
        html += '<td>' + row.nilai_minimal + '</td>';
        html += '<td>';
        html += '<button class="btn btn-primary edit-btn" data-id="' + row.kode_matakuliah + '">Edit</button>';
        html += '<button class="btn btn-danger delete-btn" data-id="' + row.kode_matakuliah + '">Delete</button>';
        html += '</td>';
        html += '</tr>';
        $('#matakuliah-table tbody').append(html);
    });

    // Reset the click handlers for the "Edit" and "Delete" buttons
    $('.edit-btn').off('click').on('click', function () {
        var id = $(this).data('id');
        var nama = $(this).closest('tr').find('td:eq(0)').text();
        var sks = $(this).closest('tr').find('td:eq(1)').text();
        var semester = $(this).closest('tr').find('td:eq(2)').text();
        var sifat = $(this).closest('tr').find('td:eq(3)').text();
        var nilai_minimal = $(this).closest('tr').find('td:eq(5)').text();
        $('#edit-id').val(id);
        $('#edit-nama').val(nama);
        $('#edit-sks').val(sks);
        $('#edit-semester').val(semester);
        setSelectedOptionByText('#edit-sifat', sifat);
        $('#edit-nilai_minimal').val(nilai_minimal);
        $('#edit-modal').modal('show');
    });
    $('.delete-btn').off('click').on('click', function () {
        var id = $(this).data('id');
        $('#delete-id').val(id);
        $('#delete-modal').modal('show');
    });
}

function groupMatakuliahData(data) {
    var groupedData = {};
    $.each(data, function (index, row) {
        var kodeMatakuliah = row.kode_matakuliah;
        if (!groupedData[kodeMatakuliah]) {
            groupedData[kodeMatakuliah] = row;
            groupedData[kodeMatakuliah].nama_konsentrasi = row.nama_konsentrasi || '-';
        } else {
            if (row.nama_konsentrasi) {
                groupedData[kodeMatakuliah].nama_konsentrasi += ', ' + row.nama_konsentrasi;
            }
        }
    });
    return groupedData;
}

    // Submit the add form using AJAX
    $('#matakuliah-form').submit(function (event) {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function (data) {
                // Update the table with the new data
                updateMatakuliahTable(data);
                // Clear the form
                $('#matakuliah-form')[0].reset();
            }
        });
    });

    // Submit the edit form using AJAX
    $('#edit-form').submit(function (event) {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function (data) {
                // Update the table with the new data
                updateMatakuliahTable(data);
                // Hide the modal
                $('#edit-modal').modal('hide');
                // Reset the form
                $('#edit-form')[0].reset();
            }
        });
    });

    // Submit the delete form using AJAX
    $('#delete-form').submit(function (event) {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function (data) {
                // Update the table with the new data
                updateMatakuliahTable(data);
                // Hide the modal
                $('#delete-modal').modal('hide');
                // Reset the form
                $('#delete-form')[0].reset();
            }
        });
    });
</script>