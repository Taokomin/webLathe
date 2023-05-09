<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');

$AcceptMaterial_id = $_GET['AcceptMaterial_id'];
$AcceptMaterial_day = $_GET['AcceptMaterial_day'];
$Partner_id = $_GET['Partner_id'];
$Employee_id = $_GET['Employee_id'];

$AcceptMaterial_detail_id = $_GET['AcceptMaterial_detail_id'];
$AcceptMaterial_detail = $_GET['AcceptMaterial_detail'];
$AcceptMaterial_quantity = $_GET['AcceptMaterial_quantity'];
$Counting_unit = $_GET['Counting_unit'];
$AcceptMaterial_price = $_GET['AcceptMaterial_price'];
$Price_unit = $_GET['Price_unit'];
$MaterialType_id = $_GET['MaterialType_id'];

$sql = "SELECT Material_quantity, Material_price FROM material WHERE Material_id = '$AcceptMaterial_detail'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$Material_quantity = $row['Material_quantity'];
$Material_price = $row['Material_price'];

$remaining_Material_quantity = $Material_quantity + $AcceptMaterial_quantity;

$sql1 = "UPDATE material SET Material_price = '$AcceptMaterial_price' WHERE Material_id = '$AcceptMaterial_detail'";
mysqli_query($con, $sql1);
$sql2 = "UPDATE material SET Material_quantity = '$remaining_Material_quantity' WHERE Material_id = '$AcceptMaterial_detail'";
mysqli_query($con, $sql2);

$sql3 = "INSERT INTO accept_material (
    AcceptMaterial_id,
    AcceptMaterial_day,
    Partner_id,
    Employee_id
) 
VALUES (
    '$AcceptMaterial_id',
    '$AcceptMaterial_day',
    '$Partner_id',
    '$Employee_id'
)";

$sql4 = "INSERT INTO accept_material_detail (
        AcceptMaterial_detail_id,
        AcceptMaterial_detail,
        AcceptMaterial_quantity,
        Counting_unit,
        AcceptMaterial_price,
        Price_unit,
        MaterialType_id,
        AcceptMaterial_id
    ) 
    VALUES (
        '$AcceptMaterial_detail_id',
        '$AcceptMaterial_detail',
        '$AcceptMaterial_quantity',
        '$Counting_unit',
        '$AcceptMaterial_price',
        '$Price_unit',
        '$MaterialType_id',
        '$AcceptMaterial_id'
    )";

$result = mysqli_query($con, $sql3) && mysqli_query($con, $sql4) or die("เกิดข้อผิดพลาดเกิดขึ้น");
if ($result) {
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
