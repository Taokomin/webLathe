<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
$Takeback_id = $_POST['Takeback_id'];
$Takeback_day = $_POST['Takeback_day'];

$sql = "UPDATE pickup_material SET Takeback_day = '$Takeback_day' WHERE Takeback_id = '$Takeback_id'";

$result = mysqli_query($con, $sql) or die("เกิดข้อผิดพลาดเกิดขึ้น");
if ($result) {
    echo "<script type='text/javascript'>";
    echo "alert('แก้ไขข้อมูลเรียบร้อยแล้ว');";
    echo "window.location.href='../Takeback.php';";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "alert('บางอย่างผิดพลาด! กรุณาลองอีกครั้ง!');";
    echo "window.location.href='Edit_Takeback.php';";
    echo "</script>";
}

exit();

