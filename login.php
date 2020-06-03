<?php include('server.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="stylesheets/login.css">

</head>
<body>
  <div class="login-form">
    <form action="login.php" method="post">
      <?php include('errors.php'); ?>
      <div class="avatar"> <img src="assets/profile.svg" alt="Login Icon"> </div>
      <h2 class="text-center">Sign in</h2>
      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-user"></i></span>
          <input type="email" class="form-control" name="email" placeholder="Email" required="required">
        </div>
      </div>
      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-lock"></i></span>
          <input type="password" class="form-control" name="password" placeholder="Password" required="required">
        </div>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary login-btn btn-block" name="login_user">Sign in</button>
      </div>
      <div class="clearfix">
        <label class="pull-left checkbox-inline"><input type="checkbox" checked> Remember me</label>
        <a href="#" class="pull-right">Forgot Password?</a>
      </div>
      <div class="or-seperator"><i>or</i></div>
      <p class="text-center">Login with your social media account</p>
      <div class="text-center social-btn">
        <a href="#" class="btn btn-primary"><i class="fa fa-facebook"></i>&nbsp; Facebook</a>
        <a href="#" class="btn btn-info"><i class="fa fa-twitter"></i>&nbsp; Twitter</a>
        <a href="#" class="btn btn-danger"><i class="fa fa-google"></i>&nbsp; Google</a>
      </div>
    </form>
    <p class="text-center text-muted large bottom-class">Don't have an account? <a href="register.php">Sign up here!</a></p>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
