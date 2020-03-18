<?php
include "config.php";
// Initialize the session
session_start();


 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<html lang="en">
<head>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
   
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
  <div class="container">
    <a class="navbar-brand" href="#">
          <img src="http://placehold.it/150x50?text=Logo" alt="">
        </a>
        <div class="container">
    <a class="navbar-brand">
        Hello, <?php echo $_SESSION['username']; ?>! </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="welcome.php">Home
                <span class="sr-only">(current)</span>
              </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin.php">Admin</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="userinfo.php">User Info</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="reset.php">Reset Password</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Page Content -->
<div class="container">
  <h1 class="mt-4">User Information Panel</h1>
    <p>Hello, <?php echo $_SESSION['username']; ?> This area is where you can see all books you have rented!</p>
</div>
<!-- /.container -->

        <?php
            
            $id = $_SESSION["id"];
            
    
    $query = "SELECT users.id, user_inventory.user_id, user_inventory.label, users.username  
             FROM user_inventory, users
             WHERE user_id = '" . $id . "' ";

    $result = mysqli_query($link, $query);
    if(!$result)
    {
        die('Query Failed'. mysqli_error($link));
    }
            
    while($row = mysqli_fetch_assoc($result))
    {
        if ($row['user_id'] === $row['id'])
        {       
        ?>
        
<div class="container">
    
           
            <div class="col-xl-12">
                <?php echo "Username : " . $row['username'] ." ".$row['user_id']. " [". $row['id'] . "]" . "<br>". "Book Name : " . $row['label'] . "<br>" . "<br>" ; ?>
            
           </div>
</div>
    
    


<?php 
        }
    

    }
        

    
?>