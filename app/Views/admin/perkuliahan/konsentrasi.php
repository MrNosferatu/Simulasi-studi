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
                <h1>Konsentrasi Program Studi</h1>
                <div class="mb-3">
                    <label for="Nama" class="form-label">Nama:</label>
                    <input type="text" id="Nama" name="nama" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <table id="konsentrasi-table" class="table">
                <thead>
                    <tr>
                        <th scope="col">Nama</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Initialize the counter variable
                    $counter = 1;

                    // Loop through the data and display it in the table
                    foreach ($konsentrasi as $konsentrasi) {
                        echo '<tr>';
                        echo '<td>' . $konsentrasi['nama'] . '</td>';
                        echo '<td>';
                        echo '<button class="btn btn-primary edit-btn" data-id="' . $konsentrasi['kode_konsentrasi'] . '">Edit</button> ';
                        echo '<button class="btn btn-danger delete-btn" data-id="' . $konsentrasi['kode_konsentrasi'] . '">Delete</button>';
                        echo '</td>';
                        echo '</tr>';

                        // Increment the counter variable
                        $counter++;
                    }
                    ?>
                </tbody>
            </table>
            <!-- Edit Modal -->
            <div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="edit-modal-label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="edit-form" action="<?= base_url('/data/konsentrasi/update') ?>" method="post">
                            <div class="modal-header">
                                <h5 class="modal-title" id="edit-modal-label">Edit Konsentrasi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="edit-id" name="id">
                                <div class="mb-3">
                                    <label for="edit-nama" class="form-label">Nama:</label>
                                    <input type="text" id="edit-nama" name="nama" class="form-control">
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
                            <h5 class="modal-title" id="delete-modal-label">Delete Konsentrasi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="delete-form" action="<?= base_url('/data/konsentrasi/delete') ?>" method="POST">
                            <div class="modal-body">
                                <input type="hidden" name="id" id="delete-id">
                                <p>Are you sure you want to delete this konsentrasi?</p>
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
</div>
<?php include(APPPATH . 'views/layouts/footer.php'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.min.js"></script>
<script>
    $(document).on('click', '.edit-btn', function () {
        var id = $(this).data('id');
        var nama = $(this).closest('tr').find('td:eq(0)').text();
        $('#edit-id').val(id);
        $('#edit-nama').val(nama);
        $('#edit-modal').modal('show');
    });
</script>
<script>
    // Delete button click handler
    $(document).on('click', '.delete-btn', function () {
        var id = $(this).data('id');
        $('#delete-id').val(id);
        $('#delete-modal').modal('show');
    });

    function updateMatakuliahTable(data) {
        $('#konsentrasi-table tbody').empty();
        $.each(data, function (index, row) {
            var html = '<tr>';
            html += '<td>' + row.nama + '</td>';
            html += '<td>';
            html += '<button class="btn btn-primary edit-btn" data-id="' + row.kode_konsentrasi + '">Edit</button>';
            html += '<button class="btn btn-danger delete-btn" data-id="' + row.kode_konsentrasi + '">Delete</button>';
            html += '</td>';
            html += '</tr>';
            $('#konsentrasi-table tbody').append(html);
        });
        // Reset the click handlers for the "Edit" and "Delete" buttons
        $('.edit-btn').off('click').on('click', function () {
            var id = $(this).data('id');
            var nama = $(this).closest('tr').find('td:eq(0)').text();
            $('#edit-id').val(id);
            $('#edit-nama').val(nama);
            $('#edit-modal').modal('show');
        });
        $('.delete-btn').off('click').on('click', function () {
            var id = $(this).data('id');
            $('#delete-id').val(id);
            $('#delete-modal').modal('show');
        });
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