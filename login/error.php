<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Error</title>
  <?php include 'css/css.html'; ?>
  <link rel="shortcut icon" type="image/png" href="../img/DSC.png"/>
</head>
<body>
<div class="form">
    <h1>Error</h1>
    <p>
    <?php 
    if( isset($_SESSION['message']) AND !empty($_SESSION['message']) ): 
        echo $_SESSION['message'];    
    else:
        header( "location: ../index.php" );
    endif;
    ?>
    </p>     
    <a href="../index.php"><button class="button button-block"/>Home</button></a>
</div>
</body>
</html>
