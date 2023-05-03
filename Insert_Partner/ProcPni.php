<?php
require('C:\xampp\XAMXUN\htdocs\webLathe\config\condb.php');
$Auto_number = $_POST['Auto_number'];
$Partner_id = $_POST['Partner_id'];
$Prefix_id = $_POST['Prefix_id'];
$Partner_name = $_POST['Partner_name'];
$Partner_surname	= $_POST['Partner_surname'];
$Partner_number = $_POST['Partner_number'];
$Partner_company = $_POST['Partner_company'];
  $sql = "INSERT INTO partner
  (
  Auto_number,
  Partner_id,
  Prefix_id,
  Partner_name,
  Partner_surname,
  Partner_number,
  Partner_company
  ) 
  VALUES
  (
  '$Auto_number',
  '$Partner_id',
  '$Prefix_id',
  '$Partner_name',
  '$Partner_surname',
  '$Partner_number',
  '$Partner_company'
  )";
    $result = mysqli_query($con, $sql) or die("เกิดข้อผิดพลาดเกิดขึ้น");
    if ($result) {
        echo "<script type='text/javascript'>";
        echo "alert('เพิ่มข้อมูลเรียบร้อยแล้ว');";
        echo "window.location.href='../Partner.php';";
        echo "</script>";
    } else {
        echo "<script type='text/javascript'>";
        echo "alert('บางอย่างผิดพลาด! กรุณาลองอีกครั้ง!');";
        echo "window.location.href='Insert_Partner.php';";
        echo "</script>";
    }
exit();
