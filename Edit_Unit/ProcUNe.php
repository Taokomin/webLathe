<?php
require('C:\xampp\XAMXUN\htdocs\Lathe_application\config\condb.php');

$Auto_number = $_POST['Auto_number'];
$Unit_id  = $_POST['Unit_id'];
$Unit_name = $_POST['Unit_name'];
$sql = "UPDATE unit SET  Unit_name = '$Unit_name' WHERE Unit_id  = '$Unit_id '";


$result = mysqli_query($con, $sql) or die("เกิดข้อผิดพลาดเกิดขึ้น");
if ($result) {
    echo "<script type='text/javascript'>";
    echo "alert('แก้ไขข้อมูลเรียบร้อยแล้ว');";
    echo "window.location.href='../Unit.php';";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "alert('บางอย่างผิดพลาด! กรุณาลองอีกครั้ง!');";
    echo "window.location.href='Edit_Unit.php';";
    echo "</script>";
}

exit();
?>
