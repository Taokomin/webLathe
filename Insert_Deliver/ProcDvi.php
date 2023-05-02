<?php
require('C:\xampp\XAMXUN\htdocs\Lathe_application\config\condb.php');
$Auto_number = $_GET['Auto_number'];
$Deliver_id = $_GET['Deliver_id'];
$Deliver_day = $_GET['Deliver_day'];
$PreOrder_id = $_GET['PreOrder_id'];
$PreOrder_day	= $_GET['PreOrder_day'];
$PreOrder_detail = $_GET['PreOrder_detail'];
$PreOrder_quantity = $_GET['PreOrder_quantity'];
$Unit_id = $_GET['Unit_id'];
$Customer_id = $_GET['Customer_id'];
$Deliver_address = $_GET['Deliver_address'];
$Employee_id = $_GET['Employee_id'];
  $sql = "INSERT INTO deliver
  (
  Auto_number,
  Deliver_id,
  Deliver_day,
  PreOrder_id,
  PreOrder_day,
  PreOrder_detail,
  PreOrder_quantity,
  Unit_id,
  Customer_id,
  Deliver_address,
  Employee_id
  ) 
  VALUES
  (
  '$Auto_number',
  '$Deliver_id',
  '$Deliver_day',
  '$PreOrder_id',
  '$PreOrder_day',
  '$PreOrder_detail',
  '$PreOrder_quantity',
  '$Unit_id',
  '$Customer_id',
  '$Deliver_address',
  '$Employee_id'
  )";
    $result = mysqli_query($con, $sql) or die("เกิดข้อผิดพลาดเกิดขึ้น");
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
