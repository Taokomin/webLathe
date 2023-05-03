<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
$Auto_number = $_POST['Auto_number'];
$Deliver_id = $_POST['Deliver_id'];
$Deliver_day = $_POST['Deliver_day'];
$PreOrder_day = $_POST['PreOrder_day'];
$PreOrder_detail = $_POST['PreOrder_detail'];
$PreOrder_quantity = $_POST['PreOrder_quantity'];
$Unit_id = $_POST['Unit_id'];
$Customer_id = $_POST['Customer_id'];
$Deliver_address = $_POST['Deliver_address'];
$Employee_id = $_POST['Employee_id'];
$sql = "UPDATE deliver SET Deliver_day = '$Deliver_day', Deliver_id = '$Deliver_id', PreOrder_day = '$PreOrder_day', PreOrder_detail = '$PreOrder_detail', Unit_id = '$Unit_id', Customer_id = '$Customer_id', Deliver_address = '$Deliver_address', Employee_id = '$Employee_id' WHERE Deliver_id = '$Deliver_id'";

$result = mysqli_query($con, $sql) or die("เกิดข้อผิดพลาดเกิดขึ้น");
if ($result) {
    echo "<script type='text/javascript'>";
    echo "alert('แก้ไขข้อมูลเรียบร้อยแล้ว');";
    echo "window.location.href='../Deliver.php';";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "alert('บางอย่างผิดพลาด! กรุณาลองอีกครั้ง!');";
    echo "window.location.href='Edit_Deliver.php';";
    echo "</script>";
}

exit();
