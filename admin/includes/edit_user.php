<?php include "C:/xampp/htdocs/cms/includes/db.php" ;?>


<?php

    if($_SESSION['user_role'] == 'admin'){
        
        
        
        

    if(isset($_GET['u_id'])){
        
    $the_user_id = $_GET['u_id'];
      
    
    

                                  
    $query = "SELECT * FROM users WHERE user_id = {$the_user_id} ";
    $select_users_by_id = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_users_by_id)){
    $user_id = $row['user_id'];
    $user_name = $row['user_name'];
    $user_password = $row['user_password'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_email = $row['user_email'];
    $user_role = $row['user_role'];
  
    }

    if(isset($_POST['update_user'])){

        
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_role = $_POST['user_role'];
        $user_name = $_POST['user_name'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];
        
//        move_uploaded_file($post_image_temp, "../images/$post_image");
        
//        if(empty($post_image)){
//            
//            $query = "SELECT * FROM post WHERE post_id = {$the_post_id}";
//            
//            $select_image = mysqli_query($connection,$query);
//            
//            while($row = mysqli_fetch_assoc($select_image)){
//                
//                $post_image = $row['post_image'];
//                
//            }
//            
//        }
        
        
        
       if(!empty($user_password)){
            
            
        $hash = "$2y$10$";
        $salt = "iusesomecrazystrings22";
        $encryption_hash = $hash . $salt;
        $hashed_password = crypt($user_password,$encryption_hash);
        
        
        $query = "UPDATE users SET ";
        $query .= "user_name = '{$user_name}', "; 
        $query .= "user_firstname = '{$user_firstname}', "; 
        $query .= "user_lastname = '{$user_lastname}', "; 
        $query .= "user_role = '{$user_role}', "; 
        $query .= "user_email = '{$user_email}', "; 
        $query .= "user_password = '{$hashed_password}' "; 
        
        $query .= "WHERE user_id = {$the_user_id} ";
        
        $update_user_query = mysqli_query($connection,$query);
        
        confirmQuery($update_user_query);
        
        
        echo "<p class='bg-success'> User Successfully Updated!: " . " " . "<a href='users.php'>View Users</a></p>";
        
        } else{
            
            echo "<script>alert('Password field can not be empty!')</script>";
                
            
              }
    }
        
        
            } else{
        
        
        header("Location: index.php");
        
        
        
    }

} else{
        
      echo "<script>alert('You are not eligable to enter this page! Contact to your admin please.')</script>";  
       header("Location: index.php"); 
        
        
        
    }
?>
  

  <form action="" method="post" enctype="multipart/form-data">
       <center><h1>EDIT USER</h1></center> 
      
       <div class="form-group">
       <label for="title">Firstname</label>
       <input type="text" value ="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname">
       </div>
       
       <div class="form-group">
       <label for="title">Lastname</label>
       <input type="text" value ="<?php echo $user_lastname; ?>" class="form-control" name="user_lastname">
       </div>
       
      
       
        
         
           <!--selecting user role -->

           <div class="form-group">

               <select name="user_role" id="">
                    <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>

                    <?php  
                    if($user_role == 'admin'){
                    
                    echo "<option value='subscriber'>subscriber</option>";
                    
                    } else{
                        
                       echo "<option value='admin''>admin</option>"; 
                    }
                    
                   ?>
                    
                    

               </select>



           </div>
           <!--selecting user role -->
        
       
<!--
       
       <div class="form-group">
       <label for="post_image">Post Image</label>
       <input type="file" name="image">
       </div>
-->
   
       
           
               
                   
                       
                               
       <div class="form-group">
       <label for="post_tags">Username</label>
       <input type="text" class="form-control" name="user_name" value="<?php echo $user_name; ?>">
       </div>
       
       <div class="form-group">
       <label for="post_tags">Email</label>
       <input type="email" class="form-control" name="user_email" value="<?php echo $user_email; ?>">
       </div>
       
       <div class="form-group">
       <label for="post_tags">Password</label>
       <input autocomplete="off" type="password" class="form-control" name="user_password" value="<?php //echo $user_password; ?>">
       </div>
       
       
       
       <div class="form-group">
           <input class="btn btn-primary" type="submit" name="update_user" value="Update User">
       </div>
        
</form>
    
    
</form>