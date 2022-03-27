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
    <h4><?php echo $_SESSION['dno'];?></h4>
    <ul>
      <li ><a href="admin.php"><i class="fas fa-home"></i><strong>Home</strong></a></li>
      <li><a href="editDept.php"><i class="fa fa-address-card"></i>Department</a></li>
      <li style="background-color: #594f8d"><a href="editMgrHr.php"><i class="fas fa-user"></i>Manager/HR</a></li>
      <li><a href="../logout.php"><i class="fas fa-address-book"></i>Logout</a></li>
    </ul>

  </div>
  <div class="main_content">
    <div class="header">Welcome!! Have a nice day.</div>
    <div class="info">
        <?php
        include "../_dbconsession.php";
        $empid = $_POST['EmpID'];

        $sql = "SELECT `username`, `password`, `role`, `Eid`, `dno` FROM `user` WHERE Eid='$empid'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        echo
        '<form action="updLoginMgrHr.php" method="post">
            <input type="hidden" name="action" value="update"/>
            <div class="mb-3">
                <label for="EmpID" class="form-label">Username</label>
                <input type="text" name="user" class="form-control" id="EmpID"  value="'.$row['username'].'">
            </div>
            <div class="mb-3">
            <label for="EmpName" class="form-label">Password</label>
            <input type="text" name="pass" class="form-control" id="EmpName">
            </div>
            <div class="mb-3">
                <label for="DOB" class="form-label">Role</label>
                <input type="text" name="role" class="form-control" id="DOB" value="'.$row['role'].'">
            </div>
            <div class="mb-3">
                <label for="Address" class="form-label">Employee ID</label>
                <input type="text" name="eid" class="form-control" id="Address" value="'.$row['Eid'].'">
            </div>
            <div class="mb-3">
                <label for="Phone" class="form-label">Department No</label>
                <input type="number" name="dno" class="form-control" id="Phone" value="'.$row['dno'].'">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>';
        
        if($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['action'])){
            $action = $_POST['action'];
            if($action == "update"){
                $user = $_POST['user'];
                $pass = $_POST['pass'];
                $role = $_POST['role'];
                $eid = $_POST['eid'];
                $dno = $_POST['dno'];
                $hash = password_hash($password, PASSWORD_DEFAULT); 
                $sql = "INSERT INTO `user`(`username`, `password`, `role`, `Eid`, `dno`) VALUES ('$user','$hash','$role','$eid','$dno')";
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