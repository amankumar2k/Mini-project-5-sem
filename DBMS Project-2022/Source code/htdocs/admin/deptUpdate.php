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
    <?php
        include "../_dbERS.php";
        $deptid = $_POST['DeptID'];

        $sql = "SELECT `DeptID`, `DeptName`, `DeptLoc`, `MgrID`, `HRID` FROM `department` WHERE DeptID=$deptid";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);

        echo
        '<form action="deptUpdate.php" method="post">
            <input type="hidden" name="action" value="update"/>
            <div class="mb-3">
                <label for="EmpID" class="form-label">Department ID</label>
                <input type="text" name="DeptID" class="form-control" id="EmpID"  value="'.$row['DeptID'].'">
            </div>
            <div class="mb-3">
            <label for="EmpName" class="form-label">Department Name</label>
            <input type="text" name="DeptName" class="form-control" id="EmpName" value="'.$row['DeptName'].'">
            </div>
            <div class="mb-3">
                <label for="DOB" class="form-label">Location</label>
                <input type="text" name="DeptLoc" class="form-control" id="DOB" value="'.$row['DeptLoc'].'">
            </div>
            <div class="mb-3">
                <label for="Address" class="form-label">Manager ID</label>
                <input type="text" name="MgrID" class="form-control" id="Address" value="'.$row['MgrID'].'">
            </div>
            <div class="mb-3">
                <label for="Phone" class="form-label">Phone</label>
                <input type="text" name="HRID" class="form-control" id="Phone" value="'.$row['HRID'].'">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>';
        
        if($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['action'])){
            $action = $_POST['action'];
            if($action == "update"){
                $deptid = $_POST['DeptID'];
                $deptname = $_POST['DeptName'];
                $loc = $_POST['DeptLoc'];
                $mgr = $_POST['MgrID'];
                $hr = $_POST['HRID'];
                $sql = "UPDATE `department` SET `DeptID`='$deptid',`DeptName`='$deptname',`DeptLoc`='$loc',`MgrID`='$mgr',`HRID`='$hr' WHERE DeptID=$deptid";
                $result = mysqli_query($con, $sql);
                
                if($result){
                   /* echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>The Record has been updated successfully</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'; */

                echo
                '
                <script>
                    alert ("The record has been updated");
                    window.location.href = "editDept.php";
                </script>
                ';

                }
                else{
                    echo mysqli_error($con);
                }
            }
        }
        ?>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>