<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'connect.php';

    if (isset($_POST['username']) && isset($_POST['password'])) {
      // sanitize inputs
      $username = mysqli_real_escape_string($con, $_POST['username']);
      $password = mysqli_real_escape_string($con, $_POST['password']);

      // check credentials
      $sql = "SELECT * FROM registration WHERE username = '$username' AND password = '$password'";
      $result = mysqli_query($con, $sql);

      if ($result && mysqli_num_rows($result) > 0) {
        session_start();
        $_SESSION['username'] = $username;
        header("Location: home.php");
        exit();
      } else {
        $error = "Invalid username or password.";
      }
    }

   
}


?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body class="bg-light">    
    <h1 class="text-center">Login To Your Account</h1>                
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-5">
          <div class="card shadow">
            <div class="card-body">
              <?php if (isset($error)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <?php echo $error; ?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php endif; ?>
              
              <form action="login.php" method="post">
                <div class="mb-3">
                  <label for="usernameInput" class="form-label">Username</label>
                  <input type="text" class="form-control" id="usernameInput" name="username" placeholder="Enter your username" name="username">
                </div>
                <div class="mb-3">
                  <label for="passwordInput" class="form-label">Password</label>
                  <input type="password" class="form-control" id="passwordInput" name="password" placeholder="Enter your password " name="password">
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
                <p class="text-center mt-3">Don't have an account? <a href="signup.php">Sign up here</a></p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>