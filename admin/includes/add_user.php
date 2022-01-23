<?php include "C:/xampp/htdocs/cms/includes/db.php" ;?>


<?php 

if(isset($_POST['create_user'])){
    
 
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];

//   $post_image = $_FILES['image']['name'];
//   $post_image_temp = $_FILES['image']['tmp_name'];

   $user_name = $_POST['user_name'];
   $user_email = $_POST['user_email'];
   $user_password = $_POST['user_password'];    
//   $post_date = date('d-m-y');
   

//   move_uploaded_file($post_image_temp, "../images/$post_image");
    
    
    
    if(!empty($user_name) && !empty($user_email) && !empty($user_password)){
        
        
        
         
       $user_name = mysqli_real_escape_string($connection,$user_name);
       $user_email = mysqli_real_escape_string($connection,$user_email);
       $user_password = mysqli_real_escape_string($connection,$user_password);
        
        
      $hash = "$2y$10$";
      $salt = "iusesomecrazystrings22";
      $encryption_hash = $hash . $salt;
      $hased_password = crypt($user_password,$encryption_hash);
        
        
        
        $query = "INSERT INTO users(user_firstname,user_lastname,user_role,user_name,user_email,user_password) ";

        $query .= "VALUES('{$user_firstname}','{$user_lastname}','{$user_role}','{$user_name}','{$user_email}','{$hased_password}') ";

        $create_user_query = mysqli_query($connection, $query);

        if(!$create_user_query){

        die("'create_post_query' Failed !!" . mysqli_error($connection));
        }


        echo "<p class='bg-success'>User Successfully Created!: " . " " . "<a href='users.php'>View Users</a></p>";
    } else{
        
        
        
       echo "<script>alert('USERNAME, EMAIL and PASSWORD fields can not be empty!')</script>"; 
        
        
        
    }
    
    
    
    
    
    
    
    
    
  
    
    
    
}

?>
  

  <form action="" method="post" enctype="multipart/form-data">
       <center><h1>ADD USER</h1></center> 
      
       <div class="form-group">
       <label for="title">Firstname</label>
       <input type="text" class="form-control" name="user_firstname">
       </div>
       
       <div class="form-group">
       <label for="title">Lastname</label>
       <input type="text" class="form-control" name="user_lastname">
       </div>
       
      
       
        
         
           <!--selecting user role -->

           <div class="form-group">

               <select name="user_role" id="">
                    
                    <option value="subscriber">Select Option</option>
                    <option value="admin">Admin</option>
                    <option value="subscriber">Subscriber</option>



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
       <input type="text" class="form-control" name="user_name">
       </div>
       
       <div class="form-group">
       <label for="post_tags">Email</label>
       <input type="email" class="form-control" name="user_email">
       </div>
       
       <div class="form-group">
       <label for="post_tags">Password</label>
       <input type="password" class="form-control" name="user_password">
       </div>
       
       
       
       <div class="form-group">
           <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
       </div>
        
    
    
    
</form>