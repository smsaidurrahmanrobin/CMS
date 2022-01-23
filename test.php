<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

<?php 
echo loggedInUserId(); 

if(userLikedPost(21)){
    
    echo "USER LIKED IT";
    
}else{
    
    echo "USER DIT NOT LIKED IT";
    
}

?>