
<!DOCTYPE html>
<html>
<head>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<script>
        function generateApiKey() {
            // Create a new XMLHttpRequest object
            var xhttp = new XMLHttpRequest();

            // Define a callback function to handle the server response
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // On success, display the generated API key in the input field
                    
                    document.getElementById('displayApiKey').value = this.responseText;
                    
                  }
            };

            // Open a POST request to the server-side script
            xhttp.open("POST", "generateApikey.php", true);
            // Send the request
            xhttp.send();
        }           
    </script>
</head>
<body>
  <?php
  $email = $_SESSION['userEmail'];
  echo "<h2>APi Page</h2>";
  echo "<h3> Hi!  $email </h2>";
  ?>
<div>
  <p id="listServices"></p>
</div>
<div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
<form  action="">
        <button type="button" onclick="generateApiKey()">Generate API Key</button>
        <br><br>
        <!-- Input field to display the generated API key -->
        <input name="key" type="text" id="displayApiKey" readonly>
        <br>
        <div class="navbar">
        <a href="index.php?page=services">Services</a>
        </div>
    </form>
</div>
  </div> 
  
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
  </body>
</html>