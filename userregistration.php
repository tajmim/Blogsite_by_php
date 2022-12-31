<?php require_once"include/db.php" ?>
<?php require_once"include/session.php" ?>
<?php require_once"include/functions.php" ?>


<!-- put data to database -->
<?php 
	if(isset($_POST['add-user'])){
		$username = $_POST['username'];
		$email = $_POST['email'];
		$contact = $_POST['phone'];
		$pass = $_POST['password'];
		$c_password = $_POST['confirm_password'];
		include 'datetime.php';
		$DateTime = $DateTime;
		


		$query = "insert into users(date,username,phone_no,email,password) Values('$DateTime','$username','$contact','$email','$pass')";

		$queryforemail = "select count(*) from users where email = '$email'";
		$querymail = mysqli_query($db,$queryforemail);
		 $total_found = mysqli_fetch_array($querymail);
		 $final_found= array_shift($total_found);
		if($final_found>0){ 
				$_SESSION['Errormessage'] = "this email already has taken";
    		Redirect_to("userregistration.php");
		}elseif(empty($username)||empty($pass)||empty($email)||empty($contact)||empty($c_password)){
    		$_SESSION['Errormessage'] = "please fill all the fields";
    		Redirect_to("userregistration.php");
    	}elseif(strlen($pass)<5){
    		$_SESSION['Errormessage'] = "At least charecters 5 password are required";
    		Redirect_to("userregistration.php");
    	}elseif($pass!==$c_password){
    		$_SESSION['Errormessage'] = "password/confirm password is not same";
    		Redirect_to("userregistration.php");

    	}
    	else{

    		$add_query = mysqli_query($db , $query);
    		if($add_query){
				$_SESSION['Successmessage'] = "user added successfully";
				Redirect_to("userregistration.php");
    		}else{
	    		$_SESSION['Errormessage'] = "user can't add";
	    		Redirect_to("userregistration.php");
    	}
    	
    	}

    	

	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Dashboard</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/frontstyle.css">
	<!-- font awesome -->
	<script src="https://kit.fontawesome.com/3633084ced.js" crossorigin="anonymous"></script>

	<script src="js/bootstrap.min.js"></script>

	<style type="text/css">
		
	</style>
</head>
<body style="background:white;">

	<div style="height: 10px;background: #ddd;"></div>
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

		<br><br><br> 
		<div class="row">
			
			<!-- Ending of side area -->


			<div class="col-sm-4 offset-4">
				<h2 class="text-center">Register a new Account</h2>
				<br><br>

				<div><?php 
				echo message(); 
				echo Successmessage(); 
				?></div>
				
				<form action="userregistration.php" method="POST" enctype="multipart/form-data">

	                <div class="mb-3 row">
	                  <label for="username" class="form-label col-sm-3"><span class="FieldInfo">Username :</span></label>
	                  <input type="text" class="form-control col" id="username" placeholder="username" name="username">
	                </div>

	                <div class="mb-3 row">
	                  <label for="email" class="form-label col-sm-3"><span class="FieldInfo">email :</span></label>
	                  <input type="email" class="form-control col" id="email" placeholder="email" name="email">
	                </div>
	                <div class="mb-3 row">
	                  <label for="phone" class="form-label col-sm-3"><span class="FieldInfo">phone no :</span></label>
	                  <input type="text" class="form-control col" id="phone" placeholder="01*********" name="phone">
	                </div>

	                <div class="mb-3 row">
	                  <label for="password" class="form-label col-sm-3"><span class="FieldInfo">Password :</span></label>
	                  <input type="password" class="form-control col" id="password" placeholder="password" name="password">
	                </div>

	                <div class="mb-3 row">
	                  <label for="confirm_password" class="form-label col-sm-3"><span class="FieldInfo">Confirm password :</span></label>
	                  <input type="password" class="form-control col" id="confirm_password" placeholder="Retype same password" name="confirm_password">
	                </div>

	                 <div class="mb-3">
	                  <input style="width:100%" type="submit" class="btn btn-primary" value="register" name="add-user">
                	</div>
				</form>

				<p class="text-center">Allready have an account? <a href="userlogin.php">Log in</a></p>

				
				

			</div>
		</div>
	</div>

	
</body>
</html>