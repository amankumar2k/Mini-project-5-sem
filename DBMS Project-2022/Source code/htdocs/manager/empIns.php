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
    <title>Emp Insert</title>
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
    <div class="header">Employee Insert</div>
    <div class="info" class="container">
        <form action="empIns.php" method="post">
            <input type="hidden" name="action" value="insert"/>
            <div class="mb-3">
                <label for="EmpID" class="form-label">Employee ID</label>
                <input type="text" name="EmpID" class="form-control" id="EmpID" placeholder="E000">
            </div>
            <div class="mb-3">
            <label for="EmpName" class="form-label">Employee Name</label>
            <input type="text" name="EmpName" class="form-control" id="EmpName">
            </div>
            <div class="mb-3">
                <label for="DOB" class="form-label">DOB</label>
                <input type="date" name="DOB" class="form-control" id="DOB">
            </div>
            <div class="mb-3">
                <label for="Address" class="form-label">Address</label>
                <input type="text" name="Address" class="form-control" id="Address">
            </div>
            <label class="form-label">Gender</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="Gender" value="M" id="flexRadioDefault1">
                <label class="form-check-label" for="flexRadioDefault1">Male</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="Gender" value="F" id="flexRadioDefault2">
                <label class="form-check-label" for="flexRadioDefault2">Female</label>
            </div>
            <div class="mb-3">
                <label for="Phone" class="form-label">Phone</label>
                <input type="tel" name="Phone" class="form-control" id="Phone">
            </div>
            <div class="mb-3">
                <label for="Salary" class="form-label">Salary</label>
                <input type="number" step="0.01" name="Salary" class="form-control" id="Salary"> 
            </div>
            <div class="mb-3">
                <label for="SupID" class="form-label">Supervisor ID</label>
                <input type="text" name="SupID" class="form-control" id="SupID">
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
            $empid = $_POST['EmpID'];
            $empname = $_POST['EmpName'];
            $dob = $_POST['DOB'];
            $address = $_POST['Address'];
            $gender = $_POST['Gender'];
            $phone = $_POST['Phone'];
            $salary = $_POST['Salary'];
            $supid = $_POST['SupID'];
            $deptid = $_POST['DeptID'];
            
            $sql = "INSERT INTO `employee`(`EmpID`, `EmpName`, `DOB`, `Address`, `Gender`, `Phone`, `Salary`, `SupID`, `DeptID`) VALUES ('$empid', '$empname', '$dob', '$address', '$gender', $phone, $salary, '$supid', '$deptid')";
            $result = mysqli_query($con, $sql);
            $sql2 = "insert into PR values ('$empid', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0)";
            $result = mysqli_query($con, $sql2);
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