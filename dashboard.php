<?php require_once"include/db.php" ?>
<?php require_once"include/session.php" ?>
<?php require_once"include/functions.php" ?>
<?php loginck(); ?>



<!-- delete post from databse -->
<?php 

if(isset($_GET['deleteid'])){
	$dltid = $_GET['deleteid'];

	$query = "select * from posts where id = $dltid";
	$result = mysqli_query($db,$query);

		while ($row=mysqli_fetch_assoc($result)) {
          $post_image = $row['image'];


				}
		$file = "Upload/".$post_image;

		if (file_exists($file)) {
    	unlink($file);
		}


	$query = "DELETE FROM posts WHERE id = $dltid";

	$dlt_query = mysqli_query($db,$query);

	if($dlt_query){
		$_SESSION['Successmessage'] = "post deleted successfully";
		Redirect_to("dashboard.php");
	}
	else{

		$_SESSION['Errormessage'] = "post deleted successfully";
		Redirect_to("dashboard.php");
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
					    <a class="nav-link active" href="dashboard.php"><i class="fa-solid fa-house-user"></i> Dashboard</a>
					  </li>
					  <li class="">
					    <a class="nav-link" href="addnewpost.php"><i class="fa-sharp fa-solid fa-plus"></i> Add New Post</a>
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
					    <a class="nav-link" href="adminpasschange.php"><i class="fa-solid fa-right-from-bracket"></i> Change password</a>
					  </li>
					  <li class="">
					    <a class="nav-link" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Log Out</a>
					  </li>
					  
					  
				</ul>
			</div>
			<!-- Ending of side area -->

			<div class="col-sm-10">
				<h1>Admin Dashboard</h1>

				<div><?php 
				echo message(); 
				echo Successmessage(); 
				?></div>


				<h4>post table</h4>

				<div class="table-responsive">
					<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>serial no</th>
							<th>Date</th>
							<th>Title</th>
							<th>Category</th>
							<th>Author</th>
							<th>Image</th>
							<th>Comments</th>
							<th>Action</th>
							<th>Details</th>
						</tr>
					</thead>
					<tbody>

					<?php 

                    $read_query = "select * from posts order by datetime desc";
                    $sirial = 0;
                    $result = mysqli_query($db,$read_query);
                    while($row = mysqli_fetch_assoc($result)){

                      $post_id = $row['id'];
                      $post_date = $row['datetime'];
                      $post_title = $row['title'];
                      $post_cat = $row['category'];
                      $author = $row['author'];
                      $post_image = $row['image'];


                      $sirial = $sirial+1;
                   ?>


						<tr>
							<td><?php echo $sirial ?></td>
							<td><?php echo $post_date ?></td>
							<td>
								<?php 
								if(strlen($post_title)>30){
    							$post_title = substr($post_title, 0,30);
    						}
								echo $post_title ?>
									
							</td>
							<td><?php echo $post_cat ?></td>
							<td><?php echo $author ?></td>
							<td><img src="Upload/<?php echo $post_image ?>" width="100px"></td>
							<td>
								



								<?php 
								$count_disapp_query="SELECT COUNT(*) FROM comments WHERE post_no = $post_id and status = 'OFF'";

								 $query = mysqli_query($db,$count_disapp_query);
								 $result_disapp = mysqli_fetch_array($query);
								 $total_disapp = array_shift($result_disapp);



								$count_disapp_query="SELECT COUNT(*) FROM comments WHERE post_no = $post_id and status = 'ON'";

								 $query = mysqli_query($db,$count_disapp_query);
								 $result_app = mysqli_fetch_array($query);
								 $total_app = array_shift($result_app);


								 ?>

								 <a href="" class="btn btn-danger"><?php echo $total_disapp; ?></a>
								 <a href="" class="btn btn-success"><?php echo $total_app; ?></a>


							</td>
							<td>
								<a href="editpost.php?editid=<?php echo $post_id ?>" class="btn btn-warning">edit</a>
								<a href="dashboard.php?deleteid=<?php echo $post_id ?>" class="btn btn-danger">delete</a>

							</td>
							<td><a href="fullPost.php?postid=<?php echo $post_id; ?>" target="_blank" class="btn btn-info">live preview</a></td>
						</tr>

					<?php } ?>
					</tbody>
				</table>
				

			</div>
		</div>
	</div>

	<div id="footer">
		<hr>
		<p>theme by | devdream team | 2022 - 2023 | -- All right reserved|</p>
		<a href="" style="color: whitesmoke; text-decoration:none;">
			<p>This site is only for study purpose tanha.com have all the rights. no one is allow to distribute copies other then  devdream team </p>
		</a>
		<hr>
	</div>

</body>
</html>