<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>

    
<?php 


if(isset($_POST['submit'])){
 
  $to = "robin.jyotu@gmail.com";
  $subject = $_POST['subject'];
  $content = $_POST['body'];
  $headers = "From:" . $_POST['email'];

  mail($to,$subject,$content,$headers);
    
    
// 
//    if(!empty($username) && !empty($email) && !empty($password)){
//       
        
echo "<h3 class='text text-center bg bg-success'>Email Sent</h3>";       

   
    
    
}



?>
    
    
  

    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                    <center><h1>Contact</h1></center>
                    <form role="form" action="" method="post" id="contact-form" autocomplete="off">
                        
                         <div class="form-group">
                            <label for="subject" class="sr-only">Subject</label>
                            <input type="subject" name="subject" id="subject" class="form-control" placeholder="Enter Your Subject Here">
                        </div>
                           
                           <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="enter your email here">
                        </div>
                        
                        
                        
                        
                         <div class="form-group">
                            <textarea name="body" id="body" class="form-control" rows="8" ></textarea>
                        </div>
                
                        <input type="submit" name="submit" id="btn-submit" class="btn btn-warning btn-lg btn-block" value="Submit">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>




!
