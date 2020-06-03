<!DOCTYPE html>
<html>
<head>
  <?php

  $response = file_get_contents('quotes_data');
  $quotes = json_decode($response,true);

  //random_number to access random quotes
  $ch = curl_init("https://www.random.org/integers/?num=1&min=0&max=1643&col=1&base=10&format=plain&rnd=new");
  curl_setopt($ch, CURLOPT_TIMEOUT, 5);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_FAILONERROR, true);
  curl_exec($ch);
  if (curl_errno($ch)) {
    $error_msg = curl_error($ch);
  }
  $num = curl_exec($ch);
  $quote_num = (int)$num; //random_number variable
  curl_close($ch);

  //if random.org fails then using php random number
  if (isset($error_msg)) {
    $quote_num= rand(0,1642);
  }
  $quote_text = $quotes[$quote_num]["text"];
  $quote_auth = $quotes[$quote_num]["author"];

  unset($response);
  unset($quotes);
  ?>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
  <link href="https://fonts.googleapis.com/css2?family=Bitter:ital@0;1&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Italianno&family=Lobster&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="stylesheets/quote-style.css">
  <link rel="stylesheet" type="text/css" href="fonts.css">
  <link rel="stylesheet" type="text/css" href="darkMode.css">
</head>
<body>

  <section class="testimonals">
    <h3 class="title">Sooth Your Day</h3>
    <hr class="dash">
    <div class="container">
      <i class="fas fa-quote-left quote-icon"></i>
      <blockquote class="ludwig"><?php echo $quote_text; ?></blockquote>
      <cite><?php echo $quote_auth; ?></cite>
    </div>
  </section>

</body>
</html>
