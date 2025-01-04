<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>API Website</title>    
</head>

<body>
<?php include "topnav.php"; ?>
<div class="content">
    <?php
    
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        switch ($page) {
            case 'home':
                include 'views/inc.home.php';
                break;
            case 'login':
                    include 'views/inc.login.php';
                break;   
            case 'register':
                    include 'views/inc.register.php';
                break;        
            case 'about':
                include 'views/inc.about.php';
                break;   
            case 'contact':
                 include 'views/inc.contact.php';
                 break;  
            case 'services':
                include 'views/inc.services.php';
                break; 
            case 'payouts':
                include 'views/inc.payouts.php';
                break;   
            case 'transactions':
                include 'views/inc.transactions.php';
                break; 
            case 'revenues':
                    include 'views/inc.revenues.php';
                break; 
            case 'api':
                    include 'views/inc.api.php';
                break;     
            case 'forgotpassword':
                include 'views/inc.forgotpassword.php';
                break;                    
            case 'resetpassword':
                include 'views/inc.resetpassword.php';
                break;
            case 'editapi':
                    include 'views/inc.editapi.php';
                    break;    
            case 'info':
                include 'views/info.php';
                break;    
            
            case 'local':
                include 'views/inc.local.php';
                break;                                  
                
            
            default:
                echo "<h1>404 Not Found</h1>";
                break;
        }
    }
    ?>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

