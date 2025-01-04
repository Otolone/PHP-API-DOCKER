<?php
session_start();
?>
<!DOCTYPE html>
<html>
<style>
table,th,td {
  border : 1px solid black;
  border-collapse: collapse;
}
th,td {
  padding: 5px;
}
</style>
<body>

<h1>List of Services associated with this API</h1>
<?php
$email = $_SESSION['userEmail'];
$apikey = $_SESSION['apikey'];
    echo "<h2> Hi!  $email </h2><br>";
?>  

<form action=""> 
<select id="services" name="services" onchange="selectService(this.value)">
<option value="">Select a service</option>
          <option value="payment">Payment</option>
          <option value="booking">Booking</option>
          <option value="service1">Service 1</option>
          <option value="service2">Service 2</option>
          <option value="service3">Service 3</option>
          <option value="Service4">Service 4</option>
</select>
</form>
<br>
<div id="listServices">List of services:</div>
<?php 
//require "./controllers/dataproceduralconn.php";
//$conn = new Database();
//$table = $conn->getServices();
//echo "<script>document.getElementById('listServices').innerHTML = </script>"

?>
<script>
function selectService(str) {
  var xhttp;    
  if (str == "") {
    document.getElementById("listServices").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("listServices").innerHTML = this.responseText;
    // Remove the selected option from the dropdown
    var selectElement = document.getElementById("services");
      for (var i = 0; i < selectElement.options.length; i++) {
        if (selectElement.options[i].value === str) {
          selectElement.remove(i);
          break;
        }
      }
    }
  };
    
    
    
  
  xhttp.open("GET", "getservices.php?q="+str, true);
  xhttp.send();

}
</script>

</body>
</html>
