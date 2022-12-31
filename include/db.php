<!-- connecting with database -->

<?php

  $db = mysqli_connect('localhost','root','','blogsite');

  if($db){
    //echo "connected";
  }else{
    echo "not connected";
  }

?>



