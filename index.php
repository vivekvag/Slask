<?php
session_start();

if (!isset($_SESSION['email'])) {
  $_SESSION['msg'] = "You must log in first";
  header('location: login.php');
}
if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['email']);
  header("location: login.php");
}
?>

<?php

// Connecting to the database

$errors = "";
$db = mysqli_connect('localhost','root','','slask');
$db2 = mysqli_connect('localhost','root','','slask');

if (isset($_POST['submit'])) {
  $task = $_POST['task'];

  if (isset($_SESSION['email'])){
    $email = $_SESSION['email'];
  }

  // Put your code here

  $date = date("d/m/Y");

  if (empty($task)) {
    $errors = "You must add new task";
  }else {
    mysqli_query($db, "INSERT INTO tasks(task, email, date) VALUES ('$task' , '$email' , '$date') ");

    header('location: index.php');

  }

}

$email = $_SESSION['email'];

// delete the current tasks
if (isset($_GET['del_task'])) {
  $id = $_GET['del_task'];
  mysqli_query($db,"DELETE FROM tasks WHERE id=$id");
  header('location: index.php');
}

// completed tasks
if (isset($_GET['complete_task'])) {
  $id = $_GET['complete_task'];


  mysqli_query($db2, "INSERT INTO completedtask select id, task, email from tasks where email ='$email' and tasks.id = $id ");
  mysqli_query($db,"DELETE FROM tasks WHERE id=$id and email = '$email' ");
  header('location: index.php');
}



// reset the tasks
if (isset($_GET['reset_task'])) {
  $id = $_GET['reset_task'];
  mysqli_query($db,"DELETE FROM tasks where email = '$email' ");
  mysqli_query($db2,"DELETE FROM completedtask where email ='$email' ");
  header('location: index.php');
}

$tasks = mysqli_query($db, "SELECT * FROM tasks where email ='$email' ");
$completedtask = mysqli_query($db2, "SELECT * FROM completedtask where email ='$email' ");
$recenttask = mysqli_query($db2, "SELECT * FROM completedtask where email ='$email' ORDER BY id DESC LIMIT 1");
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Slask - Don't Slack the Work</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="assets/slask-favicon.png" type="image/png">

  <!-- Bootstrap Link -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Link to All Css Components -->
  <link rel="stylesheet" href="stylesheets/header.css">
  <link rel="stylesheet" href="stylesheets/index.css">
  <link rel="stylesheet" href="stylesheets/footer.css">
  <link rel="stylesheet" href="stylesheets/darkMode.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Bitter:ital@0;1&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>

  <?php include "loader.html" ?>
  <!-- Navbar Starts Here
  import navbar from Navbar.php -->
  <?php include "navbar.php" ?>

  <!-- Dark Mode Toggle switch here -->
  <button id="dark-mode-toggle" class="dark-mode-toggle">
    <div>
      <svg width="100%" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 496"><path fill="currentColor" d="M8,256C8,393,119,504,256,504S504,393,504,256,393,8,256,8,8,119,8,256ZM256,440V72a184,184,0,0,1,0,368Z" transform="translate(-8 -8)"/></svg>
    </div>
  </button>
  <!-- Dark Mode Switch Ends Here -->

  <!-- <section>
  <figure class="fade-1">   <figcaption>Fig.1 of Beach </figcaption></figure>
</section> -->

<!-- Imported the quote Section from quote.php -->
<?php include "quote.php" ?>

<!-- Header Section with Total & Completed Task -->
<section id="main">
  <article id="headers">
    <header>
      <div>
        <h3>Tasks Left</h3>
        <?php  ($num = mysqli_num_rows($tasks)) ?>
        <h4 id="total"><?php echo $num; ?></h4>
      </div>

      <div>
        <h3>Completed Tasks</h3>
        <?php  ($num = mysqli_num_rows($completedtask)) ?>
        <h4 id="completed"><?php echo $num; ?></h4>
      </div>
    </header>
  </article>
</section>
<!-- Header Section Ends Here -->


<!-- Form part with Add to task button -->
<div class="container-fluid container-md pt-5 font-type">
  <div class="row">
    <div class="col-md-10">
      <!-- form class -->
      <form class="list-group shadow-sm" action="index.php" method="post">

        <?php if (isset($errors)) { ?>
          <p class="badges"><?php echo $errors; ?></p>
        <?php } ?>

        <input type="text" class="form-control form-control-lg shadow input-type" name="task" placeholder="What's your Next task?">
      </div>
      <div class="col-md-2 d-flex ">
        <button type="submit" class="btn btn-primary mt-3 shadow-sm" name="submit" data-toggle="tooltip" data-placement="top" title="Add New Task">Add Task</button>
      </div>
    </form>
  </div>
</div>
<!-- Form part Ends here -->

<!-- This is the Section where table is created, which includes Task ID, Task Name & Task action -->
<div class="container-fluid container-md mt-4 table-responsive">
  <table  class="table table-design">
    <!-- Name of the columns in the table -->
    <thead class="thead-color">
      <tr class="thead-font">
        <th scope="col-1" >SN.</th>
        <th scope="col-9" width='50%'>Task</th>
        <th scope="col-1" class="pl-md-4" >Action</th>
        <th scope="col-1" class="pl-4">Date</th>
      </tr>
    </thead>
    <tbody>

      <!-- body which will be fetched from the database with the action buttons -->
      <?php $i =1; while ($row = mysqli_fetch_array($tasks)) { ?>
        <tr>

          <!-- Fetching the data  -->
          <th scope="row"><?php echo $i; ?></th>
          <td>
            <div  class='edit' id='task_<?php echo $id; ?>'>
              <?php echo $row['task']; ?>
            </div>
          </td>
          <td>

            <div class="widget-content-right d-md-flex">
              <!-- check button icon -->
              <a href="index.php?complete_task=<?php echo $row['id']; ?>">
                <button type="submit" name="complete" class="border-0 btn-transition btn btn-outline-success" data-toggle="tooltip" data-placement="top" title="Task Completed">
                  <i class="fa fa-check"> </i>
                </button>
              </a>

              <!-- trah button icon -->
              <a href="index.php?del_task=<?php echo $row['id']; ?>">
                <button class="border-0 btn-transition btn btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Delete Data">
                  <i class="fa fa-trash"> </i>
                </button>
              </a>

            </div>
          </td>
          <td>
            <?php echo $row['date']; ?>
          </tr>
          <?php $i++; } ?>
    </tbody>
  </table>

      <!-- Reset Button -->
      <a href="index.php?reset_task=<?php echo $row['id']; ?>">
        <button  class="btn btn-outline-danger mt-3" name="reset" data-toggle="tooltip" data-placement="top" title="Reset">Reset All</button>
      </a>
      <div class="text-muted small">
        <hr>
        <div class="stats">
          <i class="fa fa-history"></i> Recently Completed Task:
        </div>
      </div>
      <?php $i =1; while ($row2 = mysqli_fetch_array($recenttask)) { ?>
        <span class="small"><?php echo $row2['task']; ?></span>
        <?php $i++; } ?>
      </div>

      <div class="mb-5"></div>

      <!-- Footer -->
      <?php include 'footer.php'; ?>

      <!-- AJAX Function starts Here -->
      <!-- <script>
      $(document).ready(function() {
      $('#butsave').on('click', function() {
      $("#butsave").attr("disabled", "disabled");
      let name = $('#name').val();
      let email = $('#email').val();
      let phone = $('#phone').val();
      let city = $('#city').val();
      if(name!="" && email!="" && phone!="" && city!=""){
      $.ajax({
      url: "save.php",
      type: "POST",
      data: {
      name: name,
      email: email,
      phone: phone,
      city: city
    },
    cache: false,
    success: function(dataResult){
    let dataResult = JSON.parse(dataResult);
    if(dataResult.statusCode==200){
    $("#butsave").removeAttr("disabled");
    $('#fupForm').find('input:text').val('');
    $("#success").show();
    $('#success').html('Data added successfully !');
  }
  else if(dataResult.statusCode==201){
  alert("Error occured !");
}

}
});
}
else{
alert('Please fill all the field !');
}
});
});
</script> -->



<!-- AJAX Fucntion Ends Here -->

<!-- darkMode -->
<script type="text/javascript" src="js/darkMode.js"></script>

<!-- BootStrap Links -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
