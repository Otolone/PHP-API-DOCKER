<!DOCTYPE html>
<html lang="en">
<head>
  <title>API Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Use only Bootstrap 5 files -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha384-xxxxxxxxxxxxxxxxxx" crossorigin="anonymous">

  
</head>
<body> 
<style>
  body {
      font-family: 'Arial', sans-serif;
      background-color: #f8f9fa;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 800px;
      margin: 40px auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
      font-size: 24px;
      font-weight: 600;
      margin-bottom: 20px;
      text-align: center;
    }

    .api-key-container, .action-buttons {
      display: flex;
      flex-direction: column;
      gap: 15px;
      margin-bottom: 20px;
    }

    .api-key-container input {
      background-color: #e9ecef;
      border: none;
      padding: 8px;
      border-radius: 5px;
      width: 100%;
      font-size: 16px;
    }

    .dropdown {
      margin-top: 15px;
    }

    .dropdown select {
      width: 100%;
      padding: 8px;
      border-radius: 5px;
      border: 1px solid #ced4da;
    }

    .action-buttons button {
      width: 100%;
      padding: 10px;
      border-radius: 5px;
    }

    @media (min-width: 768px) {
      .api-key-container, .action-buttons {
        flex-direction: row;
        justify-content: space-between;
        gap: 30px;
      }

      .action-buttons button {
        width: 48%;
      }
    }
  table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 18px;
    width: 80%;
    text-align: center;
}
th,td {
  padding: 5px;
  border: solid 1px;
}
</style>
<div class="container">
  <h2>API Keys</h2>
  
  <div class="api-key-container">
    <input type="text" id="apikey" name="apikey" placeholder="API Key" readonly>
    
    <div class="dropdown">
      <select id="services" name="services" onchange="selectService(this.value)">
        <option value="">Select a service</option>
        <option value="payment">Payment</option>
        <option value="booking">Booking</option>
        <option value="service1">Service 1</option>
        <option value="service2">Service 2</option>
        <option value="service3">Service 3</option>
        <option value="service4">Service 4</option>
      </select>
      <div id="listServices"></div>
    </div>
  </div>
  
  <div class="action-buttons">
  <button class="btn btn-primary" id = "apikey" value = "apikey" onclick ="generateApiKey(this.value)">Generate Key</button>
    <button class="btn btn-secondary" onclick="save()">Save</button>
  </div>
</div>


<div id="txtApiKey"></div>

<script>
var servicesArray= [];

var apiKeyIds = [];
var listServiceIds = [];

function updateApiKeys() {
  document.getElementById("txtApiKey").innerHTML = "";
  
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("txtApiKey").innerHTML = this.responseText;
  }
  xhttp.open("GET", "updateApiKeys.php?",true);
  xhttp.send();
}

window.onload = function (params) {
  updateApiKeys();  
}

function selectService(str) {
  if (str === "") {
    document.getElementById("listServices").innerHTML = "";
    return;
  }

  // Get the dropdown element
  var selectElement = document.getElementById("services");

  // Find and remove the selected option from the dropdown
  for (var i = 0; i < selectElement.options.length; i++) {
    if (selectElement.options[i].value === str) {
      // Add the selected option to the list of services
       servicesArray.push(str);
      //Remove it from the list of services
      selectElement.remove(i);
      break;
    }
  }

  // Update the displayed list of selected services
  updateServiceList();
}

function updateServiceList() {
  // Get 'listServices' div
  var serviceList = document.getElementById("listServices");
  serviceList.innerHTML = ""; // Clear existing list
  
  // Apply Bootstrap classes for vertical arrangement
  serviceList.className = "d-flex flex-column gap-2"; // Stacks the buttons vertically with spacing
 // create div to place button and icon horizontall
 

  servicesArray.forEach(function(service) {
    //create a div to place button and icon horizontally
    var divHorizontal = document.createElement('div');
    divHorizontal.className = "d-flex flex-row gap-2"
    // Create a button
    let serviceButton = document.createElement('button');    
    // Add Bootstrap classes to style the button
    serviceButton.className = "btn btn-primary";    
    // Set the name or/and value of the button
    serviceButton.textContent = service;
    serviceButton.value = service;
    
    // Append the button to the list
    divHorizontal.appendChild(serviceButton);
    
    // Create an inline element (delete icon)
    let inlineElement = document.createElement('i');
    
    // Style the inline element
    inlineElement.className = "fa fa-trash-o";
    inlineElement.style.color = "red";
    inlineElement.style.fontSize = '48px'; // Adjusted to 24px for better inline appearance
    
    // Set the value and attach click event
    inlineElement.value = service;
    inlineElement.onclick = function() {
      //alert('Service: ' + service)
      removeServices(service);
    };
    
    // Append the inline element to the service list
    divHorizontal.appendChild(inlineElement);
    //append the divHorzontalto serviceList
    serviceList.appendChild(divHorizontal);
  });
} 

function removeServices(service) {
    if (servicesArray.length > 0) {
    // Get the index of the element
    let index = servicesArray.indexOf(service);
    if (index !== -1) {
     let removedArray = servicesArray.splice(index, 1);
    if (removedArray[0] !== null) {
      // Add the removed service back to the dropdown
      var selectElement = document.getElementById('services');
      var newOption = document.createElement("option");
      newOption.value = removedArray[0];
      newOption.text = removedArray[0];
      selectElement.add(newOption);
    }
    }
    
  }

  // Clear the displayed list if no services are selected
  if (services.length < 1) {
    document.getElementById("listServices").innerHTML = "";
  } else {
    updateServiceList();
  }
}

function save() { 
  // get the apikey from the input
  const apiKey = document.getElementById('apikey').value;
  if (!apiKey || servicesArray.length === 0) {
    alert("You have to generate an API key and select services");
    return;    
  }
  //alert("Service array: " + servicesArray);
  //alert('Services array length: ' + servicesArray.length);
  //get the list of services from the services array
  const dataToSend = {
    apiKey: apiKey,
    services: servicesArray
  };
  //convert data to JSON
  const jsonString =  JSON.stringify(dataToSend);
  

  //send an XMLHttpRequest to a page save.php
  let xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    document.getElementById("listServices").innerHTML = this.responseText;
    updateApiKeys();
    window.location.href =  'index.php?page=api';
  }
  };

  // send the JSON string to PHP via POST   
  xhttp.open("POST", "save.php?", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("data=" + encodeURIComponent(jsonString));
  }

  function generateApiKey(value) {
      // Create a new XMLHttpRequest object
      var xhttp = new XMLHttpRequest();

      // Define a callback function to handle the server response
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          // On success, display the generated API key in the input field
          document.getElementById(value).value = this.responseText;
        }
      };

      // Open a POST request to the server-side script
      xhttp.open("POST", "generateapikey.php", true);
      // Send the request
      xhttp.send();
    }
    
    
    
 //script to edit the api
 function editApiKey(value) { 

  localStorage.setItem("apikey", value);
  window.location.href = 'index.php?page=editapi';

  /*const dataToSend = {
    apiKey: value,
  };
  
  //convert data to JSON
  const jsonString =  JSON.stringify(dataToSend);

  // Create a new XMLHttpRequest object
  const xhttp = new XMLHttpRequest();

  // Define a callback function to handle the server response
  xhttp.onreadystatechange = function () {
    if (this.readyState === 4 && this.status === 200) {
      // Redirect only after receiving confirmation from the server
      console.log('Server response: ' + this.responseText);
      if(this.responseText.includes('API Key saved')){
        window.location.href = 'index.php?page=editapi';
      }
      else {
        alert('Error saving API Key: ' + this.responseText);
      }
      
    }
  };
  xhttp.open('POST', 'savesession.php', true);
  xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhttp.send('apikey=' + encodeURIComponent(jsonString));
   */ 
}
function deleteApiKey(value) {
    //get the list of services from the services array
  const dataToSend = {
    apikey: value
  };
  //convert data to JSON
  const jsonString =  JSON.stringify(dataToSend);
  

  //send an XMLHttpRequest to a page delete.php
  let xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    updateApiKeys();
  }
  };

  // send the JSON string to PHP via POST   
  xhttp.open("POST", "delete.php?", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("delete=" + encodeURIComponent(jsonString));
  }
</script>
</body>
</html>
