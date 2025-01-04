<html>
    <body>
        <?php require "./controllers/dataproceduralconn.php";
              require 'token.php';

              $token = $newPassword = "";
              
              if (isset($_GET['token'])) {
                $token = $_GET['token'];
                
              }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if (!empty($_POST['token'])) {
                    $token = test_input($_POST['token']);
                
                }
                if (!empty($_POST['password'])) {
                    $newPassword = test_input($_POST['password']);
                    $newPassword = password_hash($newPassword, PASSWORD_BCRYPT);
                
                }
               
               if (empty($token)) {
                echo "<script>alert('Can not extract token')";
                exit();
               }
               // query the database and get the token
               $conn = new Database();

               $userId = $conn->findUserByToken($token);
               //$sql = "SELECT businessid FROM apiuser WHERE token = '$token'";
              // $userId = $conn->select_data($sql);

               //create a token class to check token expiration
                $generateToken = new GenerateToken();

                echo $generateToken->expiration($token) . " <br>";
                
                if ($userId && $generateToken->expiration($token)) {
                
                $conn->updatePassword($userId, $newPassword);
                //clear the token
                $conn->clearToken($userId);
                $conn->close_connection();
                echo "Your password has been reset successfully";
               } else {
                echo "Invalid or expired token.";
               }
            }
            //
            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
              }
        ?>
       
       <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] ."?page=resetpassword");?>">
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token);?>">
            <input type="password" name="password" placeholder="Enter your new password" required>
            <button type="submit" name="submit">Reset Password</button>
        </form>

    </body>
</html>