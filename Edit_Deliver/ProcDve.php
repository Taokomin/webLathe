<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
$Deliver_id = $_POST['Deliver_id'];
$Deliver_day = $_POST['Deliver_day'];
$Deliver_address = $_POST['Deliver_address'];

$sql = "UPDATE deliver SET Deliver_day = '$Deliver_day', Deliver_address = '$Deliver_address' WHERE Deliver_id = '$Deliver_id'";

$result = mysqli_query($con, $sql) or die("เกิดข้อผิดพลาดเกิดขึ้น");
if ($result) {
    echo "<script type='text/javascript'>";
    echo "alert('แก้ไขข้อมูลเรียบร้อยแล้ว');";
    echo "window.location.href='../Deliver.php';";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "alert('บางอย่างผิดพลาด! กรุณาลองอีกครั้ง!');";
    echo "window.location.href='Edit_Deliver.php';";
    echo "</script>";
}

exit();
