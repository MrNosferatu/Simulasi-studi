<?php include(APPPATH . 'views/layouts/header.php'); ?>
<?php include(APPPATH . 'views/layouts/admin/sidebar.php'); ?>
<div class="w-100 p-5">
    <form id="prodi-form" action="<?= base_url('/data/prodi/store') ?>" method="post">
        <h1>Form Prodi</h1>
        <div class="mb-3">
            <label for="kode_fakultas" class="form-label">Fakultas:</label>
            <select id="kode_fakultas" name="kode_fakultas" class="form-control">
                <?php foreach ($fakultas as $row): ?>
                    <option value="<?= $row['kode_fakultas'] ?>"><?= $row['nama'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
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
            <label for="ipk_minimal" class="form-label">IPK Minimal:</label>
            <input type="text" id="ipk_minimal" name="ipk_minimal" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <table id="prodi-table" class="table">
        <thead>
            <tr>
                <th scope="col">Nama</th>
                <th scope="col">SKS Minimal</th>
                <th scope="col">Nilai D Maksimal</th>
                <th scope="col">IPK Minimal</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Loop through the data and display it in the table
            foreach ($prodi as $prodi) {
                echo '<tr>';
                echo '<td>' . $prodi['nama'] . '</td>';
                echo '<td>' . $prodi['sks_minimal'] . '</td>';
                echo '<td>' . $prodi['nilai_d_maksimal'] . '</td>';
                echo '<td>' . $prodi['ipk_minimal'] . '</td>';
                echo '<td>';
                echo '<button class="btn btn-primary edit-btn" data-id="' . $prodi['kode_prodi'] . '">Edit</button> ';
                echo '<button class="btn btn-danger delete-btn" data-id="' . $prodi['kode_prodi'] . '">Delete</button>';
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
            <div class="modal-header">
                <h5 class="modal-title" id="edit-modal-label">Edit Prodi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="edit-form" action="<?= base_url('/data/prodi/update') ?>" method="post">
                <div class="modal-body">
                    <input type="hidden" id="edit-id" name="id">
                    <div class="mb-3">
                        <label for="edit-nama" class="form-label">Nama:</label>
                        <input type="text" id="edit-nama" name="nama" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="edit-sks_minimal" class="form-label">SKS Minimal:</label>
                        <input type="number" id="edit-sks_minimal" name="sks_minimal" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="edit-nilai_d_maksimal" class="form-label">Nilai D Maksimal:</label>
                        <input type="number" id="edit-nilai_d_maksimal" name="nilai_d_maksimal" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="edit-ipk_minimal" class="form-label">IPK Minimal:</label>
                        <input type="text" id="edit-ipk_minimal" name="ipk_minimal" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
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
                <h5 class="modal-title" id="delete-modal-label">Delete Program Studi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="delete-form" action="<?= base_url('/data/prodi/delete') ?>" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id" id="delete-id">
                    <p>Are you sure you want to delete this program studi?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.min.js"></script>
<script>
    $(document).on('click', '.edit-btn', function () {
        var id = $(this).data('id');
        var nama = $(this).closest('tr').find('td:eq(0)').text();
        var sks_minimal = $(this).closest('tr').find('td:eq(1)').text();
        var nilai_d_maksimal = $(this).closest('tr').find('td:eq(2)').text();
        var ipk_minimal = $(this).closest('tr').find('td:eq(3)').text();
        $('#edit-id').val(id);
        $('#edit-nama').val(nama);
        $('#edit-sks_minimal').val(sks_minimal);
        $('#edit-nilai_d_maksimal').val(nilai_d_maksimal);
        $('#edit-ipk_minimal').val(ipk_minimal);
        $('#edit-modal').modal('show');
    });

    // Delete button click handler
    $(document).on('click', '.delete-btn', function () {
        var id = $(this).data('id');
        $('#delete-id').val(id);
        $('#delete-modal').modal('show');
    });

    // Submit the add form using AJAX
    $('#prodi-form').submit(function (event) {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function (data) {
                // Update the table with the new data
                $('#prodi-table tbody').empty();
                $.each(data, function (index, row) {
                    var html = '<tr>';
                    html += '<td>' + row.nama + '</td>';
                    html += '<td>' + row.sks_minimal + '</td>';
                    html += '<td>' + row.nilai_d_maksimal + '</td>';
                    html += '<td>' + row.ipk_minimal + '</td>';
                    html += '<td>';
                    html += '<button class="btn btn-primary edit-btn" data-id="' + row.kode_prodi + '">Edit</button>';
                    html += '<button class="btn btn-danger delete-btn" data-id="' + row.kode_prodi + '">Delete</button>';
                    html += '</td>';
                    html += '</tr>';
                    $('#prodi-table tbody').append(html);
                });
                // Clear the form
                $('#prodi-form')[0].reset();
                // Reset the click handlers for the "Edit" and "Delete" buttons
                $('.edit-btn').off('click').on('click', function () {
                    var id = $(this).data('id');
                    var nama = $(this).closest('tr').find('td:eq(0)').text();
                    var sks_minimal = $(this).closest('tr').find('td:eq(1)').text();
                    var nilai_d_maksimal = $(this).closest('tr').find('td:eq(2)').text();
                    var ipk_minimal = $(this).closest('tr').find('td:eq(3)').text();
                    $('#edit-id').val(id);
                    $('#edit-nama').val(nama);
                    $('#edit-sks_minimal').val(sks_minimal);
                    $('#edit-nilai_d_maksimal').val(nilai_d_maksimal);
                    $('#edit-ipk_minimal').val(ipk_minimal);
                    $('#edit-modal').modal('show');
                });
                $('.delete-btn').off('click').on('click', function () {
                    var id = $(this).data('id');
                    $('#delete-id').val(id);
                    $('#delete-modal').modal('show');
                });
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
                $('#prodi-table tbody').empty();
                $.each(data, function (index, row) {
                    var html = '<tr>';
                    html += '<td>' + row.nama + '</td>';
                    html += '<td>' + row.sks_minimal + '</td>';
                    html += '<td>' + row.nilai_d_maksimal + '</td>';
                    html += '<td>' + row.ipk_minimal + '</td>';
                    html += '<td>';
                    html += '<button class="btn btn-primary edit-btn" data-id="' + row.kode_prodi + '">Edit</button>';
                    html += '<button class="btn btn-danger delete-btn" data-id="' + row.kode_prodi + '">Delete</button>';
                    html += '</td>';
                    html += '</tr>';
                    $('#prodi-table tbody').append(html);
                });
                // Hide the modal
                $('#edit-modal').modal('hide');
                // Reset the form
                $('#edit-form')[0].reset();
                // Reset the click handlers for the "Edit" and "Delete" buttons
                $('.edit-btn').off('click').on('click', function () {
                    var id = $(this).data('id');
                    var nama = $(this).closest('tr').find('td:eq(0)').text();
                    var sks_minimal = $(this).closest('tr').find('td:eq(1)').text();
                    var nilai_d_maksimal = $(this).closest('tr').find('td:eq(2)').text();
                    var ipk_minimal = $(this).closest('tr').find('td:eq(3)').text();
                    $('#edit-id').val(id);
                    $('#edit-nama').val(nama);
                    $('#edit-sks_minimal').val(sks_minimal);
                    $('#edit-nilai_d_maksimal').val(nilai_d_maksimal);
                    $('#edit-ipk_minimal').val(ipk_minimal);
                    $('#edit-modal').modal('show');
                });
                $('.delete-btn').off('click').on('click', function () {
                    var id = $(this).data('id');
                    $('#delete-id').val(id);
                    $('#delete-modal').modal('show');
                });
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
                $('#prodi-table tbody').empty();
                $.each(data, function (index, row) {
                    var html = '<tr>';
                    html += '<td>' + row.nama + '</td>';
                    html += '<td>' + row.sks_minimal + '</td>';
                    html += '<td>' + row.nilai_d_maksimal + '</td>';
                    html += '<td>' + row.ipk_minimal + '</td>';
                    html += '<td>';
                    html += '<button class="btn btn-primary edit-btn" data-id="' + row.kode_prodi + '">Edit</button>';
                    html += '<button class="btn btn-danger delete-btn" data-id="' + row.kode_prodi + '">Delete</button>';
                    html += '</td>';
                    html += '</tr>';
                    $('#prodi-table tbody').append(html);
                });
                // Hide the modal
                $('#delete-modal').modal('hide');
                // Reset the form
                $('#delete-form')[0].reset();
                // Reset the click handlers for the "Edit" and "Delete" buttons
                $('.edit-btn').off('click').on('click', function () {
                    var id = $(this).data('id');
                    var nama = $(this).closest('tr').find('td:eq(0)').text();
                    var sks_minimal = $(this).closest('tr').find('td:eq(1)').text();
                    var nilai_d_maksimal = $(this).closest('tr').find('td:eq(2)').text();
                    var ipk_minimal = $(this).closest('tr').find('td:eq(3)').text();
                    $('#edit-id').val(id);
                    $('#edit-nama').val(nama);
                    $('#edit-sks_minimal').val(sks_minimal);
                    $('#edit-nilai_d_maksimal').val(nilai_d_maksimal);
                    $('#edit-ipk_minimal').val(ipk_minimal);
                    $('#edit-modal').modal('show');
                });
                $('.delete-btn').off('click').on('click', function () {
                    var id = $(this).data('id');
                    $('#delete-id').val(id);
                    $('#delete-modal').modal('show');
                });
            }
        });
    });
// });
</script>