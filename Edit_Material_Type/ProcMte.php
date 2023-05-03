<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');

$Auto_number = $_POST['Auto_number'];
$MaterialType_id = $_POST['MaterialType_id'];
$MaterialType_name = $_POST['MaterialType_name'];
$sql = "UPDATE material_type SET  MaterialType_name = '$MaterialType_name' WHERE MaterialType_id = '$MaterialType_id'";


$result = mysqli_query($con, $sql) or die("เกิดข้อผิดพลาดเกิดขึ้น");
if ($result) {
    echo "<script type='text/javascript'>";
    echo "alert('แก้ไขข้อมูลเรียบร้อยแล้ว');";
    echo "window.location.href='../Material_Type.php';";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "alert('บางอย่างผิดพลาด! กรุณาลองอีกครั้ง!');";
    echo "window.location.href='Edit_Material_Type.php';";
    echo "</script>";
}

exit();
?>
