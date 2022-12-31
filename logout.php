<?php require_once"include/session.php" ?>
<?php require_once"include/functions.php" ?>


<?php 

   $_SESSION['user_name'] = Null;
   $_SESSION['user_id'] = Null;
   Redirect_to("login.php");


 ?>