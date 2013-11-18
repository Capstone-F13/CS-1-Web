<?php
session_start();
//check for last activity, and kill session as needed
if (isset($_SESSION['lastActivity'])) {
    if ($_SESSION['stayLoggedIn'] == true) {
        if (time() - $_SESSION['lastActivity'] > 2592000) {
            session_unset();
            session_destroy();
            header("Location:../shared_php/session_expired.php");
        }
    } else if (time() - $_SESSION['lastActivity'] > 1800) {
        session_unset();
        session_destroy();
        header("Location:../shared_php/session_expired.php");
    }
} else {
    $_SESSION['lastActivity'] = time(); // update last activity time stamp
}
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Login Form</title>
        <link rel="stylesheet" href="css/base.css">
        <link rel="stylesheet" href="css/layout.css">
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
        <div class="form-bg">
            <form id="login" method="POST" action="login.php">
                <h2>Login</h2>
                <input type="text" placeholder="Email" name="username" id="username">
                <br />
                <input type="password" placeholder="Password" name="password" id="password">
                <br />
                <button type="submit" class="button" style="float:right;display:block;margin-right:40px">Login</button>
                <div style="padding-left:20px">
                    <input type="checkbox" id="remember" name="remember" value="remember" />
                    <span>Keep me logged in</span>
                    <br />
                    <a href="shared_php/forget_pass.php">Forgot your password?</a>
                </div>
            </form>
        </div>
    </body>
</html>
