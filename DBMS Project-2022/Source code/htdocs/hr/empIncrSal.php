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
    <title>HR</title>
</head>
<body>
<div class="wrapper">
  <div class="sidebar">
    <h2><?php echo $_SESSION['username'];?></h2>
    <ul>
      <li><a href="hr.php"><i class="fas fa-home"></i>Home</a></li>
      <li><a href="hrEmp.php"><i class="fas fa-user"></i>Employee</a></li>
      <li style="background-color: #594f8d"><a href="hrSalary.php"><i class="fa fa-address-card"></i>Salary</a></li>
      <li><a href="../logout.php"><i class="fas fa-address-book"></i>Logout</a></li>
    </ul>

  </div>
  <div class="main_content">
    <div class="header">Welcome!! Have a nice day.</div>
    <div class="info">
    <?php
        include "../_dbERS.php";

        $empid = $_POST['EmpID'];
        
        $sql = "SELECT `EmpID`, `Comm`, `Prod`, `Crea`, `Inte`, `Punc`, `Atte`, `IncSaP`, `ImpCS`, `SettMSG`,  `Compete`, `PerGoals` FROM `pr` WHERE EmpID='$empid'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);

        echo
        '
        <br>
        <h4>Competencies: '.$row['Compete'].'</h4>
        <form class="row g-3">
            <div class="col">
                <label for="EmpID" class="form-label">Communication</label>
                <input type="number" name="EmpID" class="form-control" id="EmpID" value="'.$row['Comm'].'" disabled>
            </div>
            <div class="col">
                <label for="EmpName" class="form-label">Productivity</label>
                <input type="number" name="EmpName" class="form-control" id="EmpName" value="'.$row['Prod'].'" disabled>
            </div>
            <div class="col">
                <label for="DOB" class="form-label">Creativity</label>
                <input type="number" name="DOB" class="form-control" id="DOB" value="'.$row['Crea'].'" disabled>
            </div>
            <div class="col">
                <label for="Gender" class="form-label">Integrity</label>
                <input type="number" name="Phone" class="form-control" id="Gender" value="'.$row['Inte'].'" disabled>
            </div>
            <div class="col">
                <label for="Phone" class="form-label">Punctuality</label>
                <input type="number" name="Phone" class="form-control" id="Phone" value="'.$row['Punc'].'" disabled>
            </div>
            <div class="col">
                <label for="Salary" class="form-label">Attendance</label>
                <input type="number" step="0.01" name="Salary" class="form-control" id="Salary" value="'.$row['Atte'].'" disabled> 
            </div>
            <br>
            <div class="col">
                <label for="Salary" class="form-label">Attendance</label>
                <input type="number" step="0.01" name="Salary" class="form-control" id="Salary" value="'.$row['Atte'].'" disabled> 
            </div>
        </form>
        <br>
        <h4>Performance Goals: '.$row['PerGoals'].'</h4>
        <form class="row g-3">
            <div class="col">
                <label for="EmpID" class="form-label">Increasing Sales and Profit</label>
                <input type="number" name="EmpID" class="form-control" id="EmpID" value="'.$row['IncSaP'].'" disabled>
            </div>
            <div class="col">
                <label for="EmpName" class="form-label">Improving Customer Service</label>
                <input type="number" name="EmpName" class="form-control" id="EmpName" value="'.$row['ImpCS'].'" disabled>
            </div>
            <div class="col">
                <label for="DOB" class="form-label">Setting Monthly Sales Goals</label>
                <input type="number" name="DOB" class="form-control" id="DOB" value="'.$row['SettMSG'].'" disabled>
            </div>
        </form>';

        $sql = "SELECT Salary FROM employee WHERE EmpID='$empid'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        echo '
        <br>
        <h4>IncrSalary</h4>
        <form class="row g-3" action="empIncrSal.php" method="post">
            <input type="hidden" name="action" value="Increment">
            <input type="hidden" name="empid" value="'.$empid.'">
            <div class="col">
                <label for="EmpID" class="form-label">Salary</label>
                <input type="number" step="0.01" name="Salary" class="form-control" id="EmpID" value="'.$row['Salary'].'">
            </div>
            <button type="submit" class="btn btn-primary">Increment</button>
        </form>
        ';


        if($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['action']) and $_POST['action'] == 'Increment'){
            $empid = $_POST['empid'];
            $newsal = $_POST['Salary'];
            $sql = "UPDATE `employee` SET `Salary`='$newsal' WHERE `EmpID`='$empid'";
            $result = mysqli_query($con, $sql);

            echo
            '
            <script>
                alert ("The record has been updated");
                window.location.href = "hrSalary.php";
            </script>
            ';
        }

        
        ?>
    </div>
  </div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>