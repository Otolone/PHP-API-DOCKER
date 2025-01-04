  <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Store and Retrieve Email</title>
  </head>
  <body>
    
    

    <script>
      // Function to save email to local storage
      function saveEmail() {
        const email = document.getElementById("email").value;
        if (email) {
          localStorage.setItem("userEmail", email);
          alert("Email saved locally!");
        } else {
          alert("Please enter a valid email.");
        }
      }

      // Function to retrieve email from local storage
      function retrieveEmail() {
        const email = localStorage.getItem("userEmail");
        if (email) {
          document.getElementById("displayEmail").textContent =
            "Saved Email: " + email;
        } else {
          document.getElementById("displayEmail").textContent =
            "No email found in local storage.";
        }
      }
    </script>
  </body>
</html>

 
 
 
 
 <!--<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Store and Retrieve Email</title>
  </head>
  <body>
    <h2>Store and Retrieve Email in Local Storage</h2>

    <p id="displayEmail"></p>

    //Input field for email 
    <input type="email" id="email" placeholder="Enter your email" required />
    <button onclick="saveEmail()">Save Email Locally</button>
    <button onclick="retrieveEmail()">Retrieve Email</button>

    

    <script>
      // Function to save email to local storage
      function saveEmail() {
        const email = document.getElementById("email").value;
        if (email) {
          localStorage.setItem("userEmail", email);
          alert("Email saved locally!");
        } else {
          alert("Please enter a valid email.");
        }
      }

      // Function to retrieve email from local storage
      function retrieveEmail() {
        const email = localStorage.getItem("userEmail");
        if (email) {
          document.getElementById("displayEmail").textContent =
            "Saved Email: " + email;
        } else {
          document.getElementById("displayEmail").textContent =
            "No email found in local storage.";
        }
      }
    </script>
  </body>
</html>-->
