<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>
    
    
<?php 


if(isset($_POST['submit'])){
    
 $username = $_POST['username'];
 $email = $_POST['email'];
 $password = $_POST['password'];  
    
    
    if(username_exists($username)){
        
        echo "<script>alert('Username already exists! Try with a different username please')</script>";
    } 
    elseif(email_exists($email)){
        
        echo "<script>alert('Email already exists!')</script>";
    } else{
  
    
 
    if(!empty($username) && !empty($email) && !empty($password)){
       
        
       $username = mysqli_real_escape_string($connection,$username);
       $email = mysqli_real_escape_string($connection,$email);
       $password = mysqli_real_escape_string($connection,$password);

//       $query = "SELECT randSalt FROM users";
//       $select_randsalt_query = mysqli_query($connection,$query);
//
//       $row = mysqli_fetch_array($select_randsalt_query);
//       $salt = $row['randSalt'];
//       $password = crypt($password,$salt);

   $hash = "$2y$10$";
   $salt = "iusesomecrazystrings22";
   $encryption_hash = $hash . $salt;
   $password = crypt($password,$encryption_hash);
        
        

    $query = "INSERT INTO users (user_name,user_email,user_password,user_role) ";

    $query .= "VALUES('{$username}','{$email}','{$password}', 'subscriber' )";

    $register_user_query = mysqli_query($connection, $query);

    if(!$register_user_query){

    die("query failed" . mysqli_error($connection));

    }
        
    
      echo "<h3 class='text text-center bg-success'>Registration Successful!</h3>";
        
        
    } else {
        
        echo "<script>alert('Input Fields can not be empty!')</script>";
    }
    

    
    

}


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
                    <center><h1>Register</h1></center>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="on">
                        <div class="form-group" autocomplete="on">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>




!
