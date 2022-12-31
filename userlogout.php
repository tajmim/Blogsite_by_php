<?php require_once"include/session.php" ?>
<?php require_once"include/functions.php" ?>


<?php 

   $_SESSION['visitor_name'] = Null;
   $_SESSION['visitor_id'] = Null;
   Redirect_to("userlogin.php");


 ?>