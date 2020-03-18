<?php
include "config.php";
// Initialize the session
session_start();

// Cookie Data
//$cookieName = "";
//$cookieValue = 100;
//$cookieExpiration = time() * (60*60*24);
//setcookie($cookieName,$cookieValue,$cookieExpiration);

 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
   
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
 
  <div class="container">
    <a class="navbar-brand">
          <img src="http://placehold.it/150x50?text=Logo" alt="">
        </a>
           <div class="container">
    <a class="navbar-brand">
        Hello, <?php echo $_SESSION['username']. ", " . $_SESSION['id']; ?>! </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home
                <span class="sr-only">(current)</span>
              </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin.php">Admin</a>
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
<?php 
    if (isset($_GET['rent']))
{
    echo isset($_GET['rent']) . "rent = true <br>" . "<br>" . $_GET["rent"] ; 
    
    $book = $_GET['rent'];
    
    $query = "SELECT * FROM books WHERE id = '$book'";

    $result = mysqli_query($link, $query);
    if(!$result)
    {
        die('Query Failed'. mysqli_error());
    }
        
    while($row = mysqli_fetch_assoc($result))
    {
        echo $row['id'] . "<br>";
        echo $row['label'] . "<br>";
        echo $row['author'] . "<br>";
        
        $userid = $_SESSION['id'];
        $rowlabel = $row['label'];
        
        $query = "INSERT INTO user_inventory (user_id, label) VALUES ('" . $userid . "', '" . $rowlabel . "' ) "; 
        
        $result = mysqli_query($link, $query);
        if(!$result)
        {
            die('Query Failed'. mysqli_error());
        }
        }
}

    
    
?>
  <h1 class="mt-4">Logo Nav by Start Bootstrap</h1>
  <p>The logo in the navbar is now a default Bootstrap feature in Bootstrap 4! Make sure to set the width and height of the logo within the HTML or with CSS. For     best results, use an SVG image as your logo.</p>
</div>

<div class="container">
    <h1 class="mt5"> Search</h1>
    <form action="welcome.php" method = "post">
               
        <select name="options" id="options">
           
            <option value="All">All</option>
            <option value="author">Author</option>
            <option value="genre">Genre</option>
            <option value="label">Book</option>
            <option value="owned">Owned</option>
        </select> <br>
       
        <input type="text" name="search" placeholder="Search here!">
        <input type="submit" name="submit">
    </form>
</div>


<!-- /.container -->
   
      <div class="container">
<?php
          
       //Search funcionality
if(isset($_POST['submit']))
{
    $list = $_POST['options'];
    $search = $_POST['search'];
    
    if($_POST['options'] == 'All'){
        $query = "SELECT * FROM books";
    }
    else {
    
    $query = "SELECT * FROM books WHERE $list = '$search'"; }

    $result = mysqli_query($link, $query);
    if(!$result)
    {
        die('Query Failed'. mysqli_error());
    }
    
    while($row = mysqli_fetch_assoc($result))
    {
//        echo "<b>Book Title: </b> ". $row['label']. "<br>";
//        echo "<b> Book Author: </b>". $row['author']. "<br>";
//        echo "<b>Book Genre: </B>". $row['genre']. "<br> <br>";
        ?>
             <form action="welcome.php" method="get">
              <div class="row">

        <div class="col-md-7">
          <a href="#">
            <img class="img-fluid rounded mb-3 mb-md-0" src="http://placehold.it/700x300" alt="">
          </a>
        </div>
        <div class="col-md-5">
          <h3> <?php echo $row['label'];  ?> </h3>
          <?php
          echo "<b> Book Author: </b>". $row['author']. "<br>";
        echo "<b>Book Genre: </B>". $row['genre']. "<br> <br>"; ?>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo, quidem, consectetur, officia rem officiis illum aliquam perspiciatis aspernatur quod modi hic nemo qui soluta aut eius fugit quam in suscipit?</p>
          
          <?php
            
           // echo $row['id']. "<br>";
        
                if(isset($_GET['rent' . $row['id']]))
        {
            echo "<h1>" . $_GET['rent' . $row['id']]. "</h1>" . "<br>";
        }
            ?>

<input type="submit" name="rent" value="<?php echo $row['id'];?>" placeholder="Rent this book!" >          
          <?php 
        if(isset($_GET['rent' . $row['id']]))
        {
        
        $bookLabel = $row['label'];
        $query = "INSERT INTO user_inventory (user_id, label) VALUES ('" . $_session[$id] . "', '" . $label . "' ) "; 
        
        $result = mysqli_query($link, $query);
        if(!$result)
        {
            die('Query Failed'. mysqli_error($link));
        }

        }
            ?>
        </div>
      </div>
      </form>
      <br>
      
      
       <?php
        
        
        //echo $row['id']. " User Id". "<br>";
        //echo $row['username']. "user name". "<br>";
        // print_r($row);
        //$id = $row['id'];
        
        //echo "<option value='$id'>$id</option>";
    }
    
} 
?>
   </div>  
</body>
</html>