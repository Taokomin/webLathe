<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
$Auto_number = $_POST['Auto_number'];
$Unit_id  = $_POST['Unit_id'];
$Unit_name = $_POST['Unit_name'];
$check = "SELECT Unit_name FROM unit  WHERE Unit_name = '$Unit_name' ";
$result = mysqli_query($con, $check) or die("เกิดข้อผิดพลาดเกิดขึ้น");
if (mysqli_num_rows($result) > 0) {
  echo "<script type='text/javascript'>";
  echo "alert(' ข้อมูลซ้ำ กรุณาเพิ่มใหม่อีกครั้ง !');";
  echo "window.location.href='Insert_Unit.php';";
  echo "</script>";
} else {
  $sql = "INSERT INTO unit
  (
  Auto_number,
  Unit_id,
  Unit_name
  ) 
  VALUES
  (
  '$Auto_number',
  '$Unit_id',
  '$Unit_name'
  )";
    $result = mysqli_query($con, $sql) or die("เกิดข้อผิดพลาดเกิดขึ้น");
    if ($result) {
        echo "<script type='text/javascript'>";
        echo "alert('เพิ่มข้อมูลเรียบร้อยแล้ว');";
        echo "window.location.href='../Unit.php';";
        echo "</script>";
    } else {
        echo "<script type='text/javascript'>";
        echo "alert('บางอย่างผิดพลาด! กรุณาลองอีกครั้ง!');";
        echo "window.location.href='Insert_Unit.php';";
        echo "</script>";
    }
  }
exit();