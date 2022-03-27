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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Admin</title>
</head>
<body>
<div class="wrapper">
  <div class="sidebar">
    <h2><?php echo $_SESSION['username'];?></h2>
    <ul>
      <li ><a href="admin.php"><i class="fas fa-home"></i><strong>Home</strong></a></li>
      <li style="background-color: #594f8d"><a href="editDept.php"><i class="fa fa-address-card"></i>Department</a></li>
      <li><a href="editMgrHr.php"><i class="fas fa-user"></i>Manager/HR</a></li>
      <li><a href="../logout.php"><i class="fas fa-address-book"></i>Logout</a></li>
    </ul>

  </div>
  <div class="main_content">
    <div class="header">Welcome!! Have a nice day.</div>
    <div class="info" class="container">
        <form action="addDept.php" method="post">
            <input type="hidden" name="action" value="insert"/>
            <div class="mb-3">
                <label for="EmpID" class="form-label">Department ID</label>
                <input type="number" name="DeptID" class="form-control" id="EmpID">
            </div>
            <div class="mb-3">
                <label for="EmpName" class="form-label">Department Name</label>
                <input type="text" name="DeptName" class="form-control" id="EmpName">
            </div>
            <div class="mb-3">
                <label for="DOB" class="form-label">Location</label>
                <input type="text" name="DeptLoc" class="form-control" id="Location">
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
        <?php
        include "../_dbERS.php";

        if($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['action'])){
            $deptid = $_POST['DeptID'];
            $deptname = $_POST['DeptName'];
            $loc = $_POST['DeptLoc'];
            
            $sql = "INSERT INTO `department`(`DeptID`, `DeptName`, `DeptLoc`) VALUES ($deptid, '$deptname', '$loc')";
            $result = mysqli_query($con, $sql);
            
            if($result){
                echo '<script>
                    alert("The Department information is Added.\n Please Enter the Manager and HR using Update Department.");
                    window.location.href = "editDept.php";
                </script>';
            }
            else{
                echo mysqli_error($conn);
            }
        }
        ?>

    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>