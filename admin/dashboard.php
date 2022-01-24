<?php include "includes/admin_header.php"; ?>

    <div id="wrapper">
    

  
<!--
<?php if($connection) echo '<b style="color:red;font-size:12px;font-family:script ;">
      database connected </b> '; ?>    
-->
    
    
    


 <!-- Navigation -->
       
<?php include "includes/admin_navigation.php"; ?>     
   <!-- /.navbar-collapse -->     
        
        

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                       
                       
                        <h1 class="page-header">
                           Welcom to ADMIN Control Home <page></page>
                           
                            
                              <small><?php echo $_SESSION['username']; ?></small>
                        </h1>
                        
                        
                    </div>
                </div>
                <!-- /.row -->

           
           
<!--           widgets -->
           
           <div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    
                    <?php 
                        
                   $post_counts = recordCount('post');
                        
                    echo "<div class='huge'>{$post_counts}</div>";
                    ?>  
                    
                    
                    
                    
                  
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="./posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                     
                     
                    <?php 
                        
                   
                    $comment_counts = recordCount('comments');;
                        
                    echo "<div class='huge'>{$comment_counts}</div>";
                    ?>  
                     
                     
                     
                     
                    
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    
                    
                    
                    <?php 
                        
                   
                    $users_counts = recordCount('users');
                        
                    echo "<div class='huge'>{$users_counts}</div>";
                    ?> 
                    
                    
                    
                    
                    
                    

                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                       
                       
                       
                        <?php 
                    
                    $category_counts = recordCount('categories');
                        
                    echo "<div class='huge'>{$category_counts}</div>";
                    ?> 
                       
                       
                       
                       
                       
                       
                       
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
           
           
 <!--            widgets -->          
    
           
   <?php 
                
     
    $query = "SELECT * FROM post";
    $select_all_posts = mysqli_query($connection,$query);

    $all_post_counts = mysqli_num_rows($select_all_posts);


    $query = "SELECT * FROM post WHERE post_status = 'published' ";
    $select_all_published_posts = mysqli_query($connection,$query);

    $post_published_counts = mysqli_num_rows($select_all_published_posts);

    $query = "SELECT * FROM post WHERE post_status = 'unpublished'";
    $select_all_unpublished_posts = mysqli_query($connection,$query);

    $post_unpublished_counts = mysqli_num_rows($select_all_unpublished_posts);
                
                
    $query = "SELECT * FROM comments WHERE comment_status = 'UNAPPROVED'";
    $select_all_unapproved_comments = mysqli_query($connection,$query);

    $post_unapproved_comment_counts = mysqli_num_rows($select_all_unapproved_comments); 
                
                
                
    $query = "SELECT * FROM users WHERE user_role = 'subscriber'";
    $select_all_subscribers = mysqli_query($connection,$query);

    $subscriber_counts = mysqli_num_rows($select_all_subscribers); 
                
    
                
    ?>                 
                         
                                
                                       
                                                     
           
            
   <div class="row">
      
       <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Counts'],
            
           <?php 
            
            $element_text = ['Posts','Published Posts', 'Draft Posts', 'Comments', 'Unapproved Comments', 'Users', 'Subscriber', 'Categories' ];
            $element_count = [$all_post_counts, $post_published_counts,  $post_unpublished_counts, $comment_counts, $post_unapproved_comment_counts, $users_counts, $subscriber_counts, $category_counts];
            
            for($i = 0; $i<8 ; $i++){
                
                
                echo "['{$element_text[$i]}'" ."," . "{$element_count[$i]}],";
                
                
                
            }
           
            
            
            
            ?> 
            
            
            
//              ['Static', 10]

       
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          },
          bars: 'horizontal' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script> 
       
       <div id="barchart_material" style="width: 'auto'; height: 500px;"></div>  
   </div>
    
    
    
    
    
   <?php include "includes/admin_footer.php"; ?>
           
           
           
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    
    
    
    
   