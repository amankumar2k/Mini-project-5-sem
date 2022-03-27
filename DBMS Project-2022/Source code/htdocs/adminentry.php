<?php
include '_dbconsession.php';
$username = "admin";
$password = "admin";
$role = "admin";
$hash = password_hash($password, PASSWORD_DEFAULT);
$sql = "INSERT INTO `user`(`username`, `password`, `role`, `Eid`, `dno`) VALUES ('$username','$hash','$role',NULL, 0 )";
$result = mysqli_query($conn, $sql);
?>

<?php
include '_dbconsession.php';
$username = "mgr1";
$password = "mgr1";
$role = "mgr";
$EmpID = "M001";
$hash = password_hash($password, PASSWORD_DEFAULT);
$sql = "INSERT INTO `user`(`username`, `password`, `role`, `Eid`, `dno`) VALUES ('$username','$hash','$role','$EmpID', 1 )";
$result = mysqli_query($conn, $sql);
?>
<?php
include '_dbconsession.php';
$username = "mgr2";
$password = "mgr2";
$role = "mgr";
$EmpID = "M002";
$hash = password_hash($password, PASSWORD_DEFAULT);
$sql = "INSERT INTO `user`(`username`, `password`, `role`, `Eid`, `dno`) VALUES ('$username','$hash','$role','$EmpID', 2 )";
$result = mysqli_query($conn, $sql);
?>
<?php
include '_dbconsession.php';
$username = "mgr3";
$password = "mgr3";
$role = "mgr";
$EmpID = "M003";
$hash = password_hash($password, PASSWORD_DEFAULT);
$sql = "INSERT INTO `user`(`username`, `password`, `role`, `Eid`, `dno`) VALUES ('$username','$hash','$role','$EmpID', 3 )";
$result = mysqli_query($conn, $sql);
?>
<?php
include '_dbconsession.php';
$username = "mgr4";
$password = "mgr4";
$role = "mgr";
$EmpID = "M004";
$hash = password_hash($password, PASSWORD_DEFAULT);
$sql = "INSERT INTO `user`(`username`, `password`, `role`, `Eid`, `dno`) VALUES ('$username','$hash','$role','$EmpID', 4 )";
$result = mysqli_query($conn, $sql);
?>

<?php
include '_dbconsession.php';
$username = "hr1";
$password = "hr1";
$role = "hr";
$EmpID = "H001";
$hash = password_hash($password, PASSWORD_DEFAULT);
$sql = "INSERT INTO `user`(`username`, `password`, `role`, `Eid`, `dno`) VALUES ('$username','$hash','$role','$EmpID', 1 )";
$result = mysqli_query($conn, $sql);
?>
<?php
include '_dbconsession.php';
$username = "hr2";
$password = "hr2";
$role = "hr";
$EmpID = "H002";
$hash = password_hash($password, PASSWORD_DEFAULT);
$sql = "INSERT INTO `user`(`username`, `password`, `role`, `Eid`, `dno`) VALUES ('$username','$hash','$role','$EmpID', 2 )";
$result = mysqli_query($conn, $sql);
?>
<?php
include '_dbconsession.php';
$username = "hr3";
$password = "hr3";
$role = "hr";
$EmpID = "H003";
$hash = password_hash($password, PASSWORD_DEFAULT);
$sql = "INSERT INTO `user`(`username`, `password`, `role`, `Eid`, `dno`) VALUES ('$username','$hash','$role','$EmpID', 3 )";
$result = mysqli_query($conn, $sql);
?>
<?php
include '_dbconsession.php';
$username = "hr4";
$password = "hr4";
$role = "hr";
$EmpID = "H004";
$hash = password_hash($password, PASSWORD_DEFAULT);
$sql = "INSERT INTO `user`(`username`, `password`, `role`, `Eid`, `dno`) VALUES ('$username','$hash','$role','$EmpID', 4 )";
$result = mysqli_query($conn, $sql);
?>