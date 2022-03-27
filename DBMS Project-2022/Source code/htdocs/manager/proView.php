<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Manager</title>
</head>
<body>
<div class="wrapper">
  <div class="sidebar">
    <h2><?php echo $_SESSION['username'];?></h2>
    <ul>
      <li ><a href="mgr.php"><i class="fas fa-home"></i>Home</a></li>
      <li><a href="mgrEmp.php"><i class="fas fa-user"></i>Employees</a></li>
      <li style="background-color: #594f8d"><a href="mgrPro.php"><i class="fa fa-address-card"></i>Projects</a></li>
      <li><a href="../logout.php"><i class="fas fa-address-book"></i>Logout</a></li>
    </ul>

  </div>
  <div class="main_content">
    <div class="header">Welcome!! Have a nice day.</div>
    <div class="info" class="container">
        <?php
        include "../_dbERS.php";
        $projid = $_POST['projid'];

        $sql = "SELECT `EmpID`, `ProjID`, `Hours` FROM `workson` WHERE ProjID=$projid";
        $result = mysqli_query($con, $sql);

        echo
        '<table class="table">
            <thead>
            <tr>
                <th scope="col">EmpID</th>
                <th scope="col">Hours</th>
            </tr>
            </thead>
            <tbody>';
        while($row = mysqli_fetch_assoc($result)){
            echo 
            '
            <tr>
                <th scope="row">'.$row['EmpID'].'</th>
                <td scope="row">'.$row['Hours'].'</td>
            </tr>';
        }
        echo 
        '</tbody>
        </table>';
        ?>
    </div>
  </div>
</body>
</html>