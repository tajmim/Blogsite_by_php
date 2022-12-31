<?php require_once"include/db.php" ?>
<?php require_once"include/session.php" ?>
<?php require_once"include/functions.php" ?>
<?php loginck(); ?>




<!-- apprv comment from databse -->

<?php 
if(isset($_GET['app_commentid'])){
	$app_id= $_GET['app_commentid'];
	$query = "UPDATE comments SET status = 'ON' where id = $app_id";
	$update_query=mysqli_query($db,$query);
	if ($update_query) {
		Redirect_to("Comments.php");
	}else{
		Redirect_to("Comments.php");
	}
}

 ?>

 <!-- disapprv comments from database -->

<?php 
if (isset($_GET['dis_app_commentid'])){

	$dis_app_id= $_GET['dis_app_commentid'];
	$query = "UPDATE comments SET status = 'OFF' where id = $dis_app_id";
	$update_query=mysqli_query($db,$query);
	if ($update_query) {
		Redirect_to("Comments.php");
	}else{
		Redirect_to("Comments.php");
	}
}	
 ?>


 <!-- delete comment from database -->

<?php 
if (isset($_GET['del_commentid'])){

	$commentid= $_GET['del_commentid'];
	$query = "DELETE FROM comments WHERE id = $commentid";
	$update_query=mysqli_query($db,$query);
	if ($update_query) {
		Redirect_to("Comments.php");
	}else{
		Redirect_to("Comments.php");
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
					    <a class="nav-link" href="categories.php"><i class="fa-solid fa-tags"></i> Categories</a>
					  </li>
					  <li class="">
					    <a class="nav-link" href="admin.php"><i class="fa-sharp fa-solid fa-user"></i> Manage Admins</a>
					  </li>
					  <li class="">
					    <a class="nav-link active" href="comments.php"><i class="fa-regular fa-comments"></i> Comments
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
				<h1>Manage comments</h1>

								<h4>Un-Approved comments table</h4>

				<div class="table-responsive">
					<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>serial no</th>
							<th>Name</th>
							<th>Date</th>
							<th>Comment</th>
							<th>Approve</th>
							<th>Delete</th>
							<th>Details</th>
						</tr>
					</thead>
					<tbody>

					<?php 

                    $read_query = "select * from comments where status = 'OFF' order by datetime desc";
                    $sirial = 0;
                    $result = mysqli_query($db,$read_query);
                    while($row = mysqli_fetch_assoc($result)){

                      $cmnt_id = $row['id'];
                      $commenter_name = $row['name'];
                      $DateTime = $row['datetime'];
                      $comment = $row['comment'];
                      $post_no = $row['post_no'];
                      $sirial = $sirial+1;

                      if(strlen($commenter_name)>15){
    							$commenter_name = substr($commenter_name, 0,15);
    						}

    						if(strlen($comment)>25){
    							$comment = substr($comment, 0,25);
    						}

                   ?>


						<tr>
							<td><?php echo $sirial ?></td>
							<td><?php echo $commenter_name ?></td>
							<td><?php echo $DateTime ?></td>
							<td><?php echo $comment ?></td>
							<td><a href="comments.php?app_commentid=<?php echo $cmnt_id ?>" class="btn btn-success">approve</a></td>
							<td><a href="comments.php?del_commentid=<?php echo $cmnt_id ?>" class="btn btn-danger">delete</a></td>
							<td><a href="#" class="btn btn-info">live preview</a></td>
						</tr>

					<?php } ?>
					</tbody>
				</table>
				</div>

							<h4>Approved comments table</h4>

				<div class="table-responsive">
					<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>serial no</th>
							<th>Name</th>
							<th>Date</th>
							<th>Comment</th>
							<th>Dis-Approve</th>
							<th>Delete</th>
							<th>Details</th>
						</tr>
					</thead>
					<tbody>

					<?php 

                    $read_query = "select * from comments where status = 'ON' order by datetime desc";
                    $sirial = 0;
                    $result = mysqli_query($db,$read_query);
                    while($row = mysqli_fetch_assoc($result)){

                      $cmnt_id = $row['id'];
                      $commenter_name = $row['name'];
                      $DateTime = $row['datetime'];
                      $comment = $row['comment'];
                      $post_no = $row['post_no'];
                      $sirial = $sirial+1;

    						
    						if(strlen($commenter_name)>15){
    							$commenter_name = substr($commenter_name, 0,15);
    						}

    						if(strlen($comment)>25){
    							$comment = substr($comment, 0,25);
    						}

                   ?>


						<tr>
							<td><?php echo $sirial ?></td>
							<td><?php echo $commenter_name ?></td>
							<td><?php echo $DateTime ?></td>
							<td><?php echo $comment ?></td>
							<td><a href="comments.php?dis_app_commentid=<?php echo $cmnt_id; ?>" class="btn btn-success">Dis-approve</a></td>
							<td><a href="comments.php?del_commentid=<?php echo $cmnt_id ?>" class="btn btn-danger">delete</a></td>
							<td><a href="#" class="btn btn-info">live preview</a></td>
						</tr>

					<?php } ?>
					</tbody>
				</table>
				</div>

				<div><?php 
				echo message(); 
				echo Successmessage(); 
				?></div>
			</div>
	</div>

	<div id="footer">
		<hr>
		<p>theme by | devdream team | 2022 - 2023 | -- All right reserved|</p>
		<a href="" style="color: whitesmoke; text-decoration:none;">
			<p>This site is only for study purpose tanha.com have all the rights. no one is allow to distribute copies other than  devdream team </p>
		</a>
		<hr>
	</div>

</body>
</html>