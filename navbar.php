<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="stylesheets/darkMode.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
  <style>

  .topnav {
    overflow: hidden;
    font-family: 'Montserrat', sans-serif;
    font-weight: 500;
  }

  .topnav a {
    float: left;
    display: block;
    text-align: center;
    padding: 14px 16px;
    padding-top: 22px;
    text-decoration: none;
    font-size: 18px;
    height: 70px;
    text-transform: capitalize;
  }

  .topnav .logo{
    padding: 10px;
  }

  .topnav a.active {
    background-color: #0069D9;
    color: white;
  }

  .topnav .icon {
    display: none;
  }

  @media screen and (max-width: 600px) {
    .topnav a:not(:first-child) {display: none;}
    .topnav a.icon {
      float: right;
      display: block;
    }
  }

  @media screen and (max-width: 600px) {
    .topnav.responsive {position: relative;}
    .topnav.responsive .icon {
      position: absolute;
      right: 0;
      top: 0;
    }
    .topnav.responsive a {
      float: none;
      display: block;
      text-align: left;
    }
  }
</style>
</head>
<body>

  <div class="topnav" id="myTopnav">
    <a href="index.php" class="logo">
      <picture>
        <img src="assets/slask-logo.svg" alt="Slask-Logo" height="50px" width="150px">
      </picture>
    </a>
    <a href="index.php" class="active"><i class="fa fa-fw fa-home"></i>Home</a>
    <a href="#contact">Contact</a>
    <a href="#about">About</a>
    <?php  if (isset($_SESSION['email'])) : ?>
      <a href="index.php?logout='1'">Logout</a>
    <?php endif ?>
    <a href="javascript:void(0);" class="icon" onclick="myFunction()">
      <i class="fa fa-bars"></i>
    </a>
  </div>

  <script>
  function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
      x.className += " responsive";
    } else {
      x.className = "topnav";
    }
  }
  </script>

</body>
</html>
