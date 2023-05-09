<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');

$Auto_number = $_POST['Auto_number'];
$Material_id = $_POST['Material_id'];
$Material_name = $_POST['Material_name'];
$Material_quantity = $_POST['Material_quantity'];
$Counting_unit    = $_POST['Counting_unit'];
$MaterialType_id = $_POST['MaterialType_id'];
$Material_price = $_POST['Material_price'];
$Price_unit = $_POST['Price_unit'];

$sql = "UPDATE material SET  Material_name = '$Material_name',Material_quantity = '$Material_quantity',Counting_unit = '$Counting_unit',MaterialType_id = '$MaterialType_id',Material_price = '$Material_price',Price_unit = '$Price_unit' WHERE Material_id = '$Material_id'";


$result = mysqli_query($con, $sql) or die("เกิดข้อผิดพลาดเกิดขึ้น");
if ($result) {
    echo "<script type='text/javascript'>";
    echo "alert('แก้ไขข้อมูลเรียบร้อยแล้ว');";
    echo "window.location.href='../Material.php';";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "alert('บางอย่างผิดพลาด! กรุณาลองอีกครั้ง!');";
    echo "window.location.href='Edit_Material.php';";
    echo "</script>";
}

exit();
