<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
$Deliver_id = $_GET['Deliver_id'];
$Deliver_day = $_GET['Deliver_day'];
$Deliver_address = $_GET['Deliver_address'];
$Employee_id = $_GET['Employee_id'];


$PreOrder_detail_id = $_GET['PreOrder_detail_id'];
$Deliver_detail_id = $_GET['Deliver_detail_id'];
$Deliver_detail = $_GET['Deliver_detail'];
$Deliver_quantity = $_GET['Deliver_quantity'];
$Counting_unit = $_GET['Counting_unit'];
$Deliver_price = $_GET['Deliver_price'];
$Price_unit = $_GET['Price_unit'];
$Customer_id = $_GET['Customer_id'];
$Deliver_id = $_GET['Deliver_id'];
$showTb = $_GET['showTb'];
$sql = "INSERT INTO deliver
  (
  Deliver_id,
  Deliver_day,
  Deliver_address,
  Employee_id
  ) 
  VALUES
  (
  '$Deliver_id',
  '$Deliver_day',
  '$Deliver_address',
  '$Employee_id'
  )";
$sql1 = "INSERT INTO deliver_detail
    (
    Deliver_detail_id,
    Deliver_detail,
    Deliver_quantity,
    Counting_unit,
    Deliver_price,
    Price_unit,
    Customer_id,
    Deliver_id,
    PreOrder_detail_id
    ) 
    VALUES
    (
    '$Deliver_detail_id',
    '$Deliver_detail',
    '$Deliver_quantity',
    '$Counting_unit',
    '$Deliver_price',
    '$Price_unit',
    '$Customer_id',
    '$Deliver_id',
    '$PreOrder_detail_id'
    )";

$sql3 = "UPDATE pre_order_detail SET showTb ='$showTb' WHERE PreOrder_detail_id = '$PreOrder_detail_id'";

$result = mysqli_query($con, $sql) && mysqli_query($con, $sql1)&& mysqli_query($con, $sql3) or die("เกิดข้อผิดพลาดเกิดขึ้น");
if ($result) {
    echo "<script type='text/javascript'>";
    echo "alert('เพิ่มข้อมูลเรียบร้อยแล้ว');";
    echo "window.location.href='../Deliver.php';";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "alert('บางอย่างผิดพลาด! กรุณาลองอีกครั้ง!');";
    echo "window.location.href='Insert_Deliver.php';";
    echo "</script>";
}
exit();
