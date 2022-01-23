<?php include "includes/header.php"; ?>
<?php include "includes/db.php"; ?>

    <!-- Navigation -->

        <!-- /.container -->
    <?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                
                <?php 
                
                if(isset($_GET['cat_id'])){
                  
                    $post_cat_id = $_GET['cat_id'];
                   
                
                } 
                
                $category_query = "SELECT * FROM categories WHERE cat_id = $post_cat_id ";
                $select_all_category_query = mysqli_query($connection, $category_query);
                while($row = mysqli_fetch_assoc($select_all_category_query)){
                $cat_title = $row['cat_title'];
                
                if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){


                $stmt1 = mysqli_prepare($connection, "SELECT post_id, post_title, post_author, post_date, post_image, post_content FROM post WHERE post_category_id = ?");
                    
                  

                } else{

                $stmt2 = mysqli_prepare($connection, "SELECT post_id, post_title, post_author, post_date, post_image, post_content FROM post WHERE post_category_id = ? AND post_status = ?");
                    
                $published = 'published';   
                    
                }
                 
                if(isset($stmt1)){
                    
                    
                    mysqli_stmt_bind_param($stmt1, "i", $post_cat_id);
                    mysqli_stmt_execute($stmt1);
                    mysqli_stmt_bind_result($stmt1, $post_id, $post_title, $post_author, $post_date, $post_image, $post_content);
                    
                    $stmt = $stmt1;                    
                    
                } else{
                    
                    
                    mysqli_stmt_bind_param($stmt2, "is", $post_cat_id, $published);
                    mysqli_stmt_execute($stmt2);
                    mysqli_stmt_bind_result($stmt2, $post_id, $post_title, $post_author, $post_date, $post_image, $post_content);
                    
                    $stmt = $stmt2; 
                    
                    
                }
                    
                    
           
                while(mysqli_stmt_fetch($stmt)){
                
                
                
                    
                ?>
                
                

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id;?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                   
                    <p1>all posts in <?php echo $cat_title; ?></p1>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                

                <hr>

               <?php }} ?>
               
                <?php
                
                
                if(mysqli_stmt_num_rows($stmt) < 1){
                    
                    echo "<h1 class='text-center'> No Posts Availabe </h1>";
                    
                    
                }
                
                ?> 
             
                
                
                

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

