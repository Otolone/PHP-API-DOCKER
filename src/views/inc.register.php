<?php
//require 'controllers\sessionmanagment.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Register</title>
</head>
<body>
<?php
require "./controllers/dataproceduralconn.php";

// Define variables and set to empty values
$bNameErr = $emailErr = $addressErr = $telephoneErr = $passwordErr = $confirmpasswordErr = $usernameErr = "";
$bName = $email = $address = $telephone = $password = $confirmpassword = $username = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  if (empty($_POST["bName"])) {
    $bNameErr = "Business name is required";
  } else {
    $bName = test_input($_POST["bName"]);
    if (!preg_match("/^[a-zA-Z-' ]*$/", $bName)) {
      $bNameErr = "Only letters and white space allowed";
    }
  }

  if (empty($_POST["address"])) {
    $addressErr = "Your Address is required";
  } else {
    $address = test_input($_POST["address"]);
  }

  if (empty($_POST["telephone"])) {
    $telephoneErr = "Telephone is required";
  } else {
    $telephone = test_input($_POST["telephone"]);
  }

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
  }

  if (empty($_POST["username"])) {
    $usernameErr = "User name is required";
  } else {
    $username = test_input($_POST["username"]);
  }

  if (empty($_POST["password"])) {
    $passwordErr = "You have to give a password";
  } else {
    $password = test_input($_POST["password"]);
  }

  if (empty($_POST["confirmpassword"])) {
    $confirmpasswordErr = "You have to confirm your password";
  } else {
    $confirmpassword = test_input($_POST["confirmpassword"]);
  }

  // Proceed with inserting into the database if no errors
  if (empty($bNameErr) && empty($addressErr) && empty($telephoneErr) && empty($emailErr) && empty($usernameErr) && empty($passwordErr) && empty($confirmpasswordErr)) {
    // Check if passwords match
    if ($password !== $confirmpassword) {
      echo "<script>alert('Passwords do not match');</script>";
    } else {
      // insert int business and apiuser table
     $hashed_password =password_hash($password,PASSWORD_BCRYPT);
     //$sql = "INSERT INTO business (bName, address, tel, email, username, bus_password) VALUES ('$bName', '$address', '$telephone','$email', '$username', '$hashed_password');";
     // Create database connection
     $conn = new Database();
     // Insert a new record
     $conn->insert_data($bName, $address, $telephone, $email, $username, $hashed_password);
     
      //close coonect
      $conn->close_connection();
      
      // Navigate to the login page
      header('Location: index.php?page=login');
      exit(); // Ensure script termination after redirection
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
<h2>Registration</h2>
<p><span class="error">* required field</span></p>
<div class="flex-container">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?page=register"; ?>">
  <label for="bName">Business Name</label>
  <input id="bName" type="text" name="bName" value="<?php echo $bName; ?>">
  <span class="error">* <?php echo $bNameErr; ?></span>
 
  <label for="address">Address</label>
  <textarea id="address" name="address" rows="5" cols="40"><?php echo $address; ?></textarea>
  <span class="error">* <?php echo $addressErr; ?></span>
  
  <label for="telephone">Telephone</label>
  <input id="telephone" type="text" name="telephone" value="<?php echo $telephone; ?>">
  <span class="error">* <?php echo $telephoneErr; ?></span>
  
  <label for="email">Email</label>
  <input id="email" type="text" name="email" value="<?php echo $email; ?>">
  <span class="error">* <?php echo $emailErr; ?></span>
  
  <label for="username">User Name</label>
  <input id="username" type="text" name="username" value="<?php echo $username; ?>">
  <span class="error">* <?php echo $usernameErr; ?></span>
  
  <label for="password">Password</label>
  <input id="password" type="password" name="password" value="<?php echo $password; ?>">
  <span class="error">*</span>
  
  <label for="confirmpassword">Confirm password</label>
  <input id="confirmpassword" type="password" name="confirmpassword" value="<?php echo $confirmpassword; ?>">
  <span class="error">*</span>
  
  <br>
  <input type="submit" name="submit" value="Submit">  
</form>
</div>

</body>
</html>
