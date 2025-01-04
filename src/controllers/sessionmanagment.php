<?php
//session_start();
//$timeout_duration = 900;//15 minutes

/*if (isset($_SESSION['last_activity'])) {
    $session_life = time() - $_SESSION['last_activity'];
    //if the session has expired
    if ($session_life > $timeout_duration) {
        //Destroy the session and redirect to the login page
       echo "<span class='error'>Your session has expired.</span>";
        session_unset(); //unset all the sessions
        session_destroy(); // Destroy the session
        header("Location: index.php?page=login");
        exit();
    }
}
// update last activity time stamp
$_SESSION['last_activity'] = time();

//check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert(Your session has expired. You have to sign in again);</script>";
    header("Location: index.php?page=login");
}*/
?>

