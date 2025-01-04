<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $comment  = $_POST['comment'];

    if (!empty($username) && !empty($comment)) {
        echo "<div>Form submitted succesfully</div>";
        echo "<div>Here is the $comment</div>";

    } else {
        echo "<div>Please fill the form</div>";
    }
} else {
    echo "OOPs!! something wrong happened. ";
}

?>