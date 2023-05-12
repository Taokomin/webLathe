<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');

$PickupMaterial_id = $_POST['PickupMaterial_id'];
$PickupMaterial_day = $_POST['PickupMaterial_day'];
$Employee_id = $_POST['Employee_id'];
$PickupMaterial_status = $_POST['PickupMaterial_status'];


$PickupMaterial_detail_id = $_POST['PickupMaterial_detail_id'];
$PickupMaterial_detail = $_POST['PickupMaterial_detail'];
$PickupMaterial_quantity = $_POST['PickupMaterial_quantity'];
$Counting_unit = $_POST['Counting_unit'];
$MaterialType_id = $_POST['MaterialType_id'];


$sql = "SELECT Material_quantity FROM material WHERE Material_id = '$PickupMaterial_detail'";
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

$sql1 = "INSERT INTO pickup_material (PickupMaterial_id,PickupMaterial_day,Employee_id,PickupMaterial_status) 
        VALUES ('$PickupMaterial_id','$PickupMaterial_day','$Employee_id','$PickupMaterial_status')";

$sql2 = "INSERT INTO pickup_material_detail (PickupMaterial_detail_id,PickupMaterial_detail,PickupMaterial_quantity,Counting_unit,MaterialType_id, PickupMaterial_id) 
VALUES ('$PickupMaterial_detail_id','$PickupMaterial_detail','$PickupMaterial_quantity','$Counting_unit','$MaterialType_id', '$PickupMaterial_id')";

$sql3 = "UPDATE material SET Material_quantity ='$remaining_Material_quantity' WHERE Material_id = '$PickupMaterial_detail'";

if (mysqli_query($con, $sql1) && mysqli_query($con, $sql2) && mysqli_query($con, $sql3)) {
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
