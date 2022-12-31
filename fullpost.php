<?php require_once"include/db.php" ?> 
<?php require_once"include/session.php" ?> 
<?php require_once"include/functions.php" ?>


<?php 
  $target_id = $_GET['postid'];
  if(isset($_POST['add-comment'])){
    $name = $_POST['name'];
    include 'datetime.php';
    $DateTime = $DateTime;
    $email = $_POST['email'];
    $comment = $_POST['comment'];
    $status = "OFF";
    
    

    $query = "insert into comments(datetime,name,email,comment,status,post_no) Values('$DateTime','$name','$email','$comment','$status','$target_id');";

      

      if(empty($name) || empty($email) || empty($comment)){
        $_SESSION['Errormessage'] = "please fill all the fields";
        Redirect_to("fullpost.php?postid=$target_id");
      }elseif(strlen($comment)>500){
        $_SESSION['Errormessage'] = "comment should be at maximum 500 Character";
        Redirect_to("fullpost.php?postid=$target_id");
      }else{

        $add_query = mysqli_query($db , $query);

        if($add_query){
        $_SESSION['Successmessage'] = "comment added successfully";
        Redirect_to("fullpost.php?postid=$target_id");
        }else{
          $_SESSION['Errormessage'] = "comment can't add";
          Redirect_to("fullpost.php?postid=$target_id");
      }
      
      }

      

  }



 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>bootsrap</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="https://kit.fontawesome.com/3633084ced.js" crossorigin="anonymous"></script>
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

                    $read_query = "select * from posts order by datetime desc";

                    if(isset($_POST['search-btn'])){
                      $tpc = $_POST['search-topic'];
                      $read_query = "SELECT * FROM posts WHERE 
                      title LIKE '%$tpc%' OR
                      Category LIKE '%$tpc%' OR
                      post LIKE '%$tpc%' OR
                      Datetime LIKE '%$tpc%'
                      ORDER BY datetime DESC";
                    }

                    if(isset($_GET['postid'])){
                      $target_id = $_GET['postid'];
                      $read_query = "select * from posts WHERE id = '$target_id'";
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



                      // code for like
                      if(isset($_GET['likesomeone'])){
                        $update_like = $total_like+1;
                        $like_query = "UPDATE `posts` SET `Like` = '$update_like' WHERE `posts`.`id` = $post_id;";
                        $like_execute = mysqli_query($db,$like_query);
                        Redirect_to("fullpost.php?postid=$post_id");
                      }



                ?> <div class="blogpost">
            <img src="Upload/<?php echo $image; ?>" width="100%" class="img-responsive img-rounded">
            <h1 class="title"> <?php echo $post_title; ?> </h1>
            <p class="des">category : <?php echo $cat_name; ?> | posted on : <?php echo $post_date; ?>| posted by : <?php echo $author_name; ?> </p>
            <!-- nl12br fun means newline to break -->
            <p class="post"> <?php echo nl2br($post_des); ?> </p>

            <!-- show number of like -->
            <h5><?php echo $total_like ?> people liked this</h5>
            <a class="btn btn-primary" href="fullpost.php?postid=<?php echo $post_id ?>&likesomeone=0">like<i class="fa-light fa-thumbs-up"></i></a>
            
          </div>

          <span class="FieldInfo mb-2">comments :</span>

          <?php 

                    $read_query = "select * from comments where post_no = $target_id and status = 'ON' order by datetime desc";
                    $result = mysqli_query($db,$read_query);
                    while($row = mysqli_fetch_assoc($result)){

                      $comment_id = $row['id'];
                      $name = $row['name'];
                      $DateTime = $row['datetime'];
                      $comment = $row['comment'];
                   ?>
          <div class="comment-box">
            <div class="row">
              <div class="col-sm-1">
                <img src="images/user.jpg" width="100%">
              </div>
              <div class="col-sm-11">
                <h6><?php echo $name; ?></h6>
                <p style="font-size:16px;"><i>commented on : <?php echo $DateTime ?></i></p>
                <p><?php echo $comment; ?></p>
              </div>
            </div>
          </div>

        <?php } ?>


          <form action="fullpost.php?postid=
<?php echo $target_id; ?>" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="name" class="form-label">
                <span class="FieldInfo">Name :</span>
              </label>
              <input type="text" class="form-control" id="name" placeholder="name" name="name">
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">
                <span class="FieldInfo">Email :</span>
              </label>
              <input type="email" class="form-control" id="email" placeholder="email" name="email">
            </div>
            <div class="mb-3">
              <label for="comment" class="form-label">
                <span class="FieldInfo">Comment :</span>
              </label>
              <textarea type="text" class="form-control" id="comment" placeholder="write your comment here" name="comment"></textarea>
            </div>
            <div class="mb-3">
              <input type="submit" class="btn btn-primary" value="add comment" name="add-comment">
            </div>
          </form> <?php } ?>
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
      <p style="color:#444;">theme by | devdream team | 2022 - 2023 | -- All right reserved|</p>
      <a href="" style="color: #444; text-decoration:none;">
        <p>This site is only for study purpose have all the rights. no one is allow to distribute copies other then devdream team </p>
      </a>
    </div>
    <div style="height: 10px; background: #ddd;"></div>
  </body>
</html>