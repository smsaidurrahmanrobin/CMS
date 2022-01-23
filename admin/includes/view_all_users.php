<?php include "C:/xampp/htdocs/cms/includes/db.php" ;?> 
                           <center><h1>USERS INFORMATION</h1></center> 
                           <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Username</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Edit</th>
                                    
<!--                                   <th>Date</th>-->
                                    
                                    
                                </tr>
                            </thead>
                            
                            <tbody>
                            
                                
<?php 


$query = "SELECT * FROM users ";
$select_users = mysqli_query($connection, $query);


while($row = mysqli_fetch_assoc($select_users)){
    $user_id = $row['user_id'];
    $user_name = $row['user_name'];
    $user_password = $row['user_password'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_email = $row['user_email'];
    $user_image = $row['user_image'];
    $user_role = $row['user_role'];
    
    

    
    echo "<tr>";
    
        echo "<td>{$user_id}</td>";
        echo "<td>{$user_name}</td>";
        echo "<td>{$user_firstname}</td>";
    
//    $query = "SELECT * FROM categories WHERE cat_id = $post_category_id";
//    $select_categories_id = mysqli_query($connection, $query);
//
//
//    while($row = mysqli_fetch_assoc($select_categories_id)){
//    $cat_id = $row['cat_id'];
//    $cat_title = $row['cat_title'];
//        
//    echo "<td>{$cat_title}</td>";
//    }
    
    
    
    
        echo "<td>{$user_lastname}</td>";
        echo "<td>{$user_email}</td>";
//        echo "<td>{$user_image}</td>";
        echo "<td>{$user_role}</td>";
    
    
// $query ="SELECT * FROM post WHERE post_id = $comment_post_id"; $select_post_id_query = mysqli_query($connection,$query);
// while($row = mysqli_fetch_assoc($select_post_id_query)){
//
// $post_id = $row['post_id'];
// $post_title = $row['post_title'];
//
// echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";

// }
    
    
    
    
    
     
    echo "<td><a class='btn btn-warning' href='users.php?makeAdmin=$user_id'>Make Admin</a></td>";
    echo "<td><a class='btn btn-warning' href='users.php?makeSubscriber=$user_id'>Make Subscriber</a></td>";
    echo "<td><a class='btn btn-info' href='users.php?source=edit_user&u_id=$user_id'>Edit</a></td>";
    echo "<td><a class='btn btn-danger' href='users.php?delete=$user_id'>Delete</a></td>";
    echo "</tr>";
    

    
}

?>
 
      </tbody>
                        </table>
                        
                        
                       
<?php 



if(isset($_GET['makeSubscriber'])){
    
    $the_user_id = escape($_GET['makeSubscriber']);
    
    $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $the_user_id";
    $make_user_subscriber_query = mysqli_query($connection, $query);
    header("Location: users.php");
}


if(isset($_GET['makeAdmin'])){
    
    $the_user_id = escape($_GET['makeAdmin']);
    
    $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $the_user_id";
    $make_user_admin_query = mysqli_query($connection, $query);
    header("Location: users.php");
    
    
}





if(isset($_GET['delete'])){
    
    if(isset($_SESSION['user_role'])){
        if($_SESSION['user_role'] == 'admin'){
 
    $the_user_id = mysqli_real_escape_string($connection, escape($_GET['delete']));
    $query = "DELETE FROM users WHERE user_id = {$the_user_id}";
    $delete_user_query = mysqli_query($connection, $query);
    header("Location: users.php");
}

}
}


?>                    
                     
                    
                   