
<?php 
//session_start();
require "./controllers/dataproceduralconn.php";
?>
<html>
    <body>
        <?php

            // select the services from the KeyServices table
            $conn = new Database();
            $conn->getServices();

        ?>
          
    </body>
</html>


