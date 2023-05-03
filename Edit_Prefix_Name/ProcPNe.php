<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');

$Auto_number = $_POST['Auto_number'];
$Prefix_id = $_POST['Prefix_id'];
$Prefix_name = $_POST['Prefix_name'];
$sql = "UPDATE prefix_name SET  Prefix_name = '$Prefix_name' WHERE Prefix_id = '$Prefix_id'";


$result = mysqli_query($con, $sql) or die("เกิดข้อผิดพลาดเกิดขึ้น");
if ($result) {
    echo "<script type='text/javascript'>";
    echo "alert('แก้ไขข้อมูลเรียบร้อยแล้ว');";
    echo "window.location.href='../Prefix_Name.php';";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "alert('บางอย่างผิดพลาด! กรุณาลองอีกครั้ง!');";
    echo "window.location.href='Edit_Prefix_Name.php';";
    echo "</script>";
}

exit();
?>
