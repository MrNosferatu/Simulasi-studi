<?php include 'layouts/header.php'; ?>

  <form action="<?= base_url('/login') ?>" method="post" class="p-4 border rounded">
    <h2 class="mb-4">Login</h2>
    <?php if (session()->has('error')): ?>
      <div class="alert alert-danger">
        <?= session('error') ?>
      </div>
    <?php endif; ?>
    <div class="mb-3">
      <label for="email" class="form-label">Email:</label>
      <input type="email" id="email" name="email" class="form-control" value="asda@dsa.com">
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password:</label>
      <input type="password" id="password" name="password" class="form-control" value="asa">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
  <?php include '../layouts/footer.php'; ?>