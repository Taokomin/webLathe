<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');

$Takeback_id = $_GET['Takeback_id'];
$Takeback_day = $_GET['Takeback_day'];
$Employee_id = $_GET['Employee_id'];

$Takeback_detail_id = $_GET['Takeback_detail_id'];
$Takeback_detail = $_GET['Takeback_detail'];
$Takeback_quantity = $_GET['Takeback_quantity'];
$Counting_unit = $_GET['Counting_unit'];
$MaterialType_id = $_GET['MaterialType_id'];
$Material_id = $_GET['Material_id'];
$PickupMaterial_quantity = $_GET['PickupMaterial_quantity'];
$PickupMaterial_detail_id = $_GET['PickupMaterial_detail_id'];



$sql = "SELECT Material_quantity FROM material WHERE Material_id = '$Material_id'";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $current_Material_quantity = $row["Material_quantity"];
    $default_Material_quantity = $current_Material_quantity + $Takeback_quantity;
} else {
    echo "<script type='text/javascript'>";
    echo "alert('บางอย่างผิดพลาด! กรุณาลองอีกครั้ง!');";
    echo "window.location.href='Insert_Takeback.php';";
    echo "</script>";
    exit;
}

$remaining_Material_quantity = $current_Material_quantity - $Takeback_quantity;
$remaining_Pickup_quantity = $PickupMaterial_quantity - $Takeback_quantity;

if ($Takeback_quantity > $PickupMaterial_quantity) {
    echo "<script type='text/javascript'>";
    echo "alert('บางอย่างผิดพลาดเนื่องจากวัสดุและอุปกรณ์เกินต่อความต้องการ! กรุณาลองอีกครั้ง!');";
    echo "window.location.href='Insert_Takeback.php';";
    echo "</script>";
    exit;
}

$sql1 = "INSERT INTO takeback (Takeback_id, Takeback_day, Employee_id) 
         VALUES ('$Takeback_id', '$Takeback_day', '$Employee_id')";

$sql2 = "INSERT INTO takeback_detail (Takeback_detail_id, Takeback_detail, Takeback_quantity, Counting_unit, MaterialType_id,Takeback_id) 
         VALUES ('$Takeback_detail_id', '$Takeback_detail', '$Takeback_quantity', '$Counting_unit', '$MaterialType_id', '$Takeback_id')";

$sql3 = "UPDATE material SET Material_quantity = '$remaining_Material_quantity' WHERE Material_id = '$Material_id'";

$sql4 = "UPDATE pickup_material_detail SET PickupMaterial_quantity = '$remaining_Pickup_quantity' WHERE PickupMaterial_detail_id = '$PickupMaterial_detail_id'";

if (mysqli_query($con, $sql1) && mysqli_query($con, $sql2) && mysqli_query($con, $sql3) && mysqli_query($con, $sql4)) {
    echo "<script type='text/javascript'>";
    echo "alert('เพิ่มข้อมูลเรียบร้อยแล้ว');";
    echo "window.location.href='../Takeback.php';";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "alert('บาง
อย่างผิดพลาด! กรุณาลองอีกครั้ง!');";
    echo "window.location.href='Insert_Takeback.php';";
    echo "</script>";
}

mysqli_close($con);
exit();
