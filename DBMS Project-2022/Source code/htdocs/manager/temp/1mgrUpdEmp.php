<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Manager-EmpUpd</title>
</head>
<body>
    <div class="container">
        <form action="mgrUpdEmp.php" method="post">
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
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $action = $_POST["action"];
            

                if($action == "search"){
                    $searchid = $_POST["searchID"];
                    $sql = "SELECT `EmpID`, `EmpName`, `DOB`, `Address`, `Gender`, `Phone`, `Salary`, `SupID`, `DeptID` FROM `employee` WHERE `EmpID` = '$searchid'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    echo
                    '<form action="mgrUpdEmp.php" method="post">
                        <input type="hidden" name="action" value="update"/>
                        <input type="hidden" name="searchid" value="'.$searchid.'"/> 
                        <div class="mb-3">
                            <label for="EmpID" class="form-label">Employee ID</label>
                            <input type="text" name="EmpID" class="form-control" id="EmpID" value="'.$row['EmpID'].'">
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
                }

                if($action == "update"){
                    $searchid = $_POST['searchid'];
                    $empid = $_POST['EmpID'];
                    $empname = $_POST['EmpName'];
                    $dob = $_POST['DOB'];
                    $address = $_POST['Address'];
                    $gender = $_POST['Gender'];
                    $phone = $_POST['Phone'];
                    $salary = $_POST['Salary'];
                    $supid = $_POST['SupID'];
                    $deptid = $_POST['DeptID'];
                    $sql = "UPDATE `employee` SET `EmpID`='$empid',`EmpName`='$empname',`DOB`='$dob',`Address`='$address',`Gender`='$gender',`Phone`='$phone',`Salary`='$salary',`SupID`='$supid',`DeptID`='$deptid' WHERE `EmpID`='$searchid'";
                    $result = mysqli_query($conn, $sql);
                    
                    if($result){
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>The Record has been updated successfully</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                    }
                    else{
                        echo mysqli_error($conn);
                    }
                }
            }
        ?>
        
        
        
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>