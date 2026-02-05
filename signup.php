<?php
$success = false;
$error = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'connect.php';

    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $password = mysqli_real_escape_string($con, $_POST['password']);

        // Check if username already exists
        $checkSql = "SELECT * FROM registration WHERE username = '$username'";
        $checkResult = mysqli_query($con, $checkSql);

        if (mysqli_num_rows($checkResult) > 0) {
            $error = "Username already exists! Please choose a different username.";
        } else {
            $sql = "INSERT INTO registration (username, password) VALUES ('$username', '$password')";

            $result = mysqli_query($con, $sql);
            if ($result) {
                $success = true;
            } else {
                $error = mysqli_error($con);
            }
        }
    }
}

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <span class="navbar-brand mb-0 h1">Registration System</span>
      </div>
    </nav>
    <h1 class="text-center mt-4">Signup Page</h1>                
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-5">
          <div class="card shadow">
            <div class="card-body">
              <?php if ($success): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Success!</strong> Your account has been created successfully.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <a href="login.php" class="btn btn-primary w-100">Go to Login</a>
              <?php elseif ($error): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <?php echo $error; ?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <form action="signup.php" method="post">
                  <div class="mb-3">
                    <label for="usernameInput" class="form-label">Username</label>
                    <input type="text" class="form-control" id="usernameInput" name="username" placeholder="Enter your username" required>
                  </div>
                  <div class="mb-3">
                    <label for="passwordInput" class="form-label">Password</label>
                    <input type="password" class="form-control" id="passwordInput" name="password" placeholder="Enter your password" required>
                  </div>
                  <button type="submit" class="btn btn-primary w-100">Signup</button>
                  <p class="text-center mt-3">Already have an account? <a href="login.php">Login here</a></p>
                </form>
              <?php else: ?>
                <form action="signup.php" method="post">
                  <div class="mb-3">
                    <label for="usernameInput" class="form-label">Username</label>
                    <input type="text" class="form-control" id="usernameInput" name="username" placeholder="Enter your username" required>
                  </div>
                  <div class="mb-3">
                    <label for="passwordInput" class="form-label">Password</label>
                    <input type="password" class="form-control" id="passwordInput" name="password" placeholder="Enter your password" required>
                  </div>
                  <button type="submit" class="btn btn-primary w-100">Signup</button>
                  <p class="text-center mt-3">Already have an account? <a href="login.php">Login here</a></p>
                </form>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>