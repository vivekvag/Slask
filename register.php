
<?php include('server.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Form</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="stylesheets/register.css">

</head>
<body>
  <div class="register-form">
    <form action="register.php" method="post">
      <?php include('errors.php'); ?>
      <div class="avatar"> <img src="assets/profile.svg" alt="Login Icon"> </div>
      <h2 class="text-center">Register</h2>
      <p class="hint-text">Create your account. It's free and only takes a minute.</p>

      <div class="form-group">
        <div class="row">
          <div class="col-xs-6"><input type="text" class="form-control" name="first_name" placeholder="First Name" required="required"></div>
          <div class="col-xs-6"><input type="text" class="form-control" name="last_name" placeholder="Last Name" required="required"></div>
        </div>
      </div>
      <div class="form-group">
        <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $email; ?>" required="required">
      </div>
      <div class="form-group">
        <input type="password" class="form-control" name="password_1" placeholder="Password" required="required">
      </div>
      <div class="form-group">
        <input type="password" class="form-control" name="password_2" placeholder="Confirm Password" required="required">
      </div>
      <div class="form-group">
        <label class="checkbox-inline"><input type="checkbox" required="required"> I accept the <a href="#">Terms of Use</a> &amp; <a href="#">Privacy Policy</a></label>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-success register-btn btn-block" name="reg_user">Register Now</button>
      </div>

    </form>
    <p class="text-center text-muted large bottom-class">Already have an account? <a href="login.php">Sign in</a></p>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
