<?php include "includes/header.php"; ?>
<?php include "includes/db.php"; ?>

    <!-- Navigation -->

        <!-- /.container -->
    <?php include "includes/navigation.php"; ?>
    
<?php 
//like function for post
if(isset($_POST['liked'])){
    
    $liked_post_id = $_POST['post_id'];
    $liked_user_id = $_POST['user_id'];
    
    //1. fetching the post
    
    
    $query = "SELECT * FROM post WHERE post_id = $liked_post_id ";
    $postResult = mysqli_query($connection, $query);
    
    $post = mysqli_fetch_array($postResult);
    $likes = $post['likes'];
         
    
    //2. update post with likes
    
    
    mysqli_query($connection, "UPDATE post SET likes = $likes+1 WHERE post_id = $liked_post_id");
    
    
    
    
    //3. create likes for posts
    
    mysqli_query($connection, "INSERT INTO likes(user_id, post_id) VALUES($liked_user_id, $liked_post_id)");
    
    exit();
    
}

//unlike function for post

if(isset($_POST['unliked'])){
    
    $liked_post_id = $_POST['post_id'];
    $liked_user_id = $_POST['user_id'];
    
    //1. fetching the post
    
    
    $query = "SELECT * FROM post WHERE post_id = $liked_post_id ";
    $postResult = mysqli_query($connection, $query);
    
    $post = mysqli_fetch_array($postResult);
    $likes = $post['likes'];
         
    
    //2. DELETE likes
    
     mysqli_query($connection, "DELETE FROM likes WHERE post_id = $liked_post_id AND user_id = $liked_user_id");
    
    
     //3. UPDATE THE DECREMENTING LIKES 
    
    mysqli_query($connection, "UPDATE post SET likes = $likes-1 WHERE post_id = $liked_post_id");
    
    exit();
    
}


?>
    

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                
    <?php 

    if(isset($_GET['p_id'])){

    $the_post_id = $_GET['p_id'];    
    $view_query = "UPDATE post SET post_views_count = post_views_count + 1 WHERE post_id = $the_post_id ";
    $send_query = mysqli_query($connection, $view_query);
                    
                    
                    
                    
                    
      if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){
          
          
    $query = "SELECT * FROM post WHERE post_id = $the_post_id ";
          
      }  else{
          
          $query = "SELECT * FROM post WHERE post_id = $the_post_id AND post_status = 'published'";
      }            
          
    
    $select_all_post_query = mysqli_query($connection, $query);    
        
    if(mysqli_num_rows($select_all_post_query) < 1) {
                    
       echo "<h2 class='text-center'>No posts available</h2>";
        header("Location: index.php");

    }else{               
                    

    
    while($row = mysqli_fetch_assoc($select_all_post_query)){
    $post_title = $row['post_title'];
    $post_author = $row['post_author'];
    $post_date = $row['post_date'];
    $post_image= $row['post_image'];
    $post_content= $row['post_content'];


                    
                ?>
                
                

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo imagePlcaceholder($post_image); ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                

                <hr>

                
<?php 

if(isLoggedIn()){ ?>
    
    
<div class="row">

    <p class="pull-right font"><a class="<?php echo userLikedPost($the_post_id) ? 'unlike' : 'like'; ?>" href=""><span class="glyphicon glyphicon-thumbs-up"></span><?php echo userLikedPost($the_post_id) ? ' Unlike' : ' Like'; ?></a></p>

</div>

<?php }else{ ?>


<div class="row">

    <p class="login-to-like pull-right">You Need to <a href="/cms/login">Login</a> to LIKE.</p>

</div>

<?php }                    
                
?>

<div class="row">

    <p class="likes pull-right">Likes: <?php echo getPostLikes($the_post_id); ?></p>

</div>
               <?php } 
                
                
                
                
                
                ?> 
                
                 <!-- Blog Comments -->
                 
                 <?php 

if(isset($_POST['create_comment'])){



    $the_post_id = $_GET['p_id'];   
    $comment_author = $_POST['comment_author'];
    $comment_email = $_POST['comment_email'];
    $comment_content = $_POST['comment_content'];


    if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {


                    
                    
$query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date)";
$query .= "VALUES ($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now() )";

$create_comment_query = mysqli_query($connection,$query);

///update comment count query

//$query = "UPDATE post SET post_comment_count = post_comment_count + 1 ";
//$query .= "WHERE post_id = $the_post_id";
//
//$update_comment_count = mysqli_query($connection,$query); 

 echo "<h1 class='bg-success'>Comment Posted for Admin review!</h1>";       
                        
                    } else{
                        
                        
                        echo "<script>alert('Comment Fields can not be empty!')</script>";
                        
                        
                    }
                    
                    
                    
                    
                }
                
                ?>

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action='' method="post" role="form">
                       
                       <div class="form-group">
                           <label for="Author">Author</label>
                            <input type="text" class="form-control" name="comment_author">
                        </div>
                        <div class="form-group">
                           <label for="Author">Email</label>
                            <input type="email" class="form-control" name="comment_email">
                        </div>
                        
                        <div class="form-group">
                           <label for="Comment">Write Your Comment</label>
                            <textarea name="comment_content" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

               <?php 
               
                $query = "SELECT * FROM comments WHERE comment_post_id= {$the_post_id} ";
                $query .= "AND comment_status = 'APPROVED' ";
                $query .= "ORDER BY comment_id DESC ";
                
                $Select_comment_query = mysqli_query($connection,$query);
                
                
                
                    while ($row = mysqli_fetch_array($Select_comment_query)){
                    
                    $comment_date = $row['comment_date'];
                    $comment_content = $row['comment_content'];
                    $comment_author = $row['comment_author'];
                    
                    ?>
                    
                    <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>
                    
               <?php }
                
                
                
                }} else{
                    
                    header("Location: index.php");
                }
            
                
                
    
                
                ?>
               
                
               
               
               
               
                <!-- Comment -->
                

                
                
                
                
                

                

                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

                
            </div>

        </div>
        <!-- /.row -->

        <hr>



        <?php include "includes/footer.php" ?>
        
        
        <script>
           $(document).ready(function(){
               
           var post_id = <?php echo $the_post_id; ?>

           var user_id = <?php echo loggedInUserId(); ?>  
             
            //like   
               
             $('.like').click(function(){
                 
                 $.ajax({
                     
                     url: "/cms/post.php?p_id=<?php echo $the_post_id; ?>",
                     type: 'post',
                     data: { 
                         'liked': 1,
                         'post_id': post_id,
                         'user_id': user_id
                     }
                     
                 });
                 
                 
             }); 
               
               
            //unlike
               
               
            $('.unlike').click(function(){
                 
                 $.ajax({
                     
                     url: "/cms/post.php?p_id=<?php echo $the_post_id; ?>",
                     type: 'post',
                     data: { 
                         'unliked': 1,
                         'post_id': post_id,
                         'user_id': user_id
                     }
                     
                 });
                 
                 
             });   
               
               
               
               
           }); 
        </script>

