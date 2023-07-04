<?php include '../layouts/header.php'; ?>

  <form action="<?= base_url('/signup') ?>" method="post">
    <input type="hidden" name="_method" value="PUT">

    <div>
      <label for="nama">Name:</label>
      <input type="text" id="nama" name="nama" required minlength="3" maxlength="128" value="admin">
    </div>
    <div>
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required value="admin@email.com">
    </div>
    <div>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required minlength="8" value="11111111">
    </div>
    <div>
      <label for="confirm_password">Confirm Password:</label>
      <input type="password" id="confirm_password" name="confirm_password" required minlength="8" value="11111111">
    </div>
    <button type="submit">Save</button>
    <?php include '../layouts/footer.php'; ?>