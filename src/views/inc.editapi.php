
<!DOCTYPE html>
<html lang="en">
<head>
  <title>API Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body> 
    
<?php 
/*require "./controllers/dataproceduralconn.php";
//$apikey="";
if (isset($_SESSION['apikey'])) {
    $apikey = $_SESSION['apikey'];
    echo 'API key: ' . $apikey;
} else {
    echo 'No API key found in session.';
}
$conn = new Database();

$conn->getServices();
*/?>

<p id="message"></p>
<p id="permission"></p>
<script>
    let apikey = "";
    window.onload = function () {
       apikey = localStorage.getItem("apikey");
       getApiKey(apikey); 
    }
    
    function getApiKey(value) {
        const dataToSend = {
        apikey: value,
    };
     //convert data to JSON
     const jsonString =  JSON.stringify(dataToSend);
     // Create a new XMLHttpRequest object
     const xhttp = new XMLHttpRequest();
     // Define a callback function to handle the server response
     xhttp.onreadystatechange = function () {
    if (this.readyState === 4 && this.status === 200) {
      // Redirect only after receiving confirmation from the server
      document.getElementById("message").innerHTML = this.responseText;
    }
  };
  xhttp.open('POST', 'savesession.php', true);
  xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhttp.send('apikey=' + encodeURIComponent(jsonString));
}

let servicePermissions = ["No Permission", "Execute only", "Write only", "Write and execute only", "Read only", "Read and execute only", "Read and write only","Read, write, and execute"];
function updatePermissions(value) {
    
    const dataToSend = {
        apikey: localStorage.getItem('apikey'),
        permissions: servicePermissions[value]
    };
     //convert data to JSON
     const jsonString =  JSON.stringify(dataToSend);
     // Create a new XMLHttpRequest object
     //send an XMLHttpRequest to a page save.php
     let xhttp = new XMLHttpRequest();
     xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                    //document.getElementById("permission").innerHTML = this.responseText;
                    getApiKey(localStorage.getItem('apikey'));
            }
        };
     // send the JSON string to PHP via POST 
     xhttp.open("POST", "permissions.php?", true);
     xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
     xhttp.send("data=" + encodeURIComponent(jsonString));
    }
        
    function update() {
        //const data = {
           // service: id,
           // permissions: value
        };
       // servicePermission.push(data);
    //}
</script>  

</body>
</html>
