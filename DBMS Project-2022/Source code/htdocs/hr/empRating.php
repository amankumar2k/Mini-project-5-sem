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
    <title>Emp Rating</title>
</head>
<body>
<div class="wrapper">
  <div class="sidebar">
    <h2><?php echo $_SESSION['username'];?></h2>
    <ul>
      <li><a href="hr.php"><i class="fas fa-home"></i>Home</a></li>
      <li style="background-color: #594f8d"><a href="hrEmp.php"><i class="fas fa-user"></i>Employee</a></li>
      <li><a href="hrSalary.php"><i class="fa fa-address-card"></i>Salary</a></li>
      <li><a href="../logout.php"><i class="fas fa-address-book"></i>Logout</a></li>
    </ul>

  </div>
  <div class="main_content">
    <div class="header">Employee Rating</div>
    <div class="info" class="container">
        <?php
        include "../_dbERS.php";
        
        if ($_SERVER['REQUEST_METHOD']=='POST' and $_POST['action']=="empRate"){
        $empid = $_POST['EmpID'];
        $sql = "SELECT `EmpID`, `Comm`, `Prod`, `Crea`, `Inte`, `Punc`, `Atte`, `IncSaP`, `ImpCS`, `SettMSG` FROM `pr` WHERE EmpID='$empid'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);

        echo
        '
        <br>
        <h4>Competencies</h4>
        <form class="row g-3" action="empRating.php" method="post">
            <input type="hidden" name="action" value="Rate">
            <div class="col">
                <label for="EmpID" class="form-label">Communication</label>
                <input type="number" name="Comm" class="form-control" id="EmpID" value="'.$row['Comm'].'" min="1", max="5">
            </div>
            <div class="col">
                <label for="EmpName" class="form-label">Productivity</label>
                <input type="number" name="Prod" class="form-control" id="EmpName" value="'.$row['Prod'].'" min="1", max="5">
            </div>
            <div class="col">
                <label for="DOB" class="form-label">Creativity</label>
                <input type="number" name="Crea" class="form-control" id="DOB" value="'.$row['Crea'].'" min="1", max="5">
            </div>
            <div class="col">
                <label for="Gender" class="form-label">Integrity</label>
                <input type="number" name="Inte" class="form-control" id="Gender" value="'.$row['Inte'].'" min="1", max="5">
            </div>
            <div class="col">
                <label for="Phone" class="form-label">Punctuality</label>
                <input type="number" name="Punc" class="form-control" id="Phone" value="'.$row['Punc'].'" min="1", max="5">
            </div>
            <div class="col">
                <label for="Salary" class="form-label">Attendance</label>
                <input type="number" name="Atte" class="form-control" id="Salary" value="'.$row['Atte'].'" min="1", max="5"> 
            </div>
        <br>
        <h4>Performance Goals</h4>
            <div class="col">
                <label for="EmpID" class="form-label">Increasing Sales and Profit</label>
                <input type="number" name="IncSaP" class="form-control" id="EmpID" value="'.$row['IncSaP'].'" min="1", max="5">
            </div>
            <div class="col">
                <label for="EmpName" class="form-label">Improving Customer Service</label>
                <input type="number" name="ImpCS" class="form-control" id="EmpName" value="'.$row['ImpCS'].'" min="1", max="5">
            </div>
            <div class="col">
                <label for="DOB" class="form-label">Setting Monthly Sales Goals</label>
                <input type="number" name="SettMSG" class="form-control" id="DOB" value="'.$row['SettMSG'].'" min="1", max="5">
            </div>
            <div>
                <input type="hidden" name="EmpID" value="'.$row['EmpID'].'">
                <button type="submit">Update</button>
            </div>
        </form>';
        }

        if ($_SERVER['REQUEST_METHOD']=='POST' and $_POST['action']=="Rate"){
            $empid = $_POST['EmpID'];
            $Comm = $_POST['Comm'];
            $Prod = $_POST['Prod'];
            $Crea = $_POST['Crea'];
            $Inte = $_POST['Inte'];
            $Punc = $_POST['Punc'];
            $Atte = $_POST['Atte'];
            $IncSaP = $_POST['IncSaP']; 
            $ImpCS = $_POST['ImpCS'];
            $SettMSG = $_POST['SettMSG'];
            $sql = "UPDATE `pr` SET `Comm`=$Comm,`Prod`=$Prod,`Crea`=$Crea,`Inte`=$Inte,`Punc`=$Punc,`Atte`=$Atte,`IncSaP`=$IncSaP,`ImpCS`=$ImpCS,`SettMSG`=$SettMSG WHERE EmpID='$empid'";
            $result = mysqli_query($con, $sql);
            $sql2 = "CALL EmpPRIns('$empid', $Comm, $Prod, $Crea, $Inte, $Punc, $Atte, $IncSaP, $ImpCS, $SettMSG)";
            $result = mysqli_query($con, $sql2);
        }
        ?>
    </div>
    </div>
  </div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>