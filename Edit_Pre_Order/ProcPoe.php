<?php
require('C:\xampp\XAMXUN\htdocs\Lathe_application\config\condb.php');

$Auto_number = $_POST['Auto_number'];
$PreOrder_id = $_POST['PreOrder_id'];
$PreOrder_day = $_POST['PreOrder_day'];
$PreOrder_detail = $_POST['PreOrder_detail'];
$PreOrder_quantity    = $_POST['PreOrder_quantity'];
$Unit_id = $_POST['Unit_id'];
$Customer_id = $_POST['Customer_id'];
$Employee_id = $_POST['Employee_id'];
$sql = "UPDATE Pre_Order SET  PreOrder_day = '$PreOrder_day',PreOrder_detail = '$PreOrder_detail',PreOrder_quantity = '$PreOrder_quantity',Unit_id = '$Unit_id',Customer_id = '$Customer_id',Employee_id = '$Employee_id' WHERE PreOrder_id = '$PreOrder_id'";
$result = mysqli_query($con, $sql) or die("เกิดข้อผิดพลาดเกิดขึ้น");
if ($result) {
    echo "<script type='text/javascript'>";
    echo "alert('แก้ไขข้อมูลเรียบร้อยแล้ว');";
    echo "window.location.href='../Pre_Order.php';";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "alert('บางอย่างผิดพลาด! กรุณาลองอีกครั้ง!');";
    echo "window.location.href='Edit_Pre_Order.php';";
    echo "</script>";
}

exit();
