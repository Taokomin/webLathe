<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
$BuyMaterial_id = $_POST['BuyMaterial_id'];
$BuyMaterial_day = $_POST['BuyMaterial_day'];
$Partner_id = $_POST['Partner_id'];


$BuyMaterial_detail = $_POST['BuyMaterial_detail'];
$BuyMaterial_quantity = $_POST['BuyMaterial_quantity'];
$Counting_unit = $_POST['Counting_unit'];

$sql = "UPDATE buy_material SET  
BuyMaterial_day = '$BuyMaterial_day',
Partner_id = '$Partner_id'
WHERE BuyMaterial_id = '$BuyMaterial_id'";
$result1 = mysqli_query($con, $sql);


$sql1 = "UPDATE buy_material_detail SET  
BuyMaterial_detail = '$BuyMaterial_detail',
BuyMaterial_quantity = '$BuyMaterial_quantity',
Counting_unit = '$Counting_unit'
WHERE BuyMaterial_id = '$BuyMaterial_id'";
$result2 = mysqli_query($con, $sql1);


if ($result1 && $result2) {
    echo "<script type='text/javascript'>";
    echo "alert('แก้ไขข้อมูลเรียบร้อยแล้ว');";
    echo "window.location.href='../Buy_Material.php';";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "alert('บางอย่างผิดพลาด! กรุณาลองอีกครั้ง!');";
    echo "window.location.href='Edit_Buy_Material.php';";
    echo "</script>";
}

exit();
