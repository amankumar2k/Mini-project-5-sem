<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Manager-EmpDet</title>
</head>
<body>
    <div class="container">
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
            }
    ?>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>