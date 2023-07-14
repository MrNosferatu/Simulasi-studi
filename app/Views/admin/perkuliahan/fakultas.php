<?php include(APPPATH . 'views/layouts/header.php'); ?>
<?php include(APPPATH . 'views/layouts/admin/sidebar.php'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/js/bootstrap.min.js"></script>
<div class="w-100">
    <form id="fakultas-form" action="<?= base_url('/data/fakultas/store') ?>" method="post">
        <h1>Form Fakultas</h1>
        <div class="mb-3">
            <label for="nama">Name:</label>
            <input type="text" id="nama" name="nama" class="form-control" required minlength="3" maxlength="128" value="admin">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <table id="fakultas-table" class="table">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Loop through the data and display it in the table
            foreach ($fakultas as $fakultas) {
                echo '<tr>';
                echo '<td>' . $fakultas['nama'] . '</td>';
                echo '<td>';
                echo '<button class="btn btn-primary edit-btn" data-id="' . $fakultas['kode_fakultas'] . '">Edit</button>';
                echo '<button class="btn btn-danger delete-btn" data-id="' . $fakultas['kode_fakultas'] . '">Delete</button>';
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
            <form id="edit-form" action="<?= base_url('/data/fakultas/update') ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit-modal-label">Edit Fakultas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit-id" name="id">
                    <div class="mb-3">
                        <label for="edit-nama" class="form-label">Name:</label>
                        <input type="text" id="edit-nama" name="nama" class="form-control" required minlength="3" maxlength="128">
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
            <form id="delete-form" action="<?= base_url('/data/fakultas/delete') ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="delete-modal-label">Delete Fakultas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="delete-id" name="id">
                    <p>Are you sure you want to delete this fakultas?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Edit button click handler
        $(document).on('click', '.edit-btn', function () {
            var id = $(this).data('id');
            var nama = $(this).closest('tr').find('td:first').text();
            $('#edit-id').val(id);
            $('#edit-nama').val(nama);
            $('#edit-modal').modal('show');
        });

        // Delete button click handler
        $(document).on('click', '.delete-btn', function () {
            var id = $(this).data('id');
            $('#delete-id').val(id);
            $('#delete-modal').modal('show');
        });

        // Submit the add form using AJAX
        $('#fakultas-form').submit(function (event) {
            event.preventDefault();
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function (data) {
                    // Update the table with the new data
                    $('#fakultas-table tbody').empty();
                    $.each(data, function (index, row) {
                        var html = '<tr>';
                        html += '<td>' + row.nama + '</td>';
                        html += '<td>';
                        html += '<button class="btn btn-primary edit-btn" data-id="' + row.kode_fakultas + '">Edit</button>';
                        html += '<button class="btn btn-danger delete-btn" data-id="' + row.kode_fakultas + '">Delete</button>';
                        html += '</td>';
                        html += '</tr>';
                        $('#fakultas-table tbody').append(html);
                    });
                    // Clear the form
                    $('#fakultas-form')[0].reset();
                    // Reset the click handlers for the "Edit" and "Delete" buttons
                    $('.edit-btn').off('click').on('click', function () {
                        var id = $(this).data('id');
                        var nama = $(this).closest('tr').find('td:first').text();
                        $('#edit-id').val(id);
                        $('#edit-nama').val(nama);
                        $('#edit-modal').modal('show');
                    });
                    $('.delete-btn').off('click').on('click', function () {
                        var id = $(this).data('id');
                        $('#delete-id').val(id);
                        $('#delete-modal').modal('show');
                    });
                    // // Show the modals again after the table is updated
                    // $('#edit-modal').on('hidden.bs.modal', function () {
                    //     $('#edit-modal').modal('show');
                    // });
                    // $('#delete-modal').on('hidden.bs.modal', function () {
                    //     $('#delete-modal').modal('show');
                    // });
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
                    $('#fakultas-table tbody').empty();
                    $.each(data, function (index, row) {
                        var html = '<tr>';
                        html += '<td>' + row.nama + '</td>';
                        html += '<td>';
                        html += '<button class="btn btn-primary edit-btn" data-id="' + row.kode_fakultas + '">Edit</button>';
                        html += '<button class="btn btn-danger delete-btn" data-id="' + row.kode_fakultas + '">Delete</button>';
                        html += '</td>';
                        html += '</tr>';
                        $('#fakultas-table tbody').append(html);
                    });
                    // Hide the modal
                    $('#edit-modal').modal('hide');
                    // Reset the form
                    $('#edit-form')[0].reset();
                    // Reset the click handlers for the "Edit" and "Delete" buttons
                    $('.edit-btn').off('click').on('click', function () {
                        var id = $(this).data('id');
                        var nama = $(this).closest('tr').find('td:first').text();
                        $('#edit-id').val(id);
                        $('#edit-nama').val(nama);
                        $('#edit-modal').modal('show');
                    });
                    $('.delete-btn').off('click').on('click', function () {
                        var id = $(this).data('id');
                        $('#delete-id').val(id);
                        $('#delete-modal').modal('show');
                    });
                    // // Show the modals again after the table is updated
                    // $('#edit-modal').on('hidden.bs.modal', function () {
                    //     $('#edit-modal').modal('show');
                    // });
                    // $('#delete-modal').on('hidden.bs.modal', function () {
                    //     $('#delete-modal').modal('show');
                    // });
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
                    $('#fakultas-table tbody').empty();
                    $.each(data, function (index, row) {
                        var html = '<tr>';
                        html += '<td>' + row.nama + '</td>';
                        html += '<td>';
                        html += '<button class="btn btn-primary edit-btn" data-id="' + row.kode_fakultas + '">Edit</button>';
                        html += '<button class="btn btn-danger delete-btn" data-id="' + row.kode_fakultas + '">Delete</button>';
                        html += '</td>';
                        html += '</tr>';
                        $('#fakultas-table tbody').append(html);
                    });
                    // Hide the modal
                    $('#delete-modal').modal('hide');
                    // Reset the form
                    $('#delete-form')[0].reset();
                    // Reset the click handlers for the "Edit" and "Delete" buttons
                    $('.edit-btn').off('click').on('click', function () {
                        var id = $(this).data('id');
                        var nama = $(this).closest('tr').find('td:first').text();
                        $('#edit-id').val(id);
                        $('#edit-nama').val(nama);
                        $('#edit-modal').modal('show');
                    });
                    $('.delete-btn').off('click').on('click', function () {
                        var id = $(this).data('id');
                        $('#delete-id').val(id);
                        $('#delete-modal').modal('show');
                    });
                    // // Show the modals again after the table is updated
                    // $('#edit-modal').on('hidden.bs.modal', function () {
                    //     $('#edit-modal').modal('show');
                    // });
                    // $('#delete-modal').on('hidden.bs.modal', function () {
                    //     $('#delete-modal').modal('show');
                    // });
                }
            });
        });
    });
</script>