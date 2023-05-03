<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
$Auto_number = $_POST['Auto_number'];
$BuyMaterial_id = $_POST['BuyMaterial_id'];
$BuyMaterial_day = $_POST['BuyMaterial_day'];
$Material_id	= $_POST['Material_id'];
$BuyMaterial_quantity = $_POST['BuyMaterial_quantity'];
$Unit_id = $_POST['Unit_id'];
$MaterialType_id  = $_POST['MaterialType_id'];
$Employee_id  = $_POST['Employee_id'];
$Partner_id  = $_POST['Partner_id'];
$BuyMaterial_status  = $_POST['BuyMaterial_status'];
$sql = "INSERT INTO buy_material
(
    Auto_number,
    BuyMaterial_id,
    BuyMaterial_day,
    Material_id,
    BuyMaterial_quantity,
    Unit_id,
    MaterialType_id,
    Employee_id,
    Partner_id,
    BuyMaterial_status
) 
VALUES
(
    '$Auto_number',
    '$BuyMaterial_id',
    '$BuyMaterial_day',
    '$Material_id',
    '$BuyMaterial_quantity',
    '$Unit_id',
    '$MaterialType_id',
    '$Employee_id',
    '$Partner_id',
    '$BuyMaterial_status'
)";
$result = mysqli_query($con, $sql) or die("เกิดข้อผิดพลาดเกิดขึ้น");
if ($result) {
    echo "<script type='text/javascript'>";
    echo "alert('เพิ่มข้อมูลเรียบร้อยแล้ว');";
    echo "window.location.href='../Buy_Material.php';";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "alert('บางอย่างผิดพลาด! กรุณาลองอีกครั้ง!');";
    echo "window.location.href='Insert_Material.php';";
    echo "</script>";
}
exit();
