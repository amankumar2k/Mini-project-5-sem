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
        if($_SERVER['REQUEST_METHOD'] == 'POST' and !isset($_POST['action']) ){
        $projid = $_POST['projid'];
        echo '
        <form action="workson.php" method="post">
            <input type="hidden" name="action" value="insert"/>
            <div class="mb-3">
                <label for="EmpID" class="form-label">Employee ID</label>
                <input type="text" name="EmpID" class="form-control" id="EmpID" placeholder="E000">
            </div>
            <div class="mb-3">
                <label for="EmpID" class="form-label">ProjID</label>
                <input type="number" name="projid" class="form-control" id="EmpID" value="'.$projid.'" >
            </div>
            <div class="mb-3">
                <label for="EmpID" class="form-label">Hours</label>
                <input type="number" name="Hours" class="form-control" id="EmpID">
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>';
        }
        
        include "../_dbERS.php";

        if($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['action'])){
            $projid = $_POST['projid'];
            $empid = $_POST['EmpID'];
            $hours = $_POST['Hours'];

            $sql = "INSERT INTO `workson`(`EmpID`, `ProjID`, `Hours`) VALUES ('$empid', $projid, $hours)";
            $result = mysqli_query($con, $sql);

            if($result){
                echo '<script>
                    alert("The Employee information is Added");
                    window.location.href = "mgrPro.php";
                </script>';
            }
            else{
                echo mysqli_error($con);
            }
        }
        ?>

    </div>
  </div>
</body>
</html>