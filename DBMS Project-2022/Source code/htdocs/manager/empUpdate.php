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
    <title>Emp Update</title>
</head>
<body>
<div class="wrapper">
  <div class="sidebar">
    <h2><?php echo $_SESSION['username'];?></h2>
    <ul>
      <li><a href="mgr.php"><i class="fas fa-home"></i>Home</a></li>
      <li style="background-color: #594f8d"><a href="mgrEmp.php"><i class="fas fa-user"></i>Employees</a></li>
      <li><a href="mgrPro.php"><i class="fa fa-address-card"></i>Projects</a></li>
      <li><a href="../logout.php"><i class="fas fa-address-book"></i>Logout</a></li>
    </ul>

  </div>
  <div class="main_content">
    <div class="header">Employee Update</div>
    <div class="info" class="container">
        <?php
        include "../_dbERS.php";
        $EmpID = $_POST['EmpID'];

        $sql = "SELECT `EmpID`, `EmpName`, `DOB`, `Address`, `Gender`, `Phone`, `Salary`, `SupID`, `DeptID` FROM `employee` WHERE `EmpID`='$EmpID'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);

        echo
        '<form action="empUpdate.php" method="post">
            <input type="hidden" name="action" value="update"/>
            <div class="mb-3">
                <label for="EmpID" class="form-label">Employee ID</label>
                <input type="text" name="EmpID" class="form-control" id="EmpID"  value="'.$row['EmpID'].'">
            </div>
            <div class="mb-3">
            <label for="EmpName" class="form-label">Employee Name</label>
            <input type="text" name="EmpName" class="form-control" id="EmpName" value="'.$row['EmpName'].'">
            </div>
            <div class="mb-3">
                <label for="DOB" class="form-label">DOB</label>
                <input type="date" name="DOB" class="form-control" id="DOB" value="'.$row['DOB'].'">
            </div>
            <div class="mb-3">
                <label for="Address" class="form-label">Address</label>
                <input type="text" name="Address" class="form-control" id="Address" value="'.$row['Address'].'">
            </div>
            <label class="form-label">Gender</label>
            ';
        if($row['Gender'] == "M"){
            echo
            '<div class="form-check">
                <input class="form-check-input" type="radio" name="Gender" value="M" id="flexRadioDefault1" checked>
                <label class="form-check-label" for="flexRadioDefault1">Male</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="Gender" value="F" id="flexRadioDefault2">
                <label class="form-check-label" for="flexRadioDefault2">Female</label>
            </div>';
        }
        else {
            echo
            '<div class="form-check">
                <input class="form-check-input" type="radio" name="Gender" value="M" id="flexRadioDefault1">
                <label class="form-check-label" for="flexRadioDefault1">Male</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="Gender" value="F" id="flexRadioDefault2" checked>
                <label class="form-check-label" for="flexRadioDefault2">Female</label>
            </div>';
        }
            echo 
            '<div class="mb-3">
                <label for="Phone" class="form-label">Phone</label>
                <input type="tel" name="Phone" class="form-control" id="Phone" value="'.$row['Phone'].'">
            </div>
            <div class="mb-3">
                <label for="Salary" class="form-label">Salary</label>
                <input type="number" step="0.01" name="Salary" class="form-control" id="Salary" value="'.$row['Salary'].'"> 
            </div>
            <div class="mb-3">
                <label for="SupID" class="form-label">Supervisor ID</label>
                <input type="text" name="SupID" class="form-control" id="SupID" value="'.$row['SupID'].'">
            </div>
            <div class="mb-3">
                <label for="DeptID" class="form-label">Department ID</label>
                <input type="text" name="DeptID" class="form-control" id="DeptID" value="'.$row['DeptID'].'">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>';
        
        if($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['action'])){
            $action = $_POST['action'];
            if($action == "update"){
                $empid = $_POST['EmpID'];
                $empname = $_POST['EmpName'];
                $dob = $_POST['DOB'];
                $address = $_POST['Address'];
                $gender = $_POST['Gender'];
                $phone = $_POST['Phone'];
                $salary = $_POST['Salary'];
                $supid = $_POST['SupID'];
                $deptid = $_POST['DeptID'];
                $sql = "UPDATE `employee` SET `EmpID`='$empid',`EmpName`='$empname',`DOB`='$dob',`Address`='$address',`Gender`='$gender',`Phone`='$phone',`Salary`='$salary',`SupID`='$supid',`DeptID`='$deptid' WHERE `EmpID`='$EmpID'";
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
                    window.location.href = "mgrEmp.php";
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