<?php
require('C:\xampp\XAMXUN\htdocs\Lathe_application\config\condb.php');

$Auto_number = $_GET['Auto_number'];
$PickupMaterial_id = $_GET['PickupMaterial_id'];
$PickupMaterial_day = $_GET['PickupMaterial_day'];
$Material_id = $_GET['Material_id'];
$Material_name = $_GET['Material_name'];
$PickupMaterial_quantity = $_GET['PickupMaterial_quantity'];
$Unit_id = $_GET['Unit_id'];
$MaterialType_id = $_GET['MaterialType_id'];
$Employee_id = $_GET['Employee_id'];
$PickupMaterial_status = $_GET['PickupMaterial_status'];


$sql = "SELECT Material_quantity FROM material WHERE Material_id = '$Material_id'";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $current_Material_quantity = $row["Material_quantity"];
} else {
    echo "<script type='text/javascript'>";
    echo "alert('บางอย่างผิดพลาด! กรุณาลองอีกครั้ง!');";
    echo "window.location.href='Insert_Pickup_Material.php';";
    echo "</script>";
    exit;
}

$remaining_Material_quantity = $current_Material_quantity - $PickupMaterial_quantity;

if ($remaining_Material_quantity < 0) {
    echo "<script type='text/javascript'>";
    echo "alert('บางอย่างผิดพลาดเนื่องจากวัสดุและอุปกรณ์มีไม่เพียงพอต่อความต้องการ! กรุณาลองอีกครั้ง!');";
    echo "window.location.href='Insert_Pickup_Material.php';";
    echo "</script>";
    exit;
}

$PickupMaterial_id = $_GET['PickupMaterial_id'];

$sql1 = "INSERT INTO pickup_material (Auto_number,PickupMaterial_id,PickupMaterial_day,Material_id, Material_name, PickupMaterial_quantity, Unit_id, MaterialType_id, Employee_id, PickupMaterial_status) 
        VALUES ('$Auto_number','$PickupMaterial_id','$PickupMaterial_day','$Material_id','$Material_name', '$PickupMaterial_quantity', '$Unit_id', '$MaterialType_id', '$Employee_id', '$PickupMaterial_status')";


$sql2 = "UPDATE material SET Material_quantity = '$remaining_Material_quantity' WHERE Material_id = '$Material_id'";


if (mysqli_query($con, $sql1) && mysqli_query($con, $sql2)) {
    echo "<script type='text/javascript'>";
    echo "alert('เพิ่มข้อมูลเรียบร้อยแล้ว');";
    echo "window.location.href='../Pickup_Material.php';";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "alert('บางอย่างผิดพลาด! กรุณาลองอีกครั้ง!');";
    echo "window.location.href='Insert_Pickup_Material.php';";
    echo "</script>";
}



mysqli_close($con);
exit();
