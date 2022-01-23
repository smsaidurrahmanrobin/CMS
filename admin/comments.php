<?php include "includes/admin_header.php"; ?>

    <div id="wrapper">

 <!-- Navigation -->
       
<?php include "includes/admin_navigation.php"; ?>     
    
        
        

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                       
                       
                        <h1 class="page-header">
                           Welcom to ADMIN Control Home <page></page>
                            <small>Author</small>
                        </h1>
                        
                        
<?php 

                        
if($_SESSION['user_role'] === 'admin'){                        
                        
                        
if(isset($_GET['source'])){
    
    $source = $_GET['source'];
} else {
    
    $source = ''; 
}

 switch($source){
         
         
             
         case 'post_comments';
         include "post_comments.php";
         break;
         
     default:
         include "includes/view_all_comments.php";
         break;
         
 }                       
                                                
} else {
    
    
    header("location: index.php");
    
    
}
?>
                        
                        
                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    
   <?php include "includes/admin_footer.php"; ?>