<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
$PickupMaterial_id  = $_POST['PickupMaterial_id '];
$PickupMaterial_day = $_POST['PickupMaterial_day'];

$sql = "UPDATE pickup_material SET PickupMaterial_day = '$PickupMaterial_day' WHERE PickupMaterial_id  = '$PickupMaterial_id '";

$result = mysqli_query($con, $sql) or die("เกิดข้อผิดพลาดเกิดขึ้น");
if ($result) {
    echo "<script type='text/javascript'>";
    echo "alert('แก้ไขข้อมูลเรียบร้อยแล้ว');";
    echo "window.location.href='../Pickup_Material.php';";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "alert('บางอย่างผิดพลาด! กรุณาลองอีกครั้ง!');";
    echo "window.location.href='Edit_Pickup_Material.php';";
    echo "</script>";
}

exit();
