<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "ERS";

$con = mysqli_connect($server, $username, $password, $database);
if (!$con){
    echo '
    <script>
        alert("Database Error");
    </script>
    ';
}
?>