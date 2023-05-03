<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');

$Auto_number = $_GET['Auto_number'];
$AcceptMaterial_id = $_GET['AcceptMaterial_id'];
$AcceptMaterial_day = $_GET['AcceptMaterial_day'];
$BuyMaterial_id = $_GET['BuyMaterial_id'];
$Material_id = $_GET['Material_id'];
$BuyMaterial_day = $_GET['BuyMaterial_day'];
$BuyMaterial_quantity = $_GET['BuyMaterial_quantity'];
$Unit_id = $_GET['Unit_id'];
$MaterialType_id = $_GET['MaterialType_id'];
$Partner_id = $_GET['Partner_id'];
$Employee_id = $_GET['Employee_id'];


$sql = "SELECT Material_quantity FROM material WHERE Material_id = '$Material_id'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$Material_quantity = $row['Material_quantity'];


$remaining_Material_quantity = $Material_quantity + $BuyMaterial_quantity;


$sql1 = "UPDATE material SET Material_quantity = '$remaining_Material_quantity' WHERE Material_id = '$Material_id'";
mysqli_query($con, $sql1);

$sql2 = "INSERT INTO accept_material (
    Auto_number,
    AcceptMaterial_id,
    AcceptMaterial_day,
    BuyMaterial_id,
    Material_id,
    BuyMaterial_day,
    BuyMaterial_quantity,
    Unit_id,
    MaterialType_id,
    Partner_id,
    Employee_id
) 
VALUES (
    '$Auto_number',
    '$AcceptMaterial_id',
    '$AcceptMaterial_day',
    '$BuyMaterial_id',
    '$Material_id',  
    '$BuyMaterial_day',
    '$BuyMaterial_quantity',
    '$Unit_id',
    '$MaterialType_id',
    '$Partner_id',
    '$Employee_id'
)";

if (mysqli_query($con, $sql2)) {
    echo "<script type='text/javascript'>";
    echo "alert('เพิ่มข้อมูลเรียบร้อยแล้ว');";
    echo "window.location.href='../Accept_Material.php';";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "alert('บางอย่างผิดพลาด! กรุณาลองอีกครั้ง!');";
    echo "window.location.href='Insert_Accept_Material.php';";
    echo "</script>";
}
exit();
