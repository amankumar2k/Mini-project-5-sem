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
    <div class="info" class="container">
    <form action="hrSalary.php" method="post">
        <input type="hidden" name="action" value="search"/>
        <div class="mb-3">
            <label for="searchID" class="form-label">Employee ID</label>
            <input type="text" name="searchID" class="form-control" id="searchID" placeholder="E0000000">
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
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
                
                $sql = "SELECT EmpID, EmpName, Salary FROM employee WHERE EmpID='$searchid'";
            
                $result = mysqli_query($conn, $sql);

                $num = mysqli_num_rows($result);
                echo 'No of Employees: '. $num;
                
                echo 
                '<table class="table">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Salary</th>
                        <th scope="col">Increment</th>
                    </tr>
                    </thead>
                    <tbody>';
                while($row = mysqli_fetch_assoc($result)){
                    echo 
                    '
                    <tr>
                        <th scope="row">'.$row['EmpID'].'</th>
                        <td>'.$row['EmpName'].'</td>
                        <td>'.$row['Salary'].'</td>
                        <td>
                            <form action="empIncrSal.php" method="post">
                                <input type="hidden" name="EmpID" value="'.$row['EmpID'].'">
                                <button type="submit">I</button>
                            </form>
                        </td>
                    </tr>';
                }
              }
            }
      ?>
    </div>
  </div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>