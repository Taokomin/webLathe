<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');

$Auto_number = $_POST['Auto_number'];
$Takeback_id  = $_POST['Takeback_id '];
$Takeback_day = $_POST['Takeback_day'];
$PickupMaterial_id = $_POST['PickupMaterial_id'];
$PickupMaterial_day    = $_POST['PickupMaterial_day'];
$PickupMaterial_quantity = $_POST['PickupMaterial_quantity'];
$Material_id = $_POST['Material_id'];
$Material_name = $_POST['Material_name'];
$Takeback_quantity = $_POST['Takeback_quantity'];
$Unit_id = $_POST['Unit_id'];
$MaterialType_id = $_POST['MaterialType_id'];
$Employee_id = $_POST['Employee_id'];


$sql = "UPDATE accept_material SET  Takeback_day = '$Takeback_day',
PickupMaterial_id = '$PickupMaterial_id',
PickupMaterial_day = '$PickupMaterial_day',
Material_id = '$Material_id',
PickupMaterial_quantity = '$PickupMaterial_quantity',
Takeback_quantity = '$Takeback_quantity',
Unit_id = '$Unit_id',
Material_name = '$Material_name',
MaterialType_id = '$MaterialType_id',
Employee_id = '$Employee_id' 
WHERE 	Takeback_id  = '$Takeback_id'";


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
