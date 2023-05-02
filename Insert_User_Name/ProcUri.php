<?php
require('C:\xampp\XAMXUN\htdocs\Lathe_application\config\condb.php');

$ID = $_POST['ID'];
$Username = $_POST['Username'];
$Password = $_POST['Password'];
$Firstname = $_POST['Firstname'];
$Lastname 	= $_POST['Lastname'];
$Userlevel = $_POST['Userlevel'];

$sql = "INSERT INTO user (ID, Username, Password, Firstname, Lastname, Userlevel)
        VALUES ('$ID', '$Username', '$Password', '$Firstname', '$Lastname', '$Userlevel')";

if (mysqli_query($con, $sql)) {
    echo "<script type='text/javascript'>";
    echo "alert('เพิ่มข้อมูลเรียบร้อยแล้ว');";
    echo "window.location.href='../User.php';";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "alert('บางอย่างผิดพลาด! กรุณาลองอีกครั้ง!');";
    echo "window.location.href='Insert_User_Name.php';";
    echo "</script>";
}

exit();
