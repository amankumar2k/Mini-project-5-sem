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
        <form action="proIns.php" method="post">
            <input type="hidden" name="action" value="insert"/>
            <div class="mb-3">
                <label for="EmpID" class="form-label">Project ID</label>
                <input type="number" name="ProjID" class="form-control" id="EmpID">
            </div>
            <div class="mb-3">
                <label for="EmpName" class="form-label">Project Name</label>
                <input type="text" name="ProjName" class="form-control" id="EmpName">
            </div>
            <div class="mb-3">
                <label for="DOB" class="form-label">Location</label>
                <input type="text" name="ProjLoc" class="form-control" id="Location">
            </div>
            <div class="mb-3">
                <label for="Phone" class="form-label">Budjet</label>
                <input type="number" step="0.01" name="ProjBudg" class="form-control" id="Phone">
            </div>
            <div class="mb-3">
                <label for="Salary" class="form-label">Start Date</label>
                <input type="date" name="StartDate" class="form-control" id="Salary"> 
            </div>
            <div class="mb-3">
                <label for="SupID" class="form-label">Due Date</label>
                <input type="date" name="DueDate" class="form-control" id="SupID">
            </div>
            <div class="mb-3">
                <label for="DeptID" class="form-label">Department ID</label>
                <input type="text" name="DeptID" class="form-control" id="DeptID">
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
        <?php
        include "../_dbERS.php";

        if($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['action'])){
            $ProjID = $_POST['ProjID'];
            $ProjName = $_POST['ProjName'];
            $ProjLoc = $_POST['ProjLoc'];
            $ProjBudg = $_POST['ProjBudg'];
            $StartDate = $_POST['StartDate'];
            $DueDate = $_POST['DueDate'];
            $deptid = $_POST['DeptID'];
            
            $sql = "INSERT INTO `project`(`ProjID`, `ProjName`, `ProjLoc`, `ProjBudg`, `StartDate`, `DueDate`, `DeptID`) VALUES ('$ProjID','$ProjName','$ProjLoc',$ProjBudg,'$StartDate','$DueDate', $deptid)";
            $result = mysqli_query($con, $sql);
            if($result){
                echo '<script>
                    alert("The Employee information is Added");
                    window.location.href = "mgrEmp.php";
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