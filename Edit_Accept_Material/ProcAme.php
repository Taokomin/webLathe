<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');

$AcceptMaterial_id = $_POST['AcceptMaterial_id'];
$AcceptMaterial_day = $_POST['AcceptMaterial_day'];

$sql = "UPDATE accept_material SET  
AcceptMaterial_day = '$AcceptMaterial_day'
WHERE AcceptMaterial_id = '$AcceptMaterial_id'";

$result = mysqli_query($con, $sql) or die("เกิดข้อผิดพลาดเกิดขึ้น");
if ($result) {
    echo "<script type='text/javascript'>";
    echo "alert('แก้ไขข้อมูลเรียบร้อยแล้ว');";
    echo "window.location.href='../Accept_Material.php';";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "alert('บางอย่างผิดพลาด! กรุณาลองอีกครั้ง!');";
    echo "window.location.href='Edit_Accept_Material.php';";
    echo "</script>";
}

exit();
