<?php require_once"include/db.php" ?>
<?php require_once"include/session.php" ?>
<?php require_once"include/functions.php" ?>

<?php 
	

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';




 ?>



<?php 
	if(isset($_POST['sendotp'])){
		$forgoten_email = $_POST['email'];

		$queryforemail = "select count(*) from users where email = '$forgoten_email'";
		$querymail = mysqli_query($db,$queryforemail);
		 $total_found = mysqli_fetch_array($querymail);
		 $final_found= array_shift($total_found);
		if($final_found>0){ 

			// ----------------------------
				// code for send otp	 app pass: dbasdrhttyfudzds
			// ----------------------------

		$email = 'stajmimtanha@gmail.com';
		$password = 'tanha99@@';

		// Set up the email
		$mail = new PHPMailer();
		$mail->isSMTP();
		$mail->SMTPDebug = 2;
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 587;
		$mail->SMTPSecure = 'tls';
		$mail->SMTPAuth = true;
		$mail->Username = $email;
		$mail->Password = $password;
		$mail->setFrom($email, 'BLOGSITE');
		$mail->addAddress($forgoten_email, 'someone');
		$mail->Subject = 'PHPMailer GMail SMTP test';
		$mail->Body = 'This is a test email sent with PHPMailer using the GMail SMTP server.';

		// Send the email
		if (!$mail->send()) {
		    echo "Error: {$mail->ErrorInfo}";
		} else {
		    echo "Email sent!";
		}


	}
}




 ?>