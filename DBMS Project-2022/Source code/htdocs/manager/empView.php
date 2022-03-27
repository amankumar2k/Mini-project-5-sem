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
    <title>Emp View</title>
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
    <div class="header">Employee Details</div>
    <div class="info" class="container">
        <?php
        include "../_dbERS.php";
        $empid = $_POST['EmpID'];

        $sql = "SELECT `EmpID`, `EmpName`, `DOB`, `Address`, `Gender`, `Phone`, `Salary`, `SupID`, `DeptID` FROM `employee` WHERE `EmpID`='$empid'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);

        echo
        '<form action="mgrUpdEmp.php" method="post" class="row g-3">
            <div class="row">
            <div class="col">
                <label for="EmpID" class="form-label">Employee ID</label>
                <input type="text" name="EmpID" class="form-control" id="EmpID" value="'.$row['EmpID'].'" disabled>
            </div>
            <div class="col">
                <label for="EmpName" class="form-label">Employee Name</label>
                <input type="text" name="EmpName" class="form-control" id="EmpName" value="'.$row['EmpName'].'" disabled>
            </div>
            <div class="col">
                <label for="DOB" class="form-label">DOB</label>
                <input type="date" name="DOB" class="form-control" id="DOB" value="'.$row['DOB'].'" disabled>
            </div>
            <div class="col">
                <label for="Gender" class="form-label">Gender</label>
                <input type="text" name="Phone" class="form-control" id="Gender" value="'.$row['Gender'].'" disabled>
            </div>
            <div class="col">
                <label for="Phone" class="form-label">Phone</label>
                <input type="tel" name="Phone" class="form-control" id="Phone" value="'.$row['Phone'].'" disabled>
            </div>
            </div>
            <div class="row">
            <div class="col-md-2">
                <label for="Salary" class="form-label">Salary</label>
                <input type="number" step="0.01" name="Salary" class="form-control" id="Salary" value="'.$row['Salary'].'" disabled> 
            </div>
            <div class="col-md-2">
                <label for="SupID" class="form-label">Supervisor ID</label>
                <input type="text" name="SupID" class="form-control" id="SupID" value="'.$row['SupID'].'" disabled>
            </div>
            <div class="col-md-2">
                <label for="DeptID" class="form-label">Department ID</label>
                <input type="text" name="DeptID" class="form-control" id="DeptID" value="'.$row['DeptID'].'" disabled>
            </div>
            </div>
            <div class="col">
                <label for="Address" class="form-label">Address</label>
                <input type="text" name="Address" class="form-control" id="Address" value="'.$row['Address'].'" disabled>
            </div>
        </form>';  
        
        $sql = "SELECT `EmpID`, `ProjID`, `Hours` FROM `workson` WHERE EmpID='$empid'";
        $result = mysqli_query($con, $sql);

        echo
        '<table class="table">
            <thead>
            <tr>
                <th scope="col">ProjID</th>
                <th scope="col">Hours</th>
            </tr>
            </thead>
            <tbody>';
        while($row = mysqli_fetch_assoc($result)){
            echo 
            '
            <tr>
                <th scope="row">'.$row['ProjID'].'</th>
                <td scope="row">'.$row['Hours'].'</td>
            </tr>';
        }
        echo 
        '</tbody>
        </table>';
        
        ?>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>