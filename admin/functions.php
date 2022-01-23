<?php 


function imagePlcaceholder($image=''){
    
    if(!$image){
        
        return "noimage.jpg";
    } else{
        
        return $image;
        
    }
    
    
}


function redirect($location){
    
    
header("Location:" . $location);
exit;    
    
}




function ifItIsMethod($method=null){
    
    
    if($_SERVER['REQUEST_METHOD'] == strtoupper($method)){
        
        return true;
    }
    
    return false;
    
}


function isLoggedIn(){

    
    if(isset($_SESSION['user_role'])){
        
        return true;
    }
    
    return false;
    
}


function checkIfUserIsLoggedInAndRedirect($redirectLocation=null){
    
    if(isLoggedIn()){
        
        redirect($redirectLocation);
    }
    
    
    
}




function escape($string){
    
    global $connection;
    
    return mysqli_real_escape_string($connection, trim($string));
    
    
    
}



function confirmQuery($result){
    global $connection;
    if(!$result){

    die("'create_post_query' Failed !!" . mysqli_error($connection));
    }
}

function insert_categories(){
    
    /*insert categories query*/
    
    global $connection;
 
    if(isset($_POST['submit'])){


       $cat_title = escape($_POST['cat_title']);

        if($cat_title == "" || empty($cat_title)){

        echo "This Field should not be empty!";    

        } else{
            
            

        $stmt1 = mysqli_prepare($connection, "INSERT INTO categories(cat_title) VALUE(?) ");
        mysqli_stmt_bind_param($stmt1, "s", $cat_title);
        mysqli_stmt_execute($stmt1);

            if(!$stmt1){

                die("Query Failed" . mysqli_error($connection));

            }
        }

    }




    
}

function find_all_categories(){
    
   global $connection;
    //FIND ALL CATEGORIES QUERY
                                    
    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);    


     while($row = mysqli_fetch_assoc($select_categories)){
    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];

    echo "<tr>";
    echo "<td>{$cat_id}</td>";
    echo "<td>{$cat_title}</td>";

    echo "<td><a class='btn btn-danger' href='categories.php?delete={$cat_id}'>Delete</a></td>";
    echo "<td><a class='btn btn-warning' href='categories.php?edit={$cat_id}'>Edit</a></td>";
    echo "<tr>";
     }
    

    
    
    
}

function delete_categories(){
    
    global $connection;
    //delete cat_id query

    if(isset($_GET['delete'])){

   $the_cat_id = $_GET['delete'];

        
     
    $stmt1 = mysqli_prepare($connection, "DELETE FROM categories WHERE cat_id = ?");
    mysqli_stmt_bind_param($stmt1, "i", $the_cat_id);
    mysqli_stmt_execute($stmt1);

        if(!$stmt1){

            die("Query Failed" . mysqli_error($connection));

        }   
        

    header("Location: categories.php");

    
    
    
    
}
}


function recordCount($table){
    
    global $connection;
    
    
    $query = "SELECT * FROM " . $table;
    $select_all_posts = mysqli_query($connection,$query);

    $result = mysqli_num_rows($select_all_posts);
   
    confirmQuery($result);
    
    return $result;
    
    
    
}




function users_online(){
    
    
    if(isset($_GET['onlineusers'])){
    
    global $connection;    
    
    if(!$connection){
        session_start();
        include("../includes/db.php");
        
        
        
        $session = session_id();
  $time = time();
  $time_out_in_seconds = 06;
  $time_out = $time - $time_out_in_seconds;


  $query = "SELECT * FROM users_online WHERE session = '$session'";
  $send_query = mysqli_query($connection, $query);
  $count = mysqli_num_rows($send_query);

  if($count == NULL){

  mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session','$time')");


  } else{

  mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");


  }

  $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");

  echo $count_user = mysqli_num_rows($users_online_query);
    
        
        
        
        
        
        
        
        
    }
        
        
        
  
    
    } //get request isset()
    
}


users_online();






function username_exists($username){
    
     global $connection; 
    $query = "SELECT user_name FROM users WHERE user_name = '$username'";
    $result = mysqli_query($connection, $query);
    
   $row = mysqli_num_rows($result);
    
    if($row > 0)
    {
        return true;
        
    } else{
        return false;
    }
    
    
    
}


function email_exists($email){
    
     global $connection; 
    $query = "SELECT user_email FROM users WHERE user_email = '$email'";
    $result = mysqli_query($connection, $query);

    
    if(mysqli_num_rows($result) > 0)
    {
        return true;
        
    } else{
        return false;
    }
    
    
    
}


function register_user($username, $email, $password){
    
    
    
        global $connection;
    
    
     
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

    }else{
        
      echo "<h3 class='text text-center bg-success'>Registration Successful! <a href='index.php'>Login</a></h3> ";  
        
    }
      
      
     
}



function login_user($username, $password){
    
    
    
    global $connection;
   
    $username = trim($username);
    $password = trim($password);
    
    
    $username = mysqli_real_escape_string($connection,$username);
    $password = mysqli_real_escape_string($connection,$password);
    
    
    $query = "SELECT * FROM users WHERE user_name = '{$username}' ";
    $select_user_query = mysqli_query($connection, $query);
    
    while($row = mysqli_fetch_array($select_user_query)){
        
        $db_user_id = $row['user_id'];
        $db_user_name = $row['user_name'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_role = $row['user_role'];
        $db_user_password = $row['user_password'];
        
         $password = crypt($password, $db_user_password);
    
    if($username === $db_user_name && $password === $db_user_password){
        
        
        $_SESSION['username'] = $db_user_name;
        $_SESSION['firstname'] = $db_user_firstname;
        $_SESSION['lastname'] = $db_user_lastname;
        $_SESSION['user_role'] = $db_user_role;
       
        header("Location:/cms/admin/");
        
        
    } else{
    
   return false;
        }
        
        return true;
    }
    
    
   
  
    
    
    
}





?>