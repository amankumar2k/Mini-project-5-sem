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
    <title>Projects</title>
</head>
<body>
<div class="wrapper">
  <div class="sidebar">
    <h2><?php echo $_SESSION['username'];?></h2>
    <ul>
      <li><a href="mgr.php"><i class="fas fa-home"></i>Home</a></li>
      <li><a href="mgrEmp.php"><i class="fas fa-user"></i>Employees</a></li>
      <li style="background-color: #594f8d"><a href="mgrPro.php"><i class="fa fa-address-card"></i>Projects</a></li>
      <li><a href="../logout.php"><i class="fas fa-address-book"></i>Logout</a></li>
    </ul>

  </div>
  <div class="main_content">
    <div class="header">Projects</div>
    <div class="info" class="container">
      <form action="mgrPro.php" method="post">
            <input type="hidden" name="action" value="search"/>
            <div class="mb-3">
                <label for="searchID" class="form-label">Employee ID</label>
                <input type="text" name="searchID" class="form-control" id="searchID" placeholder="E0000000">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
        <br>
        <form action="mgrPro.php" method="post">
            <input type="hidden" name="action" value="all">
            <button type="submit" class="btn btn-primary">View All</button>
        </form>
        <br>
        <form action="proIns.php" method="post">
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
      <?php
      include "../_dbERS.php";
      $dno = $_SESSION['dno'];

      if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $action = $_POST['action'];

        if ($action == 'all'){
          $sql = "SELECT `ProjID`, `ProjName`, `ProjLoc`, `ProjBudg`, `StartDate`, `DueDate`, `DeptID` FROM `project` WHERE DeptId='$dno'";
          $result = mysqli_query($con, $sql);

          $num = mysqli_num_rows($result);
          echo "No of Projects: ". $num;

          echo '
          <table class="table">
            <thead>
              <tr>
                <th scope="col">ProjID</th>
                <th scope="col">ProjName</th>
                <th scope="col">ProjLoc</th>
                <th scope="col">ProjBudg</th>
                <th scope="col">StartDate</th>
                <th scope="col">DueDate</th>
                <th scope="col">DeptID</th>
                <th scope="col">View</th>
                <th scope="col">Assign Employee</th>
              </tr>
            </thead>
            <tbody>
          ';
          while($row = mysqli_fetch_assoc($result)){
            echo '
              <tr>
                <td>'.$row['ProjID'].'</td>
                <td>'.$row['ProjName'].'</td>
                <td>'.$row['ProjLoc'].'</td>
                <td>'.$row['ProjBudg'].'</td>
                <td>'.$row['StartDate'].'</td>
                <td>'.$row['DueDate'].'</td>
                <td>'.$row['DeptID'].'</td>
                <td>
                <form action="proView.php" method="post">
                  <input type="hidden" name="projid" value="'.$row['ProjID'].'">
                  <button type="submit">V</button>
                </form>
                </td>
                <td>
                  <form action="workson.php" method="post">
                    <input type="hidden" name="projid" value="'.$row['ProjID'].'">
                    <button type="submit">A</button>
                  </form>
                </td>
              </tr>
            ';  
          }
          echo '
          </tbody>
          </table>';
        }

        if ($action == 'search'){
          $searchid = $_POST['searchID'];
          $sql = "SELECT `ProjID`, `ProjName`, `ProjLoc`, `ProjBudg`, `StartDate`, `DueDate`, `DeptID` FROM `project` WHERE ProjID='$searchid'";
          $result = mysqli_query($con, $sql);

          $num = mysqli_num_rows($result);
          echo "No of Projects: ". $num;

          echo '
          <table class="table">
            <thead>
              <tr>
                <th scope="col">ProjID</th>
                <th scope="col">ProjName</th>
                <th scope="col">ProjLoc</th>
                <th scope="col">ProjBudg</th>
                <th scope="col">StartDate</th>
                <th scope="col">DueDate</th>
                <th scope="col">DeptID</th>
              </tr>
            </thead>
            <tbody>
          ';
          while($row = mysqli_fetch_assoc($result)){
            echo '
              <tr>
                <th scope="row">1</th>
                <td>'.$row['ProjID'].'</td>
                <td>'.$row['ProjName'].'</td>
                <td>'.$row['ProjLoc'].'</td>
                <td>'.$row['ProjBudg'].'</td>
                <td>'.$row['StartDate'].'</td>
                <td>'.$row['DueDate'].'</td>
                <td>'.$row['DeptID'].'</td>
              </tr>
            ';  
          }
          echo '
          </tbody>
          </table>';
        }
      }

      ?>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>