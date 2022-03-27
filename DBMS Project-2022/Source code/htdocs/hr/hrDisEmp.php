<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>HR-EmpDis</title>
</head>
<body>
    <div class="container">
        <form action="hrDisEmp.php" method="post">
            <input type="hidden" name="action" value="search"/>
            <div class="mb-3">
                <label for="searchID" class="form-label">Employee ID</label>
                <input type="text" name="searchID" class="form-control" id="searchID" placeholder="E0000000">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
        <br>
        <form action="hrDisEmp.php" method="post">
            <input type="hidden" name="action" value="all">
            <button type="submit" class="btn btn-primary">View All</button>
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
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                $action = $_POST['action'];

                if ($action == 'search'){
                    $searchid = $_POST['searchID'];
                    $sql = "SELECT `EmpID`, `EmpName`, `Phone`, `SupID`, `DeptID` FROM `employee` WHERE `EmpID`='$searchid'";
                }
                if ($action == 'all'){
                    $sql = "SELECT `EmpID`, `EmpName`, `Phone`, `SupID`, `DeptID` FROM `employee`";
                }
            

                $result = mysqli_query($conn, $sql);

                $num = mysqli_num_rows($result);
                echo 'No of Employees: '. $num;
                
                echo 
                '<table class="table">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Supervisor</th>
                        <th scope="col">Department</th>
                    </tr>
                    </thead>
                    <tbody>';
                while($row = mysqli_fetch_assoc($result)){
                    echo 
                    '
                    <tr>
                        <th scope="row">'.$row['EmpID'].'</th>
                        <td>'.$row['EmpName'].'</td>
                        <td>'.$row['Phone'].'</td>
                        <td>'.$row['SupID'].'</td>
                        <td>'.$row['DeptID'].'</td>
                    </tr>';
                }
                echo 
                '</table>';
            }
        ?>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>