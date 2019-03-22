<?php
session_start();
session_unset();
session_destroy(); 
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>DSC STIMATA</title>
  <?php include 'css/css.html'; ?>
  <link rel="shortcut icon" type="image/png" href="../img/DSC.png"/>
</head>

<body>
    <div class="form">
          <h1>Thanks for visiting us!</h1>
              
          <p><?= 'You have been logged out!'; ?></p>
          
          <a href="../index.php"><button class="button button-block"/>Home</button></a>

    </div>
</body>
</html>
