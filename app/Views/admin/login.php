<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css">
</head>
<body>
<form action="login.php" method="post" class="p-4 border rounded">
  <h2 class="mb-4">Login</h2>
  <div class="mb-3">
    <label for="username" class="form-label">Email:</label>
    <input type="email" id="username" name="email" class="form-control">
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password:</label>
    <input type="password" id="password" name="password" class="form-control">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</body>
</html>