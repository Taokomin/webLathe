<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');

$ID = $_POST['ID'];
$Username = $_POST['Username'];
$Password = $_POST['Password'];
$Employee_id = $_POST['Employee_id'];
$License_id = $_POST['License_id'];



$sql = "UPDATE unit SET  Username = '$Username',Password = '$Password',Employee_id = '$Employee_id',License_id = '$License_id' WHERE ID  = '$ID '";
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
