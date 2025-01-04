<!DOCTYPE html>
<html>
<head>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
    <body>
        <?php
        
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;

        //Load Composer's autoloader
        require 'vendor/autoload.php';

        
        require "./controllers/dataproceduralconn.php";
        require "token.php";

        

        $email = "";
        //$token = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                 
            $email = $_POST['email'];
            //find user by email
            $conn = new Database();
            $user= $conn->findUserByEmail($email);
            
            //var_dump($user);

            if ($user['businessid']) {
                $generateToken = new GenerateToken();
                // Create token
                $user_id = $user['businessid'];
                $token = $generateToken->createToken($user_id);
                //save token in the datbase
                $conn->saveToken($user_id, $token);
                //close connection
                $conn->close_connection();

                //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'otocomputing@gmail.com';                     //SMTP username
                $mail->Password   = 'noqvbacrxwimdagi';                               //SMTP password
                $mail->SMTPSecure = 'ssl'; 
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('otocomputing@gmail.com', 'Mailer');
                $mail->addAddress($email, 'Dear ' . $email);     //Add a recipient
                //$mail->addAddress('ellen@example.com');               //Name is optional
                //$mail->addReplyTo('info@example.com', 'Information');
                //$mail->addCC('cc@example.com');
                //$mail->addBCC('bcc@example.com');

                //Attachments
                //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Password Reset Request';
                $mail->Body = "Please click on the link below to reset your password: <a href='http://localhost/php-practice/simple-api/index.php?page=resetpassword&token=" . urlencode($token) . "'>Reset Password</a>";

                $mail->AltBody = "Please click the following link to reset your password: 'http://localhost/php-practice/simple-api/index.php?page=resetpassword&token=$token";

                $mail->send();
                echo 'Email reset link has been sent to your email';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

                
            }
            
           
        }
        ?>
        <h2>Please enter your Email to reset your password</h2>
        <div class="flex-container">
        
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . "?page=forgotpassword");?>" >
        <input type="text" name="email" value="<?php echo $email ?>" placeholder="Please Enter your email" required>
        <input type="submit" name="submit">
        </form>
        </div>
        
    </body>
</htm>