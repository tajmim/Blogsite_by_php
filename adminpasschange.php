<?php require_once"include/db.php" ?>
<?php require_once"include/session.php" ?>
<?php require_once"include/functions.php" ?>
<?php loginck(); ?>





<?php 

if(isset($_POST['passchange'])){
	$old_password = $_POST['old_pass'];
	$new_password = $_POST['new_pass'];
	$retype_password = $_POST['retype_pass'];
	$user_id = $_SESSION['user_id'];


		$query = "SELECT password FROM registration WHERE id = $user_id ";
		$find_pass = mysqli_query($db,$query);
		$find_pass = mysqli_fetch_array($find_pass);
		$find_pass = array_shift($find_pass);
		
		if($old_password == $find_pass){
			
									if($new_password == $retype_password){

										$query = "UPDATE registration SET password = '$new_password' WHERE id = $user_id";
										$change_query = mysqli_query($db , $query);
										$_SESSION['Successmessage'] = "Password change successfully";
										Redirect_to("dashboard.php");
									}else{
										$_SESSION['Errormessage'] = "new password and retype password doesn't match";
										Redirect_to("adminpasschange.php");
									}

		}else{
			$_SESSION['Errormessage'] = "old password is incorrect";
				Redirect_to("adminpasschange.php");
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
	<div style="height: 10px; background: #ddd;"></div>s


	<div class="container-fluid">
		<div class="row">
			
			<!-- Ending of side area -->


			<div class="col-sm-4 offset-4">
				<br><br><br><br>
				<h2 class="text-center mb-4">Change Password</h2>

				<div><?php 
				echo message(); 
				echo Successmessage(); 
				?></div>
				
				<form action="adminpasschange.php" method="POST" enctype="multipart/form-data">

	                <div class="mb-3">
	                  <label for="old_pass" class="form-label"><span class="FieldInfo">Old password</span></label>
	                  <div class="input-group">
	                  	<div class="input-group-text"><i class="fa-regular fa-envelope"></i></div>
	                  	<input type="password" class="form-control" id="old_pass" placeholder="old password" name="old_pass">
	                  </div> 
	                </div>
	                <div class="mb-3">
	                  <label for="new_pass" class="form-label"><span class="FieldInfo">New password</span></label>
	                  <div class="input-group">
	                  	<div class="input-group-text"><i class="fa-regular fa-envelope"></i></div>
	                  	<input type="password" class="form-control" id="new_pass" placeholder="new password" name="new_pass">
	                  </div> 
	                </div>
	                <div class="mb-3">
	                  <label for="retype_pass" class="form-label"><span class="FieldInfo">Retype password</span></label>
	                  <div class="input-group">
	                  	<div class="input-group-text"><i class="fa-regular fa-envelope"></i></div>
	                  	<input type="password" class="form-control" id="retype_pass" placeholder="retype password" name="retype_pass">
	                  </div> 
	                </div>
	                 <div class="mb-3">
	                  <input style="width:100%" type="submit" class="btn btn-primary" value="Change password" name="passchange">
                	</div>
				</form>

				

			</div>
		</div>
	</div>


</body>
</html>