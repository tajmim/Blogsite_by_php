<?php require_once"include/db.php" ?>
<?php require_once"include/session.php" ?>
<?php require_once"include/functions.php" ?>
<?php loginck(); ?>


<!-- put data to database -->
<?php 
	if(isset($_POST['add-post'])){
		$title = $_POST['title'];
		include 'datetime.php';
		$DateTime = $DateTime;
		$catname = $_POST['category'];
		$post_des = $_POST['post'];
		$Admin =  $_SESSION['user_name'];

		$Image = $_FILES['image']['name'];
		$Target = "Upload/".basename($_FILES['image']['name']);

		$query = "insert into posts(datetime,title,category,author,image,post) Values('$DateTime','$title','$catname','$Admin','$Image','$post_des')";

    	

    	if(empty($title)){
    		$_SESSION['Errormessage'] = "please fill all the fields";
    		Redirect_to("addnewpost.php");
    	}elseif(strlen($title)<2){
    		$_SESSION['Errormessage'] = "title should be at least 2 Character";
    		Redirect_to("addnewpost.php");
    	}else{

    		$add_query = mysqli_query($db , $query);
    		move_uploaded_file($_FILES['image']['tmp_name'],$Target);

    		if($add_query){
				$_SESSION['Successmessage'] = "post added successfully";
				Redirect_to("addnewpost.php");
    		}else{
	    		$_SESSION['Errormessage'] = "post can't add";
	    		Redirect_to("addnewpost.php");
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
	<link rel="stylesheet" type="text/css" href="css/adminstyle.css">
	<!-- font awesome -->
	<script src="https://kit.fontawesome.com/3633084ced.js" crossorigin="anonymous"></script>

	<script src="js/bootstrap.min.js"></script>

	<style type="text/css">
		
	</style>
</head>
<body>

<div style="height: 10px; background: #ddd;"></div>
    <nav class="navbar navbar-expand-lg bg-dark">
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
			<div class="col-sm-2">

				<ul style="margin-top:20px" id="sidebar" class="nav nav-pills flex-column">
					  <li class="nav-item">
					    <a class="nav-link" href="dashboard.php"><i class="fa-solid fa-house-user"></i> Dashboard</a>
					  </li>
					  <li class="">
					    <a class="nav-link active" href="addnewpost.php"><i class="fa-sharp fa-solid fa-plus"></i> Add New Post</a>
					  </li>
					  <li class="">
					    <a class="nav-link" href="categories.php"><i class="fa-solid fa-tags"></i> Categories</a>
					  </li>
					  <li class="">
					    <a class="nav-link" href="admin.php"><i class="fa-sharp fa-solid fa-user"></i> Manage Admins</a>
					  </li>
					  <li class="">
					    <a class="nav-link" href="comments.php"><i class="fa-regular fa-comments"></i> Comments
					    	<?php 

					    	$count_disapp_query="SELECT COUNT(*) FROM comments WHERE status = 'OFF'";

								 $query = mysqli_query($db,$count_disapp_query);
								 $result_disapp = mysqli_fetch_array($query);
								 $total_disapp = array_shift($result_disapp);
					    	 ?>
					    	 <span class="label label-danger" style="color:white;background-color: red;border-radius: 5px;font-size: 12px;padding-top: 3px;padding-bottom: 3px;padding-left: 5px;padding-right: 5px"><?php echo $total_disapp ?></span>




					    </a>
					  </li>
					  <li class="">
					    <a class="nav-link" href="blog.php"><i class="fa-solid fa-blog"></i> live Blog</a>
					  </li>
					  <li class="">
					    <a class="nav-link" href=""><i class="fa-solid fa-right-from-bracket"></i> Log Out</a>
					  </li>
					  
					  
				</ul>
			</div>
			<!-- Ending of side area -->


			<div class="col-sm-10">
				<h4>Add New Post</h4>

				<div><?php 
				echo message(); 
				echo Successmessage(); 
				?></div>
				
				<form action="addnewpost.php" method="POST" enctype="multipart/form-data">

	                <div class="mb-3">
	                  <label for="title" class="form-label"><span class="FieldInfo">Title :</span></label>
	                  <input type="text" class="form-control" id="title" placeholder="title" name="title">
	                </div>

	                <div class="mb-3">
	                  <label for="category" class="form-label"><span class="FieldInfo">Category :</span></label>
	                  <select type="text" class="form-control" id="category" placeholder="category" name="category">


	                  <?php 

                    $read_query = "select * from category order by datetime desc";
                    
                    $result = mysqli_query($db,$read_query);
                    while($row = mysqli_fetch_assoc($result)){

                      $cat_id = $row['id'];
                      $cat_name = $row['name'];
                      
                   ?>
                   <option><?php echo $cat_name; ?></option>
                 <?php } ?>
                 </select>

	                </div>

	                <div class="mb-3">
	                  <label for="image" class="form-label"><span class="FieldInfo">image :</span></label>
	                  <input type="File" class="form-control" id="image" placeholder="image" name="image">
	                </div>

	                <div class="mb-3">
	                  <label for="post" class="form-label"><span class="FieldInfo">post :</span></label>
	                  <textarea type="text" class="form-control" id="post" placeholder="post" name="post"></textarea>
	                </div>

	                 <div class="mb-3">
	                  <input type="submit" class="btn btn-primary" value="add new post" name="add-post">
                	</div>
				</form>

				
				</div>

			</div>
		</div>
	</div>

	<div id="footer">
		<hr>
		<p>theme by | devdream team | 2022 - 2023 | -- All right reserved|</p>
		<a href="" style="color: whitesmoke; text-decoration:none;">
			<p>This site is only for study purpose tanha.com have all the rights. no one is allow to distribute copies other than devdream team </p>
		</a>
		<hr>
	</div>

</body>
</html>