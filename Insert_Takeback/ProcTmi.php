<?php
require('C:\xampp\XAMXUN\htdocs\Lathe_application\config\condb.php');
$Auto_number = $_GET['Auto_number'];
$Takeback_id = $_GET['Takeback_id'];
$Takeback_day = $_GET['Takeback_day'];

$PickupMaterial_id = $_GET['PickupMaterial_id'];
$PickupMaterial_day     = $_GET['PickupMaterial_day'];
$Material_name = $_GET['Material_name'];
$Takeback_quantity = $_GET['Takeback_quantity'];
$Unit_id = $_GET['Unit_id'];
$MaterialType_id = $_GET['MaterialType_id'];
$Employee_id = $_GET['Employee_id'];

$PickupMaterial_quantity = $_GET['PickupMaterial_quantity'];

$Material_id = $_GET['Material_id'];

$sql = "SELECT Material_quantity FROM material WHERE Material_id = '$Material_id'";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $current_Material_quantity = $row["Material_quantity"];
    $default_Material_quantity = $current_Material_quantity + $PickupMaterial_quantity;
} else {
    echo "<script type='text/javascript'>";
    echo "alert('บางอย่างผิดพลาด! กรุณาลองอีกครั้ง!');";
    echo "window.location.href='Insert_Takeback.php';";
    echo "</script>";
    exit;
}

$remaining_Material_quantity = $current_Material_quantity + $Takeback_quantity;
$remaining_Pickup_quantity = $PickupMaterial_quantity - $Takeback_quantity;

if ($Takeback_quantity > $PickupMaterial_quantity) {
    echo "<script type='text/javascript'>";
    echo "alert('บางอย่างผิดพลาดเนื่องจากวัสดุและอุปกรณ์เกินต่อความต้องการ! กรุณาลองอีกครั้ง!');";
    echo "window.location.href='Insert_Takeback.php';";
    echo "</script>";
    exit;
}

$sql1 = "INSERT INTO takeback (Auto_number, Takeback_id, Takeback_day,PickupMaterial_id,PickupMaterial_day, Material_id,Material_name,PickupMaterial_quantity, Takeback_quantity, Unit_id, MaterialType_id, Employee_id) 
         VALUES ('$Auto_number', '$Takeback_id', '$Takeback_day', '$PickupMaterial_id', '$PickupMaterial_day', '$Material_id','$Material_name', '$PickupMaterial_quantity', '$Takeback_quantity', '$Unit_id', '$MaterialType_id', '$Employee_id')";

$sql2 = "UPDATE material SET Material_quantity = '$remaining_Material_quantity' WHERE Material_id = '$Material_id'";

$sql3 = "UPDATE pickup_material SET PickupMaterial_quantity = '$remaining_Pickup_quantity' WHERE PickupMaterial_id = '$PickupMaterial_id'";

if (mysqli_query($con, $sql1) && mysqli_query($con, $sql2) && mysqli_query($con, $sql3)) {
    echo "<script type='text/javascript'>";
    echo "alert('เพิ่มข้อมูลเรียบร้อยแล้ว');";
    echo "window.location.href='../Takeback.php';";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "alert('บางอย่างผิดพลาด! กรุณาลองอีกครั้ง!');";
    echo "window.location.href='Insert_Takeback.php';";
    echo "</script>";
}

mysqli_close($con);
exit();
