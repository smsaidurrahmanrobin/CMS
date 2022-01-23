
<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
 
<?php

if(!isset($_GET['email']) && !isset($_GET['token'])){
    
    redirect('index');
    
    
    
}

//$email = 'rico@email.com';
//
//$token = 'f5aaabdb645e98515fc55df61d0ec32d647ad7562670e97154c47e086ac7d1fc15a6f9ab84130862e6ff2bb481f186f54483';

if($stmt = mysqli_prepare($connection, 'SELECT user_name, user_email, token FROM users WHERE token = ?')){
    
    
  mysqli_stmt_bind_param($stmt, "s", $_GET['token']);  
    
    mysqli_stmt_execute($stmt);
    
mysqli_stmt_bind_result($stmt, $user_name, $user_email, $token);
    
    mysqli_stmt_fetch($stmt);
    
    mysqli_stmt_close($stmt);
  
    
//    if($_GET['token'] != $token || $_GET['email'] != $email) {
//        
//        
//        
//        redirect('index');
//        
//        
//    }
     
    $verified = false;
    
    
    if(isset($_POST['password']) && isset($_POST['confirmPassword'])){
        
        
      $newPass = $_POST['password'];  
      $confirmPass = $_POST['confirmPassword'];  
        
        
    if($newPass !== $confirmPass){
        
        echo "<h2 class='text text-center text-danger'>Passwords do not match, try again</h2>";
    } else{  
        
        
    //hashing password to avoid sql injection
        
   $hashedPassword = password_hash($newPass, PASSWORD_BCRYPT, array('cost'=>12));
        
    if($stmt = mysqli_prepare($connection, "UPDATE users SET token='', user_password = '{$hashedPassword}' WHERE user_email = ? ")) {
        
        
        mysqli_stmt_bind_param($stmt, "s", $_GET['email']);
        mysqli_stmt_execute($stmt);
    
        if(mysqli_stmt_affected_rows($stmt) >= 1){
            
            
            echo "<h2 class='text text-center text-success'>Password Reset Succeccfully. You Can <a href='/cms/login.php'>Login</a> Now Using Your New Password.</h2>";
        } 
        
        mysqli_stmt_close($stmt);
        
//        $verified = true;
        
        
        
    }  else{
            echo "bad query";
        } 
        
        
    }
        
    }
    
}

?>    
   
   
    
 <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>


<!-- Page Content -->
<div class="container">

<!--<?php if(!$verified): ?>-->

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">


                            <h3><i class="fa fa-lock fa-4x"></i></h3>
                            <h2 class="text-center">Reset Password</h2>
                            <p>You can reset your password here.</p>
                            <div class="panel-body">


                                <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-user color-blue"></i></span>
                                            <input id="password" name="password" placeholder="Enter password" class="form-control"  type="password">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-ok color-blue"></i></span>
                                            <input id="confirmPassword" name="confirmPassword" placeholder="Confirm password" class="form-control"  type="password">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input name="resetPassword" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                    </div>

                                    <input type="hidden" class="hide" name="token" id="token" value="">
                                </form>

                            </div><!-- Body-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!--
<?php else: ?>


<?php redirect('/cms/login.php'); ?>


<?php endif; ?>
-->

<hr>

<?php include "includes/footer.php";?>

</div> <!-- /.container -->

