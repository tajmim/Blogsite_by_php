<?php require_once"include/db.php" ?>
<?php require_once"include/session.php" ?>
<?php require_once"include/functions.php" ?>
<?php loginck(); ?>

<!-- put data to database -->
<?php 
	if(isset($_POST['add-category'])){
		$catname = $_POST['name'];
		include 'datetime.php';
		$DateTime = $DateTime;
		$Admin = $_SESSION['user_name'];

		$query = "insert into category(datetime,name,creatorname) Values('$DateTime','$catname','$Admin')";

    	

    	if(empty($catname)){
    		$_SESSION['Errormessage'] = "please fill all the fields";
    		Redirect_to("categories.php");
    	}elseif(strlen($catname)>99){
    		$_SESSION['Errormessage'] = "category name should be less than 100 charecters";
    		Redirect_to("categories.php");
    	}else{

    		$add_query = mysqli_query($db , $query);
    		if($add_query){
				$_SESSION['Successmessage'] = "category added successfully";
				Redirect_to("categories.php");
    		}else{
	    		$_SESSION['Errormessage'] = "category can't add";
	    		Redirect_to("categories.php");
    	}
    	
    	}

    	

	}


// delete categories from database
	if (isset($_GET['deleteid'])){
		$del_id=$_GET['deleteid'];
		$query="DELETE from category WHERE id=$del_id;";
		$del_query=mysqli_query($db,$query);
		if($del_query){
				$_SESSION['Successmessage'] = "category deleted successfully";
				Redirect_to("categories.php");
    		}else{
	    		$_SESSION['Errormessage'] = "category can't delete";
	    		Redirect_to("categories.php");
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
					    <a class="nav-link" href="addnewpost.php"><i class="fa-sharp fa-solid fa-plus"></i> Add New Post</a>
					  </li>
					  <li class="">
					    <a class="nav-link active" href="categories.php"><i class="fa-solid fa-tags"></i> Categories</a>
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
					    <a class="nav-link" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Log Out</a>
					  </li>
					  
					  
				</ul>
			</div>
			<!-- Ending of side area -->


			<div class="col-sm-10">
				<h4>Manage categories</h4>

				<div><?php 
				echo message(); 
				echo Successmessage(); 
				?></div>
				
				<form action="categories.php" method="POST" enctype="multipart/form-data">

	                <div class="mb-3">
	                  <label for="name" class="form-label"><span class="FieldInfo">Name :</span></label>
	                  <input type="text" class="form-control" id="name" placeholder="category Name" name="name">
	                </div>

	                 <div class="mb-3">
	                  <input type="submit" class="btn btn-primary" value="add new category" name="add-category">
                	</div>
				</form>

				<h4>categories table</h4>

				<div class="table-responsive">
					<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>serial no</th>
							<th>Added by</th>
							<th>Category name</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

					<?php 

                    $read_query = "select * from category order by datetime desc";
                    $sirial = 0;
                    $result = mysqli_query($db,$read_query);
                    while($row = mysqli_fetch_assoc($result)){

                      $cat_id = $row['id'];
                      $cat_name = $row['name'];
                      $cat_date = $row['datetime'];
                      $crt_name = $row['creatorname'];
                      $sirial = $sirial+1;
                   ?>


						<tr>
							<td><?php echo $sirial ?></td>
							<td><?php echo $crt_name ?></td>
							<td><?php echo $cat_name ?></td>
							<td><?php echo $cat_date ?></td>
							<td><a href="categories.php?deleteid=<?php echo $cat_id ?>" class="btn btn-success" >Delete</a></td>
						</tr>

					<?php } ?>
					</tbody>
				</table>
				</div>

			</div>
		</div>
	</div>

	<div id="footer">
		<hr>
		<p>theme by | tanha | 2022 - 2023 | -- All right reserved|</p>
		<a href="" style="color: whitesmoke; text-decoration:none;">
			<p>This site is only for study purpose tanha.com have all the rights. no one is allow to distribute copies other then  tanha.com </p>
		</a>
		<hr>
	</div>

</body>
</html>