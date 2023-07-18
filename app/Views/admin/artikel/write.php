<?php include(APPPATH . 'views/layouts/header.php'); ?>
<style>
    .ck-editor__editable {
    min-height: 500px !important;
}
</style>
<div class="d-flex">
    <div class="fixed-sidebar">
        <?php include(APPPATH . 'views/layouts/admin/sidebar.php'); ?>
    </div>
    <div class="flex-grow-1 overflow-auto">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <h2 class="mb-4">Write an Article</h2>
                    <form method="post" action="/articles">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea class="form-control" id="editor" name="content" rows="200"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Publish</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/js/bootstrap.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>


<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            height: '400px' // Set the height to 400 pixels
        })
        .catch(error => {
            console.error(error);
        });
</script>
<?php include(APPPATH . 'views/layouts/footer.php'); ?>