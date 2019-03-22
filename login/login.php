<?php
$email = $mysqli->escape_string($_POST['email']);
$result = $mysqli->query("SELECT * FROM users WHERE email='$email'");

if ( $result->num_rows == 0 ){
    $_SESSION['message'] = "User with that email doesn't exist!";
    header("location: login/error.php");
}
else {
    $user = $result->fetch_assoc();

    if ( password_verify($_POST['password'], $user['password']) ) {
        
        $_SESSION['email'] = $user['email'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
        
        // This is how we'll know the user is logged in
        $_SESSION['logged_in'] = true;

        if ($email == "admin") {
            header("location: login/profile.php");
        }else{
            header("location: login/profile1.php");
        }
    
    }
    else {
        $_SESSION['message'] = "You have entered wrong password, try again!";
        header("location: login/error.php");
    }
}

