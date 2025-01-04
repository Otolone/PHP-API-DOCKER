<?php
if (isset($_POST['logout'])) {
    session_start();
    session_unset();
    session_destroy();
    header("Location: index.php?page=login");
    exit();
}

?>
<html>
    <body>
    echo '<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ."?page=about"; ?>">
        <button type="submit" name="logout">Logout</button>
      </form>';
    </body>    

</html>