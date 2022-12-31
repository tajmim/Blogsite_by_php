
<?php require_once"db.php" ?>

<?php 

function redirect_to($new_location){
	header("Location:".$new_location);
    exit();
}


// function to verify if username and password match with database for admin 

function Admin_Login_Attempt($username,$pass){
  $query="SELECT * FROM registration WHERE name ='$username' and password ='$pass';";
  $result=mysqli_query(mysqli_connect('localhost','root','','blogsite'),$query);
  $admin=mysqli_fetch_assoc($result);
  if($admin){
    return $admin;
  }else{
    return null;
  }
    
}

// function to verify if username and password match with database for users

function user_login_attempt($name,$pass){
  $query = "select * from users where username = '$name' and password = '$pass';";
  $result=mysqli_query(mysqli_connect('localhost','root','','blogsite'),$query);
   $user=mysqli_fetch_assoc($result);
   if($user){
    return $user;
   }else{
    return null;
   }
}






function loginck(){
    if(!$_SESSION['user_name']){
        $_SESSION['Errormessage']="login required";
        Redirect_to("login.php");
        exit();
    }
}




 ?>