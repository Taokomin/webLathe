<?php
require('C:\xampp\XAMXUN\htdocs\Lathe_application\config\condb.php');

$Auto_number = $_POST['Auto_number'];
$AcceptMaterial_id  = $_POST['AcceptMaterial_id '];
$AcceptMaterial_day = $_POST['AcceptMaterial_day'];
$Material_id = $_POST['Material_id'];
$BuyMaterial_day    = $_POST['BuyMaterial_day'];
$BuyMaterial_quantity = $_POST['BuyMaterial_quantity'];
$BuyMaterial_detail = $_POST['BuyMaterial_detail'];
$BuyMaterial_quantity = $_POST['BuyMaterial_quantity'];
$Unit_id = $_POST['Unit_id'];
$MaterialType_id = $_POST['MaterialType_id'];
$Partner_id = $_POST['Partner_id'];
$Employee_id = $_POST['Employee_id'];


$sql = "UPDATE accept_material SET  AcceptMaterial_day = '$AcceptMaterial_day',
Material_id = '$Material_id',
BuyMaterial_day = '$BuyMaterial_day',
BuyMaterial_detail = '$BuyMaterial_detail',
BuyMaterial_quantity = '$BuyMaterial_quantity',
Unit_id = '$Unit_id',
MaterialType_id = '$MaterialType_id',
BuyMaterial_quantity = '$BuyMaterial_quantity',
Partner_id = '$Partner_id',
Employee_id = '$Employee_id' 
WHERE 	AcceptMaterial_id  = '$AcceptMaterial_id'";


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
