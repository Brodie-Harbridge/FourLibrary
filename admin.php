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


<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
      
       <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
        <!-- Custom styles admin grid -->
        <link rel="stylesheet" href="admin.css">
    
</head>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
  <div class="container">
    <a class="navbar-brand">
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
         </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="admin.php">Admin</a>
          <span class="sr-only">(current)</span>
        </li>
        <li class="nav-item">
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
<body>

<!-- Page Content -->
<div class="container">
  <h1 class="mt-4">Logo Nav by Start Bootstrap</h1>
  <p>The logo in the navbar is now a default Bootstrap feature in Bootstrap 4! Make sure to set the width and height of the logo within the HTML or with CSS. For best results, use an SVG image as your logo.</p>
</div>
<!-- /.container -->

<body>

      <h3>Three equal columns</h3>
      <p>Get three equal-width columns <strong>starting at desktops and scaling to large desktops</strong>. On mobile devices, tablets and below, the columns will automatically stack.</p>
      <div class="row">
        <div class="col-md-7">
            <form action="admin.php" method = "post">
                <input type="text" name="name" placeholder="Book Name">
                <input type="text" name="label" placeholder="Book label">
                <input type="text" name="genre" placeholder="Book Genre">
                <input type="text" name="author" placeholder="Book Author">
                <input type="submit" name="submit" placeholder="SUBMIT">
            </form>

        </div>
        <div class="col-md-5">
        
        Insert user and owned books here <br>
        <div class="row">
        <?php
    
    $query = "SELECT users.id, user_inventory.user_id, user_inventory.label, users.username  
             FROM user_inventory, users 
             WHERE users.id = user_inventory.user_id";

    $result = mysqli_query($link, $query);
    if(!$result)
    {
        die('Query Failed'. mysqli_error($link));
    }
    
    while($row = mysqli_fetch_assoc($result))
    {
        ?>
<div class="container">
    
           
            <div class="col-xl-12">
                <?php echo "Username : " . $row['username'] . "     [". $row['id'] . "]" . "<br>". "Book Name : " . $row['label'] . "<br>" . "<br>" ; ?>
            
           </div>
</div>
        <?php
        
        //print_r($row);
        //echo "User ID : " . $row['id'] . "<br>";
        //echo "Book Name : " . $row['label'] . "<br>" . "<br>";
    }
            ?>

            
            <?php
            
            ?>
            </div>
        
        </div>

      </div>



<?php

        
    
    if(isset($_POST ['submit']))
    {
        $name = $_POST['name'];
        $label = $_POST['label'];
        $genre = $_POST['genre'];
        $author= $_POST['author'];
        
        if(empty(trim($_POST['name'] || $_POST['label'] || $_POST['genre'] || $_POST['author'])))
        {
            echo "A field is empty";
        } 
        else
        {
        
        echo $name. $label. $genre. $author;
        $query = "INSERT INTO books (name, label, genre, author) VALUES ('" . $name . "', '" . $label ."', '" . $genre . "', '" . $author . "' ) ";
        
        $result = mysqli_query($link, $query);
        if(!$result)
        {
            die('Query Failed'. mysqli_error($link));
        }
        else
        {
            echo "Added " . $name ." to Database!";
            
        $name = "";
        $label = "";
        $genre = "";
        $author= "";
            exit();
        }
        }
        
    }
        

?>
    
</body>
</html>