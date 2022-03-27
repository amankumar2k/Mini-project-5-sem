<?php
session_start();
if(isset($_SESSION['loggedin'])){
  header("HTTP/1.0 404 Not Found");
  echo "<h1>404 Not Found</h1>";
  echo "The page that you have requested could not be found.";
  exit();
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
  include "_dbconsession.php";
  $username = $_POST["username"];
  $password = $_POST["password"];

  $sql = "Select * from user where username='$username'";
  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);
  if($num == 1){
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row['password'])){
      session_start();
      $_SESSION['loggedin'] = true;
      $_SESSION['username'] = $username;
      $_SESSION['empID'] = $row['Eid'];
      $_SESSION['dno'] = $row['dno'];
      
      if ($row['role'] == "admin"){
        header("location: admin/admin.php");
        exit();
      }
      elseif ($row['role'] == "mgr"){
        header("location: manager/mgr.php");
        exit();
      }
      elseif ($row['role'] == "hr"){
        header('location: hr/hr.php');
        exit();
      }
    }
    
  }
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    
    <link rel="stylesheet" href="css/index.css">
    
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <div class="container">
      <form action="index.php" method="post">
        <div class="title">Login</div>
        <div class="input-box underline">
          <input type="text" placeholder="User-id" name="username" required>
          <div class="underline"></div>
        </div>
        <div class="input-box">
          <input type="password" placeholder="Password" name="password" required>
          <div class="underline"></div>
        </div>
        <div class="input-box button">
          <input type="submit" value="Continue">
        </div>
      </form>
        
    </div>
  </body>
</html>
