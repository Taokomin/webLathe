<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');

$Auto_number = $_POST['Auto_number'];
$PickupMaterial_id  = $_POST['PickupMaterial_id '];
$PickupMaterial_day = $_POST['PickupMaterial_day'];
$Material_id = $_POST['Material_id'];
$Material_name    = $_POST['Material_name'];
$PickupMaterial_quantity = $_POST['PickupMaterial_quantity'];
$Unit_id = $_POST['Unit_id'];
$MaterialType_id = $_POST['MaterialType_id'];
$Employee_id = $_POST['Employee_id'];
$PickupMaterial_status = $_POST['PickupMaterial_status'];


$sql = "UPDATE accept_material SET  PickupMaterial_day = '$PickupMaterial_day',
Material_id = '$Material_id',
Material_name = '$Material_name',
Unit_id = '$Unit_id',
PickupMaterial_quantity = '$PickupMaterial_quantity',
Unit_id = '$Unit_id',
MaterialType_id = '$MaterialType_id',
Employee_id = '$Employee_id',
PickupMaterial_status = '$PickupMaterial_status' 
WHERE 	PickupMaterial_id  = '$PickupMaterial_id'";


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
