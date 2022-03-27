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
    <div class="info">
    <form action="editDept.php" method="post">
            <input type="hidden" name="action" value="search"/>
            <div class="mb-3">
                <label for="searchID" class="form-label">Department ID</label>
                <input type="number" name="searchID" class="form-control" id="searchID" placeholder="0">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
        <br>
        <form action="editDept.php" method="post">
            <input type="hidden" name="action" value="all">
            <button type="submit" class="btn btn-primary">View All</button>
        </form>
        <br>
        <form action="addDept.php" method="post">
            <button type="submit" class="btn btn-primary">Add</button>
        </form>


        <?php
            $servername = "localhost";
            $username = "root";
            $passworrd = "";
            $database = "ERS";
            $conn = mysqli_connect($servername, $username, $passworrd, $database);

            if(!$conn){
                die("Sorry we faiiled to connect: ". mysqli_connect_error());
            }
            /*else{
                echo "Connection was successful";
            }*/
            $sql='';

            $dno = $_SESSION['dno'];
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                $action = $_POST['action'];
                

                if ($action == 'search'){
                    $searchid = $_POST['searchID'];
                    
                    $sql = "SELECT `DeptID`, `DeptName`, `DeptLoc`, `MgrID`, `HRID` FROM `department` WHERE DeptID=$searchid";
                
                    $result = mysqli_query($conn, $sql);

                    $num = mysqli_num_rows($result);
                    echo 'No of Departments: '. $num;
                    
                    echo 
                    '<table class="table">
                        <thead>
                        <tr>
                            <th scope="col">DeptID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Location</th>
                            <th scope="col">Manager</th>
                            <th scope="col">HR</th>
                            <th scope="col">Update</th>
                            <th scope="col">Delete</th>
                        </tr>
                        </thead>
                        <tbody>';
                    while($row = mysqli_fetch_assoc($result)){
                        echo 
                        '
                        <tr>
                            <th scope="row">'.$row['DeptID'].'</th>
                            <td>'.$row['DeptName'].'</td>
                            <td>'.$row['DeptLoc'].'</td>
                            <td>'.$row['MgrID'].'</td>
                            <td>'.$row['HRID'].'</td>
                            <td>
                                <form action="deptUpdate.php" method="post">
                                    <input type="hidden" name="DeptID" value="'.$row['DeptID'].'">
                                    <button type="submit">U</button>
                                </form>
                            </td>
                            <td>
                                <form action="editDept.php" method="post">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="DeptID" value="'.$row['DeptID'].'">
                                    <button type="submit">D</button>
                                </form>
                            </td>
                        </tr>';
                    }
                    echo 
                    '</tbody>
                    </table>';
                }

                if ($action == 'delete'){
                    $DeptID = $_POST['DeptID'];
                    $sql = "DELETE FROM `department` WHERE `DeptID`='$DeptID'";
                    $result = mysqli_query($conn, $sql);
                }

                if ($action == 'all'){
                    $sql = "SELECT * from department";
                
                    $result = mysqli_query($conn, $sql);

                    $num = mysqli_num_rows($result);
                    echo 'No of Employees: '. $num;
                    
                    echo 
                    '<table class="table">
                        <thead>
                        <tr>
                            <th scope="col">DeptID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Location</th>
                            <th scope="col">Manager</th>
                            <th scope="col">HR</th>
                            <th scope="col">Update</th>
                            <th scope="col">Delete</th>
                        </tr>
                        </thead>
                        <tbody>';
                    while($row = mysqli_fetch_assoc($result)){
                        echo 
                        '
                        <tr>
                            <th scope="row">'.$row['DeptID'].'</th>
                            <td>'.$row['DeptName'].'</td>
                            <td>'.$row['DeptLoc'].'</td>
                            <td>'.$row['MgrID'].'</td>
                            <td>'.$row['HRID'].'</td>
                            <td>
                                <form action="deptUpdate.php" method="post">
                                    <input type="hidden" name="DeptID" value="'.$row['DeptID'].'">
                                    <button type="submit">U</button>
                                </form>
                            </td>
                            <td>
                                <form action="editDept.php" method="post">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="DeptID" value="'.$row['DeptID'].'">
                                    <button type="submit">D</button>
                                </form>
                            </td>
                        </tr>';
                    }
                    echo 
                    '</tbody>
                    </table>';
                }
            

                
            }
        ?>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>