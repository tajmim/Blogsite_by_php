<?php require_once"include/db.php" ?>
<?php require_once"include/session.php" ?>
<?php require_once"include/functions.php" ?>


<?php 

if(isset($_SESSION['user_name'])){
	Redirect_to("dashboard.php");

}


 ?>



<?php 

if(isset($_POST['login'])){
	$username=$_POST['username'];
	$pass=$_POST['password'];
	if(empty($username)||empty($pass)){
		$_SESSION['Errormessage'] = "pleasefill all the fields";
		Redirect_to("login.php");
	}else{
		$found_account = Admin_Login_Attempt($username,$pass);
		if($found_account){
			$_SESSION['user_id'] = $found_account['id'];
    	$_SESSION['user_name'] = $found_account['name'];
    	$_SESSION['Successmessage']="Dear {$_SESSION['user_name']}, you have login successfully";
    	Redirect_to("dashboard.php");
		}else{
			$_SESSION['Errormessage'] = "invalid username/password";
 		  Redirect_to("login.php");
		}
	}
}


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin LOG IN</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/frontstyle.css">
	<!-- font awesome -->
	<script src="https://kit.fontawesome.com/3633084ced.js" crossorigin="anonymous"></script>

	<script src="js/bootstrap.min.js"></script>

	<style type="text/css">
		body{

			background-color: #fff;
		}

		input{
			font-size: 20px !important;
			padding: 10px 15px !important;
		}



	</style>
</head>
<body>

	<div style="height: 10px; background: #ddd;"></div>
    <nav class="navbar navbar-expand-lg bg-light">
      <div class="container">
         <a class="navbar-brand" href="#"><img src="images/LOGO.png" width="250px"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">

            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="blog.php">Blog</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="#">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="#">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="#">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="#">Feature</a>
            </li>
          </ul>
          <form class="d-flex" role="search" action="blog.php" method="POST">
	        <input class="form-control me-2" type="text" placeholder="Search" aria-label="Search" name="search-topic">
	        <button class="btn btn-outline-success" type="submit" name="search-btn">Search</button>
	      </form>
        </div>
      </div>
    </nav> 
	<div style="height: 10px; background: #ddd;"></div>


	<div class="container-fluid">
		<div class="row">
			
			<!-- Ending of side area -->


			<div class="col-sm-4 offset-4">
				<br><br><br><br><br>
				<h2 class="text-center mb-4">Admin Log In</h2>

				<div><?php 
				echo message(); 
				echo Successmessage(); 
				?></div>
				
				<form action="login.php" method="POST" enctype="multipart/form-data">

	                <div class="mb-3">
	                  <label for="username" class="form-label"><span class="FieldInfo">Username :</span></label>
	                  <div class="input-group">
	                  	<div class="input-group-text"><i class="fa-regular fa-envelope"></i></div>
	                  	<input type="text" class="form-control" id="username" placeholder="username" name="username">
	                  </div> 
	                </div>
	                <div class="mb-3">
	                  <label for="password" class="form-label"><span class="FieldInfo">Password :</span></label>
	                  <div class="input-group">
	                  	<div class="input-group-text"><i class="fa-sharp fa-solid fa-lock-keyhole"></i>></div>
	                  	<input type="password" class="form-control" id="username" placeholder="password" name="password">
	                  </div> 
	                </div>
	                 <div class="mb-3">
	                  <input style="width:100%" type="submit" class="btn btn-primary" value="log in" name="login">
                	</div>
				</form>

				

			</div>
		</div>
	</div>


</body>
</html>