<?php require_once"include/db.php" ?>
<?php require_once"include/session.php" ?>
<?php require_once"include/functions.php" ?>




<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';


// recieve email from form
if(isset($_POST['sendotp'])){

    $mailto = $_POST['email'];
    $_SESSION['fmail'] = $mailto;
    $_SESSION['otp'] = rand(10000,99999);
    $otp = $_SESSION['otp'];


    $sql = "SELECT COUNT(*) FROM users WHERE email = '$mailto'";
    $result = mysqli_query($db,$sql);
    $mail_found = mysqli_fetch_array($result);
    $mail_found = array_shift($mail_found);
    if($mail_found<1){
        $_SESSION['Errormessage'] = "Your mail is not registerd";
        Redirect_to("forgotpassword.php");
    }

}













//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = false;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp-mail.outlook.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'stajmimtanha@outlook.com';                     //SMTP username
    $mail->Password   = 'tajmimtanha99@@';                               //SMTP password
    $mail->SMTPSecure = 'TLS';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('stajmimtanha@outlook.com', 'tanha');
    $mail->addAddress($mailto, 'atik');     

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Dear user';
    $mail->Body    = "your otp is {$otp} Dont share it with any one}";
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    Redirect_to("putotp.php");
} catch (Exception $e) {
    $_SESSION['Errormessage'] = "Message could not be sent to {$mailto}. Mailer Error: {$mail->ErrorInfo}";
    Redirect_to("forgotpassword.php");
}