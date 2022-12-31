<?php require_once"include/db.php" ?>
<?php require_once"include/session.php" ?>
<?php require_once"include/functions.php" ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>bootsrap</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.js"></script>
    <link rel="stylesheet" type="text/css" href="css/frontstyle.css">
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
              <a class="nav-link active" aria-current="page" href="blog.php">Blog</a>
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
        <?php 
        if(isset($_SESSION['visitor_id']))
        { ?>




          <a href="" class="ms-3 p-2"><?php echo $_SESSION['visitor_name']; ?></a> |

          <a href="userpasschange.php" class=" p-2">Change password</a>|
          <a href="userlogout.php" class=" p-2">Logout</a>

          <?php
        }else{

         ?>
            <a href="userlogin.php" class="ms-3 p-2">Enter</a> |
            <a href="userregistration.php" class=" p-2">Register</a>

        <?php } ?>



        
        </div>
      </div>
    </nav> 
	<div style="height: 10px; background: #ddd;"></div>

    <div class="container">
    	<div class="blog-header">
    		<h1>The responsive CMS blog</h1>
    		<p class="lead">The Complete blog using php</p>
    	</div>
 <div><?php 
        echo message(); 
        echo Successmessage(); 
        ?></div>
    	<div class="row">
    		<div class="col-sm-8">
         

    			<?php 

                    $read_query = "select * from posts order by datetime desc LIMIT 0,3";
                    $page_id = 1;

                    if(isset($_POST['search-btn'])){
                    	$tpc = $_POST['search-topic'];
                    	$read_query = "SELECT * FROM posts WHERE 
                    	title LIKE '%$tpc%' OR
                    	Category LIKE '%$tpc%' OR
                    	post LIKE '%$tpc%' OR
                    	Datetime LIKE '%$tpc%'
                    	ORDER BY datetime DESC";
                    }
                    if(isset($_GET['page'])){
                      $page_id=$_GET['page'];
                      $show_Post_from=$page_id*3-3;
                      $read_query = "select * from posts order by datetime desc LIMIT $show_Post_from,3";
                    }
                    if(isset($_GET['search_by_cat'])){
                      $cat_search=$_GET['search_by_cat'];
                      $read_query = "select * from posts where category = '$cat_search' order by datetime desc";
                    }if(isset($_GET['month'])){
                      $searchbymonth = $_GET['month'];
                      $read_query = "select * from posts where datetime like '___$searchbymonth%' order by datetime desc";
                    }




                    $sirial = 0;
                    $result = mysqli_query($db,$read_query);
                    while($row = mysqli_fetch_assoc($result)){

                      
               		    $post_id = $row['id'];
                      $post_date = $row['datetime'];
                      $post_title = $row['title'];
                      $cat_name = $row['category'];
                      $author_name = $row['author'];
                      $image = $row['image'];
                      $post_des = $row['post'];
                      $total_like = $row['Like'];
                      $sirial = $sirial+1;	
 					?>



                <div class="blogpost">
                	<img src="Upload/<?php echo $image; ?>" width="100%" class="img-responsive img-rounded">
                	<h1 class="title"><?php echo $post_title; ?></h1>
    				<p class="des">category : <?php echo $cat_name; ?>  |  posted on : <?php echo $post_date;  ?>| posted by : <?php echo $author_name; ?></p>
    				<p class="post">

    				<?php 
            // post description shortener
    						if(strlen($post_des)>700){
    							$post_des = substr($post_des, 0,700);
    							$post_des .= "...";
    						}
                // print post description
    				echo $post_des; ?>
    					
    				</p>


            <?php 

                $count_app_query="SELECT COUNT(*) FROM comments WHERE status = 'ON' and post_no = $post_id";

                 $query = mysqli_query($db,$count_app_query);
                 $result_app = mysqli_fetch_array($query);
                 $total_app = array_shift($result_app);
                 ?>
                 <div class="row">
                   <div class="col">
                     <a href="fullpost.php?postid=<?php echo $post_id ;?>" class="btn btn-primary">view full post</a>
                   </div>
                   <div style="text-align: right;" class="col text-right">
                     <span class="badge bg-primary"><?php echo $total_like ?> likes</span>
                     <span class="badge bg-primary"><?php echo $total_app ?> comments</span>
                   </div>
                 </div>



                </div>
              <?php } ?>
                <?php 

                $count_posts="SELECT COUNT(*) FROM posts";

                 $query = mysqli_query($db,$count_posts);
                 $result_posts = mysqli_fetch_array($query);
                 $total_posts = array_shift($result_posts);
                 $total_page = $total_posts/3;
                 $total_page = ceil($total_page);
                 

                 ?>

                 <nav>
                   <ul class="pagination pull-right" >

                    <!-- for previous button -->
                    <?php 
                    if($page_id>1){?>
                      <li class="page-item"><a class="page-link" href="blog.php?page=<?php echo $page_id-1 ?>"><?php echo "previous" ?></a></li>
                    <?php } ?> 


                     


                     <?php
                    for ($page_no = 1; $page_no <= $total_page; $page_no++) {
                      ?>





                  <!-- for active pagination link  -->

                     <?php 
                     if($page_no==$page_id){
                      ?>

                      <li class="page-item active"><a class="page-link" href="blog.php?page=<?php echo $page_no ?>"><?php echo $page_no ?></a></li>


                     <?php }  else{ ?>
                      <li class="page-item"><a class="page-link" href="blog.php?page=<?php echo $page_no ?>"><?php echo $page_no ?></a></li>
                  

                    <?php } } ?>

                    <!-- for next button -->
                    <?php 
                    if($page_id != $total_page){?>
                      <li class="page-item"><a class="page-link" href="blog.php?page=<?php echo $page_id+1 ?>"><?php echo "next" ?></a></li>
                    <?php } ?> 
                   </ul>
 
                 </nav>
    		</div>
    		<div class="col-sm-3 offset-1">
    			<h1 class="text-center">About Us</h1>
          <img src="images/about.webp" style="width: 90%;box-shadow: 0px 0px 5px gray;border-radius: 30px;">
    			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
    			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
    			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
    			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

          <!-- categories filter -->


          <div class="card mb-3 bg-primary border-primary">
            <div class="card-header">
              <h4 class="card-title text-white">Categories </h4>
            </div>
            <ul class="list-group list-group-flush">
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
              <li class="list-group-item"><a class="nav-link" href="blog.php?search_by_cat=<?php echo $cat_name; ?>"><?php echo $cat_name; ?></a> </li>
            <?php } ?>
            </ul>
          </div>

          <!--RECENT POST CARD  -->

          <div class="card bg-primary border-primary mb-3">
            <div class="card-header">
              <h4 class="card-title text-white">Recent Posts</h4>
            </div>
            <ul class="list-group list-group-flush">
              <?php 

                    $read_query = "select * from posts order by datetime desc LIMIT 0,3";
                    $sirial = 0;
                    $result = mysqli_query($db,$read_query);
                    while($row = mysqli_fetch_assoc($result)){

                     $post_id = $row['id'];
                      $post_date = $row['datetime'];
                      $post_title = $row['title'];
                      $cat_name = $row['category'];
                      $author_name = $row['author'];
                      $image = $row['image'];
                      $post_des = $row['post'];
                      $sirial = $sirial+1;  
                   ?>
              <li class="list-group-item"> 
                <div class="row">
                  <div class="col-3"><img src="Upload/<?php echo $image; ?>" width="100%"></div>
                  <div class="col-9">
                    <div class="content">
                 <a style="font-weight:bold;" class="nav-link" href="fullpost.php?postid=<?php echo $post_id; ?>"><?php echo $post_title; ?></a> 
                <p><i><?php echo $post_date ?></i></p>
               </div>
                  </div>
                </div>
              </li>
            <?php } ?>
            </ul>
          </div>

<!--Filter by month CARD  -->

          <div class="card bg-primary border-primary mb-3">
            <div class="card-header">
              <h4 class="card-title text-white">Months</h4>
            </div>
            <ul class="list-group list-group-flush">
             
              <li class="list-group-item">
                <a class="nav-link" href="blog.php?month=01">January</a>
              </li>
              <li class="list-group-item">
                <a class="nav-link" href="blog.php?month=02">February</a>
              </li>
              <li class="list-group-item">
                <a class="nav-link" href="blog.php?month=03">March</a>
              </li>
              <li class="list-group-item">
                <a class="nav-link" href="blog.php?month=04">April</a>
              </li>
              <li class="list-group-item">
                <a class="nav-link" href="blog.php?month=05">May</a>
              </li>
              <li class="list-group-item">
                <a class="nav-link" href="blog.php?month=06">June</a>
              </li>
              <li class="list-group-item">
                <a class="nav-link" href="blog.php?month=07">July</a>
              </li>
              <li class="list-group-item">
                <a class="nav-link" href="blog.php?month=08">August</a>
              </li>
              <li class="list-group-item">
                <a class="nav-link" href="blog.php?month=09">September</a>
              </li>
              <li class="list-group-item">
                <a class="nav-link" href="blog.php?month=10">October</a>
              </li>
              <li class="list-group-item">
                <a class="nav-link" href="blog.php?month=11">November</a>
              </li>
              <li class="list-group-item">
                <a class="nav-link" href="blog.php?month=12">December</a>
              </li>

            
            </ul>
          </div>


    		</div>
    	</div>
    	
    </div>

	<div style="height: 10px; background: #ddd;"></div>
    <div id="footer">
			
		<p style="color:#444;">theme by | devdream team| 2022 - 2023 | -- All right reserved|</p>
		<a href="" style="color: #444; text-decoration:none;">
			<p>This site is only for study purpose have all the rights. no one is allow to distribute copies other than  devdream team </p>
		</a>
			
	</div>
	<div style="height: 10px; background: #ddd;"></div>

    
  </body>
</html>