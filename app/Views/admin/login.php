<?php include(APPPATH . 'views/layouts/header.php'); ?>
<div class="h-100 d-flex justify-content-center align-items-center"> <!-- Add align-items-center class -->
  <form action="<?= base_url('/login') ?>" method="post" class="p-4 border rounded">
    <h2 class="mb-4">Login</h2>
    <?php if (session()->has('error')): ?>
      <div class="alert alert-danger">
        <?= session('error') ?>
      </div>
    <?php endif; ?>
    <div class="mb-3">
      <label for="email" class="form-label">Email:</label>
      <input type="email" id="email" name="email" class="form-control" value="admin@email.com">
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password:</label>
      <input type="password" id="password" name="password" class="form-control" value="11111111">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
