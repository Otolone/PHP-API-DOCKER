<!DOCTYPE html>
<html>
<head>
</head>
<body>
<p id="message">
<?php require "token.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["api"])) {
        echo "Token " . $jwt . " " . "generated!" ;   
    }
  }
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["transactions"])) {
        echo "Transaction completed!" ;   
    }
  } 
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["payout"])) {
        echo "Payout done" ;   
    }
  }
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["revenue"])) {
        echo "Revenue collected" ;   
    }
  } 
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["services"])) {
        echo "Service rendered!" ;   
    }
  }   

?>
</p>
<div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?page=api';?>">
      <button id="myButton" type="submit" name="api">Generate Api</button>
   </form>
  </div> 

</body>