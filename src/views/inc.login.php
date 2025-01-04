<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
<?php 
require "./controllers/dataproceduralconn.php";
require "token.php";

// define variables and set to empty values
$passwordErr = $emailErr = "";
$password = $email = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
  }
  
  if (empty($_POST["password"])) {
    $passwordErr = "password is required";
  } else {
    $password = test_input($_POST["password"]);
  }
  if (empty($passwordErr) && empty($emailErr)) {
    //get the password from the database using the provided email and compared it with the
    // given password
    $conn = new Database();
    $hashedPassword = $conn->getPasswordByEmail($email);
  
    if ($hashedPassword !== null) {     
   
    //compare if the passwords are the same and navigate to the api page
    if (password_verify($password, $hashedPassword)) {
      //get the businessid
      $user_id = $conn->findUserByEmail($email);

      $conn->close_connection();
      //session management
      $_SESSION['userEmail'] = $email;
      //$_SESSION['last_activity'] = time();
      if ($user_id) {
        header('Location: index.php?page=api');
      }
      exit();   
      /*/generate an apikey
      //get the id of the record above
     $businesid = $conn->get_last_id();
     $apikey  = bin2hex(random_bytes(8));
     //insert into api 
     $sql = "INSERT INTO apiuser (businessid,apikey) VALUES('$businesid', '$apikey');";  

      $conn->insert_data($sql);  
      $conn->close_connection();*/
    } else {
      echo "<script>alert('Password or email does not match');</script>";
    }
  }
} 
  
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<script>
  function saveUserEmailToLocalStorage(event) {
    //alert('Input value change to:' + event.target.value);
    localStorage.setItem('userEmail', event.target.value);    
  }
</script>
<h2>Login</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ."?page=login";?>">  
  Email: <input type="text" onchange="saveUserEmailToLocalStorage(event)" name="email" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  Password: <input type="password" name="password" value="<?php echo $password;?>">
  <span class="error">* <?php echo $passwordErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>
<div style="display:flex; flex-direction:column">
  <h3>Forgot Password?<a href="index.php?page=forgotpassword">Email reset</a></h3> 
  <h3>Not yet registered?<a href="index.php?page=register">Register</a></h3>
</div>
</body>
</html>
