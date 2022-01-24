<?php include "includes/header.php"; ?>
<?php include "includes/db.php"; ?>

    <!-- Navigation -->

        <!-- /.container -->
    <?php include "includes/navigation.php"; 
?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                
                <?php 
                
                if(isset($_GET['page'])){
                    
                    
                    $page = $_GET['page'];
                    
                    
                    
                } else{
                    
                    
                    $page = "";
                }
                
                if($page == "" || $page == 1){
                    
                    $page_1 = 0;
                    
                } else{
                    
                    $page_1 = ($page * 5) - 5;
                    
                    
                }
               
                
               if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){


                $query_post_count = "SELECT * FROM post LIMIT $page_1, 2";
                    
                  

                } else{

              $query_post_count = "SELECT * FROM post WHERE post_status= 'published' LIMIT $page_1, 2";
                    
               }
                    
                
                $find_count = mysqli_query($connection, $query_post_count);
                $count = mysqli_num_rows($find_count);
                
                if($count < 1){
                    
                    
                    echo "<h1 class='text-center'>No Posts Availabe</h1>";
                    
                } else{
                
                
                
                
                //$count = ceil($count / 4 );
                
                
                
                
               //$query = "SELECT * FROM post LIMIT $page_1, 5";
                $select_all_post_query = mysqli_query($connection, $query_post_count);
                while($row = mysqli_fetch_assoc($select_all_post_query)){
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image= $row['post_image'];
                $post_content= substr($row['post_content'],0,100);
                $post_status = $row['post_status'];  
                    
                  
                
                    
                ?>
                
                

<!--
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>
-->

                <!-- First Blog Post -->
             
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id;?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $post_author?>&p_id=<?php echo $post_id?>"><?php echo $post_author?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                
                <hr>
                <a href="post.php?p_id=<?php echo $post_id; ?>">
                <img class="img-responsive" src="images/<?php echo imagePlcaceholder($post_image); ?>" alt=""></a>
                <hr>
                
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

               <?php }} ?> 

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
    <ul class="pager">
    
       
    <?php 
        
        
    for($i = 1; $i <= $count; $i++){
      
        
        if($i == $page){
            
            
             echo "<li '><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";
            
            
            
        } else{
            
            
             echo "<li '><a href='index.php?page={$i}'>{$i}</a></li>";
            
        }
        
        
      
        
    }    
 
        
    ?>   
        
        
        
    </ul>


        <?php include "includes/footer.php" ?>
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        
        
         <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
         
         <script>
             
         $(document).ready(function(){
             
            const pusher = new Pusher('5459c3933c0332ed9e46', {
                
                cluster: 'us2',
                encrypted: true
                
            }); 
             
            var notificationChannel = pusher.subscribe('notification'); 
           
            notificationChannel.bind('new_user', function(notification){
                
                var message = notification.message;
                
                toastr.success(`${message} just registered`);
                
                console.log(message);
                
            }); 
             
         });    


        </script>

